---
title: "we.odopod"
date: "2017-09-01"
id: 5
href: "https://we.odopod.com/"
tags:
  - React
  - Redux
imageDescription: "Screenshot of the profile page for an employee."
shortDescription: "A company directory app built with React + Redux for Odopod showing employee information and a seating map."
---

A company directory app built with React + Redux for Odopod showing employee information and a seating map.

## Where does Tim sit?

The directory helped Odopod employees find where their coworkers sit with the seating map and gave profile pages to each person. Odopeeps could add their contact information like AIM screen names (in a time before Slack 😱), Twitter, and Instagram.

The we.odopod directory was one of the first projects I worked on in 2012 at Odopod. At that time, we built it on top of Twitter Bootstrap, it used [jQuery Pjax](https://github.com/defunkt/jquery-pjax) for partial page loads, and used Django for a backend and CMS. I built the original seating map with custom zooming (CSS transforms), panning, and hotspots.

## A single resource

Fast-forward to 2017. A couple of Odopod designers have some idle time, so they begin to work on a redesign for we.odopod which would include more features and consolidate information from multiple other places into this single resource.

The final feature set for we.odopod was a directory listing of all the employees (and their pets), a detail page for each person, the seating map, a career path section of the site which described different roles at Odopod, and a resources section which was mostly migrated HR content.

This was also a great opportunity for a couple of the Odopod developers to get some experience with React because it was an internal project and a single page application.

## New hotness

We started development of the new site using [Create React App](https://github.com/facebook/create-react-app). CRA gave us a great foundation to start development. We also wanted to make the app backend agnostic in case we decided to change that too. The new we.odopod app consumes RESTful APIs from the Django backend for authentication, employee information, resource pages, and more.

The app's navigation is handled by [`react-router`](https://www.npmjs.com/package/react-router), [`react-loadable`](https://www.npmjs.com/package/react-loadable) dynamically loads components only when they're needed, and [Leaflet.js](https://www.npmjs.com/package/leaflet) powers the map. We use the [`@odopod/odo-sassplate`](https://www.npmjs.com/package/@odopod/odo-sassplate) library for base and common styles. [My Shuffle library](/shuffle/) is used on the home page to filter, sort, and search people.

Being new to React, I didn't immediately push us to use Redux (or any other state manager). After we completed the project, however, I had some idle time and decided to use it learning and implementing Redux into our app.

<!-- markdownlint-disable MD033 -->
<video muted playsinline controls loop poster="/we-dot-odopod-poster.png">
  <source src="we-dot-odopod.webm" type="video/webm; codecs=vp9,vorbis">
  <source src="we-dot-odopod.mp4" type="video/mp4">
</video>
