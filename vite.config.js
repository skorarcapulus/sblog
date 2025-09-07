import { defineConfig } from 'vite';
import legacy from '@vitejs/plugin-legacy';
import { resolve } from 'path';

export default defineConfig({
  plugins: [
    legacy({
      targets: ['defaults', 'not IE 11']
    })
  ],
  root: 'wp-content/themes/skorar-theme',
  build: {
    outDir: 'dist',
    rollupOptions: {
      input: {
        main: 'assets/js/main.js',
        style: 'assets/css/dev.css' // We'll create this for Vite
      }
    }
  },
  server: {
    host: '0.0.0.0',
    port: 3000,
    hmr: {
      port: 3000
    },
    watch: {
      // Watch PHP files for changes
      ignored: ['!**/*.php']
    }
  },
  css: {
    devSourcemap: true
  }
});