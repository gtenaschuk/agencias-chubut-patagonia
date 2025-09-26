<?php
 /**
  * Title: Listado de noticias
  * Slug: dinkuminteractive/featured-02
  * Categories: featured
  */
?>
<!-- wp:group {"align":"full","className":"noticias","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull noticias"><!-- wp:paragraph {"align":"center","className":"is-style-prg_suptitel"} -->
<p class="has-text-align-center is-style-prg_suptitel">Noticias</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center" id="ultimas-actividades-realizadas">Últimas actividades realizadas</h2>
<!-- /wp:heading -->

<!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"flex","columns":3},"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"align":"wide"} -->
<!-- wp:post-date {"format":"F j, Y"} /-->

<!-- wp:post-title {"isLink":true} /-->

<!-- wp:post-featured-image /-->

<!-- wp:post-terms {"term":"category"} /-->

<!-- wp:post-excerpt {"moreText":"Leer más"} /-->
<!-- /wp:post-template -->

<!-- wp:query-pagination -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"placeholder":"Agregar texto o bloques que se mostrarán cuando la consulta no devuelva ningún resultado."} -->
<p></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->

<!-- wp:paragraph {"align":"center","className":"is-style-prg_enlaces"} -->
<p class="has-text-align-center is-style-prg_enlaces"><a href="#">¡Descubrí Más Sobre Nuestras Acciones!</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
