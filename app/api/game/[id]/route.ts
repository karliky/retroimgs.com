import { NextRequest } from 'next/server';
import { processImage } from '../../_lib/imageProcessor';
import { join } from 'path';

export async function GET(
  request: NextRequest,
  { params }: { params: { id: string } }
) {
  try {
    const searchParams = request.nextUrl.searchParams;
    
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
        'Cache-Control': 'public, max-age=31536000, immutable'
      }
    });
  } catch (error) {
    console.error('Error processing image:', error);
    return new Response('Error processing image', { status: 500 });
  }
} 