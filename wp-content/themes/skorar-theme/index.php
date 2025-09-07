<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="site-header">
        <div class="container">
            <h1 class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php bloginfo('name'); ?>
                </a>
            </h1>
            
            <nav class="main-nav">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'fallback_cb' => false,
                ]);
                ?>
            </nav>
        </div>
    </header>

    <main class="site-main">
        <div class="container">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                        <header class="post-header">
                            <h2 class="post-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            
                            <div class="post-meta">
                                <span>By <?php the_author(); ?></span>
                                <span>on <?php the_date(); ?></span>
                            </div>
                        </header>

                        <div class="post-content">
                            <?php 
                            if (is_single()) {
                                the_content();
                            } else {
                                the_excerpt();
                            }
                            ?>
                        </div>
                    </article>
                <?php endwhile; ?>

                <!-- Pagination -->
                <div class="pagination">
                    <?php
                    the_posts_pagination([
                        'prev_text' => '← Previous',
                        'next_text' => 'Next →',
                    ]);
                    ?>
                </div>

            <?php else : ?>
                <div class="no-posts">
                    <h2>Nothing found</h2>
                    <p>It seems we can't find what you're looking for.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>