import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                first: '#f3f4f6',
                second: '#b2b2b2',
                third: '#676767',
                fourth: '#1d1d1f',
                fifth: '#173260',
                sixth: '#eb6038',
                seventh: '#c1a26c'
            }
        },
    },

    plugins: [forms],
};
