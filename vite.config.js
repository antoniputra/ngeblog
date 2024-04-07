import vue from "@vitejs/plugin-vue";

/** @type {import('vite').UserConfig} */
export default {
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
        assetsDir: "",
        rollupOptions: {
            input: ["./resources/js/ngeblog.js", "./resources/css/ngeblog.css"],
            output: {
                assetFileNames: "[name][extname]",
                entryFileNames: "[name].js",
            },
        },
    },
};
