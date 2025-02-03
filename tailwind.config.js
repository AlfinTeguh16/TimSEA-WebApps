import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                neutral: {
                    50: "#FAFAFA",
                    100: "#F5F5F5",
                    200: "#E5E5E5",
                    300: "#D4D4D4",
                    400: "#A3A3A3",
                    500: "#737373",
                    600: "#525252",
                    700: "#404040",
                    800: "#262626",
                    900: "#171717",
                },
                primary: {
                    50: "#E6FFFF",
                    100: "#CCDEFE",
                    200: "#99BDFE",
                    300: "#669FFD",
                    400: "#337CFD",
                    500: "#005BFC",
                    600: "#0049CA",
                    700: "#003797",
                    800: "#002465",
                    900: "#001232",
                },
                secondary: {
                    50: "#E6F6FB",
                    100: "#CDEDF7",
                    200: "#9BDCE",
                    300: "#6ACAE6",
                    400: "#38B9DD",
                    500: "#06A7D5",
                    600: "#0586AA",
                    700: "#046480",
                    800: "#024355",
                    900: "#01212B",
                },
            },
            typography: {
                h1: {
                    fontWeight: "600",
                    fontSize: "1.75rem",
                    lineHeight: "2rem",
                    '@screen sm': {
                        fontSize: "1.5rem",
                        lineHeight: "1.75rem",
                    },
                    fontFamily: "'Plus Jakarta Sans', sans-serif",
                },
                h2: {
                    fontWeight: "500",
                    fontSize: "1.5rem",
                    lineHeight: "1.75rem",
                    '@screen sm': {
                        fontSize: "1.25rem",
                        lineHeight: "1.5rem",
                    },
                    fontFamily: "'Plus Jakarta Sans', sans-serif",
                },
                h3: {
                    fontWeight: "500",
                    fontSize: "1.25rem",
                    lineHeight: "1.5rem",
                    '@screen sm': {
                        fontSize: "1.125rem",
                        lineHeight: "1.25rem",
                    },
                    fontFamily: "'Plus Jakarta Sans', sans-serif",
                },
                paragraph: {
                    fontWeight: "400",
                    fontSize: "1.125rem",
                    lineHeight: "1.5rem",
                    '@screen sm': {
                        fontSize: "0.875rem",
                        lineHeight: "1.25rem",
                    },
                    fontFamily: "'Plus Jakarta Sans', sans-serif",
                },
                buttonMedium: {
                    fontWeight: "500",
                    fontSize: "1rem",
                    lineHeight: "1.25rem",
                    fontFamily: "'Plus Jakarta Sans', sans-serif",
                },
                buttonSmall: {
                    fontWeight: "500",
                    fontSize: "0.875rem",
                    lineHeight: "1rem",
                    fontFamily: "'Plus Jakarta Sans', sans-serif",
                },
                label: {
                    fontWeight: "500",
                    fontSize: "1rem",
                    lineHeight: "1.25rem",
                    fontFamily: "'Plus Jakarta Sans', sans-serif",
                },
            },

            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            shadow: {
                medium : "shadow-[0px_4px_8px_-2px_rgba(16,24,40,0.10)]",
                large : "shadow-[0px_20px_24px_-4px_rgba(16,24,40,0.10)]"
            }
        },
    },
    plugins: [],
};
