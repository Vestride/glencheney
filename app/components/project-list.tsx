import React from 'react';
import Link from 'next/link';
import Image from 'next/image';
import cx from 'clsx';

import styles from './project-list.module.css';
import { AugmentedProject } from '@/types';

interface ProjectListProps {
  projects: Array<AugmentedProject>;
}

export const ProjectList: React.FC<ProjectListProps> = ({ projects }) => (
  <div className={`container spacer-btm-large ${styles.container}`}>
    {projects.map((project, i) => (
      <Link className={cx(styles.project, 'col-12 col-4@sm')} href={project.slug} key={project.slug}>
        <div className={styles.imageWrapper}>
          <Image
            sizes="(min-width: 768px) calc((86vw - 32px) / 3), 90vw"
            alt={project.imageDescription}
            src={project.image}
            fill
            style={{ aspectRatio: '16 / 9' }}
            priority={i < 3}
          />
        </div>
        <div className={styles.inner}>
          <h3 className="type-header-3">{project.title}</h3>
          <p className="marginless">{project.shortDescription}</p>
        </div>
      </Link>
    ))}
  </div>
);
