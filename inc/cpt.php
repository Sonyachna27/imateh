<?php

function register_services_post_type() {
  register_post_type('services', [
    'labels' => [
      'name'               => 'Услуги',
      'singular_name'      => 'Услуга',
      'add_new'            => 'Добавить услугу',
      'add_new_item'       => 'Добавить новую услугу',
      'edit_item'          => 'Редактировать услугу',
      'new_item'           => 'Новая услуга',
      'view_item'          => 'Посмотреть услугу',
      'search_items'       => 'Найти услугу',
      'not_found'          => 'Услуги не найдены',
      'not_found_in_trash' => 'В корзине услуг не найдено',
      'menu_name'          => 'Услуги',
    ],
    'public'             => true,
    'has_archive'        => true,
    'rewrite'            => ['slug' => 'services'],
    'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
    'menu_icon'          => 'dashicons-hammer',
    'show_in_rest'       => true, 
  ]);
}
add_action('init', 'register_services_post_type');

function register_cases_post_type() {
  register_post_type('cases', [
    'labels' => [
      'name'               => 'Кейсы',
      'singular_name'      => 'Кейс',
      'add_new'            => 'Добавить кейс',
      'add_new_item'       => 'Добавить новый кейс',
      'edit_item'          => 'Редактировать кейс',
      'new_item'           => 'Новый кейс',
      'view_item'          => 'Посмотреть кейс',
      'search_items'       => 'Найти кейс',
      'not_found'          => 'Кейсы не найдены',
      'not_found_in_trash' => 'В корзине кейсов не найдено',
      'menu_name'          => 'Кейсы',
    ],
    'public'             => true,
    'has_archive'        => false,
    'rewrite'            => ['slug' => 'cases'],
    'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
    'menu_icon'          => 'dashicons-portfolio', 
    'show_in_rest'       => false, 
  ]);
}
add_action('init', 'register_cases_post_type');
