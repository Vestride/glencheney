webpackJsonp([95675931843695],{443:function(e,a){e.exports={data:{site:{siteMetadata:{title:"Glen Cheney"}},markdownRemark:{html:'<p>Drag and drop css minification with cssnano.</p>\n<h2>Convenient CSS minification</h2>\n<p>I built this small app because sometimes I need to minify CSS outside of a build system, for example, inlining CSS <a href="https://github.com/necolas/normalize.css">normalize.css</a> into the <code class="language-text">&lt;head&gt;</code> of a document. Other online CSS minifiers already exist, but none that use <a href="https://cssnano.co/">cssnano</a>. cssnano was packaged with webpack’s <a href="https://github.com/webpack-contrib/css-loader">css-loader</a> until it July 2018.</p>\n<h2>Tech details</h2>\n<p>Unfortunately, even though <code class="language-text">postcss</code> works in the browser, the <code class="language-text">cssnano</code> package does not. After you drop a CSS file onto the page, a request is sent to the server to minify the CSS. <a href="https://codemirror.net/">CodeMirror</a> then renders the response in a fullscreen editor, giving users the ability to copy the styles which were just minified.</p>\n<p>The frontend is built with TypeScript and bundled with webpack. Since the <code class="language-text">codemirror</code> and <code class="language-text">clipboard</code> packages are only used after the user adds some CSS to minify, I use webpack’s code-splitting with dynamic imports to load them after the app has initialized.</p>\n<h2>CSS OMG</h2>\n<p>The UX of this app is inspired by <a href="https://jakearchibald.github.io/svgomg/">SVGOMG</a> by Jake Archibald. I use SVGOMG all the time and being able to both paste code to minify and drag-n-drop a file is very handy.</p>\n<!-- markdownlint-disable MD033 -->\n<video muted playsinline controls loop poster="/cssnano-minifier-poster.png">\n  <source src="/static/cssnano-minifier-b86cd4b830a89c48e2bc8e37ad34b452.webm" type="video/webm; codecs=vp9,vorbis">\n  <source src="/static/cssnano-minifier-34aa992304e71cf1d2fc0db2844291a9.mp4" type="video/mp4">\n</video>',frontmatter:{title:"cssnano",imageDescription:"Landing page for the cssnano minifier application.",shortDescription:"Drag and drop css minification with cssnano.",href:"https://cssnano.herokuapp.com/",tags:["open source","drag-n-drop","TypeScript","Node"]}},hero:{sizes:{base64:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAALCAYAAAB/Ca1DAAAACXBIWXMAAAsSAAALEgHS3X78AAACJUlEQVQoz42SP2wSURjArzXWwcQBNEFSReFAzBmHpmHgj0EGB1FIMBras4SJnYHjCP8JA5tlZ7KFMADRO8QaE6mJVYE2MY2TS91aOzZGQrh7n+9dKR28NL7cLy/vLt/vfd99H0UdryuhUOgwlUpBOp2Sw+Ew8nq94Pf7wefzqYEwciAQAI/H82Nu7sJFIrllZWYmPupmtVodAV4IP+12GxKJBBSLRSgUCqrk83m5VCoBTuTXudmZy0Ty4X37xEcZ1tarQxkLh6MxajSbKBaLQS6Xg0wmo0o6nZbJhcFgcB/HX8Ocx8xOhS/X1ockQyxFzWYLOI47U4i/oXich0WbY3z7zsIec3dxz2RmulNhpVIZyrKkVN1qnQqz2ew/TITAxeNIEN/A/sEBbGy8g8CTZzAV1mo1JcP/ERJIhjyfgMHON0QKGwwGiGVX/kyFjUZDVXhGyUBK3vrcU2I+bX2BpWV2dCK8Ua/XJ0KE/2ETeJ5XukkC1cBdBh5PwubmRyWo1/sKwaVT4dVOp/P7eGpgLAqCFI1GJdxJKZlMqoJnVopxnLS9vUOGA/X7ffR8JTSk8GBe0ul0tkgkAqvlMrxYLQPLsmCz2cDlcoHD4QC73a7sTqdzCjm73fdhd/e7Ule32wXvIx+irFbrU4Zhynq9/pVGoxG0Wq1gMBgE/F6wWCyiyWQSjUajSNO0SM4YYbK/ps3mtw8fBw6Dy+Gje+4HR/PX6Z9/AYk+3ypDVdlBAAAAAElFTkSuQmCC",aspectRatio:1.777434312210201,src:"/static/cssnano-minifier-hero-9da247b859c0349a96d7121ec7491f2f-0fe8f.png",srcSet:"/static/cssnano-minifier-hero-9da247b859c0349a96d7121ec7491f2f-d7863.png 350w,\n/static/cssnano-minifier-hero-9da247b859c0349a96d7121ec7491f2f-c146b.png 700w,\n/static/cssnano-minifier-hero-9da247b859c0349a96d7121ec7491f2f-0fe8f.png 1400w,\n/static/cssnano-minifier-hero-9da247b859c0349a96d7121ec7491f2f-25199.png 2100w,\n/static/cssnano-minifier-hero-9da247b859c0349a96d7121ec7491f2f-9880c.png 2300w",srcWebp:"/static/cssnano-minifier-hero-9da247b859c0349a96d7121ec7491f2f-43730.webp",srcSetWebp:"/static/cssnano-minifier-hero-9da247b859c0349a96d7121ec7491f2f-1130a.webp 350w,\n/static/cssnano-minifier-hero-9da247b859c0349a96d7121ec7491f2f-7944d.webp 700w,\n/static/cssnano-minifier-hero-9da247b859c0349a96d7121ec7491f2f-43730.webp 1400w,\n/static/cssnano-minifier-hero-9da247b859c0349a96d7121ec7491f2f-beeb1.webp 2100w,\n/static/cssnano-minifier-hero-9da247b859c0349a96d7121ec7491f2f-71e2f.webp 2300w",sizes:"(max-width: 1400px) 100vw, 1400px"}}},pathContext:{slug:"/cssnano-minifier/",heroImage:"/images/cssnano-minifier-hero.png/",nextProject:{frontmatter:{title:"hennessy.com"},fields:{slug:"/hennessy/"}}}}}});
//# sourceMappingURL=path---cssnano-minifier-7376fa131e09e019b76a.js.map