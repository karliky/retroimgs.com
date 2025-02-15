import sharp from 'sharp';

export type ImageProcessingOptions = {
  width?: number;
  height?: number;
  fit?: 'cover' | 'contain' | 'fill' | 'inside' | 'outside';
  format?: 'jpeg' | 'png' | 'webp';
  quality?: number;
};

export async function processImage(
  imagePath: string, 
  options: ImageProcessingOptions = {}
): Promise<Buffer> {
  const {
    width,
    height,
    fit = 'cover',
    format = 'jpeg',
    quality = 80
  } = options;

  const image = sharp(imagePath);

  if (width || height) {
    image.resize({
      width,
      height,
      fit,
      withoutEnlargement: true
    });
  }

  switch (format) {
    case 'jpeg':
      return image.jpeg({ quality }).toBuffer();
    case 'png':
      return image.png({ quality }).toBuffer();
    case 'webp':
      return image.webp({ quality }).toBuffer();
    default:
      return image.jpeg({ quality }).toBuffer();
  }
} 