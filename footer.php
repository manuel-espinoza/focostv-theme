<footer class="focostv-site-footer">
  <div class="focostv-site-footer-logo">
    <div class="focostv-footer-logo">
      <a href="<?php echo esc_url(home_url('/')); ?>">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/focostv-logo-white.svg'); ?>"
          alt="Logo de Focos TV">
      </a>
    </div>
    <div class="focostv-site-footer-menu">
      <?php
      wp_nav_menu(array(
        'theme_location' => 'footer_menu_principal',
        'container' => false,
        'menu_class' => 'focostv-footer-menu',
        'fallback_cb' => false,
      ));
      ?>
    </div>
    <div class="focostv-site-footer-menu">
      <?php
      wp_nav_menu(array(
        'theme_location' => 'footer_menu_secondary',
        'container' => false,
        'menu_class' => 'focostv-footer-menu-secondary',
        'fallback_cb' => false,
      ));
      ?>
    </div>
    <div class="focostv-site-footer-copyright">
      <p class="copyright-text">
        © Copyright <?php echo date('Y'); ?>, <?php bloginfo('name'); ?> El Salvador, Todos los derechos
        reservados.
      </p>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>