<?php get_header();

    function showPosts() {
        while(have_posts()) {
            the_post(); ?>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_content(); ?>
            <hr>
            <?php
        }
    }

?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg') ?>)"></div>
        <div class="page-banner__content container t-center c-white">
            <h1 class="headline headline--large">Welcome!</h1>
            <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
            <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
            <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
        </div>
    </div>

    <div class="full-width-split group">
        <div class="full-width-split__one">
            <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>

            <?php 
                $homepage_events = new WP_Query(array(
                    'posts_per_page' => 3,
                    'post_type' => 'event',
                    // 'orderby' => 'post_date',
                    // custom meta fileds sorting
                    'meta_key' => 'event_date',
                    // 'orderby' => 'meta_value_num', // When I have this. Order ASC or DESC no longer works
                    'orderby' => 'meta_value',
                    'meta_query' => array(
                        array(
                            'key' => 'event_date',
                            'compare' => '>=',
                            'value' => $today,
                            'type' => 'DATETIME'
                        )
                    ),
                    // custom meta fileds sorting
                    'order' => 'DESC'
                ));
            
            // This works too
            // $today = date('Y-m-d\TH:i');

            // $homepage_events = new WP_Query(array(
            //     'posts_per_page' => 3,
            //     'post_type' => 'event',
            //     'meta_key' => 'event_date',
            //     'orderby' => 'meta_value',
            //     'order' => 'ASC',
            //     'meta_query' => array(
            //         array(
            //             'key' => 'event_date',
            //             'compare' => '>=',
            //             'value' => $today,
            //             'type' => 'DATETIME'
            //         )
            //     )
            // ));

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
                        } catch (Exception $e) {
                            $event_date_month = '00';
                            $event_date_day = '00';
                        }
                    } else {
                        $event_date_month = '--';
                            $event_date_day = '--';
                    }
                    // Jet Engine.
                    ?>

                    <div class="event-summary">
                        <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
                            <span class="event-summary__month"><?php echo esc_html( $event_date_month ); ?></span>
                            <span class="event-summary__day"><?php echo esc_html( $event_date_day ); ?></span>
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

                <?php }
            ?>

            <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event') ?>" class="btn btn--blue">View All Events</a></p>
        </div>
        </div>
        <div class="full-width-split__two">
            <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>

            <?php 
                $homepaga_posts = new WP_Query(array(
                    'posts_per_page' => 2,

                ));

                while ($homepaga_posts -> have_posts()) {
                    $homepaga_posts->the_post(); ?>
                    <div class="event-summary">
                        <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
                        <span class="event-summary__month"><?php the_time('M'); ?></span>
                        <span class="event-summary__day"><?php the_time('d'); ?></span>
                        </a>
                        <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <p><?php if (has_excerpt()) {
                            echo get_the_excerpt();
                        } else {
                            echo wp_trim_words(get_the_content(), 18);
                        } 
                        // echo wp_trim_words(get_the_excerpt(), 20);
                        ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
                        </div>
                    </div>
                <?php } wp_reset_postdata();
            ?>

            <p class="t-center no-margin"><a href="<?php echo site_url('/blog'); ?>" class="btn btn--yellow">View All Blog Posts</a></p>
            </div>
        </div>
    </div>

    <div class="hero-slider">
        <div data-glide-el="track" class="glide__track">
            <div class="glide__slides">
            <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bus.jpg')?>">
                <div class="hero-slider__interior container">
                <div class="hero-slider__overlay">
                    <h2 class="headline headline--medium t-center">Free Transportation</h2>
                    <p class="t-center">All students have free unlimited bus fare.</p>
                    <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                </div>
                </div>
            </div>
            <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/apples.jpg')?>">
                <div class="hero-slider__interior container">
                <div class="hero-slider__overlay">
                    <h2 class="headline headline--medium t-center">An Apple a Day</h2>
                    <p class="t-center">Our dentistry program recommends eating apples.</p>
                    <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                </div>
                </div>
            </div>
            <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bread.jpg')?>">
                <div class="hero-slider__interior container">
                <div class="hero-slider__overlay">
                    <h2 class="headline headline--medium t-center">Free Food</h2>
                    <p class="t-center">Leroy University offers lunch plans for those in need.</p>
                    <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                </div>
                </div>
            </div>
            </div>
            <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
        </div>
    </div>
<?php
    get_footer();

?>

