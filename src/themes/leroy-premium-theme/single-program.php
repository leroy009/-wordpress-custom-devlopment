<!-- This should have the same name as the post type I want to use here. -->
<?php
    get_header();

    function showEvents() {
        while(have_posts()) {
            the_post(); ?>
            <div class="page-banner">
                <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?> )"></div>
                <div class="page-banner__content container container--narrow">
                    <h1 class="page-banner__title"><?php the_title() ?></h1>
                    <div class="page-banner__intro">
                    <p>DO NOT FORGET TO REPLACE THE SUBTITLE LATER</p>
                    </div>
                </div>
            </div>

            <div class="container container--narrow page-section">
                <div class="metabox metabox--position-up metabox--with-home-link">
                        <p>
                            <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program') ?>"><i class="fa fa-home" aria-hidden="true">
                            </i> All Programs </a> <span class="metabox__main"><?php the_title() ?></span>
                        </p>
                    </div>
                <div class="genetic-content">
                    <?php the_content() ?>
                </div>

                <?php 
            
                $today = date('Y-m-d\TH:i');
                $homepage_events = new WP_Query(array(
                    'posts_per_page' => 2,
                    'post_type' => 'event',
                    'meta_key' => 'event_date',
                    'orderby' => 'meta_value',
                    'meta_query' => array(
                        array(
                            'key' => 'event_date',
                            'compare' => '>=',
                            'value' => $today,
                            'type' => 'DATETIME'
                        ), array(
                            'key' => 'related_program',
                            'compare' => 'LIKE',
                            'value' => '"' . get_the_ID() . '"'

                        )
                    ),
                    // custom meta fileds sorting
                    'order' => 'ASC'
                ));
                
                if ($homepage_events->have_posts()) {

                echo '<hr>';
                echo '<h2 class="headline headline--medium" style="margin-top: 20px;">Upcoming ' . get_the_title() . '</h2>';

                while($homepage_events->have_posts()) {
                    $homepage_events->the_post(); 
                    // $post_id = get_the_ID();

                    // ACF 
                    /*
                    $event_date = new DateTime(get_gield('event_date));
                    $event_month = $event_date->formart('M');
                    $event_day = $event_date->formart('d');
                    */

                    // Jet Engine.
                    $event_date = get_post_meta( get_the_ID(), 'event_date', true );
                    // echo 'Event date: ';
                    // var_dump($event_date); // Debug output

                    // Check if the event date is valid
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
                    // Jet Engine.


                    ?>
                    
                    <div class="event-summary" style="margin-bottom: 30px; ">
                        <a class="event-summary__date t-center" style="width: 100px;" href="<?php the_permalink(); ?>">
                            <span class="event-summary__month"><?php echo esc_html( $event_date_month ); ?></span>
                            <span class="event-summary__day"><?php echo esc_html( $event_date_day ); ?></span>
                            <span class="event-summary__month"><?php echo esc_html( $event_date_year ); ?></span>
                        </a>
                        <div class="event-summary__content">
                            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                            <p><?php if (has_excerpt()) {
                            echo get_the_excerpt();
                        } else {
                            echo wp_trim_words(get_the_content(), 18);
                        } 
                        // echo wp_trim_words(get_the_excerpt(), 20);
                        ?>  <a href="<a href="<?php the_permalink() ?>" class="nu gray">Learn more</a></p>
                            <!-- <p><?php echo wp_trim_words(get_the_excerpt(), 15) ?> <a href="<a href="<?php the_permalink() ?>" class="nu gray">Learn more</a></p> -->
                        </div>
                    </div>

                <?php wp_reset_postdata();
                }
            }
            ?>

            </div>

            <?php
        }
    }

    showEvents();
    get_footer();

?>

