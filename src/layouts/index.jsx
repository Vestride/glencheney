import React, { Component } from 'react';
import PropTypes from 'prop-types';
import Helmet from 'react-helmet';
import { initialize, pageview } from 'react-ga';

import Header from '../components/header';
import config from '../config';
import './index.css';
import './grid.css';
import './prism-theme.css';

class Layout extends Component {
  componentDidMount() {
    initialize('UA-24218764-1');
    pageview(window.location.pathname + window.location.search);
  }

  render() {
    const { children, data } = this.props;
    const image = config.url + data.ogImage.childImageSharp.original.src;
    const description = config.description;
    const title = `${data.site.siteMetadata.title} · Portfolio`;
    return (
      <div>
        <Helmet>
          <html lang="en" />
          <title>{title}</title>
          <link rel="canonical" href={`${config.url}${this.props.location.pathname}`} />
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
          <meta name="twitter:creator" content={config.twitter} />
          <meta name="twitter:title" content={title} />
          <meta name="twitter:description" content={description} />
          <meta name="twitter:image" content={image} />
        </Helmet>
        <Header siteTitle={data.site.siteMetadata.title} />
        <main id="main" role="main">
          {children()}
        </main>
      </div>
    );
  }
}

Layout.propTypes = {
  children: PropTypes.func,
}

export default Layout;

export const query = graphql`
  query SiteTitleQuery {
    site {
      siteMetadata {
        title
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
`;
