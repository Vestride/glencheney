---
title: 'Odopod Code Library'
date: '2017-10-01'
id: 2
href: 'https://code.odopod.com/'
tags:
  - open source
  - components
imageDescription: 'Screenshot of the odopod code library directory page.'
shortDescription: 'A collection of vanilla JavaScript components used in Odopod web projects.'
---

A collection of vanilla JavaScript components used in Odopod web projects.

## 🐤 Beginnings

When I joined Odopod in 2012, there was a small set of jQuery plugins that were ported from project to project. Files were named with a version number at the end and, if we remembered, we updated the version number when changes were made to it.

This, however, was difficult to maintain and to determine what the latest version of the plugin was.

In 2013 and 2014, Odopod worked on two large projects: sony.com and store.google.com. Near the end of 2014 myself and a Senior Developer made a push to create an internal library of JavaScript components to keep track of all the great work we had done and improve it over time with the goal of eventually open-sourcing it.

## 👨‍💻 The private library

Our internal library, named Spark at the time, lived in private repositories on BitBucket and we used to Bower to manage the dependencies. Bower was still quite popular at the time for frontend libraries and it allowed any Odopod developer with access to the BitBucket repositories to install the packages via SSH.

The dependencies in Bower looked something like this:

```js
"dependencies": {
  "spark-scroll-animation": "git@bitbucket.org:redacted/sfo-spark-scroll-animation.git",
  "spark-carousel": "git@bitbucket.org:redacted/sfo-spark-carousel.git#~2.2.1",
  "spark-object-fit": "git@bitbucket.org:redacted/sfo-spark-object-fit.git",
  "spark-on-swipe": "git@bitbucket.org:redacted/sfo-spark-on-swipe.git#~2.0.3",
  "spark-responsive-images": "git@bitbucket.org:redacted/sfo-spark-responsive-images.git#~0.1.5",
  "spark-video": "git@bitbucket.org:redacted/sfo-spark-video.git",
  "spark-share": "git@bitbucket.org:redacted/sfo-spark-share.git"
}
```

This was okay for some of the work Odopod did, but as a mostly frontend studio, we often deliver code to other companies. It also made continuous integration and Heroku deployments more difficult because they needed a SSH key with access to the repos. I spent some time writing a Heroku buildpack that added a SSH key from an environment variable and then installed bower components.

## 🔤 Naming things

The technology group at Odopod tried our best to come up with a great name which the lawyers were okay with, which took over a year. My favorite was **Podium**, but unfortunately it wasn't approved. We decided none of the approved names were that great, so we called it the Code Library and prefixed all the packages with `odo-`. Naming is hard 😅.

## 📦 GitHub and npm

I [moved the repository to GitHub](https://github.com/odopod/code-library/) as _monorepo_. We use [Lerna](https://github.com/lerna/lerna) to manage and publish all 31 odo packages to npm, which is much better than managing 30+ different repositories which all share dependencies.

## 📝 Documentation

One of the most important parts of any library is its documentation. Every Odo component has a documentation + demos page to go with it, showing off what it can do and its public APIs. Almost half of the components also have TypeScript definitions with an `index.d.ts` file, giving developers who use [VS Code](https://code.visualstudio.com/) useful autocompletion and docs.

## 🔬 Behind the scenes

The components are written in ES2015+, compiled with Babel, and bundled with Rollup. Unit tests are run in a headless Chrome browser with Karma using Mocha and Chai. Code coverage is collected by Istanbul, while Gulp runs all these tasks.

## 🚀 Release

On August 2, 2017 [we made the Odopod Code Library public](https://www.odopod.com/news/code-library) 🎉.

If you’d like to contribute, you’ll find all the components on [GitHub](https://github.com/odopod/code-library). Each one is published on npm under the [@odopod](https://www.npmjs.com/org/odopod) organization.
