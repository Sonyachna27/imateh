<?php 
    $case_image_laptop = get_field('case_image_laptop');
    $case_time = get_field('case_time');
    $case_link = get_field('case_link');
    $case_choice_service = get_field('case_choice_service');
    $thumb = get_the_post_thumbnail_url('full');
    $excerpt = get_the_excerpt();
?>
<section class="prime">
	<div class="container">
		<div class="prime__container">
            <?php if($case_image_laptop) : ?>
            <div class="prime__img">
				<img src="<?= $case_image_laptop ?>" alt="<?= get_the_title(); ?>">
			</div>
            <?php endif; ?>
			<div class="prime__content">
				<div class="prime__brand">
					<span class="prime__simple"><?= __('Бренд' , 'headgroup') ?></span>
                    <?php if($thumb) : ?>
					    <img src="<?= $thumb ?>" alt="<?= get_the_title(); ?>">
                    <?php endif; ?>
                    <?php if($excerpt) : ?>
					    <p><?= $excerpt ?></p>
                    <?php endif; ?>
                </div>
                <?php if( have_rows('case_team') ): ?>
				<div class="prime__command">
					<span class="prime__simple"><?= __('Команда' , 'headgroup') ?></span>
					<ul class="prime__command__list">
                            <?php while( have_rows('case_team') ): the_row(); 
                                $case_team_name = get_sub_field('case_team_name');
                                ?>
						            <li><?= $case_team_name ?></li>
                            <?php endwhile; ?>
					</ul>
				</div>
                <?php endif; ?>
				<div class="prime__direction">
                        <?php if($case_choice_service) : ?>
						<div class="prime__direction__item">
							<span class="prime__simple"><?= __('Напрямок' , 'headgroup') ?></span>
							<?php
                                foreach ($case_choice_service as $case_choice) { ?>
                                    <a href="<?= get_the_permalink($case_choice -> ID) ?>" class="simple"><?= $case_choice -> post_title ?></a>
                            <?php } ?>
						</div>
                        <?php endif; ?>
                        <?php if($case_time) : ?>
						<div class="prime__direction__item">
							<span class="prime__simple"><?= __('Тривалість' , 'headgroup') ?></span>
							<span><?= $case_time ?></span>
						</div>
                        <?php endif; ?>
				</div>
                <?php if($case_link) : ?>
				<div class="prime__btn">
					<a href="<?= $case_link ?>" class="btn"><?= __('перейти на сайт' , 'headgroup') ?></a>
				</div>
                <?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php if( have_rows('case_technology') ): ?>
<section class="tech">
	<div class="container">
		<div class="tech__container">
			<h2><?= __('Технології, що стоять за цим проєктом' , 'headgroup') ?></h2>
			<div class="tech__items">
                    <?php while( have_rows('case_technology') ): the_row(); 
                        $case_technology_name = get_sub_field('case_technology_name');
                        $case_technology_image = get_sub_field('case_technology_image');
                        ?>
                    <div class="tech__item">
                        <?php if($case_technology_image) : ?>
                            <img src="<?= $case_technology_image ?>" alt="<?= $case_team_name ? $case_team_name : get_the_title(); ?>">
                        <?php endif; ?>
                        <?php if($case_technology_name) : ?>
                            <span><?= $case_technology_name ?></span>
                        <?php endif; ?>
                    </div>
                    <?php endwhile; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php if( have_rows('case_images') ): ?>
<section class="solutions">
	<div class="container"> 
	<div class="solutions__wrap">
	<div class="solutions__items">
            <?php while( have_rows('case_images') ): the_row(); 
                $case_image = get_sub_field('case_image');
                ?>
                <?php if($case_image) : ?>
		            <div class="solutions__item"><img src="<?= $case_image ?>" alt="Solutions 2"></div>
                <?php endif; ?>
            <?php endwhile; ?>
	</div>
	</div>
	</div>
</section>
<?php endif; ?>
<?php
$current_post_id = get_the_ID();

// Все кейсы
$all_cases = get_posts([
  'post_type' => 'cases',
  'posts_per_page' => -1,
  'post_status' => 'publish',
  'orderby' => 'date',
  'order' => 'DESC',
]);

$current_index = array_search($current_post_id, array_column($all_cases, 'ID'));

$total = count($all_cases);
$prev_index = ($current_index - 1 + $total) % $total;
$next_index = ($current_index + 1) % $total;

$prev_post = $all_cases[$prev_index] ?? null;
$next_post = $all_cases[$next_index] ?? null;
?>

<div class="links mb-m">
  <div class="container">
    <div class="links__container">
      
      <?php if ($prev_post): ?>
        <a href="<?= get_permalink($prev_post->ID) ?>" class="links__item link__left">
          <div>
            <svg width="112" height="112" viewBox="0 0 112 112" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="110.5" y="1.5" width="109" height="109" rx="54.5" transform="rotate(90 110.5 1.5)" stroke="#BAF67C" stroke-width="3"/>
              <path d="M64 64L48 48M48 48H64M48 48V64" stroke="#BAF67C" stroke-width="3"/>
              <path d="M64 64L48 48M48 48H64M48 48V64" stroke="#BAF67C" stroke-width="3"/>
            </svg>
          </div>
          <span>попередній кейс</span>
        </a>
      <?php endif; ?>

      <?php if ($next_post): ?>
        <a href="<?= get_permalink($next_post->ID) ?>" class="links__item link__right">
          <span>наступний кейс</span>
          <div>
            <svg width="112" height="112" viewBox="0 0 112 112" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="110.5" y="110.5" width="109" height="109" rx="54.5" transform="rotate(-180 110.5 110.5)" stroke="#BAF67C" stroke-width="3"/>
              <path d="M48 64L64 48M64 48V64M64 48H48" stroke="#BAF67C" stroke-width="3"/>
              <path d="M48 64L64 48M64 48V64M64 48H48" stroke="#BAF67C" stroke-width="3"/>
            </svg>
          </div>
        </a>
      <?php endif; ?>

    </div>
  </div>
</div>
