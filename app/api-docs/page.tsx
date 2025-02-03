export default function ApiDocs() {
  return (
    <div className="py-12 space-y-12">
      <header className="space-y-4">
        <h1 className="text-4xl font-bold">API Documentation</h1>
        <p className="text-gray-400">Everything you need to know about using the RetroImgs API.</p>
      </header>

      <section className="space-y-8">
        <div className="space-y-4">
          <h2 className="text-2xl font-bold text-purple-400">Endpoints</h2>
          
          <div className="space-y-6">
            <div className="bg-gray-800/30 p-6 rounded-lg space-y-4">
              <h3 className="text-xl font-bold">Random Image</h3>
              <pre className="bg-black/50 p-4 rounded">
                <code>GET https://api.retroimgs.com/random</code>
              </pre>
              <p className="text-gray-400">Returns a random retro game screenshot.</p>
            </div>

            <div className="bg-gray-800/30 p-6 rounded-lg space-y-4">
              <h3 className="text-xl font-bold">Console Specific</h3>
              <pre className="bg-black/50 p-4 rounded">
                <code>{'GET https://api.retroimgs.com/console/{console-name}'}</code>
              </pre>
              <p className="text-gray-400">Returns a random screenshot from a specific console.</p>
            </div>

            <div className="bg-gray-800/30 p-6 rounded-lg space-y-4">
              <h3 className="text-xl font-bold">Game Specific</h3>
              <pre className="bg-black/50 p-4 rounded">
                <code>{'GET https://api.retroimgs.com/game/{game-id}'}</code>
              </pre>
              <p className="text-gray-400">Returns a specific game screenshot.</p>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
} 