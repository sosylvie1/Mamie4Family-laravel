import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                marron: {
                    fonce: '#3B2F2F',
                    clair: '#C8A68C',
                },
                caramel: {
                    DEFAULT: '#D7A86E',
                    fonce: '#A66E37',
                    pastel: '#E6C9A8',
                },
                sable: '#FAF9F6',
                taupe: '#6B5E54',
                rose: '#E7C6B9',
                sauge: '#B5C99A',
                brume: '#A7BBC7',
                terrecuite: '#C97C5D',
                ocre: '#E0B973',
                olive: '#9BB37B',
            },
        },
    },

    plugins: [forms, typography],
};

