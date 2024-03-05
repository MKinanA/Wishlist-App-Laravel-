/** @type {import('tailwindcss').Config} */
export default {
  content: ['resources/views/index.blade.php'],
  theme: {
    extend: {},
  },
  plugins: [require('daisyui')],
}

