import React from 'react';
import PropTypes from 'prop-types';
import { Link } from 'gatsby';
import Img from 'gatsby-image';
import cx from 'clsx';

import styles from './project-list.module.css';

const ProjectList = ({ projects, images }) => (
  <div className={`container spacer-btm-large ${styles.container}`}>
    {projects.map(({ node }, i) => (
      <Link className={cx(styles.project, 'col-12 col-4@sm')} to={node.fields.slug} key={node.id}>
        <Img
          className={styles.imageWrapper}
          sizes={Object.assign(images[i], { sizes: '(min-width: 768px) calc((86vw - 32px) / 3), 90vw' })}
        />
        <div className={styles.inner}>
          <h3 className="type-header-3">{node.frontmatter.title}</h3>
          <p className="marginless">{node.frontmatter.shortDescription}</p>
        </div>
      </Link>
    ))}
  </div>
);

ProjectList.propTypes = {
  projects: PropTypes.array.isRequired,
  images: PropTypes.array.isRequired,
};

export default ProjectList;
