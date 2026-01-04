<?php 
    $service_title = get_field('service_title');
    $services_description = get_field('services_description');
    $services_icon = get_field('services_icon');
    $services_cost = get_field('services_cost');
    $services_time_create = get_field('services_time_create');
?>
<section class="ecommers hero">
    <div class="container">
        <div class="ecommers__container hero__container">
            <h1><?= $service_title ? $service_title : get_the_title(); ?></h1>
            <div class="ecommers__wrap hero__wrap">
            <div class="ecommers__info hero__info">
                <?php if ($services_time_create) : ?>
                    <div class="ecommers__info__term term hero__info__term"><?= $services_time_create ?></div>
                <?php endif; ?>
                <?php if($services_cost) : ?>
                <div class="ecommers__info__price price hero__info__price"><?= __('Від' , 'headgroup') ?> <span><?= $services_cost ?></span></div>
                <?php endif;?>
            </div>
            <div class="ecommers__promo hero__promo">
                <?php if($services_description) : ?>
                    <p><?= $services_description ?></p>
                <?php endif; ?>
                <div class="ecommers__promo__wrap hero__promo__wrap"> 
                <a href="#contacts" class="btn"><?= __('ОБГОВОРИТИ ПРОЄКТ' , 'headgroup') ?></a>
                <?php if($services_icon) : ?>
                    <img src="<?= $services_icon ?>" alt="<?= get_the_title(); ?>">
                <?php endif; ?>
            </div>
            </div>
            </div>
        </div>
    </div>
</section>
<?= the_content(); ?>