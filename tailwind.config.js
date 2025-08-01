import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            container: {
                center: true,
                padding: {
                    DEFAULT: '12rem',
                    sm: '1.5rem',
                    md: '2rem',
                    lg: '3rem',
                    xl: '4rem',
                    '2xl': '12rem',
                },
            },
            colors: {
                primary: {
                    50: '#f0fdfa',
                    100: '#ccfbf1',
                    200: '#99f6e4',
                    300: '#5eead4',
                    400: '#2dd4bf',
                    500: '#14b8a6',
                    600: '#0d9488',
                    700: '#0f766e',
                    800: '#115e59',
                    900: '#134e4a',
                },
                secondary: {
                    500: '#008f9c',
                    600: '#007a86',
                    700: '#005d6d',
                },
                accent: {
                    500: '#1DC98A',
                },
            },
            keyframes: {
                pulseColors: {
                    '0%, 100%': { backgroundColor: '#34d399' }, // verde
                    '33%': { backgroundColor: '#60a5fa' },      // azul
                    '66%': { backgroundColor: '#f472b6' },      // rosa
                },
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { transform: 'translateY(20px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                }
            },
            animation: {
                pulseColors: 'pulseColors 3s infinite',
                fadeIn: 'fadeIn 0.3s ease-out',
                slideUp: 'slideUp 0.4s ease-out',
            },
            screens: {
                'xs': '475px',
                ...defaultTheme.screens,
            },
        },
    },

    plugins: [
        forms,
        typography,
        function({ addComponents }) {
            addComponents({
                '.container': {
                    maxWidth: '100%',
                    '@screen sm': {
                        maxWidth: '640px',
                    },
                    '@screen md': {
                        maxWidth: '768px',
                    },
                    '@screen lg': {
                        maxWidth: '1024px',
                    },
                    '@screen xl': {
                        maxWidth: '1280px',
                    },
                    '@screen 2xl': {
                        maxWidth: '1536px',
                    },
                }
            })
        }
    ],
};
