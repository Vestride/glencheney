import React from 'react';
import PropTypes from 'prop-types';
import Link from 'gatsby-link';
import Img from 'gatsby-image';

import styles from './project-list.module.css';

const ProjectList = ({ projects, images }) => (
  <div className="container">
    {projects.map(({ node }, i) => (
      <Link className={styles.project + ' col-12 col-4@sm'} to={node.fields.slug} key={node.id}>
        <Img outerWrapperClassName={styles['image-outer-wrapper']} className={styles['image-wrapper']} sizes={Object.assign(images[i], { sizes: '(min-width: 768px) calc((86vw - 32px) / 3), 90vw' })} />
        <div className={styles.inner}>
          <h3 className={styles.title}>{node.frontmatter.title}</h3>
          <p className="marginless">{node.excerpt}</p>
        </div>
      </Link>
    ))}
  </div>
);

ProjectList.propTypes = {
  projects: PropTypes.array.isRequired,
  images: PropTypes.array.isRequired,
}

export default ProjectList;
