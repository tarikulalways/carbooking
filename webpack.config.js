const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const path = require('path');

const EASYBOOKING_VERSION = '0.0.1';

const config = {
    ...defaultConfig,
    entry:{
        backend: path.resolve(__dirname, 'dev_easybooking/backend.js')
    },
    output: {
        filename: `[name].${EASYBOOKING_VERSION}.js`,
        path: path.resolve(__dirname, 'assets/build')
    },
    plugins: [...defaultConfig.plugins, new CleanWebpackPlugin()]
}
module.exports = config;