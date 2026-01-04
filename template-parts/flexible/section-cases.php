<?php 
    $cases_title = get_sub_field('cases_title');
?>
<section class="cases main__cases">
    <div class="container">
        <div class="cases__wrap">
        <div class="cases__title">
            <?php if($cases_title) : ?>
                <h2><?= $cases_title ?></h2>
            <?php endif; ?>
            <div class="cases__count">
                <div class="cases-pagination"></div>
            </div>
        </div>
        
            <div class="cases__items"> 
            <?php

            $args = [
                'post_type'      => 'cases',
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
                'posts_per_page' => 10, 
            ];

            $query = new WP_Query($args);

            if ( $query->have_posts() ) :
                $counter = 1;
                while ( $query->have_posts() ) : $query->the_post();
                    $logo = get_the_post_thumbnail_url(get_the_ID(), 'full'); 
                    $excerpt = get_the_excerpt();
                    $case_image_laptop = get_field('case_image_laptop');
                    $case_choice_service = get_field('case_choice_service');
                    ?>
                    <div class="cases__item">
                        <div class="cases__item__info">
                            <div class="cases__item__info__count">
                                <?= str_pad($counter, 2, '0', STR_PAD_LEFT); ?>
                            </div>
                            <div class="cases__item__info__category">
                                <?php
                                if($case_choice_service) : 
                                    foreach ($case_choice_service as $case_service) { ?>
                                    
                                        <a href="<?= get_the_permalink($case_service -> ID); ?>"><span><?= $case_service -> post_title ?></span></a>
                                <?php } ?>
                                    
                                <?php endif; ?>
                            </div>
                            <div class="cases__item__info__content">
                                <?php if ( $logo ) : ?>
                                    <img src="<?= esc_url($logo); ?>" alt="<?= esc_attr(get_the_title()); ?>">
                                <?php endif; ?>
                                <p><?= esc_html($excerpt); ?></p>
                            </div>
                        </div>
                        <div class="cases__item__link">
                            <?php if ( $case_image_laptop ) : ?>
                               <img src="<?= $case_image_laptop ?>" alt="<?= get_the_title(); ?>">
                            <?php endif; ?>
                            <a href="<?= get_the_permalink(); ?>" class="btn btn-secondary">
                                <?= __('детальніше про кейс' , 'headgroup') ?>
                            </a>
                        </div>
                    </div>
                    <?php
                    $counter++;
                endwhile;

                wp_reset_postdata();
            endif;
            ?>

              
                    </div> 
        </div>
    </div>
</section>