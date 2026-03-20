<?php
// Default template for WP Portfolio

function wp_portfolio_template() {
    // Add your default template code here
    echo '<h1>Welcome to WP Portfolio</h1>';
}

add_action('wp_head', 'wp_portfolio_template');
