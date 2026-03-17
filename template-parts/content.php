<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Contractor_Starter_Theme
 */
?>
<?php
if (is_singular()) : ?>
<?php
$title = get_the_title($post->ID);
$authorid = $post->post_author;
$author_acf_prefix = 'user_';
$author_id_prefixed = $author_acf_prefix . $authorid;
$author_photo = get_field('author_photo', $author_id_prefixed);
$company_title = get_field('company_title', 'user_' . $authorid);
$bio = get_the_author_meta('description', $authorid);
$social_media = get_field('social_media', 'user_' . $authorid);
?>

<section class="hero hero--blog-detail" aria-label="Blog detail page">
    <div class="blog_inner d-flex align-items-center pos-rel">
        <picture class="bg--image-abs overlay">
            <?php
            $thumb_id = get_post_thumbnail_id();
            $thumb_url_array = wp_get_attachment_image_src($thumb_id, "full", true);
            $thumb_url = $thumb_url_array[0];
            $thumb_alt = get_post_meta(get_post_thumbnail_id(), "_wp_attachment_image_alt", true);
            ?>
            <img src="<?php echo $thumb_url; ?>" alt="<?php echo $thumb_alt; ?>">
        </picture>
        <div class="container container-1350">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    <div class="hero-content ta-c c-con-lig">
						<?php 
							$categories = get_the_category();
							if ( ! empty( $categories ) ) : 
								$single_cat = $categories[0];
							?>
								<span class="micro">
									<?php echo esc_html( $single_cat->name ); ?>
								</span>
						<?php endif; ?>
                        <h1 class="lvl-1 tt-up"><?php echo $title; ?></h1>
                        <div class="d-flex align-items-center justify-content-center col-gap-4 row-gap-3 mt-4">
                            <div class="blog__inner__meta d-flex align-items-center flex-wrap row-gap-3 col-gap-3">
                                <p class="d-flex align-items-center m-0"><i class="fa-solid fa-alarm-clock"></i><?php echo reading_time($post); ?> Read</p>
                                <p class="d-flex align-items-center m-0"><i class="fa-solid fa-calendar"></i>  
                                <?php $published_date = get_the_date('U');
									$modified_date  = get_the_modified_date('U');
									if ( $modified_date > $published_date ) {
										echo 'Updated: ' . get_the_modified_date('m.d.y');
									} else {
										echo 'Posted On ' . get_the_date('m.d.y'); } ?>
                                </p>                                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php // Progress bar for blog posts
    if ( is_single() && 'post' == get_post_type() ): ?>
        <div class="post-progress">
            <div class="post-progress__bar" id="scroll-progress"></div>
        </div>
    <?php endif; ?>
</section>
<!-- End - Blog single hero -->

<!-- Blog single section -->
<section class="blog-detail cs-pb-lg" aria-label="page introduction">
    <div class="container">
        <div class="post-detail-content mw-870">
            <div class="blog-detail-content">
                <?php the_content(); ?>
            </div>
            <div class="author-card  cs-mt-def">
                <div class="author-meta d-flex justify-content-between">
                    <div class="author-img">
                        <?php if (!empty($author_photo)) : ?>
                            <div class="author-photo">
                                <img src="<?php echo esc_url($author_photo['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($author_photo['alt']); ?>" />
                            </div>
                        <?php else : ?>
                            <div class="author-avatar">
                                <?php echo get_avatar($authorid); ?>
                            </div>
                        <?php endif; ?>
                        <p class="author-name">Written By: <?php the_author(); ?></p>
                    </div>
                    <?php if (!empty($social_media)) : ?>
                        <div class="author-social d-flex align-items-center">
                            <?php foreach ($social_media as $item) :
                                $icon = $item['icon'];
                                $link = $item['link']; 
                                if (!empty($link && $icon)) : ?>
                                <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target'] ? esc_attr($link['target']) : '_self'; ?>" class="social-item">
									<i class="fa <?php echo $icon; ?>"></i>
                                </a>
                            <?php endif; endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>                          
                <?php if (!empty($bio)) : ?>
                    <div class="author-bio pt-3"> 
                        <p><?php echo $bio; ?></p>
                    </div>
                <?php endif; ?>                
            </div>
        </div>
    </div>
</section>
<!-- End - Blog single section -->
<?php endif; ?>