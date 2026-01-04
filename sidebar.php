<aside class="aside">
    <div class="aside__content">
        <nav class="aside-nav">
            <ul class="aside-nav-list top-menu">
            <?php if ( has_nav_menu( 'aside-menu' ) ) : ?>
                <?php wp_nav_menu( array( 
                    'theme_location' => 'aside-menu', 
                    'container' => false, 
                    'items_wrap' => '<ul id="%1$s" class="menu">%3$s</ul>' 
                ) ); ?>
            <?php endif; ?>
            </ul>
    </nav>
    </div>
</aside>