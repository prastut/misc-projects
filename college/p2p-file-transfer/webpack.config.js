module.exports = {
  entry: './src/client.js',
  target: 'web',

  output: {
    filename: 'dist/bundle.js'
  },

  module: {
    loaders: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'babel-loader'
      },
      {
        test: /\.json$/,
        loader: 'json'
      }
    ]
  },

  node: {
    fs: 'empty'
  }
}
