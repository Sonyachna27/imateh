<?php 
$why_term = get_sub_field('why_term');
$why_title = get_sub_field('why_title');
?>
<section class="why mb-m">
    <div class="container">
        <div class="why__container">
            
            <div class="why__title">
                <?php if ($why_term): ?>
                    <span class="term"><?= $why_term; ?></span>
                <?php endif; ?>
                <?php if ($why_title): ?>
                    <h2><?= $why_title; ?></h2>
                <?php endif; ?>
            </div>

            <div class="why__content">
                <div class="why__items fancy__list__items">
                    <?php if (have_rows('why')): 
                        $counter = 1;
                    ?>
                        <?php while (have_rows('why')): the_row(); 
                            $why_block_title = get_sub_field('why_block_title');
                            $why_block_icon = get_sub_field('why_block_icon');
                            $why_block_description = get_sub_field('why_block_description');
                        ?>
                            <div class="why__item fancy__list__item">
                                <div class="why__item__top fancy__list__item__top">
                                    <div class="why__item__count fancy__list__item__count">
                                        <span><?= str_pad($counter, 2, '0', STR_PAD_LEFT); ?></span>
                                        <?php if ($why_block_icon): ?>
                                            <img src="<?= esc_url($why_block_icon); ?>" alt="<?= esc_attr($why_block_title ?: get_the_title()); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($why_block_title): ?>
                                        <div class="why__item__promo fancy__list__item__promo"><?= esc_html($why_block_title); ?></div>
                                    <?php endif; ?>
                                </div>
                                <?php if ($why_block_description): ?>
                                    <div class="why__item__bottom fancy__list__item__bottom"><?= wp_kses_post($why_block_description); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php 
                            $counter++;
                        endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>
