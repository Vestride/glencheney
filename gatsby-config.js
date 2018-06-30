module.exports = {
  siteMetadata: {
    title: 'Glen Cheney',
  },
  plugins: [
    'gatsby-plugin-react-helmet',
    'gatsby-transformer-remark',
    'gatsby-transformer-sharp',
    'gatsby-plugin-sharp',
    {
      resolve: 'gatsby-source-filesystem',
      options: {
        name: 'src',
        path: `${__dirname}/src/`,
      },
    },
  ],
};
