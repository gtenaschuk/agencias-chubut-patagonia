/* eslint-disable no-unused-vars */
/*
global wp

* List of block names
core/archives
core/audio
core/button
core/buttons
core/calendar
core/categories
core/classic
core/code
core/column
core/columns
core/cover
core/file
core/latest-comments
core/latest-posts
core/legacy-widget
core/gallery
core/group
core/heading
core/html
core/image
core/list
core/media-text
core/more
core/navigation
core/navigation-link
core/nextpage
core/paragraph
core/preformatted
core/pullquote
core/query
core/quote
core/rss
core/search
core/separator
core/shortcode
core/social-link
core/social-links
core/spacer
core/subhead
core/table
core/tag-cloud
core/text-columns
core/verse
core/video
core/widget-area
*/

// Adding the filter to change excerpt info label
wp.hooks.addFilter(
	'i18n.gettext',
	'dinkuminteractive/override-write-an-excerpt-label',
	dinkuminteractive_change_excerpt_label
);

// Define our filter callback.
function dinkuminteractive_change_excerpt_label(translation, text, domain) {
	if (text === 'Write an excerpt (optional)') {
		return 'Write an excerpt';
	}

	return translation;
}

// Paragraph
wp.blocks.registerBlockStyle('core/paragraph', {
	name: 'prg_primary',
	label: 'Parrafo Formato'
});

wp.blocks.registerBlockStyle('core/paragraph', {
	name: 'prg_padding',
	label: 'Parrafo Margen'
});

wp.blocks.registerBlockStyle('core/paragraph', {
	name: 'prg_suptitel',
	label: 'Sup Titulo'
});

wp.blocks.registerBlockStyle('core/paragraph', {
	name: 'prg_bggreen',
	label: 'Tutulo bg Verde'
});

wp.blocks.registerBlockStyle('core/paragraph', {
	name: 'prg_supverde',
	label: 'Sup Verde'
});

wp.blocks.registerBlockStyle('core/paragraph', {
	name: 'prg_enlaces',
	label: 'Enlaces'
});

wp.blocks.registerBlockStyle('core/paragraph', {
	name: 'prg_pulleft',
	label: 'Align Izq'
});

// Button
wp.blocks.registerBlockStyle('core/button', {
	name: 'btn_primary',
	label: 'Boton Verde'
});

wp.blocks.registerBlockStyle('core/button', {
	name: 'btn_secondary',
	label: 'Boton Gris'
});

wp.blocks.registerBlockStyle('core/button', {
	name: 'btn_white',
	label: 'Boton Blanco'
});

wp.blocks.registerBlockStyle('core/button', {
	name: 'btn_bordered',
	label: 'Boton Borde Gris'
});

wp.blocks.registerBlockStyle('core/button', {
	name: 'btn_download',
	label: 'Descarga'
});

wp.blocks.registerBlockStyle('core/button', {
	name: 'btn_download-arrow',
	label: 'Flecha descargar'
});

wp.blocks.registerBlockStyle('core/button', {
	name: 'btn_arrow-gray',
	label: 'Link flecha'
});

wp.blocks.registerBlockStyle('core/button', {
	name: 'btn_play',
	label: 'Play'
});

wp.blocks.registerBlockStyle('core/button', {
	name: 'btn_cirle-green',
	label: 'Redondo Verde'
});

// Cover
wp.blocks.registerBlockStyle('core/cover', {
	name: 'cover_radius',
	label: 'Borde redondeado'
});

// list
wp.blocks.registerBlockStyle('core/list', {
	name: 'list_green',
	label: 'Check Verdes'
});
