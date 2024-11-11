import React from 'react';
import Image from 'next/image';
import cx from 'clsx';
import { SocialLinks } from './social-links';

import styles from './about.module.css';
import profilePhoto from '../../public/odoshoot.jpg';

export const About: React.FC = () => {
  const diff = Date.now() - 1275350400000;
  return (
    <section className={styles.about} id="about">
      <div className="spacer-btm-large"></div>
      <div className="container spacer-btm-large">
        <div className="col-6@sm col-start-5@sm">
          <h2 className="type-header-2">About me</h2>
          <p>
            With over {Math.round(new Date(diff).getTime() / 31536000000)} years of experience building frontend
            websites and applications, I&rsquo;m passionate about performance and delightful interactions. I am a
            self-motivated developer with strong organizational and communication skills. I also contribute to my open
            source projects and others&rsquo;.
          </p>
          <p>I enjoy working with people who care about the work they do and for the people who use it.</p>
          <p className="marginless">
            <a href="/GlenCheneyResume2018.pdf">resume.pdf</a>
          </p>
        </div>
        <div className="col-3@sm col-start-2@sm order-first@sm">
          <Image
            className={cx(styles.imageWrapper, 'no-min-width')}
            src={profilePhoto}
            alt="Glen smiling in a salmon button-up shirt on a black background."
            width="192"
            sizes="192px"
            style={{ height: 'auto' }}
          />
        </div>
      </div>
      <div className="container spacer-btm-large">
        <div className="col-12 col-10@sm col-start-2@sm">
          <hr className="marginless" />
        </div>
      </div>
      <div className="container spacer-btm-large">
        <div className="col-12 col-5@sm col-start-8@sm">
          <SocialLinks />
        </div>
        <div className="col-12 col-5@sm col-start-2@sm order-first@sm">
          <h2>About this site</h2>
          <p className="marginless">
            <a href="https://github.com/Vestride/glencheney">This site</a> is built on{' '}
            <a target="_blank" rel="noopener noreferrer" href="https://nextjs.org/">
              Next.js
            </a>
            , a static site generator for React. Components are written in React and project pages are written in
            markdown. Next takes care of development environment, bundling, code-splitting, and more.
          </p>
        </div>
      </div>
    </section>
  );
};
