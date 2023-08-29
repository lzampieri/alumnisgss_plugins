module.exports = {
    entry: {
        'sponsors/block': ['./sponsors/block.jsx'],
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
  