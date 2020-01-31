import React from 'react';
import PropTypes from 'prop-types';
import { Link, graphql } from 'gatsby';
import Img from 'gatsby-image';
import Helmet from 'react-helmet';
import cx from 'clsx';
import Layout from '../components/layout';

import styles from './project.module.css';

const Project = ({ data, pageContext, location }) => {
  const post = data.markdownRemark;
  data.hero.fluid.sizes = '(min-width: 1629px) 1400px, (min-width: 768px) 86vw, 100vw';
  const heroImageAbsoluteUrl = data.site.siteMetadata.url + data.hero.fluid.src;
  const description = post.frontmatter.shortDescription;
  const title = `${data.site.siteMetadata.title} · Portfolio`;
  return (
    <Layout location={location}>
      <Helmet>
        <title>{title}</title>
        <meta name="description" content={description} />

        {/* Open Graph tags */}
        <meta property="og:type" content="article" />
        <meta property="og:title" content={title} />
        <meta property="og:description" content={description} />
        <meta property="og:image" content={heroImageAbsoluteUrl} />
        <meta property="og:image:width" content={1400} />
        <meta property="og:image:height" content={788} />

        {/* Twitter Card tags */}
        <meta name="twitter:title" content={title} />
        <meta name="twitter:description" content={description} />
        <meta name="twitter:image" content={heroImageAbsoluteUrl} />
      </Helmet>
      <div className="spacer-btm-large"></div>
      <article className="spacer-btm-large">
        <div className="container container-full@xs spacer-btm-large">
          <Img className={cx('col-12', styles.hero)} alt={post.frontmatter.imageDescription} sizes={data.hero.fluid} />
        </div>
        <div className="container">
          <div className="col-3@sm">
            <p className="type-label">URL</p>
            <a target="_blank" rel="noopener noreferrer" className={styles.textOverflow} href={post.frontmatter.href}>
              {post.frontmatter.href}
            </a>
            <p className="type-label">Tags</p>
            <p className={styles.tags}>
              {post.frontmatter.tags.map(tag => (
                <span key={tag} className={styles.tag}>
                  {tag}
                </span>
              ))}
            </p>
          </div>
          <div className="col-8@sm col-start-4@sm">
            <h1 className="type-header-2">{post.frontmatter.title}</h1>
            <div className={cx(styles.markdown, 'no-min-width')} dangerouslySetInnerHTML={{ __html: post.html }} />
          </div>
        </div>
      </article>
      <div className="container spacer-btm-large">
        <div className="col-10 col-start-2">
          <hr />
          <div className="spacer-btm-large"></div>
          <p className="type-label">Next project</p>
          <Link to={pageContext.nextProject.fields.slug}>
            <h2 className="type-header-2">{pageContext.nextProject.frontmatter.title}</h2>
          </Link>
        </div>
      </div>
    </Layout>
  );
};

Project.propTypes = {
  data: PropTypes.shape({
    markdownRemark: PropTypes.shape({
      html: PropTypes.string.isRequired,
      frontmatter: PropTypes.shape({
        title: PropTypes.string.isRequired,
        imageDescription: PropTypes.string.isRequired,
        href: PropTypes.string.isRequired,
        tags: PropTypes.arrayOf(PropTypes.string).isRequired,
      }).isRequired,
    }).isRequired,
    hero: PropTypes.shape({
      fluid: PropTypes.object.isRequired,
    }).isRequired,
  }).isRequired,
};

export default Project;

export const query = graphql`
  query BlogPostQuery($slug: String!, $heroImage: String!) {
    site {
      siteMetadata {
        title
        url
      }
    }
    markdownRemark(fields: { slug: { eq: $slug } }) {
      html
      frontmatter {
        title
        imageDescription
        shortDescription
        href
        tags
      }
    }
    hero: imageSharp(fluid: { originalName: { eq: $heroImage } }) {
      fluid(maxWidth: 1400) {
        ...GatsbyImageSharpFluid_withWebp
      }
    }
  }
`;
