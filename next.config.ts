import type { NextConfig } from 'next';
import createMDX from '@next/mdx';
import remarkGfm from 'remark-gfm';
import remarkFrontmatter from 'remark-frontmatter';
import rehypePrism from 'rehype-prism';
import rehypeSlug from 'rehype-slug';

const nextConfig: NextConfig = {
  output: 'export',
  pageExtensions: ['md', 'mdx', 'ts', 'tsx'],
  images: {
    unoptimized: true,
  },
};

const withMDX = createMDX({
  extension: /\.mdx?$/,
  options: {
    remarkPlugins: [remarkGfm, remarkFrontmatter],
    rehypePlugins: [rehypePrism, rehypeSlug],
  },
});

// Merge MDX config with Next.js config
export default withMDX(nextConfig);
