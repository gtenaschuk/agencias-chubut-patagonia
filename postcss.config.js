/**
 * Exports the PostCSS configuration.
 *
 * @param  root0
 * @param  root0.file
 * @param  root0.options
 * @param  root0.env
 * @param  root0
 * @param  root0.file
 * @param  root0.options
 * @param  root0.env
 * @param  root0
 * @param  root0.file
 * @param  root0.options
 * @param  root0.env
 * @param  root0
 * @param  root0.file
 * @param  root0.options
 * @param  root0.env
 * @return {string} PostCSS options.
 */
module.exports = ({ file, options, env }) => ({
	/* eslint-disable-line */
	plugins: {
		"postcss-nested": {},
		"postcss-css-variables": {
			preserve: false,
			preserveAtRulesOrder: true,
		},
		"postcss-calc": {
			precision: 0,
		},
		"postcss-import": {},
		"postcss-preset-env": {
			stage: 0,
			autoprefixer: {
				grid: true,
			},
		},
		"postcss-discard-duplicates": {},
		// Prefix editor styles with class `editor-styles-wrapper`.
		"postcss-editor-styles-77":
			file.basename === "style-editor.css"
				? {
						scopeTo: ".editor-styles-wrapper",
						ignore: [
							":root",
							".edit-post-visual-editor.editor-styles-wrapper",
							".wp-toolbar",
						],
						remove: [
							"html",
							":disabled",
							"[readonly]",
							"[disabled]",
						],
						tags: [
							"button",
							"input",
							"label",
							"select",
							"textarea",
							"form",
						],
				  }
				: false,
		// Minify style on production using cssano.
		cssnano:
			env === "production"
				? {
						preset: [
							"default",
							{
								autoprefixer: false,
								calc: {
									precision: 8,
								},
								convertValues: true,
								discardComments: {
									removeAll: true,
								},
								mergeLonghand: false,
								zindex: false,
							},
						],
				  }
				: false,
	},
});
