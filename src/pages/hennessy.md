---
title: "hennessy.com"
date: "2017-08-10"
id: 1
href: "https://www.hennessy.com/us/"
imageDescription: "Screenshot of hennessy.com/us/ home page with Marshall Taylor riding a bicycle."
---

This is the US site for Hennessy cognac. Odopod has been Hennessy's digital partner since 2012 and it is one of the few sites Odopod has maintained over the years, allowing us to iterate and improve it over time.

## Modernizing the stack

The site is built with Django and the frontend was originally created by another vendor. Unfortunately, the frontend was built for a micro site and as more features and sections were added, it had trouble scaling. One main JS file used to import all the JavaScript for other pages using RequireJS and conditionally initialize it. Dependencies were hard to keep track of, there was a single massive JavaScript bundle sent to the client, and our Ruby Sass with Compass was a mess.

In 2016, Hennessy got a design "revamp" and we started to move away from RequireJS with a small webpack build and ES6. We still had a single bundle and many scripts with RequireJS' `define` pattern, but we started to manage our dependencies with npm. We also started writing our CSS with SCSS instead of Sass.

During early 2017, I started work on modernizing the build system:

* Code-splitting creates a JS bundle per page, reducing the initial code the browser needed to download and parse.
* All dependencies are managed through npm.
* Everything is SCSS.
* Asynchronously load common and page-level CSS to avoid render-blocking.
* Dynamic imports (`import()`) for code not needed immediately on page load, like modals.
* Utilize `requestIdleCallback` to initialize sections of the page "below the fold" when the browser has a moment, preventing main thread unresponsiveness on page load.

## Notable projects

I've worked quite a bit on Hennessy. Most of it is still there, but some of the experience pages are gone. Here are some things that are still live:

* [Store Locator](https://www.hennessy.com/us/collection/master-blenders-selection-no-2/) - Using Google Maps and the addresses of locations which sell Hennessy, the user can find stores closest to them and all over the US. Click "Find a Store" to explore it. [permalink](https://www.hennessy.com/us/store-locator/#master-blenders-selection-no-2)
* [X.O The Odyssey](https://www.hennessy.com/us/xo-the-odyssey/) - An experience page for one of Hennessy's marks. It uses CSS 3D transforms to rotate slices of an image, kind of like a Rubix Cube.
* [Modular Campaign](https://www.hennessy.com/us/collection/vs/?reveal) - This section of the campaign features some parallax scrolling and temporary fixed positioning. CMS users add a header and then as many chapters and sections within those chapters as they want and an optional footer.
* [Hennessy Academy](https://www.hennessy.com/us/heritage/academy/) - The Hennessy Essentials quiz is a Preact app and the other quizzes reuse some of the Preact components from the Essentials quiz.
* [Cocktail Quiz](https://www.hennessy.com/us/cocktail-quiz/) - The cocktail quiz touched many parts of Hennessy, including the user accounts and lead to some good refactoring of cocktail product tiles. The quiz is also built with Preact.
