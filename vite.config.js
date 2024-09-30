import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/theme.min.css',
                'resources/js/phoenix.js',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
