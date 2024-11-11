import Link from 'next/link';

export default function NotFound() {
  return (
    <>
      <div className="spacer-btm-large"></div>
      <div className="container">
        <div className="col-12" style={{ textAlign: 'center' }}>
          <h1 className="type-header-1">This is awkward</h1>
          <p>The page you&rsquo;re trying to visit doesn&rsquo;t exist.</p>
          <p>
            <Link href="/">Return Home</Link>
          </p>
        </div>
      </div>
    </>
  );
}
