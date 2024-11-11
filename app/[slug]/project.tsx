import React from 'react';
import cx from 'clsx';
import Image, { StaticImageData } from 'next/image';
import Link from 'next/link';

import { AugmentedProject, ProjectFrontmatter } from '@/types';
import styles from './project.module.css';

interface ProjectProps {
  children: React.ReactNode;
  frontmatter: ProjectFrontmatter;
  hero: StaticImageData;
  next: AugmentedProject;
  previous: AugmentedProject;
}

export const Project: React.FC<ProjectProps> = ({ children, frontmatter, hero, next, previous }) => {
  return (
    <>
      <div className="spacer-btm-large"></div>
      <article className="spacer-btm-large">
        <div className="container container-full@xs spacer-btm-large">
          <Image
            priority
            alt={frontmatter.imageDescription}
            src={hero}
            width="1400"
            style={{ height: 'auto' }}
            className={cx('col-12', styles.hero)}
            sizes="(min-width: 1629px) 1400px, (min-width: 768px) 86vw, 100vw"
          />
        </div>
        <div className="container">
          <div className="col-3@sm">
            <p className="type-label">URL</p>
            <a target="_blank" rel="noopener noreferrer" className={styles.textOverflow} href={frontmatter.href}>
              {frontmatter.href}
            </a>
            <p className="type-label">Tags</p>
            <p className={styles.tags}>
              {frontmatter.tags.map((tag) => (
                <span key={tag} className={styles.tag}>
                  {tag}
                </span>
              ))}
            </p>
            <p className="type-label">Date</p>
            <p>
              {new Intl.DateTimeFormat('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
              }).format(new Date(frontmatter.date))}
            </p>
          </div>
          <div className="col-8@sm col-start-4@sm">
            <h1 className="type-header-2">{frontmatter.title}</h1>
            <div className={cx(styles.markdown, 'no-min-width')}>{children}</div>
          </div>
        </div>
      </article>
      {(next || previous) && (
        <div className="container spacer-btm-large">
          <div className="col-10 col-start-2">
            <hr />
            <div className="spacer-btm-large"></div>
            <div className={styles.projectNav}>
              <div>
                <p className="type-label">Next project</p>
                <Link href={`/${next.slug}`}>
                  <h2 className="type-header-2">{next.title}</h2>
                </Link>
              </div>
              <div>
                <p className="type-label">Previous project</p>
                <Link href={`/${previous.slug}`}>
                  <h2 className="type-header-2">{previous.title}</h2>
                </Link>
              </div>
            </div>
          </div>
        </div>
      )}
    </>
  );
};
