import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                serif: ["Playfair Display", ...defaultTheme.fontFamily.serif],
            },
            colors: {
                // Custom semantic colors for "Dark & Cozy" theme
                paper: {
                    DEFAULT: "#faf9f6", // Off-white for paper feel (if needed for light mode or specific cards)
                    dark: "#1c1917", // stone-900 - main card bg
                    darker: "#0c0a09", // stone-950 - main app bg
                },
                ink: {
                    lighter: "#a8a29e", // stone-400
                    light: "#e7e5e4", // stone-200
                    DEFAULT: "#1c1917", // stone-900
                },
                accent: {
                    light: "#fde68a", // amber-200
                    DEFAULT: "#d97706", // amber-600
                    dark: "#78350f", // amber-900
                },
            },
        },
    },

    plugins: [forms],
};
