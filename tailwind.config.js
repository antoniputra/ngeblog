const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: ["./resources/views/**/*.blade.php", "./resources/js/**/*.vue"],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    daisyui: {
        themes: [
            {
                mytheme: {
                    primary: "#5eead4",
                    secondary: "#00beaa",
                    accent: "#00d3d5",
                    neutral: "#04040a",
                    "base-100": "#fffbff",
                    info: "#00daff",
                    success: "#00ff80",
                    warning: "#d3a100",
                    error: "#ff628c",
                },
            },
        ],
    },
    plugins: [require("daisyui"), require("@tailwindcss/typography")],
};
