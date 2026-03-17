<?php
/**
 * Template Name: Blog Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package contractor_stnd_toolbox
 */

get_header();
?>
<main id="primary" class="site-main">
<?php get_template_part( 'template-parts/partials/blog', 'hero'); ?>

<?php $the_query = new WP_Query( array( 
			'post__not_in' => get_option( 'sticky_posts' ), // Hide 'sticky' post from query
			'post_type' => 'post',
			'post_status' => 'publish',
			//'posts_per_page' => -1,
			'posts_per_page' => 9,
			'facetwp' => true,
		) );
		if ( $the_query->have_posts() ) : ?>	
		<section class="blog-posts cs-pt-md cs-pb-lg" aria-labelledby="list of articles">
			<div class="container c-w-1350">
				<div class="filters-wrap cs-pb-md">
					<?php echo do_shortcode( '[facetwp facet="categories"]' );?>
				</div>
				<div class="row post-list">
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div class="col-md-4 article_inner_wrapper">
                            <div class="card--recent-article h-100">
								<a class="rec-art-link card--block-link h-100" href="<?php the_permalink(); ?>">
									<div class="recent-article_wrapper h-100 d-flex flex-column">										
										<div class="article-image-wrapper">
											<?php if (has_post_thumbnail()) : ?>
												<picture class="article-img w-full pos-rel">
													<?php echo get_the_post_thumbnail(get_the_ID(), 'medium'); ?>
													<div class="post-meta">
														<p class="blog-date">
															<?php
															$published_date = get_the_date('U');
															$modified_date  = get_the_modified_date('U');

															if ($modified_date > $published_date) {
																echo 'Updated: ' . get_the_modified_date('m.d.y');
															} else {
																echo 'Posted On: ' . get_the_date('m.d.y');
															}
															?>
														</p>
													</div>													
												</picture>
											<?php endif; ?>
										</div>

										<div class="recent-article-info d-flex flex-column h-100">
											<p class="read-time">
												<?php echo reading_time(get_the_ID()); ?> Read
											</p>
											<h4 class="card-title"><?php the_title(); ?></h4>
											<div class="card-text">
												<p>
													<?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
												</p>
											</div>
											<span class="btn btn--tertiary-dark">Tertiary Button</span>
										</div>

									</div>
								</a>
							</div>
                        </div>
					<?php endwhile; ?> <?php wp_reset_postdata(); ?> 
				</div>
				<?php echo do_shortcode( '[facetwp facet="pagination"]' );?>
			</div>
		</section>
		<?php endif;?>
    <?php 	
		// ACF Page Options to True/False fields to show/hide universal page sections
		// Get template part if option is set to true (1)
		if ( get_field( 'display_final_cta_banner', get_the_ID()) == 1 ) {
			get_template_part( 'template-parts/partials/final', 'cta-banner' );
	} ?>
</main>
<?php
get_footer();