---
title: "Compdrop"
date: "2017-09-01"
id: 7
href: "https://compdrop.io/"
tags:
  - open source
  - drag-n-drop
  - TypeScript
  - Vue
  - PWA
imageDescription: "Screenshot of the compdrop app without any files added yet."
shortDescription: "Compdrop is a drag and drop web app to view website designs in the browser."
---

Compdrop is a simple way to view website designs in a desktop browser. Just drag and drop your images into the browser.

## Improving the workflow

For design reviews, designers at Odopod would export their Photoshop files to jpgs (called "[comps](https://en.wikipedia.org/wiki/Comprehensive_layout)") on our internal server. They then gathered in a meeting room and pulled up the images in Preview.app to critique the work. In 2013, one of the developers built [cmpdrp.com](http://cmpdrp.com) as a drag-n-drop preview of the designs that automatically scaled them to actual size, showed the designs within a browser's chrome, and allowed clicking through them.

## PWA all the things!

Late in 2017 I had some idle time and really wanted to do something with Vue and TypeScript. I decided to rebuild the comp drop app, make it a <abbr title="Progressive Web App">PWA</abbr>, and add some new features to it.

I started off the project with a [Vue PWA scaffold](https://github.com/vuejs-templates/pwa) and added TypeScript to it. The PWA template handled all the service worker caching and offline needs and I started building the new Compdrop.

## New features

After soliciting feedback from the designers and watching how they used the old compdrop, I began to add new features to the app.

* Dropping a directory of images on the page instead of selecting all within a directory.
* Retina image scaling for designs done at 2x size.
* Added a mode which allowed images to be scrolled.
* New keyboard shortcuts.
* Added support for "collections". Designers used to open multiple tabs of cmpdrp, one for each person to show their work. Now they can drop multiple directories in, each one creates a collection.

<!-- markdownlint-disable MD033 -->
<video muted playsinline controls loop poster="/compdrop-poster.png">
  <source src="compdrop.webm" type="video/webm; codecs=vp9,vorbis">
  <source src="compdrop.mp4" type="video/mp4">
</video>

## Thoughts on Vue

Vue was nice to use, but it feels a little too "automagic" for my liking. Using the [`vue-class-component`](https://github.com/vuejs/vue-class-component) decorator was also enjoyable because I was accustomed to components in React. Vuex, the state management library for Vue, was very nice to use and easier for me to grok than Redux.
