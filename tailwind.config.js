/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        fontFamily: {
            'Poppins': ['Poppins', 'sans-serif']
        },
        extend: {},
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
