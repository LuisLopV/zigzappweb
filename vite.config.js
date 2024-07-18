import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['public/front/css/styles.css', 'public/front/js/scripts.js'],
            refresh: true,
        }),
    ],
});