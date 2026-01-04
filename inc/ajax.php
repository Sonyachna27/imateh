<?php
/**
 * Ajax Cases
 */
add_action('wp_ajax_load_cases_by_service', 'load_cases_by_service');
add_action('wp_ajax_nopriv_load_cases_by_service', 'load_cases_by_service');

function load_cases_by_service() {
  $service_id = $_POST['service'] ?? 'all';
  $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;

  $args = [
    'post_type'      => 'cases',
    'post_status'    => 'publish',
    'posts_per_page' => 5,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'offset'         => $offset
  ];

  if ($service_id !== 'all') {
    $args['meta_query'] = [
      [
        'key'     => 'case_choice_service',
        'value'   => '"' . $service_id . '"',
        'compare' => 'LIKE'
      ]
    ];
  }

  $cases = new WP_Query($args);
  $index = $offset + 1;

  $count_args = $args;
  $count_args['offset'] = 0;
  $count_args['posts_per_page'] = -1;
  $count_query = new WP_Query($count_args);
  $total_cases = $count_query->found_posts;

  if ($cases->have_posts()) :
    while ($cases->have_posts()) : $cases->the_post();
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
  echo "<!--total_cases:$total_cases-->";

  wp_die();
}
