module.exports = {
    entry: {
        'directors_tiles/block': ['./directors_tiles/block.jsx'],
    },
    output: {
        path: __dirname,
        filename: '[name].js'
    },
    module: {
        loaders: [
            {
                test: /.jsx$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
            },
        ],
    },
};
  