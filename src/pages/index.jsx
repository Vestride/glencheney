import React from 'react';
import ProjectList from '../components/project-list';
import styles from './index.module.css';

import github from '../images/github.svg';
import twitter from '../images/twitter.svg';
import codepen from '../images/codepen.svg';
import linkedin from '../images/linkedin.svg';

const IndexPage = ({ data }) => (
  <div>
    <div className="container">
      <div className="col-12">
        <div className="spacer-btm-large"></div>
        <h1 className="type-header-1">Hey, I&rsquo;m Glen, a Frontend Engineer</h1>
        <p className="marginless">I&rsquo;m passionate about performance and delightful interactions. I work at <a href="https://www.odopod.com">Odopod</a> in San Francisco.</p>
        <div className="spacer-btm-large"></div>
        <h2>Projects</h2>
        <p>Take a look at some of the work I&rsquo;ve done.</p>
      </div>
    </div>
    <ProjectList projects={data.allMarkdownRemark.edges} images={[
      data.hennessyImage.childImageSharp.sizes,
      data.odopodCodeLibraryImage.childImageSharp.sizes,
      data.odopodImage.childImageSharp.sizes,
      data.shuffleImage.childImageSharp.sizes,
      data.weDotOdopodImage.childImageSharp.sizes,
      data.audemarsPiguetImage.childImageSharp.sizes,
      data.compdropImage.childImageSharp.sizes,
      data.cssnanoMinifierImage.childImageSharp.sizes,
    ]} />
    <div className="spacer-btm-large"></div>
    <div className="container spacer-btm-large">
      <div className="col-12">
        <h2>Find me elsewhere</h2>
        <p className={styles.socials}>
          <a className={styles.social} title="GitHub" target="_blank" rel="noopener" href="https://github.com/Vestride">
            <img src={github} alt="GitHub logo" />
          </a>
          <a className={styles.social} title="Twitter" target="_blank" rel="noopener" href="https://twitter.com/Vestride">
            <img src={twitter} alt="Twitter logo" />
          </a>
          <a className={styles.social} title="CodePen" target="_blank" rel="noopener" href="http://codepen.io/Vestride/">
            <img src={codepen} alt="CodePen logo" />
          </a>
          <a className={styles.social} title="LinkedIn" target="_blank" rel="noopener" href="https://www.linkedin.com/in/glenium/">
            <img src={linkedin} alt="LinkedIn logo" />
          </a>
        </p>
      </div>
    </div>
  </div>
);

export default IndexPage;

export const query = graphql`
  query IndexQuery {
    site {
      siteMetadata {
        title
      }
    }
    hennessyImage: file(relativePath: { eq: "images/hennessy.png" }) {
      childImageSharp {
        sizes(maxWidth: 664) {
          ...GatsbyImageSharpSizes_withWebp
        }
      }
    }
    odopodImage: file(relativePath: { eq: "images/odopod-com.png" }) {
      childImageSharp {
        sizes(maxWidth: 664) {
          ...GatsbyImageSharpSizes_withWebp
        }
      }
    }
    compdropImage: file(relativePath: { eq: "images/compdrop.png" }) {
      childImageSharp {
        sizes(maxWidth: 664) {
          ...GatsbyImageSharpSizes_withWebp
        }
      }
    }
    audemarsPiguetImage: file(relativePath: { eq: "images/audemars-piguet.png" }) {
      childImageSharp {
        sizes(maxWidth: 664) {
          ...GatsbyImageSharpSizes_withWebp
        }
      }
    }
    cssnanoMinifierImage: file(relativePath: { eq: "images/cssnano-minifier.png" }) {
      childImageSharp {
        sizes(maxWidth: 664) {
          ...GatsbyImageSharpSizes_withWebp
        }
      }
    }
    odopodCodeLibraryImage: file(relativePath: { eq: "images/odopod-code-library.png" }) {
      childImageSharp {
        sizes(maxWidth: 664) {
          ...GatsbyImageSharpSizes_withWebp
        }
      }
    }
    shuffleImage: file(relativePath: { eq: "images/shuffle.png" }) {
      childImageSharp {
        sizes(maxWidth: 664) {
          ...GatsbyImageSharpSizes_withWebp
        }
      }
    }
    weDotOdopodImage: file(relativePath: { eq: "images/we-dot-odopod.png" }) {
      childImageSharp {
        sizes(maxWidth: 664) {
          ...GatsbyImageSharpSizes_withWebp
        }
      }
    }
    allMarkdownRemark(sort: {fields: [frontmatter___id], order: ASC}) {
      totalCount
      edges {
        node {
          id
          frontmatter {
            title
            shortDescription
          }
          fields {
            slug
          }
        }
      }
    }
  }
`;
