import React from 'react';
import PropTypes from 'prop-types';
import GatsbyLink from 'gatsby-link';
import Img from 'gatsby-image';
import Helmet from 'react-helmet';

import styles from './project.module.css';

const Project = ({ data, pathContext }) => {
  const post = data.markdownRemark;
  data.hero.sizes.sizes = '(min-width: 1629px) 1400px, (min-width: 768px) 86vw, 100vw';
  return (
    <div>
      <Helmet>
        <title>{`${data.site.siteMetadata.title} · ${post.frontmatter.title}`}</title>
      </Helmet>
      <div className="spacer-btm-large"></div>
      <article className="spacer-btm-large">
        <div className="container container-full@xs spacer-btm-large">
          <Img outerWrapperClassName={`col-12 ${styles.hero}`} alt={post.frontmatter.imageDescription} sizes={data.hero.sizes} />
        </div>
        <div className="container">
          <div className="col-3@sm">
            <p className="type-label">URL</p>
            <a target="_blank" rel="noopener" className={styles['text-overflow']} href={post.frontmatter.href}>{post.frontmatter.href}</a>
            <p className="type-label">Tags</p>
            <p className={styles.tags}>
              {post.frontmatter.tags.map((tag) => (
                <span key={tag} className={styles.tag}>{tag}</span>
              ))}
            </p>
          </div>
          <div className="col-8@sm col-start-4@sm">
            <h1 className="type-header-2">{post.frontmatter.title}</h1>
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
            <h2 className="type-header-2">{pathContext.nextProject.frontmatter.title}</h2>
          </GatsbyLink>
        </div>
      </div>
    </div>
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
      sizes: PropTypes.object.isRequired,
    }).isRequired,
  }).isRequired,
}

export default Project;

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
      sizes(maxWidth: 1400) {
        ...GatsbyImageSharpSizes_withWebp
      }
    }
  }
`;
