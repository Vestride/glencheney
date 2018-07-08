import React from 'react';
import styles from './social-links.module.css';
import github from '../images/github.svg';
import twitter from '../images/twitter.svg';
import codepen from '../images/codepen.svg';
import linkedin from '../images/linkedin.svg';

export default () => (
  <div>
    <h2>Find me elsewhere</h2>
    <p className={styles.socials}>
      <a className={styles.social} title="GitHub" target="_blank" rel="noopener" href="https://github.com/Vestride">
        <img src={github} alt="GitHub logo" />
      </a>
      <a className={styles.social} title="Twitter" target="_blank" rel="noopener" href="https://twitter.com/Vestride">
        <img src={twitter} alt="Twitter logo" />
      </a>
      <a className={styles.social} title="CodePen" target="_blank" rel="noopener" href="http://codepen.io/Vestride/">
        <img src={codepen} alt="CodePen logo" />
      </a>
      <a className={styles.social} title="LinkedIn" target="_blank" rel="noopener" href="https://www.linkedin.com/in/glenium/">
        <img src={linkedin} alt="LinkedIn logo" />
      </a>
    </p>
  </div>
);
