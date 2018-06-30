import React from 'react';
import Link from 'gatsby-link';
import Img from 'gatsby-image';

import styles from './project-list.module.css';

const ProjectList = ({ projects, images }) => (
  <div className="container">
    {projects.map(({ node }, i) => (
      <Link className={styles.project + ' col-6 col-4@sm'} to={node.fields.slug} key={node.id}>
        <Img sizes={images[i]} />
        <div className={styles.inner}>
          <span>{node.frontmatter.title}{" "}</span>
          <span>— {node.frontmatter.date}</span>
          <p className="marginless">{node.excerpt}</p>
        </div>
      </Link>
    ))}
  </div>
);

export default ProjectList;
