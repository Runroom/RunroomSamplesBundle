const Encore = require('@symfony/webpack-encore');
const glob = require('glob-all');
const path = require('path');
const StyleLintPlugin = require('stylelint-webpack-plugin');

Encore
  .setOutputPath('./src/Resources/public/')
  .setPublicPath('./')
  .setManifestKeyPrefix('bundles/easyadmin')

  .copyFiles({
    from: './assets/img',
    to: 'img/[name].[ext]',
    pattern: /\.(png|jpg|jpeg|gif|ico)$/
  })
  .copyFiles({
    from: './assets/img',
    to: 'svg/[name].svg',
    pattern: /\.svg$/
  })

  .enableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(false)
  .enableVersioning(false)
  .enableSassLoader()
  .enableEslintLoader({ configFile: './.eslintrc' })
  .addPlugin(
    new StyleLintPlugin({
      configFile: '.stylelintrc',
      context: 'assets/scss',
      files: '**/*.scss',
      failOnError: false,
      quiet: false
    })
  )
  .enablePostCssLoader()

  .addEntry('app', './assets/js/app.js')
  .addStyleEntry('styles', './assets/scss/styles.scss');

module.exports = Encore.getWebpackConfig();
