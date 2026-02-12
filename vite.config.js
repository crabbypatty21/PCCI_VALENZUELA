import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
    preview: {
        host: true, // allow external hosts
        port: process.env.PORT || 4173, // use Render-assigned port
        strictPort: false,
        allowedHosts: ['pcci-valenzuela.onrender.com'], // whitelist your Render domain
    },
});
