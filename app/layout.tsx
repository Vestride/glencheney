import type { Metadata, Viewport } from 'next';
import { GoogleAnalytics } from '@next/third-parties/google';

import '@/globals.css';
import '@/grid.css';
import '@/prism-theme.css';
import { Header } from '@/components/header';
import { TITLE, DESCRIPTION } from '@/constants';

const image = '/we-dot-odopod-hero.png';

export const viewport: Viewport = {
  themeColor: '#3498db',
};

export const metadata: Metadata = {
  metadataBase: new URL('https://glencheney.com'),
  title: {
    default: TITLE,
    template: '%s | Glen Cheney’s Portfolio',
  },
  description: DESCRIPTION,
  icons: {
    icon: [
      {
        url: '/favicon-32x32.png',
        sizes: '32x32',
      },
      {
        url: '/favicon-16x16.png',
        sizes: '16x16',
      },
    ],
    apple: '/apple-touch-icon.png',
  },
  manifest: '/site.webmanifest',
  openGraph: {
    title: TITLE,
    description: DESCRIPTION,
    images: [image],
  },
  twitter: {
    card: 'summary_large_image',
    creator: '@Vestride',
    title: TITLE,
    description: DESCRIPTION,
    images: [image],
  },
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#3498db" />
      <meta name="msapplication-TileColor" content="#2d89ef" />
      <body>
        <Header siteTitle="Glen Cheney" />
        <main>{children}</main>
      </body>
      <GoogleAnalytics gaId="UA-24218764-1" />
    </html>
  );
}
