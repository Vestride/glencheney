---
title: "cssnano"
date: "2017-09-01"
id: 8
href: "https://cssnano.herokuapp.com/"
tags:
  - open source
  - drag-n-drop
  - TypeScript
  - Node
imageDescription: "Landing page for the cssnano minifier application."
shortDescription: "Drag and drop css minification with cssnano."
---

Drag and drop css minification with cssnano.

## Convenient CSS minification

I built this small app because sometimes I need to minify CSS outside of a build system, for example, inlining CSS [normalize.css](https://github.com/necolas/normalize.css) into the `<head>` of a document. Other online CSS minifiers already exist, but none that use [cssnano](https://cssnano.co/). cssnano was packaged with webpack's [css-loader](https://github.com/webpack-contrib/css-loader) until it July 2018.

## Tech details

Unfortunately, even though `postcss` works in the browser, the `cssnano` package does not. After you drop a CSS file onto the page, a request is sent to the server to minify the CSS. [CodeMirror](https://codemirror.net/) then renders the response in a fullscreen editor, giving users the ability to copy the styles which were just minified.

The frontend is built with TypeScript and bundled with webpack. Since the `codemirror` and `clipboard` packages are only used after the user adds some CSS to minify, I use webpack's code-splitting with dynamic imports to load them after the app has initialized.

## CSS OMG

The UX of this app is inspired by [SVGOMG](https://jakearchibald.github.io/svgomg/) by Jake Archibald. I use SVGOMG all the time and being able to both paste code to minify and drag-n-drop a file is very handy.

<!-- markdownlint-disable MD033 -->
<video muted playsinline controls loop poster="/cssnano-minifier-poster.png">
  <source src="cssnano-minifier.webm" type="video/webm; codecs=vp9,vorbis">
  <source src="cssnano-minifier.mp4" type="video/mp4">
</video>
