import fs from 'node:fs/promises';
import { join, basename } from 'node:path';
import { glob } from 'glob';
import { compileMDX } from 'next-mdx-remote/rsc';
import remarkGfm from 'remark-gfm';
import remarkFrontmatter from 'remark-frontmatter';
import rehypePrism from 'rehype-prism';
import rehypeSlug from 'rehype-slug';

import { useMDXComponents } from '../mdx-components';
import { ProjectFrontmatter, AugmentedProject } from '@/types';
import { ProjectId, ProjectImage } from './images';

export async function getProjectSlugs() {
  const projects = await glob(join(process.cwd(), 'app', 'projects', '*.md'));
  return projects.map((project) => ({
    slug: basename(project, '.md'),
  }));
}

export async function compileMarkdown(slug: string) {
  const source = await fs.readFile(join(process.cwd(), 'app', 'projects', `${slug}.md`));

  // eslint-disable-next-line react-hooks/rules-of-hooks
  const components = useMDXComponents({});

  const result = await compileMDX<ProjectFrontmatter>({
    source,
    options: {
      mdxOptions: {
        remarkPlugins: [remarkGfm, remarkFrontmatter],
        rehypePlugins: [rehypePrism, rehypeSlug],
      },
      parseFrontmatter: true,
    },
    components,
  });

  return result;
}

export async function compileAllPages(): Promise<AugmentedProject[]> {
  const slugs = await getProjectSlugs();
  const promises = slugs.map(({ slug }) => compileMarkdown(slug));
  const pages = await Promise.all(promises);
  const pagesWithSlugs = pages.map<AugmentedProject>((page, i) => ({
    ...page.frontmatter,
    slug: slugs[i].slug,
    image: ProjectImage[page.frontmatter.id as ProjectId],
  }));

  return pagesWithSlugs.toSorted((a, b) => a.id - b.id);
}
