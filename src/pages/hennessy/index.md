---
title: "hennessy.com"
date: "2017-08-10"
id: 1
href: "https://www.hennessy.com/us/"
tags:
  - build systems
  - maintenance
  - Preact
  - parallax scrolling
imageDescription: "Screenshot of hennessy.com/us/ home page with Marshall Taylor riding a bicycle."
shortDescription: "Mobile users dominate the US site for Hennessy."
---

This is the US site for Hennessy cognac. Odopod has been Hennessy’s digital partner since 2012 and it is one of the few sites Odopod has maintained over the years, allowing us to iterate and improve it over time.

More than 70% of traffic is from mobile devices, making performance and load times even more important.

## Modernizing the stack

The site is built with Django and the frontend was originally created by another vendor. Unfortunately, the frontend was built for a micro site and as more features and sections were added, it had trouble scaling. One main JS file used to import all the JavaScript for other pages using RequireJS and conditionally initialize it. Dependencies were hard to keep track of, there was a single massive JavaScript bundle sent to the client, and Compass was deeply entangled in the Ruby Sass code.

In 2016, Hennessy went through a design "revamp" and we started to move away from RequireJS with a small webpack build and ES6. We still had a single bundle and many scripts with RequireJS' `define` pattern, but we started to manage our dependencies with npm. We also started writing our CSS with SCSS instead of Sass.

During early 2017, I started work on modernizing the build system:

* Code-splitting creates a JS bundle per page, reducing the initial code the browser needed to download and parse.
* All dependencies are managed through npm.
* Everything is SCSS.
* Asynchronously load common and page-level CSS to avoid render-blocking.
* Dynamic imports (`import()`) for code not needed immediately on page load, like modals.
* Utilize `requestIdleCallback` to initialize sections of the page "below the fold" when the browser has a moment, preventing main thread unresponsiveness on page load.

## Notable projects

I've worked quite a bit on Hennessy. Most of it is still there, but some of the experience pages are gone. Here are some things that are still live:

### [Store Locator](https://www.hennessy.com/us/collection/master-blenders-selection-no-2/)

Using Google Maps and the addresses of locations which sell Hennessy, the user can find stores closest to them and all over the US. Click "Find a Store" to explore it. [permalink](https://www.hennessy.com/us/store-locator/#master-blenders-selection-no-2)

<!-- markdownlint-disable MD033 -->
<video muted playsinline controls loop poster="/hennessy-store-locator-poster.png">
  <source src="hennessy-store-locator.webm" type="video/webm; codecs=vp9,vorbis">
  <source src="hennessy-store-locator.mp4" type="video/mp4">
</video>

### [X.O The Odyssey](https://www.hennessy.com/us/xo-the-odyssey/)

A scroll-jacked experience page for one of Hennessy’s marks. It uses CSS 3D transforms to rotate slices of an image, kind of like a Rubix Cube.

<video muted playsinline controls loop poster="/the-odyssey-poster.png">
  <source src="the-odyssey.webm" type="video/webm; codecs=vp9,vorbis">
  <source src="the-odyssey.mp4" type="video/mp4">
</video>

### [Modular Campaign](https://www.hennessy.com/us/collection/vs/?reveal)

This section of the campaign features some parallax scrolling and temporary fixed positioning. CMS users add a header and then as many chapters and sections within those chapters as they want and an optional footer.

<video muted playsinline controls loop poster="/hennessy-modular-campaign-poster.png">
  <source src="hennessy-modular-campaign.webm" type="video/webm; codecs=vp9,vorbis">
  <source src="hennessy-modular-campaign.mp4" type="video/mp4">
</video>

### [Hennessy Academy](https://www.hennessy.com/us/heritage/academy/)

The Hennessy Essentials quiz is a Preact app and the other quizzes reuse some of the Preact components from the Essentials quiz. As simple as it is, I really like the Preact component I made for the sticky navigation which animates the titles as the user scrolls through sections of the page.

<video muted playsinline controls loop poster="/heritage-culture-poster.png">
  <source src="heritage-culture.webm" type="video/webm; codecs=vp9,vorbis">
  <source src="heritage-culture.mp4" type="video/mp4">
</video>

### [Cocktail Quiz](https://www.hennessy.com/us/cocktail-quiz/)

The cocktail quiz touched many parts of Hennessy, including the user accounts and lead to some good refactoring of cocktail product tiles. The quiz is also built with Preact.

<video muted playsinline controls loop poster="/hennessy-cocktail-quiz-poster.png">
  <source src="hennessy-cocktail-quiz.webm" type="video/webm; codecs=vp9,vorbis">
  <source src="hennessy-cocktail-quiz.mp4" type="video/mp4">
</video>
