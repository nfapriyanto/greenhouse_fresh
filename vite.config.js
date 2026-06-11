import {
    defineConfig,
    loadEnv
} from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig(({ mode }) => {
    // Load env variables from the project root
    const env = loadEnv(mode, process.cwd(), '');

    // Detect if we are running in tunnel/domain mode
    const isTunnel = env.APP_URL && env.APP_URL.includes('muu.my.id');

    const hmrConfig = isTunnel 
        ? {
            host: 'greenhouse-vite.muu.my.id',
            protocol: 'wss',
            clientPort: 443,
          }
        : {
            protocol: 'ws',
          };

    const originConfig = isTunnel
        ? 'https://greenhouse-vite.muu.my.id'
        : 'http://localhost:5175';

    return {    
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
            tailwindcss(),
        ],
        server: {
            host: '0.0.0.0',
            port: 5175,
            strictPort: true,
            cors: true,
            allowedHosts: true,
            origin: originConfig,
            hmr: hmrConfig,
            watch: {
                ignored: ['**/storage/framework/views/**'],
            },
        },
    };
});
