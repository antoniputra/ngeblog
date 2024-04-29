import vue from "@vitejs/plugin-vue";

/** @type {import('vite').UserConfig} */
export default {
    resolve: {
        alias: {
            "@toast-ui/editor/dist/toastui-editor.css":
                "/node_modules/@toast-ui/editor/dist/toastui-editor.css",
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
        assetsDir: "resolve-ngeblog-dist",
        rollupOptions: {
            input: ["./resources/js/ngeblog.js", "./resources/css/ngeblog.css"],
            output: {
                assetFileNames: "resolve-ngeblog-dist/[name][extname]",
                entryFileNames: "resolve-ngeblog-dist/[name].js",
            },
        },
    },
};
