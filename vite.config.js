import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { svelte } from '@sveltejs/vite-plugin-svelte';
import typescript from '@rollup/plugin-typescript';
import { sveltePreprocess } from "svelte-preprocess";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts'],
            refresh: true,
        }),
        svelte(
            {
                refresh: true,
                preprocess: sveltePreprocess()
            }
        ),
        typescript({
            tsconfig: "tsconfig.json"
        })
    ]
});
