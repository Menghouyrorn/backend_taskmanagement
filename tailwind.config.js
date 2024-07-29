/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/views/layouts/**/*.blade.php",
    "./resources/views/pages/**/*.blade.php",
    "./resources/views/partial/**/*.blade.php"
  ],
  theme: {
    extend: {
      colors:{
        'color-test':'#3fd4f4'
      }
    },
  },
  plugins: [],
}

