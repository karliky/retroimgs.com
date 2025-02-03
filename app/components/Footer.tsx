import Link from 'next/link';

export default function Footer() {
  return (
    <footer className="bg-gradient-to-b from-gray-900/40 to-gray-900/60 backdrop-blur-sm mt-12 py-8">
      <div className="max-w-7xl mx-auto px-4">
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
    </footer>
  );
} 