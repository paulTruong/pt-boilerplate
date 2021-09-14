const path = require("path");
const { WebpackManifestPlugin } = require("webpack-manifest-plugin");
const FixStyleOnlyEntriesPlugin = require("webpack-fix-style-only-entries");

const dirJs = path.join(__dirname, "js");
const dirSass = path.join(__dirname, "sass");
module.exports = {
  entry: {
    "index": path.join(dirJs, "index.js"),
    "admin": path.join(dirJs, "admin.js"),
    "main": path.join(dirSass, "main.scss"),
    "editor-styles": path.join(dirSass, "editor-styles.scss"),
  },
  output: {
    path: path.join(__dirname, "dist"),
    clean: true,
    filename: "js/[name].[contenthash].js",
  },
  plugins: [
    new FixStyleOnlyEntriesPlugin(),
    new WebpackManifestPlugin({
        publicPath: ""
    }),
  ],
  module: {
    rules: [
      {
        test: /\.(woff|woff2)$/,
        type: "asset/resource",
        generator: {
          filename: "fonts/[hash][ext]",
        },
      },
    ],
  },
};
