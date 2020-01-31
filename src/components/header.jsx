import React from 'react';
import { Link } from 'gatsby';
import cx from 'clsx';

import styles from './header.module.css';

const Header = ({ siteTitle }) => (
  <header className={styles.header}>
    <div className="container">
      <nav className={cx(styles.nav, 'col-12')}>
        <Link className={styles.link} to="/">
          <svg viewBox="0 0 32 32" width={24} height={24}>
            <title>Letter G Polygon</title>
            <desc>A low-poly polygon in the shape of a G</desc>
            <g>
              <path className={styles.polygon} fill="#9cccec" d="M18 2l-16 14 8 2 8-16z" />
              <path className={styles.polygon} fill="#dfeff9" d="M14 30l-4-12h14l-10 12z" />
              <path className={styles.polygon} fill="#99abb6" d="M2 16l12 14-4-12-8-2z" />
              <path className={`${styles.polygon} ${styles.small}`} fill="#a8bbc7" d="M2 16l8 2 3 9-11-11z" />
              <path className={`${styles.polygon} ${styles.tiny}`} fill="#4d85a9" d="M18 2l-8 16h6l2-16z" />
              <path
                className={`${styles.polygon} ${styles.small}`}
                fill="#4d85a9"
                d="M16.747 12.024l-6.747 5.976 8-16-1.253 10.024z"
              />
              <path className={`${styles.polygon} ${styles.small}`} fill="#b1d5ed" d="M2 16l8 2 4-8-12 6z" />
              <path className={`${styles.polygon} ${styles.small}`} fill="#5895bb" d="M16 18h-6l3-6 3 6z" />
              <path className={`${styles.polygon} ${styles.small}`} fill="#d5e4f1" d="M14 30l-1-3 6-3-5 6z" />
              <path
                className={`${styles.polygon} ${styles.small}`}
                fill="#517e9a"
                d="M18 2l-.744 6.012-3.256 1.988 4-8z"
              />
              <path className={`${styles.polygon} ${styles.small}`} fill="#c4dbed" d="M10 18l3 9 6-3-9-6z" />
            </g>
          </svg>
          <span className={styles.text}>{siteTitle}</span>
        </Link>
        <Link className={styles.link} to="/#about">
          About
        </Link>
      </nav>
    </div>
  </header>
);

export default Header;
