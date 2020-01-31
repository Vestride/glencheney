import React from 'react';
import Layout from '../components/layout';

const NotFoundPage = ({ location }) => (
  <Layout location={location}>
    <div className="spacer-btm-large"></div>
    <div className="container">
      <div className="col-12" style={{ textAlign: 'center' }}>
        <h1 className="type-header-1">This is awkward</h1>
        <p>The page you&rsquo;re trying to visit doesn&rsquo;t exist.</p>
      </div>
    </div>
  </Layout>
);

export default NotFoundPage;
