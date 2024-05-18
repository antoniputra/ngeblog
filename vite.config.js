import vue from "@vitejs/plugin-vue";

/** @type {import('vite').UserConfig} */
export default {
    resolve: {
        alias: {
            "@": "/resources/js",
        },
    },
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    build: {
        minify: false,
        assetsDir: "ngeblog-admin-assets",
        rollupOptions: {
            input: ["./resources/js/ngeblog.js", "./resources/css/ngeblog.css"],
            output: {
                assetFileNames: "ngeblog-admin-assets/[name][extname]",
                entryFileNames: "ngeblog-admin-assets/[name].js",
            },
        },
    },
};
