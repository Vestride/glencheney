import React from 'react';
import { graphql } from 'gatsby';
import Layout from '../components/layout';
import ProjectList from '../components/project-list';
import About from '../components/about';

const IndexPage = ({ data, location }) => (
  <Layout location={location}>
    <div className="container">
      <div className="col-12 col-10@sm">
        <div className="spacer-btm-large"></div>
        <h1 className="type-header-1">Hey, I&rsquo;m Glen, a Frontend Engineer</h1>
        <p className="marginless">
          I&rsquo;m passionate about performance and delightful interactions. I work at{' '}
          <a href="https://www.lyft.com">Lyft</a> in San Francisco.
        </p>
        <div className="spacer-btm-large"></div>
        <h2 className="type-header-2">Projects</h2>
      </div>
    </div>
    <ProjectList
      projects={data.allMarkdownRemark.edges}
      images={[
        data.hennessyImage.childImageSharp.fluid,
        data.odopodCodeLibraryImage.childImageSharp.fluid,
        data.odopodImage.childImageSharp.fluid,
        data.shuffleImage.childImageSharp.fluid,
        data.weDotOdopodImage.childImageSharp.fluid,
        data.audemarsPiguetImage.childImageSharp.fluid,
        data.compdropImage.childImageSharp.fluid,
        data.cssnanoMinifierImage.childImageSharp.fluid,
      ]}
    />
    <About profilePhoto={data.profilePhoto.childImageSharp.fluid} />
  </Layout>
);

export default IndexPage;

export const query = graphql`
  query IndexQuery {
    hennessyImage: file(relativePath: { eq: "images/hennessy.png" }) {
      childImageSharp {
        fluid(maxWidth: 664) {
          ...GatsbyImageSharpFluid_withWebp
        }
      }
    }
    odopodImage: file(relativePath: { eq: "images/odopod-com.png" }) {
      childImageSharp {
        fluid(maxWidth: 664) {
          ...GatsbyImageSharpFluid_withWebp
        }
      }
    }
    compdropImage: file(relativePath: { eq: "images/compdrop.png" }) {
      childImageSharp {
        fluid(maxWidth: 664) {
          ...GatsbyImageSharpFluid_withWebp
        }
      }
    }
    audemarsPiguetImage: file(relativePath: { eq: "images/audemars-piguet.png" }) {
      childImageSharp {
        fluid(maxWidth: 664) {
          ...GatsbyImageSharpFluid_withWebp
        }
      }
    }
    cssnanoMinifierImage: file(relativePath: { eq: "images/cssnano-minifier.png" }) {
      childImageSharp {
        fluid(maxWidth: 664) {
          ...GatsbyImageSharpFluid_withWebp
        }
      }
    }
    odopodCodeLibraryImage: file(relativePath: { eq: "images/odopod-code-library.png" }) {
      childImageSharp {
        fluid(maxWidth: 664) {
          ...GatsbyImageSharpFluid_withWebp
        }
      }
    }
    shuffleImage: file(relativePath: { eq: "images/shuffle.png" }) {
      childImageSharp {
        fluid(maxWidth: 664) {
          ...GatsbyImageSharpFluid_withWebp
        }
      }
    }
    weDotOdopodImage: file(relativePath: { eq: "images/we-dot-odopod.png" }) {
      childImageSharp {
        fluid(maxWidth: 664) {
          ...GatsbyImageSharpFluid_withWebp
        }
      }
    }
    profilePhoto: file(relativePath: { eq: "images/odoshoot.jpg" }) {
      childImageSharp {
        fluid(maxWidth: 304) {
          ...GatsbyImageSharpFluid_withWebp
        }
      }
    }
    allMarkdownRemark(sort: { fields: [frontmatter___id], order: ASC }) {
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
