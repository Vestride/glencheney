import React from 'react';
import GatsbyLink from 'gatsby-link';
import Img from 'gatsby-image';
import Helmet from 'react-helmet';

import styles from './project.module.css';

export default ({ data, pathContext }) => {
  const post = data.markdownRemark;
  return (
    <div>
      <Helmet>
        <title>{`${data.site.siteMetadata.title} · ${post.frontmatter.title}`}</title>
      </Helmet>
      <article className="spacer-btm-large">
        <div className={styles.hero}>
          <Img alt={post.frontmatter.imageDescription} sizes={data.hero.sizes} />
        </div>
        <div className="spacer-btm-large"></div>
        <div className="container">
          <div className="col-3@sm">
            <div className="no-min-width">
              <p className="type-label">URL</p>
              <p>
                <a target="_blank" rel="noopener" className={styles['text-overflow']} href={post.frontmatter.href}>{post.frontmatter.href}</a>
              </p>
              <p className="type-label">Tags</p>
              <p>{post.frontmatter.tags.join(', ')}</p>
            </div>
          </div>
          <div className="col-8@sm col-start-4@sm">
            <h1 className="type-header-1">{post.frontmatter.title}</h1>
            <div className={`${styles.markdown} no-min-width`} dangerouslySetInnerHTML={{ __html: post.html }} />
          </div>
        </div>
      </article>
      <div className="container spacer-btm-large">
        <div className="col-10 col-start-2">
          <hr/>
          <div className="spacer-btm-large"></div>
          <p className="type-label">Next project</p>
          <GatsbyLink to={pathContext.nextProject.fields.slug}>
            <h2 className="type-header-1">{pathContext.nextProject.frontmatter.title}</h2>
          </GatsbyLink>
        </div>
      </div>
    </div>
  );
};

export const query = graphql`
  query BlogPostQuery($slug: String!, $heroImage: String!) {
    site {
      siteMetadata {
        title
      }
    }
    markdownRemark(fields: { slug: { eq: $slug } }) {
      html
      frontmatter {
        title
        imageDescription
        href
        tags
      }
    }
    hero: imageSharp(id: { regex: $heroImage }) {
      sizes(maxWidth: 2560) {
        ...GatsbyImageSharpSizes_withWebp
      }
    }
  }
`;
