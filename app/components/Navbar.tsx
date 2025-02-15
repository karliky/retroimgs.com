'use client';
import { Camera, Code, Home, Menu, X, Gamepad2 } from 'lucide-react';
import Link from 'next/link';
import { useState } from 'react';

export default function Navbar() {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  
  return (
    <header className="bg-black/50 backdrop-blur-sm fixed top-0 left-0 right-0 z-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-16">
          <div className="flex items-center">
            <Link href="/" className="text-white font-bold text-xl flex items-center gap-2">
              <Gamepad2 className="w-6 h-6 text-cyan-400" />
              RetroImgs
            </Link>
          </div>

          {/* Desktop Navigation */}
          <nav className="hidden md:flex items-center space-x-8">
            <Link href="/" className="text-gray-300 hover:text-cyan-400 flex items-center space-x-2 transition-colors">
              <Home className="w-4 h-4" />
              <span>Home</span>
            </Link>
            <Link href="/api-docs" className="text-gray-300 hover:text-cyan-400 flex items-center space-x-2 transition-colors">
              <Code className="w-4 h-4" />
              <span>API Docs</span>
            </Link>
            <Link href="/gallery" className="text-gray-300 hover:text-cyan-400 flex items-center space-x-2 transition-colors">
              <Camera className="w-4 h-4" />
              <span>Gallery</span>
            </Link>
          </nav>

          {/* Mobile menu button */}
          <button
            className="md:hidden text-gray-300 hover:text-white"
            onClick={() => setIsMenuOpen(!isMenuOpen)}
          >
            {isMenuOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
          </button>
        </div>

        {/* Mobile Navigation */}
        {isMenuOpen && (
          <nav className="md:hidden py-4 space-y-4">
            <Link href="/" className="text-gray-300 hover:text-cyan-400 flex items-center space-x-2 transition-colors">
              <Home className="w-4 h-4" />
              <span>Home</span>
            </Link>
            <Link href="/api-docs" className="text-gray-300 hover:text-cyan-400 flex items-center space-x-2 transition-colors">
              <Code className="w-4 h-4" />
              <span>API Docs</span>
            </Link>
            <Link href="/gallery" className="text-gray-300 hover:text-cyan-400 flex items-center space-x-2 transition-colors">
              <Camera className="w-4 h-4" />
              <span>Gallery</span>
            </Link>
          </nav>
        )}
      </div>
    </header>
  );
} 