<?php
/*
 * Template Name: Страница кейсов
 * Description: Это моя кастомная страница кейсов
 * Author: Misha Kushnirenko
 * Version: 1.0
 */
?>
<?php get_header(); ?>

<main>
<?php
$used_services_ids = [];

$cases = get_posts([
  'post_type' => 'cases',
  'post_status' => 'publish',
  'numberposts' => -1,
]);

foreach ($cases as $case) {
  $selected_services = get_field('case_choice_service', $case->ID); 
  if (!empty($selected_services)) {
    foreach ($selected_services as $service) {
      if (is_object($service)) {
        $used_services_ids[] = $service->ID;
      } else {
        $used_services_ids[] = $service;
      }
    }
  }
}

$used_services_ids = array_unique($used_services_ids);

if (!empty($used_services_ids)) {
  $services = get_posts([
    'post_type' => 'services',
    'post_status' => 'publish',
    'numberposts' => -1,
    'orderby' => 'date',
    'order' => 'ASC',
    'post__in' => $used_services_ids
  ]);
} else {
  $services = [];
}


$cases_args = [
  'post_type'      => 'cases',
  'post_status'    => 'publish',
  'posts_per_page' => 5,
  'orderby'        => 'date',
  'order'          => 'DESC'
];
$cases_query = new WP_Query($cases_args);
?>

<section class="projects mb-m">
  <div class="container">
    <div class="projects__container">
      <h1><?= get_the_title(); ?></h1>

      <div class="projects__wrap">
        <div class="projects__list">
          <div class="projects__list__item active" data-service="all"><?= __('ВСI' , 'headgroup') ?></div>
          <?php foreach($services as $service): ?>
            <div class="projects__list__item" data-service="<?= $service->ID ?>">
              <?= esc_html($service->post_title) ?>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="projects__items" id="cases-container">
          <?php
          if ( $cases_query->have_posts() ) :
            $index = 1;
            while ( $cases_query->have_posts() ) : $cases_query->the_post();
              $related_services = get_field('case_choice_service');
              $thumb = get_the_post_thumbnail_url(get_the_ID(), 'full');
              $case_image_laptop = get_field('case_image_laptop');
              ?>
              <div class="projects__item cases__item">
                <div class="cases__item__info">
                  <div class="cases__item__info__count">
                    <?= str_pad($index++, 2, '0', STR_PAD_LEFT) ?>
                  </div>
                  <div class="cases__item__info__category">
                    <?php if($related_services):
                      foreach($related_services as $service): ?>
                        <span><?= esc_html(get_the_title($service)) ?></span>
                    <?php endforeach; endif; ?>
                  </div>
                  <div class="cases__item__info__content">
                    <img src="<?= esc_url($thumb) ?>" alt="<?= esc_attr(get_the_title()) ?>">
                    <p><?= get_the_excerpt() ?></p>
                  </div>
                </div>
                <div class="cases__item__link">
                <?php if($case_image_laptop) : ?>
                  <img src="<?= esc_url($case_image_laptop) ?>" alt="<?= esc_attr(get_the_title()) ?>">
                <?php endif; ?>
                  <a href="<?= get_permalink() ?>" class="btn btn-secondary"><?= __('детальніше про кейс' , 'headgroup') ?></a>
                </div>
              </div>
          <?php
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </div>

        <?php
        $total_cases = wp_count_posts('cases')->publish;
        if ($total_cases > 5): ?>
          <button class="btn load-more" id="load-more-cases" data-offset="5"><?= __('дивитись ще' , 'headgroup') ?></button>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?= the_content(); ?>
</main>

<?php get_footer(); ?>
