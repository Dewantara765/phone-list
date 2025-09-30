import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite'


export default defineConfig({
     server: {
    host: '0.0.0.0',
    hmr: {
      host: '192.168.1.4', // your local IP
    },
  },
    plugins: [
        vue(),
        tailwindcss(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    
});
