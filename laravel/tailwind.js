module.exports = {
  theme: {
    customForms: theme => ({
      default: {
        'input, textarea, multiselect, select': {
          width: theme('width.full'),
          borderRadius: theme('borderRadius.default'),
          borderColor: theme('colors.gray.300'),
          backgroundColor: theme('colors.white'),
          '&:focus': {
            backgroundColor: theme('colors.white')
          }
        },
        checkbox: {
          borderColor: theme('colors.gray.300')
        }
      }
    }),
    // https://github.com/benface/tailwindcss-transforms
    scale: { // defaults to {}
      '75': '0.75',
      '100': '1'
    },
    // https://github.com/benface/tailwindcss-transitions
    transitionDuration: {
      'default': '50ms',
      '0': '0ms',
      '25': '25ms',
      '50': '50ms',
      '100': '100ms'
    },
    fontFamily: {
      sans: [
        'Nunito',
        'Ubuntu',
        '-apple-system',
        'BlinkMacSystemFont',
        '"Segoe UI"',
        'Roboto',
        '"Helvetica Neue"',
        'Arial',
        '"Noto Sans"',
        'sans-serif',
        '"Apple Color Emoji"',
        '"Segoe UI Emoji"',
        '"Segoe UI Symbol"',
        '"Noto Color Emoji"'
      ]
    },
    spacing: {
      px: '1px',
      '0': '0',
      '1': '0.25rem',
      '2': '0.5rem',
      '3': '0.75rem',
      '4': '1rem',
      '5': '1.25rem',
      '6': '1.5rem',
      '8': '2rem',
      '10': '2.5rem',
      '12': '3rem',
      '16': '4rem',
      '20': '5rem',
      '24': '6rem',
      '32': '8rem',
      '40': '10rem',
      '48': '12rem',
      '56': '14rem',
      '64': '16rem',
      '72': '18rem',
      '80': '20rem',
      '96': '24rem',
      '128': '32rem'
    },
    zIndex: {
      '100': '100'
    }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/custom-forms'),
    require('tailwindcss-transitions')(),
    require('tailwindcss-transforms')({
      '3d': false, // defaults to false
    })
  ]
}
