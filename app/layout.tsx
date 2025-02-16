import type { Metadata } from "next";
import { Geist } from "next/font/google";
import "./globals.css";
import Navbar from "./components/Navbar";
import Footer from "./components/Footer";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

export const metadata: Metadata = {
  title: "RetroImgs - Retro Gaming Image API",
  description: "The perfect Lorem Ipsum for retro video game images. Access thousands of classic gaming screenshots through our simple API.",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <body
        className={`${geistSans.variable} antialiased min-h-screen bg-black text-white relative`}
      >
        {/* Animated Background */}
        <div className="fixed inset-0 z-0">
          {/* Gradient base */}
          <div className="absolute inset-0 bg-gradient-to-br from-purple-900/20 via-black to-cyan-900/20" />
          
          {/* Animated grid */}
          <div className="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.05)_1px,_transparent_1px),_linear-gradient(90deg,_rgba(255,255,255,0.05)_1px,_transparent_1px)] bg-[size:64px_64px] [transform-origin:0_0] animate-grid-movement" />
          
          {/* Glowing orbs */}
          <div className="absolute top-1/4 left-1/4 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-pulse-slow" />
          <div className="absolute bottom-1/4 right-1/4 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl animate-pulse-slow delay-1000" />
          
          {/* Scanlines effect */}
          <div className="absolute inset-0 bg-[linear-gradient(transparent_0%,_rgba(0,0,0,0.4)_50%,_transparent_100%)] bg-[length:100%_4px]" />
          
          {/* Noise texture */}
          <div className="absolute inset-0 opacity-[0.03] bg-noise" />
        </div>

        <Navbar />
        <main className="relative z-10 w-full overflow-x-hidden pt-16 min-h-[calc(100vh-4rem)]">
          {children}
        </main>
        <Footer />
      </body>
    </html>
  );
}
