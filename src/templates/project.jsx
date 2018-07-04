import React from 'react';
import GatsbyLink from 'gatsby-link';
import Img from 'gatsby-image';

import styles from './project.module.css';

export default ({ data, pathContext }) => {
  const post = data.markdownRemark;
  return (
    <div>
      <article className="spacer-btm-large">
        <div className={styles.hero}>
          <Img alt={post.frontmatter.imageDescription} sizes={data.hero.sizes} />
        </div>
        <div className="spacer-btm-large"></div>
        <div className="container">
          <div className="col-8@sm col-start-3@sm">
            <h1 className="type-header-1">{post.frontmatter.title}</h1>
            <div className={styles.markdown} dangerouslySetInnerHTML={{ __html: post.html }} />
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
  query BlogPostQuery($slug: String!) {
    markdownRemark(fields: { slug: { eq: $slug } }) {
      html
      frontmatter {
        title
        imageDescription
      }
    }
    hero: imageSharp(id: { regex: $slug }) {
      sizes(maxWidth: 2560) {
        ...GatsbyImageSharpSizes_withWebp
      }
    }
  }
`;
