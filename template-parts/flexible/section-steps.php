<?php 
$steps_title = get_sub_field('steps_title');
?>
<section class="stage mb-m">
    <div class="container">
        <div class="stage__container">
            
            <?php if ($steps_title): ?>
                <div class="stage__title">
                    <h2><?= $steps_title; ?></h2>
                </div>
            <?php endif; ?>

            <?php if (have_rows('steps')): 
                $counter = 1;
            ?>
            <div class="stage__items fancy__items">
                <?php while (have_rows('steps')): the_row(); 
                    $steps_block_title = get_sub_field('steps_block_title');
                    $steps_block_description = get_sub_field('steps_block_description');
                ?>
                <div class="stage__item fancy-bg">
                    <div class="stage__item__content fancy-content">
                        
                        <?php if ($steps_block_title): ?>
                            <div class="stage__item__content__title fancy-content__title">
                                <h3><?= $steps_block_title; ?></h3>
                            </div>
                        <?php endif; ?>

                        <?php if ($steps_block_description): ?>
                            <div class="stage__item__content__info fancy-content__info">
                                <?= wp_kses_post($steps_block_description); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="stage__item__count fancy-bg__variation">
                        <span><?= str_pad($counter, 2, '0', STR_PAD_LEFT); ?></span>
                    </div>
                </div>
                <?php 
                    $counter++;
                endwhile; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>
