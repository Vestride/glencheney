import React, { Component } from 'react';
import PropTypes from 'prop-types';
import Helmet from 'react-helmet';
import { initialize, pageview } from 'react-ga';

import Header from '../components/header';
import './index.css';
import './grid.css';

class Layout extends Component {
  componentDidMount() {
    initialize('UA-24218764-1');
    pageview(window.location.pathname + window.location.search);
  }

  render() {
    const { children, data } = this.props;
    return (
      <div>
        <Helmet title={data.site.siteMetadata.title}
          meta={[
            { name: 'description', content: 'Sample' },
            { name: 'keywords', content: 'sample, something' },
          ]}
        />
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
  }
`;
