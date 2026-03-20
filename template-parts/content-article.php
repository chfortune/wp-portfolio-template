<?php
/**
 * Template for displaying an article card.
 *
 * @package Custom_Theme
 */

?>
<div class="article-card">
    <h2><?php the_title(); ?></h2>
    <div class="entry-content">
        <?php the_excerpt(); ?>
    </div>
</div>