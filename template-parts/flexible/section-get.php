<?php 
    $get_title = get_sub_field('get_title');
    $get_image = get_sub_field('get_image');
    $get_content = get_sub_field('get_content');
?>
<section class="get mb-m">
    <div class="container">
        <?php if($get_title) : ?>
        <div class="get__title">
            <h2><?= $get_title ?></h2>
        </div>
        <?php endif; ?>
        <div class="get__content">
            <?php if($get_image) : ?>
            <div class="get__img">
                <img src="<?= $get_image ?>" alt="<?= $get_title ? $get_title : get_the_title(); ?>">
            </div>
            <?php endif; ?>
            <?php if($get_content) : ?>
            <div class="get__content__info">
                   <?= $get_content ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>