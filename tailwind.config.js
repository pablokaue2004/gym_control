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
                    blue100: "#6AACE5",
                    blue200: "#4677A2",
                },
            },
        },
    },
    plugins: [],
};
