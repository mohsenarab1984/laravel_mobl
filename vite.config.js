import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import path from "path";
export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue(),
    ],

    resolve: {
        alias: {
            "@js": path.resolve(__dirname, "./resources/js"),
            "@com": path.resolve(__dirname, "./resources/js/Components"),
            "@assets_blog": path.resolve(__dirname, "./resources/assets_blog"),
            "@blog_images": path.resolve(__dirname, "./resources/assets_blog/images"),
        },
    },
});
