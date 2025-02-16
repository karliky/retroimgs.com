import Link from 'next/link';

export default function Footer() {
  return (
    <footer className="bg-black/40 backdrop-blur-sm mt-12 py-8">
      <div className="container mx-auto">
        <div className="px-4 sm:px-6 lg:px-8">
          <div className="flex flex-row justify-between items-center">
            <nav className="flex space-x-6">
              <Link
                href="/about"
                className="text-gray-200 hover:text-white"
              >
                About
              </Link>
            </nav>
            
            <div className="text-right">
              <p className="text-gray-300 text-sm mb-2">
                Built with love by a Nogg-Aholic explorer - Karliky
              </p>
              <p className="text-gray-400 text-sm">
                © {new Date().getFullYear()} RetroImgs.
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
} 