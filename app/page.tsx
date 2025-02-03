import Link from 'next/link';
import Image from 'next/image';

export default function Home() {
  return (
    <div className="space-y-32 pb-20">
      {/* Hero Section */}
      <section className="py-20 text-center space-y-8">
        <h1 className="text-6xl font-joti-one bg-gradient-to-r from-purple-400 via-pink-400 to-purple-500 text-transparent bg-clip-text"
            style={{
              textShadow: "3px 3px 6px rgba(168, 85, 247, 0.3)",
              WebkitTextStroke: "1px rgba(168, 85, 247, 0.1)"
            }}>
          Retro Gaming Images
          <br />
          Made Simple
        </h1>
        <p className="text-xl text-gray-400 max-w-2xl mx-auto">
          Access thousands of classic gaming screenshots through our simple API.
          Perfect for placeholders, mockups, or just reliving the golden age of gaming.
        </p>
        <div className="flex justify-center gap-6">
          <Link 
            href="/api-docs"
            className="bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-lg font-medium transition-colors duration-200"
          >
            Get Started
          </Link>
          <Link
            href="/gallery"
            className="bg-gray-800 hover:bg-gray-700 text-white px-8 py-3 rounded-lg font-medium transition-colors duration-200"
          >
            Browse Gallery
          </Link>
        </div>
      </section>

      {/* Example Section */}
      <section className="space-y-8">
        <h2 className="text-3xl font-bold text-center">Simple to Use</h2>
        <div className="bg-gray-800/50 p-6 rounded-lg">
          <pre className="font-mono text-sm">
            <code className="text-purple-400">
              {'<img src="https://api.retroimgs.com/random" alt="Random retro game screenshot" />'}
            </code>
          </pre>
        </div>
      </section>

      {/* Features Section */}
      <section className="grid md:grid-cols-3 gap-8">
        <div className="bg-gray-800/30 p-6 rounded-lg space-y-4">
          <h3 className="text-xl font-bold text-purple-400">Extensive Library</h3>
          <p className="text-gray-400">
            Access thousands of screenshots from classic consoles like NES, SNES, Genesis, and more.
          </p>
        </div>
        <div className="bg-gray-800/30 p-6 rounded-lg space-y-4">
          <h3 className="text-xl font-bold text-purple-400">Simple API</h3>
          <p className="text-gray-400">
            Easy-to-use REST API with filtering options for console, game, year, and more.
          </p>
        </div>
        <div className="bg-gray-800/30 p-6 rounded-lg space-y-4">
          <h3 className="text-xl font-bold text-purple-400">Free to Use</h3>
          <p className="text-gray-400">
            No API key required for basic usage. Perfect for personal projects and prototypes.
          </p>
        </div>
      </section>
    </div>
  );
}
