<?php
/*
 * Template Name: Страница блога
 * Description: Это моя кастомная страница блога
 * Author: Misha Kushnirenko
 * Version: 1.0
 */
?>
<?php get_header(); ?>

<main class="o-page">
    <?= get_template_part('template-parts/content', 'breadcrumbs'); ?>

    <section class="blog mb-m">
        <div class="container">
            <div class="blog__container">
                <h1 class="center-title"><?= the_title(); ?></h1>
         
                <div class="blog__tabs__wrapper">
                    <div class="blog__tabs">
                        <?php
                        $tags = get_tags();
                        ?>
                        <button class="blog__tab <?php echo !isset($_GET['tag']) ? 'active-tab' : ''; ?>" data-tag="all">All<span><?php echo wp_count_posts()->publish; ?></span></button>
                        <?php foreach ($tags as $tag) : ?>
                            <button class="blog__tab <?php echo (isset($_GET['tag']) && $_GET['tag'] == $tag->slug) ? 'active-tab' : ''; ?>" data-tag="<?php echo $tag->slug; ?>">
                                <?php echo $tag->name; ?><span><?php echo $tag->count; ?></span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="blog__tabs-content grid-container">
                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                        $tag_slug = isset($_GET['tag']) ? sanitize_title($_GET['tag']) : '';

                        $args = array(
                            'post_type'      => 'post', 
                            'posts_per_page' => 12,      
                            'paged'          => $paged, 
                            'orderby'        => 'date', 
                            'order'          => 'DESC',
                        );

                        if ($tag_slug && $tag_slug != 'all') {
                            $args['tag'] = $tag_slug; 
                        }

                        $query = new WP_Query($args);
                        ?>

                        <?php if ($query->have_posts()) : ?>
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <div class="news-item">
                                    <a href="<?php the_permalink(); ?>" class="news-item-img">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('thumbnail', array('alt' => get_the_title())); ?>
                                        <?php endif; ?>
                                    </a>
                                    <div class="news-item-wrap">
                                        <div class="coins">
                                            <?php
                                            $post_tags = get_the_tags();
                                            if ($post_tags) :
                                                $tags_count = 0;
                                                foreach ($post_tags as $tag) :
                                                    if ($tags_count < 3) : // Выводим не более 3 тегов
                                            ?>
                                                <a href="<?php echo get_tag_link($tag->term_id); ?>">
                                                    <img src="<?= THORGATES_THEME_DIRECTORY ?>/assets/images/coins.svg" alt="coins">
                                                    <?= $tag->name; ?>
                                                </a>
                                            <?php
                                                        $tags_count++;
                                                    endif;
                                                endforeach;
                                            endif;
                                            ?>
                                        </div>
                                        <a href="<?php the_permalink(); ?>">
                                            <div><?php the_title(); ?></div>
                                        </a>
                                        <p><?php the_excerpt(); ?></p>
                                        <span class="date"><?php echo get_the_date('M d, Y'); ?></span>
                                    </div>
                                </div>
                            <?php endwhile; ?>               
                        <?php else : ?>
                            <p><?= __('No posts found.' , 'airdrop') ?></p>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                     <!-- Пагинация -->
                     <?php if ($query->max_num_pages > 1): ?>
                        <div class="blog__tabs-pagination">
                            <?php
                            echo paginate_links(array(
                                'total' => $query->max_num_pages,
                                'prev_text' => '<img src="' . THORGATES_THEME_DIRECTORY . '/assets/images/arrow-left.svg" alt="arrow left">',
                                'next_text' => '<img src="' . THORGATES_THEME_DIRECTORY . '/assets/images/arrow-rigth.svg" alt="arrow right">',
                            ));
                            ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <?= the_content() ?>
    </section>
</main>

<?php get_footer(); ?>
