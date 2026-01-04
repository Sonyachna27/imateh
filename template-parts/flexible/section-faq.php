<?php 
$faq_title = get_sub_field('faq_title');
$faq_description = get_sub_field('faq_description');

if (have_rows('faq')) : 
    $counter = 1;
?>
<section class="faq mb-m" itemscope itemtype="https://schema.org/FAQPage">
    <div class="container">
        <div class="faq__container">
            
            <div class="faq__title justify-title">
                <?php if ($faq_title): ?>
                    <h2><?= $faq_title; ?></h2>
                <?php endif; ?>

                <?php if ($faq_description): ?>
                    <p><?= $faq_description; ?></p>
                <?php endif; ?>
            </div>

            <div class="faq__items accord">
                <?php while (have_rows('faq')) : the_row(); 
                    $faq_ask = get_sub_field('faq_ask');
                    $faq_answer = get_sub_field('faq_answer');

                    if (!$faq_ask || !$faq_answer) continue; 
                ?>
                <div class="faq__item accord-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <div class="faq__item__top accord-item-top">
                        <span class="faq__item__top__count">
                            <?= str_pad($counter, 2, '0', STR_PAD_LEFT); ?>
                        </span>
                        <p itemprop="name"><?= esc_html($faq_ask); ?></p>
                        <div class="faq-icon-wrapper"></div>
                    </div>
                    <div class="faq__item-bottom accord-item-bottom" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq__item-bottom-wrap">
                            <p itemprop="text"><?= esc_html($faq_answer); ?></p>
                        </div>
                    </div>
                </div>
                <?php $counter++; endwhile; ?>
            </div>

        </div>
    </div>
</section>
<?php endif; ?>
