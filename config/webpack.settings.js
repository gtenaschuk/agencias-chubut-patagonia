// Webpack settings exports.
const path = require( 'path' );
const watching = process.env.NODE_WATCH;

module.exports = {
	entries: {
		// JS files.
		// admin: './assets/js/admin/admin.js',
		// blocks: './assets/js/blocks/blocks.js',
		main: './assets/js/main.js',
		// shared: './assets/js/shared/shared.js',
		// styleguide: './assets/js/styleguide/styleguide.js',
		// 'blocks-editor': './includes/blocks/blocks-editor.js',

		// SCSS files.
		// 'admin-style': './assets/scss/admin/admin-style.scss',
		'editor-style': './assets/scss/editor_style.scss',
		'style.min': './assets/scss/style.scss',
		// 'styleguide-style': './assets/scss/styleguide/styleguide.scss',
	},
	filename: {
		js: 'js/[name].js',
		css: 'css/[name].css',
	},
	paths: {
		src: {
			base: './assets/',
			scss: './assets/scss/',
			js: './assets/js/',
		},
		dist: {
			base: './dist/',
			clean: [ './img', './svg', './scss', './css', './js', 'fonts' ],
		},
	},
	stats: {
		// Copied from `'minimal'`.
		all: false,
		errors: true,
		modules: true,
		warnings: true,
		// Our additional options.
		assets: true,
		errorDetails: true,
		excludeAssets: /\.(jpe?g|png|gif|svg|woff|woff2)$/i,
		moduleTrace: true,
		performance: true,
	},
	copyWebpackConfig: {
		patterns: [
			{
				from: '**/*.{jpg,jpeg,png,gif,svg,eot,ttf,woff,woff2}',
				to: '[path][name][ext]',
				context: path.resolve( process.cwd(), './assets/' ),
			},
			{
				from: 'js/lib/*.js',
				to: '[path][name][ext]',
				context: path.resolve( process.cwd(), './assets/' ),
			},
			{
				from: 'css/lib/*.css',
				to: '[path][name][ext]',
				context: path.resolve( process.cwd(), './assets/' ),
			},
		],
	},
	ImageminPlugin: {
		test: /\.(jpe?g|png|gif|svg)$/i,
	},
	performance: {
		maxAssetSize: 100000,
	},
	manifestConfig: {
		basePath: '',
	},
};

if ( 'html' === watching ) {
	module.exports.BrowserSyncConfig = {
		host: 'localhost',
		port: 3000,
		// Serve files from the app directory, with a specific index filename
		server: {
			baseDir: './html',
			index: 'index.html',
			serveStaticOptions: {
				extensions: [ 'html' ],
			},
			routes: {
				'/dist': './dist',
			},
		},
		open: true,
		watch: true,
	};
} else {
	module.exports.BrowserSyncConfig = {
		host: 'localhost',
		port: 3000,
		proxy: 'http://base-theme.test',
		open: false,
		files: [
			'**/*.php',
			'dist/js/**/*.js',
			'dist/css/**/*.css',
			'dist/scss/**/*.scss',
			'dist/svg/**/*.svg',
			'dist/img/**/*.{jpg,jpeg,png,gif}',
			'dist/fonts/**/*.{eot,ttf,woff,woff2,svg}',
		],
	};
	//performance: {
	//	maxAssetSize: 100000,
	//},
	//manifestConfig: {
	//	basePath: '',
	//},
}
