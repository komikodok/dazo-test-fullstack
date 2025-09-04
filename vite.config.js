import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    test: {
        environment: 'jsdom', 
        globals: true,        
        setupFiles: [],
        coverage: {
            provider: 'v8', 
            reporter: ['text', 'html'], 
            include: ['resources/js/components/product/**', 'resources/js/components/sidebar/**'], 
            exclude: ['**/*.spec.ts', '**/tests/**', 'node_modules/**'], 
        },    
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.ts',
            ],
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