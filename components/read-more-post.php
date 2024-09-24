<?php
$custom_text = 'Leer nota';
if (isset($args['permalink'])) {
    $permalink = $args['permalink'];
}
if (isset($args['custom_text'])) {
    $custom_text = $args['custom_text'];
}
?>

<div class="focostv-front-page-post-link">
    <a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($custom_text); ?>
    </a>
    <div class="goto-post-icon"><!-- https://feathericons.dev/?search=arrow-up-right&iconset=feather -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon"
            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <line x1="7" x2="17" y1="17" y2="7" />
            <polyline points="7 7 17 7 17 17" />
        </svg>
    </div>
</div>