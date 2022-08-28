import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        {
            name: 'ziggy',
            enforce: 'post',
            handleHotUpdate({ server, file }) {
                if (file.includes('/routes/') && file.endsWith('.php')) {
                    exec('php artisan ziggy:generate', (error, stdout) => error === null && console.log(`  > Ziggy routes generated!`))
                }
            }
        },
        {
            name: 'blade',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: '*',
                    });
                }
            },
        }
    ],
});
