<?php $post_type = get_post_type(); ?>
<?php get_header(); ?>
	<main>
        <div class="container">
            <?= get_template_part('template-parts/single/single' , $post_type ) ?>
        </div>
    </main><!-- .site-main -->
<?php get_footer(); ?>