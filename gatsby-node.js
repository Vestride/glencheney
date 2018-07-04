/**
 * Implement Gatsby's Node APIs in this file.
 *
 * See: https://www.gatsbyjs.org/docs/node-apis/
 */
const path = require('path');
const { createFilePath } = require(`gatsby-source-filesystem`);

exports.onCreateNode = ({ node, getNode, boundActionCreators }) => {
  const { createNodeField } = boundActionCreators;
  if (node.internal.type === 'MarkdownRemark') {
    const slug = createFilePath({ node, getNode, basePath: 'pages' })
    createNodeField({
      node,
      name: 'slug',
      value: slug,
    });
  }
};

exports.createPages = ({ graphql, boundActionCreators }) => {
  const { createPage } = boundActionCreators;
  return new Promise((resolve, reject) => {
    graphql(`
      {
        allMarkdownRemark(sort: {fields: [frontmatter___id], order: ASC}) {
          edges {
            node {
              frontmatter {
                title
              }
              fields {
                slug
              }
            }
          }
        }
      }
    `
    ).then((result) => {
      const posts = result.data.allMarkdownRemark.edges;
      posts.forEach(({ node }, index) => {
        let nextProject = index === posts.length - 1 ? posts[0] : posts[index + 1];
        createPage({
          path: node.fields.slug,
          component: path.resolve('./src/templates/project.jsx'),
          context: {
            // Data passed to context is available in page queries as GraphQL variables.
            slug: node.fields.slug,
            nextProject: nextProject.node,
          },
        });
      });
      resolve();
    });
  })
};
