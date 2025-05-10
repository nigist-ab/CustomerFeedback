import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';


export default defineConfig({
    server: {
        host: '127.0.0.1', // 👈 Force Vite to use IPv4 instead of IPv6
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'), // 👈 Add this line
        },
    },
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        
    ],
});
