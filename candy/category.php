<?php
/**
* template name: category
* @link https://codex.wordpress.org/Category_Templates 
*/
 
get_header(); ?> 
 
<section id="primary" class="site-content">
<div id="content" role="main">
 
<header class="archive-header">
<h1 class="archive-title">category: <?php single_cat_title(); ?></h1>
</header>
 
<?php 
// any posts to display?
if ( have_posts() ) :

    while ( have_posts() ) : the_post(); ?>
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <small><?php candy_posted_on(); candy_posted_by(); ?></small>
 
        <div class="entry">
            <?php the_content(); ?>
        </div>
 
    <?php endwhile; 
 
else: ?>
<p class="warning">sorry, nothing found :(</p>
 
<?php endif; ?>

</div>
</section>
 
 
<?php get_sidebar(); ?>
<?php get_footer(); ?>