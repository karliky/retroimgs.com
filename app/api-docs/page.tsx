'use client';
import { useState, useRef, useEffect } from 'react';
import { Sliders, RefreshCcw, Download } from 'lucide-react';

type ImageFormat = 'jpeg' | 'png' | 'webp';
type FitMode = 'cover' | 'contain' | 'fill' | 'inside' | 'outside';

interface APIConfig {
  width: number;
  height: number;
  format: ImageFormat;
  quality: number;
  fit: FitMode;
}

export default function ApiDocs() {
  const [activeEndpoint, setActiveEndpoint] = useState<'random' | 'console' | 'game'>('random');
  const [isLoading, setIsLoading] = useState(false);
  const [currentImage, setCurrentImage] = useState<string | null>(null);
  const canvasRef = useRef<HTMLCanvasElement>(null);
  
  const [config, setConfig] = useState<APIConfig>({
    width: 800,
    height: 600,
    format: 'webp',
    quality: 90,
    fit: 'cover'
  });

  // Function to construct API URL based on current config
  const constructApiUrl = () => {
    // Use window.location.origin to get the current domain
    const baseUrl = typeof window !== 'undefined' ? window.location.origin : '';
    const params = new URLSearchParams({
      width: config.width.toString(),
      height: config.height.toString(),
      format: config.format,
      quality: config.quality.toString(),
      fit: config.fit
    });

    switch (activeEndpoint) {
      case 'random':
        return `${baseUrl}/api/random?${params}`;
      case 'console':
        return `${baseUrl}/api/console/nes?${params}`;
      case 'game':
        return `${baseUrl}/api/game/123?${params}`;
      default:
        return `${baseUrl}/api/random?${params}`;
    }
  };

  // Function to test the API
  const testApi = async () => {
    setIsLoading(true);
    try {
      const response = await fetch(constructApiUrl());
      const blob = await response.blob();
      const imageUrl = URL.createObjectURL(blob);
      setCurrentImage(imageUrl);
    } catch (error) {
      console.error('Error testing API:', error);
    } finally {
      setIsLoading(false);
    }
  };

  // Effect to draw image on canvas when it changes
  useEffect(() => {
    if (currentImage && canvasRef.current) {
      const canvas = canvasRef.current;
      const ctx = canvas.getContext('2d');
      const img = new Image();
      
      img.onload = () => {
        if (ctx) {
          canvas.width = config.width;
          canvas.height = config.height;
          ctx.drawImage(img, 0, 0, config.width, config.height);
        }
      };
      
      img.src = currentImage;
    }
  }, [currentImage, config.width, config.height]);

  return (
    <div className="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div className="space-y-12 pb-12">
        <header className="space-y-4">
          <h1 className="text-4xl font-bold">API Documentation</h1>
          <p className="text-gray-400">Everything you need to know about using the RetroImgs API.</p>
        </header>

        {/* Two-column layout with proper spacing */}
        <div className="grid lg:grid-cols-2 gap-12">
          {/* Left Column - Documentation */}
          <div className="space-y-8 h-fit">
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
                    <pre className="bg-black/50 p-4 rounded overflow-x-auto">
                      <code className="break-all whitespace-pre-wrap">GET https://retroimgs.com/api/random?width=800&height=600&format=webp&quality=90</code>
                    </pre>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Right Column - Interactive Testing */}
          <div className="space-y-8 h-fit">
            <h2 className="text-2xl font-bold text-purple-400">Try It Out</h2>
            
            <div className="space-y-8">
              {/* Configuration Panel */}
              <div className="space-y-6 bg-gray-800/30 p-6 rounded-lg">
                <div className="flex items-center gap-2">
                  <Sliders className="w-5 h-5 text-purple-400" />
                  <h3 className="text-xl font-bold">Configuration</h3>
                </div>

                <div className="space-y-2">
                  <label className="text-sm text-gray-400">Endpoint</label>
                  <div className="grid grid-cols-3 gap-2">
                    {(['random', 'console', 'game'] as const).map((endpoint) => (
                      <button
                        key={endpoint}
                        onClick={() => setActiveEndpoint(endpoint)}
                        className={`px-4 py-2 rounded ${
                          activeEndpoint === endpoint
                            ? 'bg-purple-600 text-white'
                            : 'bg-gray-700/30 text-gray-300 hover:bg-gray-700/50'
                        }`}
                      >
                        {endpoint}
                      </button>
                    ))}
                  </div>
                </div>

                <div className="grid grid-cols-2 gap-4">
                  <div className="space-y-2">
                    <label className="text-sm text-gray-400">Width</label>
                    <input
                      type="number"
                      value={config.width}
                      onChange={(e) => setConfig({ ...config, width: parseInt(e.target.value) })}
                      className="w-full px-3 py-2 bg-gray-700/30 rounded focus:outline-none focus:ring-2 focus:ring-purple-500"
                    />
                  </div>
                  <div className="space-y-2">
                    <label className="text-sm text-gray-400">Height</label>
                    <input
                      type="number"
                      value={config.height}
                      onChange={(e) => setConfig({ ...config, height: parseInt(e.target.value) })}
                      className="w-full px-3 py-2 bg-gray-700/30 rounded focus:outline-none focus:ring-2 focus:ring-purple-500"
                    />
                  </div>
                </div>

                <div className="space-y-2">
                  <label className="text-sm text-gray-400">Format</label>
                  <select
                    value={config.format}
                    onChange={(e) => setConfig({ ...config, format: e.target.value as ImageFormat })}
                    className="w-full px-3 py-2 bg-gray-700/30 rounded focus:outline-none focus:ring-2 focus:ring-purple-500"
                  >
                    <option value="webp">WebP</option>
                    <option value="jpeg">JPEG</option>
                    <option value="png">PNG</option>
                  </select>
                </div>

                <div className="space-y-2">
                  <label className="text-sm text-gray-400">Quality: {config.quality}%</label>
                  <input
                    type="range"
                    min="1"
                    max="100"
                    value={config.quality}
                    onChange={(e) => setConfig({ ...config, quality: parseInt(e.target.value) })}
                    className="w-full"
                  />
                </div>

                <div className="space-y-2">
                  <label className="text-sm text-gray-400">Fit Mode</label>
                  <select
                    value={config.fit}
                    onChange={(e) => setConfig({ ...config, fit: e.target.value as FitMode })}
                    className="w-full px-3 py-2 bg-gray-700/30 rounded focus:outline-none focus:ring-2 focus:ring-purple-500"
                  >
                    <option value="cover">Cover</option>
                    <option value="contain">Contain</option>
                    <option value="fill">Fill</option>
                    <option value="inside">Inside</option>
                    <option value="outside">Outside</option>
                  </select>
                </div>

                <button
                  onClick={testApi}
                  disabled={isLoading}
                  className="w-full py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg flex items-center justify-center gap-2 transition-colors"
                >
                  {isLoading ? (
                    <RefreshCcw className="w-5 h-5 animate-spin" />
                  ) : (
                    <>
                      <RefreshCcw className="w-5 h-5" />
                      Test API
                    </>
                  )}
                </button>
              </div>

              {/* Preview Panel */}
              <div className="space-y-4">
                <div className="flex items-center justify-between">
                  <h3 className="text-xl font-bold">Preview</h3>
                  {currentImage && (
                    <a
                      href={currentImage}
                      download="retro-image"
                      className="flex items-center gap-2 text-purple-400 hover:text-purple-300"
                    >
                      <Download className="w-5 h-5" />
                      Download
                    </a>
                  )}
                </div>

                <div className="relative bg-gray-800/30 rounded-lg overflow-hidden">
                  <div className="absolute inset-0 bg-[linear-gradient(45deg,_#2c2c2c_25%,_transparent_25%,_transparent_75%,_#2c2c2c_75%,_#2c2c2c),linear-gradient(45deg,_#2c2c2c_25%,_transparent_25%,_transparent_75%,_#2c2c2c_75%,_#2c2c2c)] bg-[length:20px_20px] bg-[position:0_0,_10px_10px] opacity-50" />
                  <canvas
                    ref={canvasRef}
                    className="relative z-10 max-w-full h-auto mx-auto"
                  />
                  {!currentImage && (
                    <div className="absolute inset-0 flex items-center justify-center text-gray-400">
                      Click &quot;Test API&quot; to load an image
                    </div>
                  )}
                </div>

                <div className="space-y-2">
                  <label className="text-sm text-gray-400">Generated URL</label>
                  <div className="bg-gray-800/30 p-4 rounded-lg">
                    <code className="text-sm text-purple-400 break-all">
                      {constructApiUrl()}
                    </code>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
} 