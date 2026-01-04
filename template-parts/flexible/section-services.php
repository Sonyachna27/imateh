<?php 
    $services_title = get_sub_field('services_title'); 
    $services_link = get_sub_field('services_link');
?>
<section class="services mb-l">
    <div class="container">
        <div class="services__container">
            <?php if($services_title) : ?>
            <div class="services__title">
                   <?= $services_title ?>
            </div>
            <?php endif; ?>
            <?php if($services_link) : ?>
                <a href="<?= $services_link['url'] ?>" rel="nofollow , norreper" class="btn"><?= $services_link['title'] ?></a>
            <?php endif; ?>
            <div class="services__items fancy__items">
                <?php 
                    $args = [
    'post_type'      => 'services',
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'ASC',
    'posts_per_page' => -1,
];

$services_query = new WP_Query($args);

if ( $services_query->have_posts() ) {
    while ( $services_query->have_posts() ) {
        $services_query->the_post(); 
            $services_time_create = get_field('services_time_create');
            $services_pack = get_field('services_pack');
            $services_cost = get_field('services_cost');
            $services_icon = get_field('services_icon');
            $services_label = get_field('services_label');
        ?>
                       <a href="<?= get_the_permalink(); ?>" class="services__item  fancy-bg">
                    <div class="services__item__content fancy-content">
                        <div class="services__item__content__title fancy-content__title">
                            <h3><?= get_the_title(); ?></h3>
                            <?php if($services_label) : ?>
                                <div><?= $services_label ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="services__item__content__info fancy-content__info">
                            <?php if($services_time_create) : ?>
                                <span class="term"><?= $services_time_create ?></span>
                            <?php endif; ?>
                            <?php if($services_pack) : ?>
                                <?= $services_pack ?>
                            <?php endif; ?>
                        </div>
                        <?php if($services_cost) : ?>
                        <div class="services__item__content__info__price price"><?=__('Від ' , 'headgroup') ?><span> <?= $services_cost ?></span> </div>
                        <?php endif; ?>
                        </div>
                        
                    <div class="services__item__link fancy-bg__variation">
                    <div href="<?= get_the_permalink(); ?>" >
                        <svg width="112" height="112" viewBox="0 0 112 112" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1.5" y="110.5" width="109" height="109" rx="54.5" transform="rotate(-90 1.5 110.5)" stroke="#BAF67C" stroke-width="3"/>
                        <path d="M48 48L64 64M64 64H48M64 64V48" stroke="#BAF67C" stroke-width="3"/>
                        <path d="M48 48L64 64M64 64H48M64 64V48" stroke="#BAF67C" stroke-width="3"/>
                    </svg>
                </div>
                </div>
                <?php if($services_icon) : ?>
                    <div class="services__item__img">
                        <img src="<?= $services_icon ?>" alt="<?= get_the_title(); ?>">
                    </div>
                    <?php endif; ?>
                </a>
    <?php }
    wp_reset_postdata();
}
                ?>
                </div>
            </div>
        </div>
    </div>
</section>