<?php 
    $reviews_title = get_sub_field('reviews_title');
    $reviews_custom = get_sub_field('reviews_custom');
    $custom_review = !$reviews_custom ? 'option' : ''; 
?>
<?php if( have_rows('reviews' , $custom_review) ): ?>

<section class="reviews mb-m">
    <div class="container">
        <div class="reviews__title justify-title">
            <?php if($reviews_title) : ?>
            <h2><?= $reviews_title ?></h2>
            <?php endif; ?>
            <div class="reviews__arrows">
                
                <div class="reviews-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                    <path d="M18 17.5L2 1.5M2 1.5L18 1.5M2 1.5V17.5" stroke="#BAF67C" stroke-width="3"/>
                    </svg>
                    </div>
                    <div class="reviews-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                    <path d="M2 1.5L18 17.5M18 17.5L2 17.5M18 17.5L18 1.5" stroke="#BAF67C" stroke-width="3"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper reviewsSlider container">
<div class="swiper-wrapper reviews-wrapper">
    <?php while( have_rows('reviews' , $custom_review) ): the_row(); 
        $reviews_photo = get_sub_field('reviews_photo');
        $reviews_name_brand = get_sub_field('reviews_name_brand');
        $reviews_name = get_sub_field('reviews_name');
        $reviews_review = get_sub_field('reviews_review');
        ?>
        <div class="swiper-slide reviews__item">
                <div class="reviews__item__content">
                    <?php if($reviews_name) : ?>
                    <div class="reviews__item__content__name"><?= $reviews_name ?></div>
                    <?php endif; ?>
                    <?php if($reviews_review) : ?>
                        <p><?= $reviews_review ?></p>
                    <?php endif;?>
                </div>
                <div class="reviews__item__absolute">
                    <?php if($reviews_name_brand) : ?>
                        <div class="reviews__item__site"><?= $reviews_name_brand ?></div>
                    <?php endif;?>
                    <?php if($reviews_photo) : ?>
                        <div class="reviews__item__img">
                            <img src="<?= $reviews_photo ?>" alt="<?= $reviews_name ? $reviews_name : get_the_title(); ?>">
                        </div>  
                    <?php endif; ?>
                
                </div>
        </div>
    <?php endwhile; ?>
    
</div>
    </div>
</section>
<?php endif; ?>
