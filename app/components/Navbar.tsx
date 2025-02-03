'use client';
import Link from 'next/link';
import { usePathname } from 'next/navigation';
import { useState } from 'react';

export default function Navbar() {
  const pathname = usePathname();
  const [isOpen, setIsOpen] = useState(false);
  
  const isActive = (path: string) => {
    return pathname === path ? 'text-purple-400' : 'text-gray-300 hover:text-white';
  };

  return (
    <nav className="bg-gray-900/50 backdrop-blur-sm sticky top-0 z-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          <div className="flex-shrink-0">
            <Link 
              href="/" 
              className="text-2xl font-joti-one text-transparent bg-clip-text bg-gradient-to-r from-purple-300 via-purple-400 to-pink-400 hover:from-purple-200 hover:via-purple-300 hover:to-pink-300 transition-all duration-300"
              style={{ 
                letterSpacing: "0.5px",
                textShadow: "2px 2px 4px rgba(168, 85, 247, 0.4)",
                WebkitTextStroke: "1px rgba(168, 85, 247, 0.2)"
              }}
            >
              RetroImgs
            </Link>
          </div>
          
          {/* Mobile menu button */}
          <div className="md:hidden">
            <button
              onClick={() => setIsOpen(!isOpen)}
              className="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none"
              aria-expanded="false"
            >
              <span className="sr-only">Open main menu</span>
              {/* Hamburger icon */}
              <svg
                className={`${isOpen ? 'hidden' : 'block'} h-6 w-6`}
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
              </svg>
              {/* Close icon */}
              <svg
                className={`${isOpen ? 'block' : 'hidden'} h-6 w-6`}
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          {/* Desktop menu */}
          <div className="hidden md:flex md:space-x-8">
            <Link href="/" className={`${isActive('/')} transition-colors duration-200 font-medium`}>
              Home
            </Link>
            <Link href="/api-docs" className={`${isActive('/api-docs')} transition-colors duration-200 font-medium`}>
              API Docs
            </Link>
            <Link href="/gallery" className={`${isActive('/gallery')} transition-colors duration-200 font-medium`}>
              Gallery
            </Link>
          </div>
        </div>

        {/* Mobile menu, show/hide based on menu state */}
        <div className={`${isOpen ? 'block' : 'hidden'} md:hidden`}>
          <div className="px-2 pt-2 pb-3 space-y-1">
            <Link
              href="/"
              className={`${isActive('/')} block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200`}
            >
              Home
            </Link>
            <Link
              href="/api-docs"
              className={`${isActive('/api-docs')} block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200`}
            >
              API Docs
            </Link>
            <Link
              href="/gallery"
              className={`${isActive('/gallery')} block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200`}
            >
              Gallery
            </Link>
          </div>
        </div>
      </div>
    </nav>
  );
} 