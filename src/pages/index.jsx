import React from 'react';

import ProjectList from '../components/project-list';
import styles from './index.module.css';

const IndexPage = ({ data }) => (
  <div className={styles.intro}>
    <div className="container">
      <div className="col-12">
        <div className="spacer-large"></div>
        <h1>Hey, I&rsquo;m Glen, a Frontend Engineer</h1>
        <p className="marginless">I&rsquo;m passionate about performance and delightful interactions. I work at <a href="https://www.odopod.com">Odopod</a> in San Francisco.</p>
        <div className="spacer-large"></div>
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
    <div className="spacer-large"></div>
    <div className="container">
      <div className="col-12">
        <h2>Find me elsewhere</h2>
        <p><a href="https://github.com/Vestride">GitHub</a> <a href="https://twitter.com/Vestride">Twitter</a> <a href="http://codepen.io/Vestride/">CodePen</a> <a href="https://account.xbox.com/en-US/Profile?gamerTag=Vestride">Xbox</a></p>
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
            date(formatString: "YYYY")
          }
          fields {
            slug
          }
          excerpt
        }
      }
    }
  }
`;
