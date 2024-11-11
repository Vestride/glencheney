---
title: 'odopod.com'
date: '2016-09-01'
id: 3
href: 'https://www.odopod.com/'
tags:
  - build systems
  - maintenance
  - Node
imageDescription: "Screenshot of the Odopod home page. 'Hi, we’re Odopod — a digital design agency.'"
shortDescription: 'Odopod’s brand site runs on ExpressJS.'
---

Odopod’s brand site runs on ExpressJS.

## Old name, same company

When Nurun acquired Odopod, it became Nurun SF. In 2015, after some changes, Odopod was able to use the name again. The old Odopod site had grown outdated and we needed a new one.

## Backend

Odopod.com uses [Contentful](https://www.contentful.com) as the CMS. It is quite flexible and provides APIs for querying published (and draft) content and hosting for images and videos. The [`contentful`](https://www.npmjs.com/package/contentful) package fetches data when the Express server starts. Templates are written in [Pug](https://www.npmjs.com/package/pug) (formerly Jade). The site integrated with the Instagram API to search for @odopod photos with certain hashtags as well as the Jobvite API. We used [Cheerio](https://www.npmjs.com/package/cheerio) to parse the Jobvite response and modify it before displaying it.

## Frontend

webpack and Gulp are the frontend build system to bundle JS and CSS. I used webpack's code-splitting to create a commons bundle and page-specific bundles.

The common CSS and page-level CSS are loaded asynchronously to avoid blocking page rendering on load.

## Service workers

Google’s [Workbox](https://github.com/googlechrome/workbox) is fantastic. It makes implementing and managing a service worker simple.

### Precaching

The Workbox service worker allows us to precache all the webpack assets generated during the build process very easily.

```js
// Precache and provide routes for webpack assets.
workbox.precaching.precacheAndRoute(self.__precacheManifest || []);
```

### Runtime caching

Workbox also lets you set up runtime caching which only saves responses once the browser has requested it. This was useful for caching fonts because odopod.com serves a web font with the `.woff2` file type and a fallback `.woff` file. Only one of these font files should be cached; saving both is a waste of data. To accomplish this, we register a route looking for font files, then tell Workbox to use the cached version of the file when the browser wants it. If Workbox doesn’t have the file yet, it will fetch the font like normal and then store it.

```js
workbox.routing.registerRoute(
  /\.(?:woff|woff2)$/,
  workbox.strategies.cacheFirst({
    cacheName: 'fonts',
    plugins: [
      new workbox.expiration.Plugin({
        maxAgeSeconds: 30 * 24 * 60 * 60,
      }),
    ],
  }),
);
```

The odopod.com service worker also does runtime caching for images from odopod.com as well as images from Contentful with a maximum number of entries in the cache for each.

### Offline page

Since we already have a service worker, why not provide a simple “You’re offline” page to the user when there is no Internet connection? I created a new Pug template, added that page (`/offline`) to the assets that Workbox caches, and then watch for navigation events which fail.

```js
// Cache the offline page.
workbox.precaching.precache([{ url: '/offline', revision: '1' }]);

// Respond to navigation requests with the offline page if the fetch fails.
workbox.routing.registerRoute(
  ({ event }) => event.request.mode === 'navigate',
  ({ url }) => fetch(url.href).catch(() => caches.match('/offline')),
);
```
