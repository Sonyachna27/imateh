<?php
	$tags = get_the_tags();
    $choose_posts = get_field('choose_posts' , 'option');
    $choose_airdrop = get_field('choose_airdrop' , 'option');
?>
<div class="container"> 
<div class="page-wrap mb-m">
	<div class="main-content">
		<article class="article">
		<?php if ( has_post_thumbnail() ) { ?>
    		<img src="<?= get_the_post_thumbnail_url(); ?>" alt="<?= the_title(); ?>">
		<?php } ?>
			<?php 
				if ( $tags ) { ?>
					<div class="coins">
						<?php foreach ( $tags as $tag ) { ?>
							<a href="<?= get_tag_link( $tag->term_id ); ?>">
								<img src="<?= THORGATES_THEME_DIRECTORY ?>/assets/images/coins.svg" alt="<?= esc_attr( $tag->name ); ?>">
								<?= esc_html( $tag->name ); ?>
							</a>
						<?php } ?>
					</div>
			<?php } ?>
			<h1><?= the_title(); ?></h1>
			<div class="author">
				<img src="<?= THORGATES_THEME_DIRECTORY ?>/assets/images/author-logo.svg" alt="Nikita Vyshinsky">
				<div class="author-info">
					<span class="author-name"><?= get_the_author(); ?></span>
					<div class="author-date"><?= get_the_date( 'M d, Y g:i A' ); ?></div>
				</div>
			</div>

			<?php
				$content = get_the_content();
				if ( !empty($content) ) { ?>
					<article class="mini-article article">
						<?= $content; ?>
					</article>
				<?php } ?>
		</article>
	</div>
	<div class="navbar">
		<div><?= __('Popular news' , 'airdrop') ?></div>
		<?php

$current_post_id = get_the_ID();


$posts_args = array(
    'post_type'      => 'post', 
    'posts_per_page' => 3,      
    'post__not_in'   => array($current_post_id), 
    'post__in' => $choose_posts,
    'orderby'        => 'date', 
    'order'          => 'DESC',
);

$related_posts = new WP_Query($posts_args);

if ($related_posts->have_posts()) : ?>
    <div class="navbar-news">
        <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
            <div class="news-item">
                <a href="<?php the_permalink(); ?>" class="news-item-img">
                    <?php the_post_thumbnail('thumbnail', array('alt' => get_the_title())); ?>
                </a>
                <div class="news-item-wrap">
                    <div class="coins">
                        <?php
                        $post_tags = get_the_tags();
                        if ($post_tags) :
                            $tags_count = 0;
                            foreach ($post_tags as $tag) :
                                if ($tags_count < 2) : // Выводим не более 3 тегов
                        ?>
                            <a href="<?= get_tag_link($tag->term_id); ?>">
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
                    <span class="date"><?php echo get_the_date('M d, Y'); ?></span>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; wp_reset_postdata(); ?>

		<a href="<?= get_url_template('template-parts/page-blog.php') ?>" class="btn gold-btn">
			<span><?= __('All news' , 'airdrop') ?></span>
		</a>
		<div><?= __('Airdrops list' , 'airdrop') ?></div>
		<div class="airdrop-list">
		<?php
		$aridrops_args = array(
                    'post_type' => 'airdrops', 
                    'posts_per_page' => 3,                 
                    'post_status' => 'publish',
                    'post__in' => $choose_airdrop,
                );

                $airdrops_query = new WP_Query($aridrops_args);
                if ($airdrops_query->have_posts()) :
                    while ($airdrops_query->have_posts()) : $airdrops_query->the_post(); ?>
                        <?= get_template_part('template-parts/content', 'airdrops') ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p><?= __('There are no airdrops available.' , 'airdrop') ?></p>
                <?php endif;
                wp_reset_postdata();
                ?>
		</div>
		<a href="<?= get_url_template('template-parts/page-airdrops.php') ?>" class="btn gold-btn">
			<span><?= __('All airdrops' , 'airdrop') ?></span>
		</a>
	</div>
</div>
</div>
<?php if( have_rows('faq') ): ?>
<section class="faq mb-m">
<div class="container">
	<div class="faq__container">
	<h2 class="faq__title"><?= __('Frequently asked questions' , 'airdrop') ?></h2>
	<div class="faq__accord accord">
        <?php $itt_item = 1; while( have_rows('faq') ): the_row(); 
            $faq_ask = get_sub_field('faq_ask');
            $faq_answer = get_sub_field('faq_answer');
            ?>
            <div class="faq__accord-item accord-item">
                <div class="faq__accord-item-top accord-item-top">
                    <div class="accord-count">0<?= $itt_item ?></div>
                    <p><?= $faq_ask ?></p>

                    <div class="icon-wrapper">
                        <img class="initial-state" src="<?= THORGATES_THEME_DIRECTORY ?>/assets/images/initial-state.svg" alt="icon">
                        <img class="hover-state" src="<?= THORGATES_THEME_DIRECTORY ?>/assets/images/hover-state.svg" alt="icon">
                    
                </div>
                </div>
                <div class="faq__accord-item-bottom accord-item-bottom">
                    <p><?= $faq_answer ?></p>
                </div>
            </div>
        <?php $itt_item; endwhile; ?>

	
	</div>
	</div>
</div>
</section>
<?php endif; ?>
<section class="news mb-m">
    <div class="container">
        <div class="news__container">
            <div class="news__title">
                <h2><?= __('Latest news about crypto & airdrops' , 'airdrop') ?></h2>
            </div>
            <div class="news__slider__wrap">
                <div class="swiper newsSlider">
                    <div class="swiper-wrapper">
                        <?php
                        $args = array(
                            'post_type'      => 'post',
                            'posts_per_page' => 10,
                            'post__not_in'   => array(get_the_ID()),
                            'orderby'        => 'date',
                            'order'          => 'DESC'
                        );
                        $news_query = new WP_Query($args);
                        
                        if ($news_query->have_posts()) :
                            while ($news_query->have_posts()) : $news_query->the_post();
                                ?>
                                <div class="swiper-slide news-slide news-item">
                                    <a href="<?php the_permalink(); ?>" class="news-slide-img news-item-img">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('full', array('alt' => get_the_title())); ?>
                                        <?php else : ?>
                                            <img src="<?= AIRDROP_THEME_DIRECTORY ?>/assets/images/slider-img.jpg" alt="slider img">
                                        <?php endif; ?>
                                    </a>
                                    <div class="news-slide-wrap news-item-wrap">
                                        <div class="coins">
                                            <?php
                                            $post_tags = get_the_tags();
                                            if ($post_tags) {
                                                $tags = array_slice($post_tags, 0, 3);
                                                foreach ($tags as $tag) {
                                                    echo '<a href="' . get_tag_link($tag->term_id) . '">
                                                        <img src="' . AIRDROP_THEME_DIRECTORY . '/assets/images/coins.svg" alt="' . $tag->name . '">' . $tag->name . '</a>';
                                                }
                                            } else {
                                                echo '<span>No tags available</span>';
                                            }
                                            ?>
                                        </div>
                                        <a href="<?php the_permalink(); ?>">
                                            <div><?php the_title(); ?></div>
                                        </a>
                                        <a href="<?php the_permalink(); ?>">
                                            <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                        </a>
                                        <span class="date"><?php the_time('M j, Y'); ?></span>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
				<div class="arrow news-button-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="24" viewBox="0 0 28 24" fill="none">
                            <path d="M1.49001 10.3017L11.09 0.701695C11.5416 0.252252 12.1529 -6.05132e-05 12.79 -6.04575e-05C13.4272 -6.04018e-05 14.0384 0.252252 14.49 0.701695C14.9323 1.15707 15.1797 1.76689 15.1797 2.4017C15.1797 3.0365 14.9323 3.64632 14.49 4.10169L8.98001 9.60169L25.6 9.60169C26.2365 9.60169 26.847 9.85455 27.2971 10.3046C27.7471 10.7547 28 11.3652 28 12.0017C28 12.6382 27.7471 13.2487 27.2971 13.6988C26.847 14.1488 26.2365 14.4017 25.6 14.4017L8.99001 14.4017L14.49 19.9017C14.7133 20.1249 14.8903 20.39 15.0112 20.6817C15.132 20.9733 15.1942 21.286 15.1942 21.6017C15.1942 21.9174 15.132 22.23 15.0112 22.5217C14.8903 22.8134 14.7133 23.0784 14.49 23.3017C14.2668 23.5249 14.0017 23.702 13.71 23.8229C13.4184 23.9437 13.1057 24.0059 12.79 24.0059C12.4743 24.0059 12.1617 23.9437 11.87 23.8229C11.5783 23.702 11.3133 23.5249 11.09 23.3017L1.49001 13.7017C1.04772 13.2463 0.800324 12.6365 0.800325 12.0017C0.800325 11.3669 1.04772 10.7571 1.49001 10.3017Z" fill="white"/>
                        </svg>
                    </div>
                    <div class="arrow news-button-next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="24" viewBox="0 0 28 24" fill="none">
                            <path d="M26.51 13.7042L16.91 23.3042C16.4584 23.7536 15.8471 24.0059 15.21 24.0059C14.5728 24.0059 13.9616 23.7536 13.51 23.3042C13.0677 22.8488 12.8203 22.239 12.8203 21.6042C12.8203 20.9694 13.0677 20.3595 13.51 19.9042L19.02 14.4042H2.39999C1.76347 14.4042 1.15303 14.1513 0.702942 13.7012C0.252855 13.2511 0 12.6407 0 12.0042C0 11.3676 0.252855 10.7572 0.702942 10.3071C1.15303 9.85702 1.76347 9.60416 2.39999 9.60416H19.01L13.51 4.10416C13.2867 3.88092 13.1097 3.61588 12.9888 3.3242C12.868 3.03251 12.8058 2.71988 12.8058 2.40416C12.8058 2.08844 12.868 1.77582 12.9888 1.48413C13.1097 1.19244 13.2867 0.927412 13.51 0.704165C13.7332 0.480917 13.9983 0.303827 14.29 0.183006C14.5816 0.0621858 14.8943 -9.97993e-09 15.21 0C15.5257 9.97993e-09 15.8383 0.0621858 16.13 0.183006C16.4217 0.303827 16.6867 0.480917 16.91 0.704165L26.51 10.3042C26.9523 10.7595 27.1997 11.3694 27.1997 12.0042C27.1997 12.639 26.9523 13.2488 26.51 13.7042Z" fill="white"/>
                        </svg>
                    </div>
            </div>
        </div>
    </div>
</section>

