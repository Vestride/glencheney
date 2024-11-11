import React from 'react';
import Image from 'next/image';

import styles from './social-links.module.css';
import github from '../../public/github.svg';
import twitter from '../../public/twitter.svg';
import codepen from '../../public/codepen.svg';
import linkedin from '../../public/linkedin.svg';

export const SocialLinks: React.FC = () => (
  <div>
    <h2>Find me elsewhere</h2>
    <p className={styles.socials}>
      <a
        className={styles.social}
        title="GitHub"
        target="_blank"
        rel="noopener noreferrer"
        href="https://github.com/Vestride"
      >
        <Image src={github} alt="GitHub logo" width="64" />
      </a>
      <a
        className={styles.social}
        title="Twitter"
        target="_blank"
        rel="noopener noreferrer"
        href="https://twitter.com/Vestride"
      >
        <Image src={twitter} alt="Twitter logo" width="64" />
      </a>
      <a
        className={styles.social}
        title="CodePen"
        target="_blank"
        rel="noopener noreferrer"
        href="http://codepen.io/Vestride/"
      >
        <Image src={codepen} alt="CodePen logo" width="64" />
      </a>
      <a
        className={styles.social}
        title="LinkedIn"
        target="_blank"
        rel="noopener noreferrer"
        href="https://www.linkedin.com/in/glenium/"
      >
        <Image src={linkedin} alt="LinkedIn logo" width="64" />
      </a>
    </p>
  </div>
);
