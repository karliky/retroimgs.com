export default function About() {
  return (
    <div className="min-h-[calc(100vh-6rem)] py-8 space-y-12">
      <header className="space-y-4">
        <h1 className="text-4xl font-bold">About RetroImgs</h1>
        <p className="text-gray-400">The story behind your favorite retro gaming image API</p>
      </header>

      <div className="space-y-12">
        <section className="space-y-6">
          <h2 className="text-2xl font-bold text-purple-400">Our Mission</h2>
          <p className="text-gray-300 leading-relaxed">
            RetroImgs was born from a simple idea: make it easy for developers and retro gaming enthusiasts 
            to access high-quality screenshots from classic video games. Whether you&apos;re building a website, 
            creating a presentation, or just need some nostalgic placeholder images, we&apos;ve got you covered.
          </p>
        </section>

        <section className="space-y-6">
          <h2 className="text-2xl font-bold text-purple-400">What We Offer</h2>
          <div className="grid md:grid-cols-2 gap-8">
            <div className="bg-gray-800/30 p-6 rounded-lg space-y-4">
              <h3 className="text-xl font-bold">Extensive Library</h3>
              <p className="text-gray-300">
                Our database includes thousands of carefully curated screenshots from the most iconic 
                gaming platforms, spanning multiple generations of consoles and handhelds.
              </p>
            </div>
            <div className="bg-gray-800/30 p-6 rounded-lg space-y-4">
              <h3 className="text-xl font-bold">Simple Integration</h3>
              <p className="text-gray-300">
                With our straightforward API, integrating retro gaming images into your projects 
                is as simple as adding an img tag. No authentication required for basic usage.
              </p>
            </div>
          </div>
        </section>

        <section className="space-y-6">
          <h2 className="text-2xl font-bold text-purple-400">Credits</h2>
          <div className="bg-gray-800/30 p-6 rounded-lg space-y-4">
            <p className="text-gray-300 leading-relaxed">
              We want to give special thanks to Dan Patrick for his incredible work on the console logos 
              used throughout our website. His collection of professionally redrawn console logos represents 
              over 500 hours of work across 15 months, bringing unprecedented quality and accuracy to 
              gaming platform logos.
            </p>
            <p className="text-gray-300 leading-relaxed">
              The complete collection of these logos can be found on{' '}
              <a 
                href="https://archive.org/details/console-logos-professionally-redrawn-plus-official-versions"
                target="_blank"
                rel="noopener noreferrer"
                className="text-purple-400 hover:text-purple-300 underline"
              >
                Internet Archive
              </a>
              , where Dan has made them available for the community. The collection includes over 245 
              platforms across arcade systems, computers, consoles, and handhelds.
            </p>
          </div>
        </section>

        <section className="space-y-6">
          <h2 className="text-2xl font-bold text-purple-400">Contact Us</h2>
          <div className="bg-gray-800/30 p-6 rounded-lg">
            <p className="text-gray-300">
              Have questions or suggestions? We&apos;d love to hear from you! Reach out to us at{' '}
              <a href="mailto:contact@retroimgs.com" className="text-purple-400 hover:text-purple-300">
                contact@retroimgs.com
              </a>
            </p>
          </div>
        </section>
      </div>
    </div>
  );
} 