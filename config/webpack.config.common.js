const path = require( 'path' );
const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' );
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const FixStyleOnlyEntriesPlugin = require( 'webpack-remove-empty-scripts' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const StyleLintPlugin = require( 'stylelint-webpack-plugin' );
const WebpackBar = require( 'webpackbar' );
const ImageminPlugin = require( 'imagemin-webpack-plugin' ).default;
const ESLintPlugin = require( 'eslint-webpack-plugin' );

// If DISABLE_IMAGE_MIN is set the images won't be optimized.
const disableImageMin = Boolean( process.env.DISABLE_IMAGE_MIN || false );
const isProduction = process.env.NODE_ENV === 'production';

// Config files.
const settings = require( './webpack.settings.js' );

/**
 * Configure entries.
 *
 * @return {Object[]} Array of webpack settings.
 */
const configureEntries = () => {
	const entries = {};

	for ( const [ key, value ] of Object.entries( settings.entries ) ) {
		entries[ key ] = path.resolve( process.cwd(), value );
	}

	return entries;
};

module.exports = {
	entry: configureEntries(),
	output: {
		path: path.resolve( process.cwd(), settings.paths.dist.base ),
		filename: settings.filename.js,
	},

	// Console stats output.
	// @link https://webpack.js.org/configuration/stats/#stats
	stats: settings.stats,

	// External objects.
	externals: {
		jquery: 'jQuery',
		lodash: 'lodash',
	},

	// Performance settings.
	performance: {
		maxAssetSize: settings.performance.maxAssetSize,
	},

	// Build rules to handle asset files.
	module: {
		rules: [
			// Scripts.
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: [
					{
						loader: 'babel-loader',
						options: {
							cacheDirectory: true,
							sourceMap: ! isProduction,
						},
					},
				],
			},

			// Styles.
			{
				test: /\.s[ac]ss$/i,
				include: path.resolve( process.cwd(), settings.paths.src.scss ),
				use: [
					{
						loader: MiniCssExtractPlugin.loader,
						// fallback to style-loader in development
						// process.env.NODE_ENV !== "production"
						// 	? "style-loader"
						// 	: MiniCssExtractPlugin.loader,
					},
					{
						loader: 'css-loader',
						options: {
							sourceMap: ! isProduction,
						},
					},
					{
						loader: 'sass-loader',
						options: {
							sourceMap: ! isProduction,
						},
					},
					{
						loader: 'postcss-loader',
						options: {
							sourceMap: ! isProduction,
							postcssOptions: {
								ident: 'postcss-scss',
							},
						},
					},
				],
			},
		],
	},

	plugins: [
		// Remove the extra JS files Webpack creates for CSS entries.
		// This should be fixed in Webpack 5.
		new FixStyleOnlyEntriesPlugin( {
			silent: true,
		} ),

		// Clean the `dist` folder on build.
		new CleanWebpackPlugin( {
			cleanStaleWebpackAssets: false,
		} ),

		// Extract CSS into individual files.
		new MiniCssExtractPlugin( {
			filename: settings.filename.css,
			chunkFilename: '[id].css',
		} ),

		// Copy static assets to the `dist` folder.
		new CopyWebpackPlugin( {
			patterns: settings.copyWebpackConfig.patterns,
		} ),

		// Compress images
		// Must happen after CopyWebpackPlugin
		new ImageminPlugin( {
			disable: ! isProduction || true === disableImageMin,
			test: settings.ImageminPlugin.test,
		} ),

		// Lint CSS.
		new StyleLintPlugin( {
			context: path.resolve( process.cwd(), settings.paths.src.scss ),
			files: '**/*.scss',
		} ),

		// Lint JS.
		new ESLintPlugin( {
			context: path.resolve( process.cwd(), settings.paths.src.scss ),
			files: '**/*.js',
			fix: true,
		} ),

		// Fancy WebpackBar.
		new WebpackBar(),
	],
};
