/** @type {import('tailwindcss').Config} */
export default {
    content: ['./src/**/*.{js,ts,jsx,tsx,ejs}'],
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
                roboto: ['Roboto', 'sans-serif'],
            },
            width: {
                'calc-1/2': 'calc(50% - 1rem)',
            },
        },
    },
    plugins: [],
    mode: 'jit',
};
