<?php 
    get_header(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?> )"></div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title">All Events</h1>
                <div class="page-banner__intro">
                    <p>Check out the meet ups we have.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container container--narrow page-section">
        <?php
            while(have_posts()) {
                the_post(); 
                
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
                            <p><?php echo wp_trim_words(get_the_excerpt(), 15) ?> <a href="<a href="<?php the_permalink() ?>" class="nu gray">Learn more</a></p>
                        </div>
                    </div>
            <?php }
            echo paginate_links();
        ?>
    </div>

    <?php
    get_footer();
?>