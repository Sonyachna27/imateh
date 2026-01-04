<?php
if (class_exists('Kirki')) {
    Kirki::add_config('mebelka_theme_config', array(
        'capability'  => 'edit_theme_options',
        'option_type' => 'theme_mod',
    ));

    // Основная панель
    Kirki::add_panel('main_settings', array(
        'priority'    => 10,
        'title'       => esc_html__('Основные настройки', 'mebelka'),
    ));

    // Вкладка Логотип
    Kirki::add_section('logo_section', array(
        'title'       => esc_html__('Логотип', 'mebelka'),
        'panel'       => 'main_settings',
        'priority'    => 150,
    ));

    Kirki::add_field('mebelka_theme_config', array(
        'type'      => 'image',
        'settings'  => 'site_logo',
        'label'     => esc_html__('Загрузить логотип хедера', 'mebelka'),
        'section'   => 'logo_section',
        'default'   => '',
        'priority'  => 10,
    ));

    Kirki::add_field('mebelka_theme_config', array(
        'type'      => 'image',
        'settings'  => 'site_logo_footer',
        'label'     => esc_html__('Загрузить логотип футора', 'mebelka'),
        'section'   => 'logo_section',
        'default'   => '',
        'priority'  => 10,
    ));

    // Вкладка Социальные сети
    Kirki::add_section('social_links_section', array(
        'title'       => esc_html__('Социальные сети', 'mebelka'),
        'panel'       => 'main_settings',
        'priority'    => 160,
    ));

    // Определение социальных сетей с соответствующими Dashicons
    $social_networks = [
        'youtube'   => ['label' => 'Youtube', 'icon' => 'dashicons-youtube'],
        'instagram' => ['label' => 'Instagram', 'icon' => 'dashicons-camera'],
        'telegram'  => ['label' => 'Telegram', 'icon' => 'dashicons-paperclip'],
    ];

    // Добавляем поля для социальных сетей
    foreach ($social_networks as $key => $data) {
        Kirki::add_field('mebelka_theme_config', array(
            'type'      => 'text',
            'settings'  => 'social_' . $key,
            'label'     => sprintf('<span class="dashicons %s"></span> %s', $data['icon'], esc_html__($data['label'], 'mebelka')),
            'section'   => 'social_links_section',
            'default'   => '',
            'priority'  => 10,
            'sanitize_callback' => 'esc_url',
        ));
    }

    // Вкладка Footer
    Kirki::add_section('footer_section', array(
        'title'       => esc_html__('Footer', 'mebelka'),
        'panel'       => 'main_settings',
        'priority'    => 170,
    ));


    Kirki::add_field('mebelka_theme_config', array(
        'type'      => 'text',
        'settings'  => 'footer_copyright',
        'label'     => esc_html__('Копирайт', 'mebelka'),
        'section'   => 'footer_section',
        'default'   => '',
        'priority'  => 20,
    ));


    //Вкладка контактный данные
    Kirki::add_section( 'contact_details', array(
        'title'    => __( 'Контактные данные', 'mebelka' ),
        'priority' => 165,
        'panel'    => 'main_settings', 
    ) );

    Kirki::add_field( 'mebelka_config', array(
        'type'        => 'text',
        'settings'    => 'contact_phone',
        'label'       => __( 'Телефон', 'mebelka' ),
        'section'     => 'contact_details',
        'default'     => '',
        'priority'    => 10,
    ) );

    Kirki::add_field( 'mebelka_config', array(
        'type'        => 'text',
        'settings'    => 'contact_email',
        'label'       => __( 'Электронная почта', 'mebelka' ),
        'section'     => 'contact_details',
        'default'     => '',
        'priority'    => 20,
        'transport'   => 'postMessage',
    ) );

    Kirki::add_field( 'mebelka_config', array(
        'type'      => 'textarea',
        'settings'    => 'contact_work_time',
        'label'       => __( 'Рабочие часы', 'mebelka' ),
        'section'     => 'contact_details',
        'default'     => '',
        'priority'    => 30,
    ) );
}
