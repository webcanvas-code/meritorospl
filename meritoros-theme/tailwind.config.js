/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './template-parts/**/*.php',
    './inc/**/*.php',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        'mer-green': '#48c279',
        'mer-green-dark': '#3ea868',
      },
      fontFamily: {
        sans: ['Host Grotesk', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      borderRadius: {
        '4xl': '2rem',
        '5xl': '2.5rem',
      },
    },
  },
  safelist: [
    'sm:w-[55%]', 'sm:w-[45%]',
    'sm:min-h-0', 'sm:h-auto', 'sm:h-[400px]',
  ],
  plugins: [],
}
