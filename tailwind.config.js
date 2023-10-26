const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Lexend', ...defaultTheme.fontFamily.sans],
            },
            ringColor: {
                'black-400': '#000000',
                // Add other ring colors if needed
              },
              backgroundColor: {
                'black-100': '#f2f2f2', // Replace with your desired color
                'black-200': '#e5e5e5',
                'black-300': '#d8d8d8',
                'black-400': '#cccccc',
                'black-500': '#bfbfbf',
                'black-600': '#b2b2b2',
                'black-700': '#a5a5a5',
                'black-800': '#999999',
                'black-900': '#8c8c8c',
                'black': '#000',
              },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/aspect-ratio'),
    ],
};
