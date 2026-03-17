<?php 
/**
 * The template for blog hero section
 *
 */
?>

<?php
			$sticky = get_option('sticky_posts');
			$args = array(
				'posts_per_page'      => 1, // Number of sticky posts to get
				'post__in'            => $sticky,
				'ignore_sticky_posts' => 1,
				'post_status'    => 'publish',
			);
			if (!empty($sticky)):
				// has sticky posts
				query_posts($args);

				$stickyPosts = new WP_query();
				$stickyPosts->query($args);
			?>
            <?php if ($stickyPosts->have_posts()): ?>
                <?php while ($stickyPosts->have_posts()) : $stickyPosts->the_post(); ?>
                    <section class="hero hero--blog" aria-label="featured article">
                        <?php
                            $thumb_id = get_post_thumbnail_id();
                            if ($thumb_id) : ?>
                            <picture class="hero--bg bg--image-abs overlay">
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'full');	?>
                            </picture>
                        <?php endif; ?>

                        <div class="container">
                            <div class="row">
                                <div class="col-xl-7 col-lg-9">
                                    <div class="hero-content d-flex flex-column align-items-start row-gap-lg-24">
                                        <header>
                                            <h1 class="micro">Featured Article</h1>
                                            <h2><?php echo wp_trim_words(get_the_title(), 12); ?></h2>
                                        </header>
                                        <div class="blog__inner__meta d-flex align-items-center flex-wrap row-gap-3 col-gap-3">
                                            <p class="d-flex align-items-center m-0"><i class="fa-solid fa-alarm-clock"></i><?php echo reading_time($post); ?> Read</p>
                                            <p class="d-flex align-items-center m-0"><i class="fa-solid fa-calendar"></i> Posted <?php echo get_the_date('m.d.y'); ?></p>                                            
                                        </div>
                                        <div class="feat-excerpt">
                                            <p><?php echo get_the_excerpt(); ?></p>
                                        </div>
                                        <a aria-label="Read more about <?php the_title(); ?>" class="btn btn--secondary-light" href="<?php the_permalink(); ?>">
                                            <span>Keep Reading</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endwhile;
                endif;
                wp_reset_query(); ?>
            <?php endif; ?>