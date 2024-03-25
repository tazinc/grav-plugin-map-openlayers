const path = require('path');

module.exports = {
  entry: './js/openlayers.ts', // Entry point of your application (TypeScript)
  output: {
    filename: 'openlayers.js', // Output bundle file
    path: path.resolve(__dirname, 'assets'), // Output directory
    library: 'ol', // Name of the exported global variable
    libraryTarget: 'umd', // Universal Module Definition
  },
  resolve: {
    symlinks: true, // Allow resolving symbolic links
    extensions: ['.ts', '.js'], // Resolve TypeScript and JavaScript files
  },
  module: {
    rules: [
      {
        test: /\.ts$/, // Apply ts-loader for TypeScript files
        use: 'ts-loader',
        exclude: /node_modules/,
      },
      {
        test: /\.css$/, // Apply sass-loader, css-loader, and style-loader for SCSS files
        use: ['style-loader', 'css-loader'/*, 'sass-loader'*/],
      },
    ],
  },
};
