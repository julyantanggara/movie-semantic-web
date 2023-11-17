/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    './templates/*.{html,js, py}',
    './templates/components/*.{html,js,py}',
  ],
  theme: {
    extend: {
      fontFamily: {
        Work: ["'Work Sans', sans-serif"],
      },
      colors: {
        mainColor: '#232327',
        semiBlack: 'rgba(0,0,0,0.6)',
        darkGray: '#0f1014',
        lightGray: '#32312f',
        semiWhite: '#f5f6f8',
      },
      animation: {
        rotate: 'rotate 3s infinite linear',
        gradient: 'gradient 3s infinite linear',
        scale: 'scale 10s infinite linear',
        colorChange: 'colorChange 3s infinite linear',
      },
      keyframes: {
        colorChange: {
          '0%': {
            'border': '2px solid #ff0074',
            'box-shadow': '0 0 10px #ff0074',
          },
          '25%': {
            'border': '2px solid #4913ff',
            'box-shadow': '0 0 10px #4913ff',
          },
          '75%': {
            'border': '2px solid #ff0074',
            'box-shadow': '0 0 10px #ff0074',
          },
          '100%': {
            'border': '2px solid #ff0074',
            'box-shadow': '0 0 10px #ff0074',
          },
        },
        rotate: {
          '0%': {
            transform: 'rotate(0deg)',
          },
          '25%': {
            transform: 'rotate(90deg)',
          },
          '50%': {
            transform: 'rotate(180deg)',
          },
          '75%': {
            transform: 'rotate(270deg)',
          },
          '100%': {
            transform: 'rotate(360deg)',
          },
        },
        gradient: {
          '0%': {
            'background-position': '0% 50%',
          },
          '50%': {
            'background-position': '100% 50%',
          },
          '100%': {
            'background-position': '0% 50%',
          }
        },
        scale: {
          '0%': {
            scale: '100%',
          },
          '50%': {
            scale: '2000%',
          },
          '100%': {
            scale: '4000%',
          }
        },
      },
      boxShadow: {
        'custom': '0 0 10px #f5f6f8',
      },
      borderColor: {
        'custom': '#f5f6f8',
      },
    },
    plugins: [],
  }
}