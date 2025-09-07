<?php
/**
 * Title: Two Column Content
 * Description: Two column layout with image and text content
 * Categories: skorar, columns, content
 * Keywords: columns, image, text, content
 */
?>

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"3rem"}}}} -->
<div class="wp-block-columns alignwide">
    
    <!-- wp:column {"width":"40%"} -->
    <div class="wp-block-column" style="flex-basis:40%">
        <!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
        <figure class="wp-block-image size-large" style="border-radius:8px">
            <img src="https://via.placeholder.com/600x400/0073aa/ffffff?text=Your+Image" alt="" />
        </figure>
        <!-- /wp:image -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column {"width":"60%","verticalAlignment":"center"} -->
    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60%">
        
        <!-- wp:heading {"level":2} -->
        <h2 class="wp-block-heading">About Our Service</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph -->
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
        <!-- /wp:paragraph -->

        <!-- wp:list -->
        <ul class="wp-block-list">
            <!-- wp:list-item -->
            <li>Professional and reliable service</li>
            <!-- /wp:list-item -->
            
            <!-- wp:list-item -->
            <li>Expert team with years of experience</li>
            <!-- /wp:list-item -->
            
            <!-- wp:list-item -->
            <li>Customer satisfaction guaranteed</li>
            <!-- /wp:list-item -->
        </ul>
        <!-- /wp:list -->

        <!-- wp:button {"backgroundColor":"primary","textColor":"white"} -->
        <div class="wp-block-button">
            <a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button">Learn More</a>
        </div>
        <!-- /wp:button -->

    </div>
    <!-- /wp:column -->

</div>
<!-- /wp:columns -->