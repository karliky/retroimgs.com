import { NextRequest } from 'next/server';
import { processImage } from '../../_lib/imageProcessor';
import { join } from 'path';

const corsHeaders = {
  'Access-Control-Allow-Origin': '*',
  'Access-Control-Allow-Methods': 'GET, OPTIONS',
  'Access-Control-Allow-Headers': 'Content-Type',
};

export async function OPTIONS() {
  return new Response(null, {
    headers: corsHeaders
  });
}

export async function GET(
  request: NextRequest,
  { params }: { params: Promise<{ id: string }> }
): Promise<Response> {
  try {
    const searchParams = request.nextUrl.searchParams;
    const gameId = (await params).id;
    console.log(`Processing image for game: ${gameId}`);
    
    // Get image processing parameters
    const width = searchParams.get('width') ? parseInt(searchParams.get('width')!) : undefined;
    const height = searchParams.get('height') ? parseInt(searchParams.get('height')!) : undefined;
    const fit = searchParams.get('fit') as 'cover' | 'contain' | 'fill' | 'inside' | 'outside' | undefined;
    const format = searchParams.get('format') as 'jpeg' | 'png' | 'webp' | undefined;
    const quality = searchParams.get('quality') ? parseInt(searchParams.get('quality')!) : undefined;

    // For now, return the default image regardless of game ID
    const imagePath = join(process.cwd(), 'public', 'default.jpg');
    const processedImage = await processImage(imagePath, {
      width,
      height,
      fit,
      format,
      quality
    });

    // Set appropriate content type
    const contentType = format === 'png' ? 'image/png' : 
                       format === 'webp' ? 'image/webp' : 
                       'image/jpeg';

    return new Response(processedImage, {
      headers: {
        'Content-Type': contentType,
        'Cache-Control': 'public, max-age=31536000, immutable',
        ...corsHeaders
      }
    });
  } catch (error) {
    console.error('Error processing image:', error);
    return new Response('Error processing image', { 
      status: 500,
      headers: corsHeaders
    });
  }
} 