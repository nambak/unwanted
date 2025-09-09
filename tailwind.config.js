module.exports = {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.{js,ts,vue}',
        './node_modules/vue-tailwind-wysiwyg-editor/**/*.{js,ts,vue}',
    ],
    theme: {
        extend: {
            fontFamily: {
                'sans': ['Nanum Gothic', 'sans-serif'],
            },
        },
    },
}