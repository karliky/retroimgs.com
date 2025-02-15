import Link from 'next/link';
import { Terminal, Gamepad2, Sparkles } from 'lucide-react';
import Image from 'next/image';

export default function Home() {
  return (
    <div className="min-h-[90vh] flex items-center justify-center">
      <div className="relative grid md:grid-cols-2 gap-12 items-center max-w-6xl mx-auto px-4">
        {/* Decorative scanlines overlay */}
        <div className="absolute inset-0 bg-[linear-gradient(transparent_0%,_rgba(0,0,0,0.3)_50%,_transparent_100%)] bg-[length:100%_4px] pointer-events-none" />
        
        {/* Main content */}
        <div className="relative space-y-6 text-center md:text-left">
          {/* Glowing text effect */}
          <h1 className="text-6xl md:text-7xl font-bold tracking-tighter">
            <span className="bg-gradient-to-r from-purple-400 via-cyan-400 to-purple-400 text-transparent bg-clip-text animate-gradient">
              RetroImgs
            </span>
          </h1>

          {/* Feature badges */}
          <div className="flex flex-wrap gap-4 justify-center md:justify-start">
            <div className="bg-purple-500/10 border border-purple-500/20 rounded-full px-6 py-2 flex items-center gap-2">
              <Terminal size={16} className="text-purple-400" />
              <span className="text-sm">Simple API</span>
            </div>
            <div className="bg-cyan-500/10 border border-cyan-500/20 rounded-full px-6 py-2 flex items-center gap-2">
              <Gamepad2 size={16} className="text-cyan-400" />
              <span className="text-sm">200+ Platforms</span>
            </div>
            <div className="bg-purple-500/10 border border-purple-500/20 rounded-full px-6 py-2 flex items-center gap-2">
              <Sparkles size={16} className="text-purple-400" />
              <span className="text-sm">High Quality</span>
            </div>
          </div>

          <p className="text-gray-400 text-lg">
            The perfect Lorem Ipsum for retro video game images.
            Access thousands of classic gaming screenshots through our simple API.
          </p>

          {/* CTA Buttons */}
          <div className="flex gap-4 justify-center md:justify-start">
            <Link 
              href="/api-docs"
              className="group relative px-8 py-3 bg-purple-500 hover:bg-purple-600 text-white rounded-lg transition-all duration-200 overflow-hidden"
            >
              <div className="absolute inset-0 bg-gradient-to-r from-purple-600 to-cyan-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
              <span className="relative">Get Started</span>
            </Link>
            <Link 
              href="/gallery"
              className="px-8 py-3 bg-gray-800/50 hover:bg-gray-800/70 text-gray-300 rounded-lg transition-colors duration-200"
            >
              Browse Gallery
            </Link>
          </div>
        </div>

        {/* Hero Image - Updated styling */}
        <div className="relative aspect-square md:aspect-auto md:h-[600px] rounded-lg overflow-hidden order-first md:order-last">
          <Image
            src="https://images.unsplash.com/photo-1584212166146-8a6b4eb62fcc?q=80&w=3000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            alt="Retro gaming setup with purple lighting"
            fill
            className="object-cover object-[75%_50%]"
            priority
          />
          <div className="absolute inset-0 bg-gradient-to-r from-black/80 via-black/20 to-transparent md:bg-gradient-to-l" />
        </div>
      </div>
    </div>
  );
}
