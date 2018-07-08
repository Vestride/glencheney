import React from 'react';
import PropTypes from 'prop-types';
import Img from 'gatsby-image';
import SocialLinks from '../components/social-links';

import styles from './about.module.css';
import resumeHref from '../assets/GlenCheneyResume2018.pdf';

// glen.codes

const About = ({ profilePhoto }) => {
  profilePhoto.sizes = '304px';
  return (
    <section className={styles.about} id="about">
      <div className="spacer-btm-large"></div>
      <div className={`container ${styles.intro}`}>
        <div className="col-6@sm col-start-5@sm">
          <h2 className="type-header-1">About me</h2>
          <p>I have over 8 years of experience building frontend websites and applications. I&rsquo;m Passionate about performance and delightful interactions. I am a self-motivated developer with strong organizational and communication skills. I also contribute to my open source projects and others&rsquo;.</p>
          <p className="marginless">I enjoy working with people who care about the work they do and for the people who use it.</p>
        </div>
        <div className={`col-3@sm col-start-2@sm ${styles['photo-column']}`}>
          <Img outerWrapperClassName={styles['image-outer-wrapper'] + ' no-min-width'} className={styles['image-wrapper']} sizes={profilePhoto} alt="Glen smiling in a salmon button-up shirt on a black background." />
        </div>
      </div>
      <div className="container spacer-btm-large">
        <div className="col-12 col-8@sm col-start-2@sm">
          <h2>Looking for my resume?</h2>
          <p>Here you go: <a href={resumeHref}>resume.pdf</a></p>
          <SocialLinks />
          <h2>About this site</h2>
          <p className="marginless">This site is built on <a target="_blank" rel="noopener" href="https://www.gatsbyjs.org/">Gatsby</a>, a static site generator for React. Components are written in React with GraphQL and project pages are written in markdown. Gatsby takes care of development environment, bundling, code-splitting, and more. I use some Gatsby plugins for images, markdown, and code syntax highlighting.</p>
        </div>
      </div>
    </section>
  );
};

About.propTypes = {
  profilePhoto: PropTypes.shape({
    sizes: PropTypes.string.isRequired,
  }).isRequired,
};

export default About;
