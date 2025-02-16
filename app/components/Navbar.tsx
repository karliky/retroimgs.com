'use client';
import { Camera, Code, Home, Menu, X, Gamepad2 } from 'lucide-react';
import Link from 'next/link';
import { useState } from 'react';
import { usePathname } from 'next/navigation';
import { useEffect } from 'react';

export default function Navbar() {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const pathname = usePathname();
  
  // Close menu when pathname changes
  useEffect(() => {
    setIsMenuOpen(false);
  }, [pathname]);

  // Create a custom Link component that includes a more subtle active state styling
  const NavLink = ({ href, children }: { href: string, children: React.ReactNode }) => {
    const isActive = pathname === href;
    return (
      <Link 
        href={href} 
        className={`flex items-center space-x-2 transition-colors px-3 py-2 rounded-lg ${
          isActive 
            ? 'text-cyan-400 bg-white/5' 
            : 'text-gray-300 hover:text-cyan-400 hover:bg-white/5'
        }`}
      >
        {children}
      </Link>
    );
  };
  
  return (
    <header className="bg-black/50 backdrop-blur-sm fixed top-0 left-0 right-0 z-50">
      <div className="container mx-auto">
        <div className="px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center h-16">
            <div className="flex items-center">
              <Link href="/" className="text-white font-bold text-xl flex items-center gap-2">
                <Gamepad2 className="w-6 h-6 text-cyan-400" />
                RetroImgs
              </Link>
            </div>

            {/* Desktop Navigation */}
            <nav className="hidden md:flex items-center space-x-2">
              <NavLink href="/">
                <Home className="w-4 h-4" />
                <span>Home</span>
              </NavLink>
              <NavLink href="/api-docs">
                <Code className="w-4 h-4" />
                <span>API Docs</span>
              </NavLink>
              <NavLink href="/gallery">
                <Camera className="w-4 h-4" />
                <span>Gallery</span>
              </NavLink>
            </nav>

            {/* Mobile menu button */}
            <button
              className="md:hidden text-gray-300 hover:text-white"
              onClick={() => setIsMenuOpen(!isMenuOpen)}
              aria-label={isMenuOpen ? 'Close menu' : 'Open menu'}
            >
              {isMenuOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
            </button>
          </div>

          {/* Mobile Navigation */}
          {isMenuOpen && (
            <nav className="md:hidden py-4 space-y-2">
              <NavLink href="/">
                <Home className="w-4 h-4" />
                <span>Home</span>
              </NavLink>
              <NavLink href="/api-docs">
                <Code className="w-4 h-4" />
                <span>API Docs</span>
              </NavLink>
              <NavLink href="/gallery">
                <Camera className="w-4 h-4" />
                <span>Gallery</span>
              </NavLink>
            </nav>
          )}
        </div>
      </div>
    </header>
  );
} 