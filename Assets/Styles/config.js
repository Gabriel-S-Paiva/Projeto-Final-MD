window.tailwind = window.tailwind || {};
window.tailwind.config = {
  theme: {
    extend: {
      colors: {
        primary: '#3A4A5A',
        secondary: '#A5B5C0',
        light: '#E5DCCA',
        dark: '#2E2E2E'
      },
      fontFamily: {
        uni: ['Unispace', 'roboto'],
        switzer: ['Switzer', 'sans-serif']
      }
    }
  },
  content: [
    './**/*.php',
    './**/*.html',
    './Assets/**/*.js'
  ],
  safelist: [
    'bg-primary', 'text-primary',
    'bg-light', 'text-light',
    'bg-secondary', 'text-secondary',
    'font-uni', 'font-switzer'
  ]
}
