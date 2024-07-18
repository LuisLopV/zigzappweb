import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['public/front/css/app.css', 'public/front/js/app.js'],
            refresh: true,
        }),
    ],
});