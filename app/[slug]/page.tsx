import type { Metadata, ResolvingMetadata } from 'next';

import { Project } from './project';
import { ProjectId, ProjectHeroImage } from '../images';
import { compileAllPages, compileMarkdown, getProjectSlugs } from '@/utils';

interface Params {
  slug: string;
}

interface SlugPageProps {
  params: Promise<Params>;
}

export async function generateStaticParams() {
  return getProjectSlugs();
}

export default async function Page({ params }: SlugPageProps) {
  const { slug } = await params;

  const { content, frontmatter } = await compileMarkdown(slug);

  const projectId = frontmatter.id as ProjectId;
  const hero = ProjectHeroImage[projectId];

  // Figure out the next project. Compiling them all is inefficient, but it's
  // the easiest way to get the sorted list of slugs.
  const allPages = await compileAllPages();
  const slugs = allPages.map(({ slug }) => slug);
  const currentSlugIndex = slugs.indexOf(slug);
  const next = currentSlugIndex - 1 >= 0 ? allPages[currentSlugIndex - 1] : allPages[allPages.length - 1];
  const previous = currentSlugIndex + 1 < allPages.length ? allPages[currentSlugIndex + 1] : allPages[0];

  return (
    <Project frontmatter={frontmatter} hero={hero} next={next} previous={previous}>
      {content}
    </Project>
  );
}

// eslint-disable-next-line @typescript-eslint/no-unused-vars
export async function generateMetadata({ params }: SlugPageProps, parent: ResolvingMetadata): Promise<Metadata> {
  const { slug } = await params;

  const { frontmatter } = await compileMarkdown(slug);

  const hero = ProjectHeroImage[frontmatter.id as ProjectId];

  return {
    title: frontmatter.title,
    description: frontmatter.shortDescription,
    openGraph: {
      type: 'article',
      title: frontmatter.title,
      description: frontmatter.shortDescription,
      images: [
        {
          url: hero.src,
          width: 1400,
          height: 788,
        },
      ],
    },
    twitter: {
      card: 'summary_large_image',
      creator: '@Vestride',
      title: frontmatter.title,
      description: frontmatter.shortDescription,
      images: [
        {
          url: hero.src,
          width: 1400,
          height: 788,
        },
      ],
    },
  };
}
