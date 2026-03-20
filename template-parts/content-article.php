<?php

/**
 * Template for displaying article cards
 *
 * @package YourThemeName
 */

?>
<article class="article-card">
    <h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <div class="article-excerpt">
        <?php the_excerpt(); ?>
    </div>
    <div class="article-meta">
        <span class="article-date"><?php echo get_the_date(); ?></span>
        <span class="article-author"><?php the_author(); ?></span>
    </div>
</article>