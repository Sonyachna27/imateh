<?php
    $about_title = get_sub_field('about_title');
    $about_image = get_sub_field('about_image');
    $about_content = get_sub_field('about_content');
?>
<section class="about mb-m">
    <div class="container">
        <div class="about__container">
            <?php
                if($about_title) { ?>
                    <div class="about__title">
                        <h2><?= $about_title ?></h2>
                    </div>
            <?php } ?>
            <div class="about__wrapper">
                <?php 
                    if($about_image) { ?> 
                        <div class="about__image">
                            <img src="<?= $about_image ?>" alt="Airdrops are free distributions">
                        </div>
                <?php } ?>
                <?php 
                    if($about_content) { ?>
                        <div class="about__content">
                            <?= $about_content ?>
                        </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>