/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/src/**/*'{.html,.js,.css}"],
  theme: {
    extend: {
      colors: {
        primary: '#151b35',
        secondary: '#C0480C',
        subtle_highlight: '#C9C9C9',
        background_color: '#E8E3DC',
        main_button: '#F05F16',
        light_surface_text: '#402A1A',
        dark_surface_text: '#F3F3F3'
      },
      fontFamily: {
        titles: ['Lexend', 'sans-serif'],
        paragraphs: ['Alata', 'sans-serif'],
        logo: ['MuseoModerno', 'sans-serif']
      },
      screens: {
        sm: '576px',
        md: '768px',
        lg: '992px',
        xl: '1200px'
      },
      borderRadius: {
        'message_button': '10px'
      },
      width: {
        '380': '380px'
      },
      height: {
        '80': '80px'
      }
    }
  },
  plugins: [],
}

