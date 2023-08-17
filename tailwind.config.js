module.exports = {
    prefix: "tw-",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                gym: {
                    red100: "#C95555",
                    red200: "#932424",
                },
            },
        },
    },
    plugins: [],
};
