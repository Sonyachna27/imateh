<?php 
    $content = get_sub_field('content');
    $intro = get_sub_field('content_intro');
?>
<?php
    if($content) { ?>
        <section class="mb-s content<?= $intro ? ' intro' : '' ?>">
        <div class="container">
            <article <?= $intro ? 'class="intro__container"' : '' ?>>		
                <?= $content ?>
            </article>
        </div>
        </section>
<?php } ?>
