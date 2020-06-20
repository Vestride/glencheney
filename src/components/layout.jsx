import React from 'react';
import { StaticQuery, graphql } from 'gatsby';
import { Helmet } from 'react-helmet';

import Header from '../components/header';
import './index.css';
import './grid.css';
import './prism-theme.css';

export default ({ children, location }) => (
  <StaticQuery
    query={graphql`
      query SiteTitleQuery {
        site {
          siteMetadata {
            title
            url
            description
            twitter
          }
        }
        ogImage: file(relativePath: { eq: "images/we-dot-odopod-hero.png" }) {
          childImageSharp {
            original {
              src
              width
              height
            }
          }
        }
      }
    `}
    render={(data) => {
      const image = data.site.siteMetadata.url + data.ogImage.childImageSharp.original.src;
      const description = data.site.siteMetadata.description;
      const title = `${data.site.siteMetadata.title} · Portfolio`;
      return (
        <>
          <Helmet>
            <html lang="en" />
            <title>{title}</title>
            <link rel="canonical" href={`${data.site.siteMetadata.url}${location.pathname}`} />
            <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
            <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png" />
            <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png" />
            <link rel="manifest" href="/site.webmanifest" />
            <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#3498db" />
            <meta name="msapplication-TileColor" content="#2d89ef" />
            <meta name="theme-color" content="#3498db" />
            <meta name="description" content={description} />

            {/* Open Graph tags */}
            <meta property="og:title" content={title} />
            <meta property="og:description" content={description} />
            <meta property="og:image" content={image} />
            <meta property="og:image:width" content={data.ogImage.childImageSharp.original.width} />
            <meta property="og:image:height" content={data.ogImage.childImageSharp.original.height} />

            {/* Twitter Card tags */}
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:creator" content={data.site.siteMetadata.twitter} />
            <meta name="twitter:title" content={title} />
            <meta name="twitter:description" content={description} />
            <meta name="twitter:image" content={image} />
          </Helmet>
          <Header siteTitle={data.site.siteMetadata.title} />
          <main id="main" role="main">
            {children}
          </main>
        </>
      );
    }}
  />
);
