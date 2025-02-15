export default function ApiDocs() {
  return (
    <div className="min-h-[calc(100vh-6rem)] py-8 space-y-12">
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
                <code>GET https://retroimgs.com/api/random</code>
              </pre>
              <p className="text-gray-400">Returns a random retro game screenshot.</p>
            </div>

            <div className="bg-gray-800/30 p-6 rounded-lg space-y-4">
              <h3 className="text-xl font-bold">Console Specific</h3>
              <pre className="bg-black/50 p-4 rounded">
                <code>{'GET https://retroimgs.com/api/console/{console-name}'}</code>
              </pre>
              <p className="text-gray-400">Returns a random screenshot from a specific console.</p>
            </div>

            <div className="bg-gray-800/30 p-6 rounded-lg space-y-4">
              <h3 className="text-xl font-bold">Game Specific</h3>
              <pre className="bg-black/50 p-4 rounded">
                <code>{'GET https://retroimgs.com/api/game/{game-id}'}</code>
              </pre>
              <p className="text-gray-400">Returns a specific game screenshot.</p>
            </div>

            <div className="bg-gray-800/30 p-6 rounded-lg space-y-4">
              <h3 className="text-xl font-bold">Query Parameters</h3>
              <div className="space-y-3">
                <p className="text-gray-400">All endpoints support the following query parameters:</p>
                <ul className="list-disc list-inside space-y-2 text-gray-400">
                  <li><code className="text-purple-400">width</code> - Desired width in pixels</li>
                  <li><code className="text-purple-400">height</code> - Desired height in pixels</li>
                  <li><code className="text-purple-400">fit</code> - Resize mode (cover, contain, fill, inside, outside)</li>
                  <li><code className="text-purple-400">format</code> - Output format (jpeg, png, webp)</li>
                  <li><code className="text-purple-400">quality</code> - Image quality (1-100)</li>
                </ul>
                <p className="text-gray-400">Example:</p>
                <pre className="bg-black/50 p-4 rounded">
                  <code>GET https://retroimgs.com/api/random?width=800&height=600&format=webp&quality=90</code>
                </pre>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
} 