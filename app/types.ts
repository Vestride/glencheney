import { StaticImageData } from 'next/image';

export interface ProjectFrontmatter {
  title: string;
  date: string;
  id: number;
  href: string;
  tags: string[];
  imageDescription: string;
  shortDescription: string;
}

export interface AugmentedProject extends ProjectFrontmatter {
  slug: string;
  image: StaticImageData;
}
