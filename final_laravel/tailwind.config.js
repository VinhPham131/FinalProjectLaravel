import forms from '@tailwindcss/forms';
import flowbitePlugin from 'flowbite/plugin';

/ @type {import('tailwindcss').Config} /
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/.blade.php',
        './storage/framework/views/*.php',
        './resources//.blade.php',
        './resources/**/.js',
        './resources//*.vue',
        './node_modules/flowbite//*.js',
    ],

    theme: {
        screens: {
            phone: '320px',
            tablet: '640px',
            laptop: '1400px',
            desktop: '1920px',
            sm: '576px',
            md: '960px',
            lg: '1440px',
        },
        extend: {
            fontFamily: {
                garamond: ['"EB Garamond"', 'serif'],
            },
            width: {
                'calc-1/2': 'calc(50% - 1rem)',
            },
            colors: {
                'a28b68': '#a28b68',
            }
        },
    },

    plugins: [
        forms,
        flowbitePlugin,
    ],
};
