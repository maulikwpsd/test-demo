<?php 

/**
 * Recent Articles Section Template
 *
 * By default this layout will pull in field data from 'Theme Options > Recent Articles'.
 * 
 * This can be overridden on an individual basis using the 'Page Options' panel on specific pages
 * 
 * @package hk_contractor_stnd
 */

$microTitle = get_field( 'recent_articles_micro_title', 'option');
$mainTitle = get_field( 'recent_articles_main_title', 'option' );
$recent_articles_content = get_field( 'recent_articles_content', 'option' );
$recent_articles_link = get_field( 'recent_articles_link', 'option' );
$recent_artical_type = get_field( 'recent_artical_type', get_the_ID() );
?>

<section id="recent-articles-<?php echo esc_attr( get_the_ID() ); ?>" class="recent-articles pt-xxl pb-xxl" aria-label="recent articles">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-content d-flex flex-column flex-lg-row row-gap-24 align-items-start align-items-lg-end justify-content-between">
                    <div class="section-header">
                        <?php if (!empty($microTitle)) : ?>
                            <h2 class="micro"><?php echo $microTitle;?></h2>
                            <?php if(!empty($mainTitle)):?>
                                <h3 class="lvl-2"><?php echo $mainTitle;?></h3>
                            <?php endif;?>
                        <?php else : ?>
                            <?php if (!empty($mainTitle)) : ?>
                                <h2><?php echo $mainTitle;?></h2>
                            <?php endif ; ?>
                        <?php endif ; ?>
                        <?php if (!empty($recent_articles_content)) : ?>
                            <p><?php echo $recent_articles_content;?></p>
                        <?php endif ; ?>
                    </div>
                    <?php if(!empty($recent_articles_link)):?>
                        <div class="cta-link">
                            <a class="btn btn--secondary" href="<?php echo $recent_articles_link['url'];?>" <?php if(!empty($recent_articles_link['target'])) {?> target="_blank" <?php }?>><?php echo $recent_articles_link['title'];?></a>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="recent-article-main_wrapper d-flex">
            <?php if($recent_artical_type == 'ra--related'): ?>
                <?php
                    $current_post_id = get_the_ID();
                    $categories = wp_get_post_categories($current_post_id);

                    $args = array(
                        'post_type'      => 'post',
                        'posts_per_page' => 3,
                        'post_status'    => 'publish',
                        'post__not_in'   => array($current_post_id), // exclude current post
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                        'category__in'   => $categories, // related by category
                    );

                    $the_query = new WP_Query($args);

                    if ($the_query->have_posts()) :
                        while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            
                            <div class="article_inner_wrapper">
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
                                                                        echo 'Updated: ' . get_the_modified_date('n.j.y');
                                                                    } else {
                                                                        echo 'Posted On: ' . get_the_date('n.j.y');
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
                                                <span class="btn btn--tertiary-dark mt-auto">Tertiary Button</span>
                                            </div>

                                        </div>
                                    </a>
                                </div>
                            </div>

                        <?php endwhile;
                    endif;

                    wp_reset_postdata();
                    ?>
            <?php elseif($recent_artical_type == 'ra--recent') : ?>
                <?php 
                $args = array(    
                    'post_type' => 'post',          
                    'posts_per_page' => 3, 
                    'post_status' => 'publish',
                    'post__not_in' => get_option( 'sticky_posts' ),
                    'orderby' => 'date', 
                    'order'   => 'DESC', 
                );
                $the_query = new WP_Query($args); 
                if($the_query->have_posts()) : 
                    while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <div class="article_inner_wrapper">
                            <div class="card--recent-article h-100">
                                <a class="rec-art-link card--block-link h-100" href="<?php the_permalink(); ?>">
                                    <div class="recent-article_wrapper h-100 d-flex flex-column">
                                        <div class="article-image-wrapper">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <picture class="article-img w-full pos-rel">
                                                    <?php echo get_the_post_thumbnail(get_the_ID(),'medium'); ?>
                                                     <div class="post-meta">
                                                        <p class="blog-date"> 
                                                            <?php
                                                                $published_date = get_the_date('U');
                                                                $modified_date  = get_the_modified_date('U');

                                                                if ( $modified_date > $published_date ) {
                                                                    echo 'Updated: ' . get_the_modified_date('n.j.y');
                                                                } else {
                                                                    echo 'Post On: ' . get_the_date('n.j.y');
                                                                }
                                                            ?>
                                                        </p> 
                                                    </div>
                                                    
                                                </picture>
                                            <?php endif; ?>
                                        </div>
                                        <div class="recent-article-info d-flex flex-column h-100">
                                            <p class="read-time"><?php echo reading_time(get_the_ID()); ?> Read</p>
                                            <h4 class="card-title"><?php the_title(); ?></h4>
                                            <p class="card-text"><?php echo wp_trim_words( get_the_excerpt(),   20, '...' ); ?></p>   
                                            <span class="btn btn--tertiary-dark mt-auto">Tertiary Button</span>  
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endwhile; endif; wp_reset_postdata(); ?>

                <?php else : ?>

                        <?php
                            $select_category = get_field('select_category', get_the_ID());

                            $cat_ids = [];

                            // If Term Objects are returned
                            if ( is_array($select_category) ) {
                                foreach ( $select_category as $cat ) {
                                    $cat_ids[] = is_object($cat) ? $cat->term_id : $cat;
                                }
                            }

                            $args = array(
                                'post_type'      => 'post',
                                'posts_per_page' => 3,
                                'post_status'    => 'publish',
                                'post__not_in'   => get_option('sticky_posts'),
                                'orderby'        => 'date',
                                'order'          => 'DESC',
                            );

                            // Add category filter only if categories are selected
                            if ( ! empty($cat_ids) ) {
                                $args['category__in'] = $cat_ids;
                            }

                            $the_query = new WP_Query($args);

                            if ( $the_query->have_posts() ) :
                                while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                <div class="article_inner_wrapper">
                                    <div class="card--recent-article h-100">
                                        <a class="rec-art-link card--block-link h-100" href="<?php the_permalink(); ?>">
                                            <div class="recent-article_wrapper h-100 d-flex flex-column">
                                                <div class="article-image-wrapper">
                                                    <?php if ( has_post_thumbnail() ) : ?>
                                                        <picture class="article-img w-full pos-rel">
                                                            <?php echo get_the_post_thumbnail(get_the_ID(),'medium'); ?>
                                                            <div class="post-meta">
                                                                <p class="blog-date">
                                                                    <?php
                                                                    $published_date = get_the_date('U');
                                                                    $modified_date  = get_the_modified_date('U');

                                                                    if ( $modified_date > $published_date ) {
                                                                        echo 'Updated: ' . get_the_modified_date('n.j.y');
                                                                    } else {
                                                                        echo 'Post On: ' . get_the_date('n.j.y');
                                                                    }
                                                                    ?>
                                                                </p> 
                                                            </div>
                                                            
                                                        </picture>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="recent-article-info d-flex flex-column h-100">
                                                    <p class="read-time"><?php echo reading_time(get_the_ID()); ?> Read</p>
                                                    <h4 class="card-title"><?php the_title(); ?></h4>
                                                    <p class="card-text"><?php echo wp_trim_words( get_the_excerpt(),   20, '...' ); ?></p>   
                                                    <span class="btn btn--tertiary-dark mt-auto">Tertiary Button</span>  
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                    <?php endwhile; endif; wp_reset_postdata(); ?>

                    <?php endif; ?>
            </div>
        </div>
    </div>
</section>