var path = require('path')
var webpack = require('webpack')
const VueLoaderPlugin = require('vue-loader/lib/plugin')


var letterWoff = {
    test: /\.(woff|woff2|eot|ttf|otf)$/,
    loader: "file-loader"
  };
var letterSvg = {
    test: /\.(png|jpg|gif|svg)$/,
    loader: 'file-loader',
    options: {
        name: '[name].[ext]'
    }
  }

  module.exports = {
    entry: {main: './src/main.js'},
    output: {
      path: path.resolve(__dirname, '../../public/js/vue_dist'),
      filename: "[name]-bundle.js",
      publicPath: "http://localhost:8080/dist/"
    },
    module: {
        rules: [
          letterWoff,
          letterSvg,
          {
            test: /\.css$/,
            use: [
              'vue-style-loader',
              'css-loader',
              "sass-loader"
            ],
          }, 
          {
            test: /\.s[ac]ss$/i,
            use: ["vue-style-loader", "css-loader", "sass-loader"],
          },      {
            test: /\.vue$/,
            loader: 'vue-loader',
            options: {
              loaders: {
              }
              // other vue-loader options go here
            }
          },
          {
            test: /\.js$/,
            loader: 'babel-loader',
            exclude: /node_modules/
          },
          {
            test: /\.(png|jpg|gif|svg)$/,
            loader: 'file-loader',
            options: {
              name: '[name].[ext]?[hash]'
            }
          }
        ]
    },
    resolve: {
        alias: {
          'vue$': 'vue/dist/vue.esm.js'
        },
        extensions: ['*', '.js', '.vue', '.json']
      },
      devServer: {
        historyApiFallback: true,
        noInfo: true,
        overlay: true,
        contentBase: false,
        hot: true,
        headers: {
                'Access-Control-Allow-Origin': '*'
              }
      },
      performance: {
        hints: false
      },
      plugins: [
        new VueLoaderPlugin()
      ],
      devtool: '#eval-source-map',
  }
