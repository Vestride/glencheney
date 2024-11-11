import { About } from './components/about';
import { ProjectList } from './components/project-list';
import { compileAllPages } from './utils';

export default async function Page() {
  const projects = await compileAllPages();

  return (
    <>
      <div className="container">
        <div className="col-12 col-10@sm">
          <div className="spacer-btm-large"></div>
          <h1 className="type-header-1">Hey, I&rsquo;m Glen, a Frontend Engineer</h1>
          <p className="marginless">
            I&rsquo;m passionate about performance and delightful interactions. I work remotely for{' '}
            <a href="https://www.lyft.com">Lyft</a> in Charlotte, NC.
          </p>
          <div className="spacer-btm-large"></div>
          <h2 className="type-header-2">Projects</h2>
        </div>
      </div>
      <ProjectList projects={projects} />
      <About />
    </>
  );
}
