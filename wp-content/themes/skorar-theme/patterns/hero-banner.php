<?php
/**
 * Title: Hero Banner
 * Description: A large hero section with title, description and call-to-action button
 * Categories: skorar, header, call-to-action
 * Keywords: hero, banner, cta
 */
?>

<!-- wp:cover {"url":"","dimRatio":30,"overlayColor":"dark","minHeight":60,"minHeightUnit":"vh","align":"full"} -->
<div class="wp-block-cover alignfull" style="min-height:60vh">
    <span aria-hidden="true" class="wp-block-cover__background has-dark-background-color has-background-dim-30 has-background-dim"></span>
    
    <div class="wp-block-cover__inner-container">
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
        <div class="wp-block-group">
            
            <!-- wp:heading {"textAlign":"center","level":1,"fontSize":"xx-large"} -->
            <h1 class="wp-block-heading has-text-align-center has-xx-large-font-size">Welcome to Our Site</h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","fontSize":"large"} -->
            <p class="has-text-align-center has-large-font-size">We create amazing experiences that help your business grow and succeed in the digital world.</p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"2rem"}}}} -->
            <div class="wp-block-buttons" style="margin-top:2rem">
                <!-- wp:button {"backgroundColor":"primary","textColor":"white"} -->
                <div class="wp-block-button">
                    <a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button">Get Started</a>
                </div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->

        </div>
        <!-- /wp:group -->
    </div>
</div>
<!-- /wp:cover -->