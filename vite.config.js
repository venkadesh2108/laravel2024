import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import react from '@vitejs/plugin-react';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    base: '/',
    build: {
        outDir: '../../public/build', // Adjust the output directory as needed
    },
    plugins: [
        laravel( {
            input: [
                'resources/css/app.css',
                './app.js',
            ],
            hotFile: './hot'
        }),
        // react(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    hmr: {
        host: 'localhost',
    },
    watch: {
        usePolling: true
    }
});
