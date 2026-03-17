<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package contractor_stnd_toolbox
 */

get_header();


$microTitle = get_field('error_404_page_micro_title', 'option');
$mainTitle = get_field('error_404_page_micro_title_cop', 'option');
$content_404 = get_field('error_404_page_content', 'option');
$cta_404 = get_field('error_404_page_link', 'option');
$services_404 = get_field('error_404_services_section', 'option');
?>
<main id="primary" class="site-main">
	<section id="cs-hero-basic-404" class="pt-xxl pb-xxl block-cs-hero-basic bg-bas-mid" aria-label="page introduction">
		<div class="container ">
			<div class="row ta-c">
				<div class="col-12">
					<div class="hero-content d-flex flex-column row-gap-24 ">
						<?php if ($microTitle) : ?>
							<div class="section-header">
								<h2 class="micro"><?php echo $microTitle; ?></h2>
								<h3 class="lvl-2"><?php echo $mainTitle; ?></h3>
							</div>
						<?php else : ?>
							<div class="section-header">
								<h2><?php echo $mainTitle; ?></h2>
							</div>
						<?php endif; ?>
						<?php if (! empty($content_404)) : ?>
							<div class="editor-content">
								<?php echo $content_404; ?>
							</div>
						<?php endif; ?>
						<?php if ($cta_404) : ?>
							<div class="btn-wrap pt-4">
								<a class="btn btn--secondary" href="<?php echo esc_url($cta_404['url']); ?>" target="<?php echo esc_attr($cta_404['target']); ?>" aria-label="Open Link">
									<span><?php echo esc_html($cta_404['title']); ?></span>
								</a>
							</div>
						<?php endif; ?>
						</header>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="services-404" class="service default error block-ng-featured-services cs-pt-lg cs-pb-def" aria-label="services 404">
		<div class="container">
			<?php if (have_rows('error_404_services_section', 'option')) : ?>
				<div class="row justify-content-start service-list row-gap-30">
					<?php while (have_rows('error_404_services_section', 'option')) : the_row(); ?>
						<?php
						$page                = get_sub_field('page');

						if (is_numeric($page)) {
							$page = get_post($page);
						}
						global $post;
						$post = $page;
						setup_postdata($post);
						?>
						<div class="col-lg-4">
							<a aria-label="Read about <?php echo esc_attr(get_the_title()); ?>"
								href="<?php the_permalink(); ?>"
								class="card--block-link d-block">
								<div class="card--service-blocks">
									<?php if (get_sub_field('custom_title')) : ?>
										<h3 class="tt-ca"><?php the_sub_field('custom_title'); ?></h3>
									<?php else : ?>
										<h3 class="tt-ca"><?php the_title(); ?></h3>
									<?php endif; ?>
									<div class="services-info">
										<p class="btn btn--tertiary-dark mt-2 pt-1">Learn More</p>
									</div>
								</div>
							</a>
						</div>
					<?php endwhile;
					wp_reset_postdata(); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php
	get_template_part('template-parts/partials/recent', 'articles');
	get_template_part('template-parts/partials/final', 'cta-banner');
	?>
</main><!-- #main -->
<?php
get_footer();
