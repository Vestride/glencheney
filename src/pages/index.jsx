import React from 'react';

import ProjectList from '../components/project-list';
import styles from './index.module.css';

const IndexPage = ({ data }) => (
  <div className={styles.intro}>
    <div className="container">
      <div className="col-12">
        <h1>Hey, I&rsquo;m Glen, a Frontend Engineer</h1>
        <p>I&rsquo;m passionate about performance and delightful interactions. I work at <a href="http://www.odopod.com">Odopod</a> in San Francisco.</p>
        <p>You can find me on <a href="https://github.com/Vestride">GitHub</a>, <a href="https://twitter.com/Vestride">Twitter</a>, <a href="http://codepen.io/Vestride/">CodePen</a>, and <a href="https://account.xbox.com/en-US/Profile?gamerTag=Vestride">Xbox</a> as Vestride.</p>
        <h2>Projects</h2>
      </div>
    </div>
    <ProjectList projects={data.allMarkdownRemark.edges} images={[
      data.hennessyImage.childImageSharp.sizes,
    ]} />
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
    hennessyImage: file(relativePath: { eq: "images/hennessy.jpg" }) {
      childImageSharp {
        sizes(maxWidth: 1200) {
          ...GatsbyImageSharpSizes_withWebp
        }
      }
    }
    allMarkdownRemark(sort: {fields: [frontmatter___date], order: DESC}) {
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
