import { defineConfig } from 'vite';
import legacy from '@vitejs/plugin-legacy';

export default defineConfig({
  plugins: [
    legacy({
      targets: ['defaults', 'not IE 11']
    })
  ],
  root: 'wp-content',
  build: {
    outDir: '../dist',
    rollupOptions: {
      input: {
        // Add your theme/plugin entry points here
        // main: 'wp-content/themes/your-theme/assets/main.js',
      }
    }
  },
  server: {
    host: '0.0.0.0',
    port: 3000,
    hmr: {
      port: 3000
    }
  }
});