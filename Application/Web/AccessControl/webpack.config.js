
var path = require('path');
var webpack = require('webpack');


module.exports = {
    entry: [
        './static/js/stat.jsx'
    ],
    output: {
        filename: path.join(__dirname,'./static/js/stat.js')
    },
    resolve: {
        modulesDirectories: ['node_modules', 'src'],
        extensions: ['', '.js']
    },
    module: {
        loaders: [
            {
                test: /\.jsx?$/,
                exclude: /node_modules/,
                loaders: ['babel']
            },
            {
                test: /\.css$/,
                loader: "style-loader!css-loader"
            },
            {
                test: /\.json$/,
                loader: 'json-loader'

            }

        ]
    }
};