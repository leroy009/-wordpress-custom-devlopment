<?php 
    get_header(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?> )"></div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title">Past Events</h1>
                <div class="page-banner__intro">
                    <p>A recap of our past events.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container container--narrow page-section">
        <?php
            
            $today = date('Y-m-d\TH:i');
            $past_events = new WP_Query(array(
                'paged' => get_query_var('paged', 1),
                'posts_per_page' => 5,
                'post_type' => 'event',
                'meta_key' => 'event_date',
                'orderby' => 'meta_value',
                'meta_query' => array(
                    array(
                        'key' => 'event_date',
                        'compare' => '<',
                        'value' => $today,
                        'type' => 'DATETIME'
                    )
                ),
                'order' => 'ASC'
            ));

            while($past_events->have_posts()) {
                $past_events->the_post(); 
                
                $event_date = get_post_meta( get_the_ID(), 'event_date', true );

                if ( !empty( $event_date ) ) {
                    try {
                        // $date = new DateTime('@' .$event_date); // Time Stamp
                        $date = new DateTime($event_date);
                        $date->setTimezone(new DateTimeZone('Africa/Johannesburg'));
                        $event_date_month = $date->format('M'); 
                        $event_date_day = $date->format('d'); 
                        $event_date_year = $date->format('Y'); 
                    } catch (Exception $e) {
                        $event_date_month = '00';
                        $event_date_day = '00';
                        $event_date_year = '00';
                    }
                } else {
                    $event_date_month = '--';
                    $event_date_day = '--';
                    $event_date_year = '--';
                }
                ?>
                <div class="event-summary" style="margin-bottom: 30px;">
                        <a class="event-summary__date t-center" style="width: 100px;" href="<?php the_permalink(); ?>">
                            <span class="event-summary__month"><?php echo esc_html( $event_date_month ); ?></span>
                            <span class="event-summary__day"><?php echo esc_html( $event_date_day ); ?></span>
                            <span class="event-summary__month"><?php echo esc_html( $event_date_year ); ?></span>
                        </a>
                        <div class="event-summary__content">
                            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 15) ?> <a href="<a href=<?php the_permalink() ?>" class="nu gray">Learn more</a></p>
                        </div>
                    </div>
            <?php }
            echo paginate_links(array(
                'total' => $past_events->max_num_pages
            ));
        ?>
    </div>

    <?php
    get_footer();
?>