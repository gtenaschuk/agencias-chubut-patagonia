<?php
 /**
  * Title: Theme Footer
  * Slug: dinkuminteractive/footer-default
  * Categories: footer
  */
?>
<!-- wp:group {"align":"full","layout":{"inherit":true}} -->
<div class="wp-block-group alignfull"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide" style="padding-top:4rem;padding-bottom:4rem"><!-- wp:site-title {"level":0} /-->

<!-- wp:paragraph {"align":"right"} -->
<p class="has-text-align-right">' .
<?php
echo sprintf(
	/* Translators: WordPress link. */
	esc_html__( 'Proudly powered by %s', 'dinkuminteractive' ),
	'<a href="' . esc_url( __( 'https://www.dinkuminteractive.com/', 'dinkuminteractive' ) ) . '" rel="nofollow">Dinkum Interactive</a>'
)
?>
</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
