import { StaticImageData } from 'next/image';
import hennessyHero from '../public/hennessy-hero.png';
import hennessy from '../public/hennessy.png';
import odopodCodeLibraryHero from '../public/odopod-code-library-hero.png';
import odopodCodeLibrary from '../public/odopod-code-library.png';
import odopodComHero from '../public/odopod-com-hero.png';
import odopodCom from '../public/odopod-com.png';
import shuffleHero from '../public/shuffle-hero.png';
import shuffle from '../public/shuffle.png';
import weDotOdopodHero from '../public/we-dot-odopod-hero.png';
import weDotOdopod from '../public/we-dot-odopod.png';
import audemarsPiguetHero from '../public/audemars-piguet-hero.png';
import audemarsPiguet from '../public/audemars-piguet.png';
import compdropHero from '../public/compdrop-hero.png';
import compdrop from '../public/compdrop.png';
import cssnanoMinifierHero from '../public/cssnano-minifier-hero.png';
import cssnanoMinifier from '../public/cssnano-minifier.png';

export enum ProjectId {
  Hennessy = 1,
  OdopodCodeLibrary = 2,
  OdopodCom = 3,
  Shuffle = 4,
  WeDotOdopod = 5,
  AudemarsPiguet = 6,
  Compdrop = 7,
  CssnanoMinifier = 8,
}

export const ProjectHeroImage: Record<ProjectId, StaticImageData> = {
  [ProjectId.Hennessy]: hennessyHero,
  [ProjectId.OdopodCodeLibrary]: odopodCodeLibraryHero,
  [ProjectId.OdopodCom]: odopodComHero,
  [ProjectId.Shuffle]: shuffleHero,
  [ProjectId.WeDotOdopod]: weDotOdopodHero,
  [ProjectId.AudemarsPiguet]: audemarsPiguetHero,
  [ProjectId.Compdrop]: compdropHero,
  [ProjectId.CssnanoMinifier]: cssnanoMinifierHero,
};

export const ProjectImage: Record<ProjectId, StaticImageData> = {
  [ProjectId.Hennessy]: hennessy,
  [ProjectId.OdopodCodeLibrary]: odopodCodeLibrary,
  [ProjectId.OdopodCom]: odopodCom,
  [ProjectId.Shuffle]: shuffle,
  [ProjectId.WeDotOdopod]: weDotOdopod,
  [ProjectId.AudemarsPiguet]: audemarsPiguet,
  [ProjectId.Compdrop]: compdrop,
  [ProjectId.CssnanoMinifier]: cssnanoMinifier,
};
