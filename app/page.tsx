"use client";
import Link from 'next/link';
import { Terminal, Gamepad2, Sparkles } from 'lucide-react';
import { useEffect, useRef } from 'react';

const GAME_IMAGES = [
  'https://cdn11.bigcommerce.com/s-ymgqt/images/stencil/1280x1280/products/27913/63698/brosdes__08247.1720030578.gif',
  'https://m.media-amazon.com/images/I/71Mix1O+d0L._AC_UF1000,1000_QL80_.jpg',
  'https://platform.polygon.com/wp-content/uploads/sites/2/chorus/uploads/chorus_asset/file/666726/pkmn1.0.jpg',
  'https://img.itch.zone/aW1nLzEzMzM3NDQ2LmdpZg==/315x250%23cm/VX6Y6F.gif',
  'https://thekingofgrabs.com/wp-content/uploads/2017/12/lufia-the-ruins-of-lore-gba-wide.png?w=1038&h=576&crop=1',
  'https://imgix.ranker.com/user_node_img/91/1818287/original/pok_mon-puzzle-challenge-photo-u1?auto=format&q=60&fit=crop&fm=pjpg&dpr=2&w=355',
  'https://cdn.arstechnica.net/wp-content/uploads/2019/02/mnscreen.jpg',
  'https://platform.polygon.com/wp-content/uploads/sites/2/chorus/uploads/chorus_asset/file/7870005/Screen_Shot_2017_01_25_at_1.27.36_PM.png?quality=90&strip=all&crop=0,5.9961315280464,100,94.003868471954',
  'https://i.ytimg.com/vi/rN9DBptxCuk/hqdefault.jpg'
];

// Helper function to get a subset of images with rotation
const getImageSubset = (startIndex: number, count: number) => {
  const result = [];
  for (let i = 0; i < count; i++) {
    const index = (startIndex + i) % GAME_IMAGES.length;
    result.push(GAME_IMAGES[index]);
  }
  return result;
};

function ScrollingRow({ images, speed, delay = 0 }: { images: string[], speed: number, delay?: number }) {
  const scrollerRef = useRef<HTMLDivElement>(null);
  const contentRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    if (!scrollerRef.current || !contentRef.current) return;
    
    const scroller = scrollerRef.current;
    const content = contentRef.current;
    
    // Clone the content for seamless scrolling
    scroller.appendChild(content.cloneNode(true));
    
    let animationFrameId: number;
    let startTime: number | null = null;
    let currentTranslate = 0;
    
    const animate = (timestamp: number) => {
      if (!startTime) startTime = timestamp;
      const elapsed = timestamp - startTime;
      
      // Calculate the new position
      currentTranslate = (elapsed * speed) % content.offsetWidth;
      scroller.style.transform = `translateX(-${currentTranslate}px)`;
      
      animationFrameId = requestAnimationFrame(animate);
    };

    // Add delay before starting animation
    setTimeout(() => {
      animationFrameId = requestAnimationFrame(animate);
    }, delay);

    return () => {
      if (animationFrameId) {
        cancelAnimationFrame(animationFrameId);
      }
    };
  }, [speed, delay]);

  return (
    <div className="scroll-outer-container overflow-hidden">
      <div className="scroll-container" ref={scrollerRef}>
        <div className="scroll-content" ref={contentRef}>
          {images.map((url, index) => (
            <img 
              key={index} 
              src={url} 
              className="scroll-image w-[200px] h-[120px] object-cover rounded-lg mx-2" 
              alt={`Gaming image ${index + 1}`}
              loading="eager"
            />
          ))}
        </div>
      </div>
    </div>
  );
}

export default function Home() {
  // Create three different arrangements of the images
  const row1Images = getImageSubset(0, 6);
  const row2Images = getImageSubset(3, 6);
  const row3Images = getImageSubset(6, 6);

  return (
    <div className="container mx-auto">
      <div className="min-h-[90vh] flex items-center justify-center py-12 lg:py-24">
        <div className="relative grid lg:grid-cols-2 gap-8 lg:gap-12 items-center w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
          {/* Decorative scanlines overlay */}
          <div className="absolute inset-0 bg-[linear-gradient(transparent_0%,_rgba(0,0,0,0.3)_50%,_transparent_100%)] bg-[length:100%_4px] pointer-events-none" />
          
          {/* Main content */}
          <div className="relative space-y-6 text-center lg:text-left">
            {/* Optimized headline */}
            <h1 className="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold tracking-tighter">
              <span>
                Retro Gaming Image API
              </span>
            </h1>

            {/* Feature badges with enhanced copy */}
            <div className="flex flex-wrap gap-4 justify-center lg:justify-start">
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

            {/* Enhanced value proposition */}
            <p className="text-gray-400 text-lg">
              Power your{' '}
              <span className="inline-block bg-gradient-to-r from-purple-400 via-cyan-400 to-purple-400 bg-clip-text text-transparent font-semibold hover:animate-pulse transition-all duration-300">
                retro gaming projects
              </span>
              {' '}with the most comprehensive game screenshot API. 
              Access high-quality images from NES, SNES, PlayStation, and 200+ classic gaming platforms. 
              Perfect for developers, content creators, and retro gaming enthusiasts.
            </p>

            {/* CTA Buttons with stronger action words */}
            <div className="flex gap-4 justify-center lg:justify-start">
              <Link 
                href="/api-docs"
                className="group relative px-8 py-3 bg-purple-500 hover:bg-purple-600 text-white rounded-lg transition-all duration-200 overflow-hidden"
              >
                <div className="absolute inset-0 bg-gradient-to-r from-purple-600 to-cyan-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
                <span className="relative">Start Free Trial</span>
              </Link>
              <Link 
                href="/gallery"
                className="px-8 py-3 bg-gray-800/50 hover:bg-gray-800/70 text-gray-300 rounded-lg transition-colors duration-200"
              >
                Explore Library
              </Link>
            </div>
          </div>

          {/* Scrolling Image Grid */}
          <div className="relative order-first lg:order-last w-full overflow-hidden">
            <div className="skewed-container space-y-4">
              <ScrollingRow images={row1Images} speed={0.02} />
              <ScrollingRow images={row2Images} speed={0.03} delay={100} />
              <ScrollingRow images={row3Images} speed={0.015} delay={200} />
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
