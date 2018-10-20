import React from 'react';
import ProjectList from '../components/project-list';
import About from '../components/about';

const IndexPage = ({ data }) => (
  <div>
    <div className="container">
      <div className="col-12 col-10@sm">
        <div className="spacer-btm-large"></div>
        <h1 className="type-header-1">Hey, I&rsquo;m Glen, a Frontend Engineer</h1>
        <p className="marginless">I&rsquo;m passionate about performance and delightful interactions. I work at <a href="https://www.lyft.com">Lyft</a> in San Francisco.</p>
        <div className="spacer-btm-large"></div>
        <h2 className="type-header-2">Projects</h2>
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
    <About profilePhoto={data.profilePhoto.childImageSharp.sizes} />
  </div>
);

export default IndexPage;

export const query = graphql`
  query IndexQuery {
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
    profilePhoto: file(relativePath: { eq: "images/odoshoot.jpg" }) {
      childImageSharp {
        sizes(maxWidth: 304) {
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
