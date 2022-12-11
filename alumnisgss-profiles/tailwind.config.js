module.exports = {
    mode: 'jit',
    content: [
        './blocks/**/block.jsx',
        './blocks/**/renderer.php',
        './src/app.css' // To force compilation of all explicitly defined stuff
    ],
};
