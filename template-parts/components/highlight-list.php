<?php 
if ( have_rows( 'highlight_list' ) ) : ?>
    <ul class="highlights d-flex flex-column align-items-start row-gap-16 m-0">
        <?php while ( have_rows( 'highlight_list' ) ) : the_row();
            $highlight_text = get_sub_field( 'highlight_text' );
            $icon = get_sub_field( 'icon');
            if(!empty($icon || $highlight_text)): ?> 
                <li class="highlights__item d-flex align-items-center m-0">
                    <?php if(!empty($icon)):?>
                        <i class="fa <?php echo esc_attr( $icon ); ?>"></i>
                    <?php endif;?>
                    <?php if(!empty($highlight_text)):?>
                        <p><?php echo $highlight_text; ?></p>
                    <?php endif;?>
                </li>
            <?php endif; ?>
        <?php endwhile; ?>
    </ul>
<?php endif; ?>