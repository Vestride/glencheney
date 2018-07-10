import React from 'react';
import PropTypes from 'prop-types';
import Img from 'gatsby-image';
import SocialLinks from '../components/social-links';

import styles from './about.module.css';
import resumeHref from '../assets/GlenCheneyResume2018.pdf';

const About = ({ profilePhoto }) => {
  profilePhoto.sizes = '188px';
  return (
    <section className={styles.about} id="about">
      <div className="spacer-btm-large"></div>
      <div className="container spacer-btm-large">
        <div className="col-6@sm col-start-5@sm">
          <h2 className="type-header-2">About me</h2>
          <p>With over 8 years of experience building frontend websites and applications, I&rsquo;m passionate about performance and delightful interactions. I am a self-motivated developer with strong organizational and communication skills. I also contribute to my open source projects and others&rsquo;.</p>
          <p>I enjoy working with people who care about the work they do and for the people who use it.</p>
          <p className="marginless">
            <a href={resumeHref}>resume.pdf</a>
            {' '}
            <a href="https://glen.codes">glen.codes</a>
          </p>
        </div>
        <div className="col-3@sm col-start-2@sm order-first@sm">
          <Img outerWrapperClassName={'no-min-width'} className={styles['image-wrapper']} sizes={profilePhoto} alt="Glen smiling in a salmon button-up shirt on a black background." />
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
          <p className="marginless"><a href="https://github.com/Vestride/glencheney">This site</a> is built on <a target="_blank" rel="noopener" href="https://www.gatsbyjs.org/">Gatsby</a>, a static site generator for React. Components are written in React with GraphQL and project pages are written in markdown. Gatsby takes care of development environment, bundling, code-splitting, and more.</p>
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
