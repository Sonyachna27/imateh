<?php 
    $cashback_title = get_sub_field('cashback_title');
    $cashback_description = get_sub_field('cashback_description');
    $cashback_note = get_sub_field('cashback_note');
    $cashback_footer_note = get_sub_field('cashback_footer_note');
?>
<section class="cashback mb-m">
    <div class="container">
        <div class="cashback__container">
                <img class="cashback__hand" src="<?= THORGATES_THEME_DIRECTORY ?>assets/images/animal-from-fingers-sideways-on-white-background 3.png" alt="Рекомендуй HeadGroup24">
            <div class="cashback__title">
                <?php if($cashback_title) : ?>
                    <h2><?= $cashback_title ?></h2>
                <?php endif; ?>
                <?php if($cashback_description) : ?>
                <div class="cashback__title__coupon">
                    <span>
                    <?= $cashback_description ?>
                    </span>
                </div>
                <?php endif; ?>
            </div>
            <div class="cashback__content">
                <div class="cashback__absolute">
                    <img src="<?= THORGATES_THEME_DIRECTORY ?>assets/images/a-blank----sign-on-a-white-background.png" alt="dollar">
                    <div class="cashback__absolute__btn">
                            <a href="#contacts" class="btn"><span> <?= __('хочу взяти участь' , 'headgroup') ?></span></a>
                    </div>
                    
                </div>
                <div class="cashback__price">
                <?php if( have_rows('cashback_price') ): ?>
                    <div class="cashback__price__title">
                        <span class="simple"><?= __('вартість проекта' , 'headgroup') ?></span>
                        <span class="simple"><?= __('твій кешбек' , 'headgroup') ?></span>
                    </div>
                    <ul class="cashback__price__list">
                            <?php while( have_rows('cashback_price') ): the_row(); 
                                $cashback_price_value = get_sub_field('cashback_price_value');
                                $cashback_price_take = get_sub_field('cashback_price_take');
                                ?>
                                <li>
                                    <?php if($cashback_price_value) : ?>
                                        <div><span><?= $cashback_price_value ?></span> =</div>
                                    <?php endif;?>
                                    <?php if($cashback_price_take) : ?>
                                        <div><span><?= $cashback_price_take ?></span></div>
                                    <?php endif;?>
                                </li>
                            <?php endwhile; ?>
                        
                    </ul>
                    <?php endif; ?>
                    <?php if($cashback_note) : ?>
                    <div class="cashback__price__note">
                        <?= $cashback_note ?>
                    </div>
                    <?php endif;?>
                    <?php if($cashback_footer_note) : ?>
                        <div class="cashback__price__footnote"><?= $cashback_footer_note ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>