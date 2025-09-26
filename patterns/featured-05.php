<?php
 /**
  * Title: Post de flora y fauna
  * Slug: dinkuminteractive/featured-05
  * Categories: featured
  */
?>
<!-- wp:group {"align":"full","className":"projects projects-grid projects-grid-3","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull projects projects-grid projects-grid-3" id="projects-grid-3"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"42px","fontStyle":"normal","fontWeight":"900"}}} -->
<h2 class="wp-block-heading has-text-align-center" id="que-especie-estas-buscando" style="font-size:42px;font-style:normal;font-weight:900">¿Que especie estas buscando?</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"projects-filter","layout":{"type":"constrained"}} -->
<div class="wp-block-group projects-filter"><!-- wp:list -->
<ul><!-- wp:list-item -->
<li><a href="javascript:void(0)" data-filter="*">Todas Las Especies </a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="javascript:void(0)" data-filter=".fauna_category-peces">Peces</a> </li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="javascript:void(0)" data-filter=".fauna_category-anfibios">Anfibios</a> </li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="javascript:void(0)" data-filter=".fauna_category-reptiles">Reptiles</a> </li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="javascript:void(0)" data-filter=".fauna_category-aves">Aves</a> </li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="javascript:void(0)" data-filter=".fauna_category-mamiferos">Mamíferos</a></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":1,"query":{"perPage":"20","pages":0,"offset":0,"postType":"fauna","order":"asc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[]},"displayLayout":{"type":"flex","columns":3},"align":"wide","className":"alignwide projects-all","layout":{"type":"constrained"}} -->
<div class="wp-block-query alignwide projects-all"><!-- wp:post-template {"align":"wide"} -->
<div class="project-item">
<!-- wp:post-featured-image /-->

<!-- wp:post-title {"level":3,"isLink":true} /-->

<!-- wp:acf/acf-field-block {"name":"acf/acf-field-block","mode":"preview"} /-->
</div>
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
<!-- /wp:query --></div>
<!-- /wp:group -->
