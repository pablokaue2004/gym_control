import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
  plugins: [
    vue(),
    laravel(["resources/css/app.css", "resources/js/app.js"])
  ],
  resolve: {
    alias: {
      '@imagesEataticas': path.resolve(__dirname, './storage/app/public/static/images')
    }
  }
});
