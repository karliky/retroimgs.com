'use client';
import { useState } from 'react';
import Image from 'next/image';
import { consoles, categories, brands, getConsoleBrand, type ConsoleCategory, type ConsoleBrand } from '../data/consoles';

// Helper function to calculate Levenshtein distance
function levenshteinDistance(str1: string, str2: string): number {
  const track = Array(str2.length + 1).fill(null).map(() =>
    Array(str1.length + 1).fill(null));

  for (let i = 0; i <= str1.length; i++) track[0][i] = i;
  for (let j = 0; j <= str2.length; j++) track[j][0] = j;

  for (let j = 1; j <= str2.length; j++) {
    for (let i = 1; i <= str1.length; i++) {
      const indicator = str1[i - 1] === str2[j - 1] ? 0 : 1;
      track[j][i] = Math.min(
        track[j][i - 1] + 1,
        track[j - 1][i] + 1,
        track[j - 1][i - 1] + indicator
      );
    }
  }

  return track[str2.length][str1.length];
}

export default function Gallery() {
  const [selectedCategory, setSelectedCategory] = useState<ConsoleCategory | 'all'>('all');
  const [selectedBrand, setSelectedBrand] = useState<ConsoleBrand | 'all'>('all');
  const [searchQuery, setSearchQuery] = useState('');

  // Updated filtering logic to use fuzzy search
  const filteredConsoles = consoles.filter(console => {
    const categoryMatch = selectedCategory === 'all' || console.category === selectedCategory;
    const brandMatch = selectedBrand === 'all' || getConsoleBrand(console.name) === selectedBrand;
    
    if (!categoryMatch || !brandMatch) return false;
    if (!searchQuery) return true;

    const consoleName = console.name.toLowerCase();
    const search = searchQuery.toLowerCase();
    
    // Direct substring match
    if (consoleName.includes(search)) return true;
    
    // Split search query into words and check each word
    const searchWords = search.split(' ');
    const consoleWords = consoleName.split(' ');
    
    // Check each search word against each console word
    return searchWords.every(searchWord => 
      consoleWords.some(consoleWord => {
        const distance = levenshteinDistance(consoleWord, searchWord);
        // Allow more tolerance for longer words
        const maxDistance = Math.max(Math.floor(searchWord.length * 0.4), 2);
        return distance <= maxDistance;
      })
    );
  });

  return (
    <div className="py-12 space-y-12">
      <header className="space-y-4">
        <h1 className="text-4xl font-bold">Console Gallery</h1>
        <p className="text-gray-400">Browse our collection of retro gaming systems</p>
      </header>

      {/* Enhanced Filter Section */}
      <div className="grid gap-8 md:grid-cols-[300px,1fr]">
        {/* Filters Sidebar */}
        <div className="space-y-8">
          {/* Search Input */}
          <div className="space-y-3">
            <h3 className="text-lg font-medium text-gray-200">Search</h3>
            <input
              type="text"
              placeholder="Search consoles..."
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              className="w-full px-4 py-2 rounded-lg bg-gray-800/30 text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-600"
            />
          </div>

          {/* Categories */}
          <div className="space-y-3">
            <h3 className="text-lg font-medium text-gray-200">Categories</h3>
            <div className="flex flex-col gap-2">
              <button
                onClick={() => setSelectedCategory('all')}
                className={`px-4 py-2 rounded-lg text-left transition-colors duration-200 ${
                  selectedCategory === 'all'
                    ? 'bg-purple-600 text-white'
                    : 'bg-gray-800/30 text-gray-300 hover:bg-gray-800/50'
                }`}
              >
                All Categories
              </button>
              {categories.map((category) => (
                <button
                  key={category}
                  onClick={() => setSelectedCategory(category)}
                  className={`px-4 py-2 rounded-lg text-left transition-colors duration-200 ${
                    selectedCategory === category
                      ? 'bg-purple-600 text-white'
                      : 'bg-gray-800/30 text-gray-300 hover:bg-gray-800/50'
                  }`}
                >
                  {category}
                </button>
              ))}
            </div>
          </div>

          {/* Brands */}
          <div className="space-y-3">
            <h3 className="text-lg font-medium text-gray-200">Brands</h3>
            <div className="flex flex-col gap-2">
              <button
                onClick={() => setSelectedBrand('all')}
                className={`px-4 py-2 rounded-lg text-left transition-colors duration-200 ${
                  selectedBrand === 'all'
                    ? 'bg-purple-600 text-white'
                    : 'bg-gray-800/30 text-gray-300 hover:bg-gray-800/50'
                }`}
              >
                All Brands
              </button>
              {brands.map((brand) => (
                <button
                  key={brand}
                  onClick={() => setSelectedBrand(brand)}
                  className={`px-4 py-2 rounded-lg text-left transition-colors duration-200 ${
                    selectedBrand === brand
                      ? 'bg-purple-600 text-white'
                      : 'bg-gray-800/30 text-gray-300 hover:bg-gray-800/50'
                  }`}
                >
                  {brand}
                </button>
              ))}
            </div>
          </div>

          {/* Active Filters Summary */}
          <div className="space-y-3">
            <h3 className="text-lg font-medium text-gray-200">Active Filters</h3>
            <div className="space-y-2 text-sm text-gray-400">
              <p>Category: {selectedCategory === 'all' ? 'All' : selectedCategory}</p>
              <p>Brand: {selectedBrand === 'all' ? 'All' : selectedBrand}</p>
              {searchQuery && <p>Search: "{searchQuery}"</p>}
            </div>
          </div>
        </div>

        {/* Console Grid */}
        <div className="space-y-6">
          {/* Results Count */}
          <div className="text-gray-400">
            {filteredConsoles.length} {filteredConsoles.length === 1 ? 'console' : 'consoles'} found
          </div>

          {/* Grid */}
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {filteredConsoles.map((console) => (
              <div
                key={console.name}
                className="bg-gray-800/30 rounded-lg overflow-hidden hover:bg-gray-800/50 transition-colors duration-200"
              >
                <div className="aspect-video relative bg-gray-900/50 p-6">
                  <Image
                    src={console.image}
                    alt={`${console.name} logo`}
                    fill
                    className="object-contain p-4"
                  />
                </div>
                <div className="p-4">
                  <h2 className="text-lg font-medium text-gray-200">{console.name}</h2>
                  <p className="text-sm text-gray-400">{console.category}</p>
                  <p className="text-sm text-gray-400">{getConsoleBrand(console.name)}</p>
                </div>
              </div>
            ))}
          </div>

          {filteredConsoles.length === 0 && (
            <div className="text-center py-12 text-gray-400">
              No consoles found matching the current filters.
            </div>
          )}
        </div>
      </div>
    </div>
  );
} 