<?php
/*
Section: Investment Deal Cards
*/

// Query for investment deals post
$args = array(
    'post_type' => 'booking_properties',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC'
);

$booking_properties_query = new WP_Query($args);
?>

<section class="cards">
    <div class="container mx-auto px-4 py-8">
        <?php if ($booking_properties_query->have_posts()) : 
            while ($booking_properties_query->have_posts()) : 
                $booking_properties_query->the_post(); 
                
                // Get all ACF image fields
                $images = array();
                for ($i = 1; $i <= 8; $i++) {
                    $image = get_field('booking_property_image_' . $i);
                    if ($image) {
                        $images[] = $image;
                    }
                }
                
                if (!empty($images)) : ?>
                    <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-20 gap-4 mb-10 deal-cards">
                        
                        <!-- Left Column - Gallery Slider -->
                        <div class="w-full">
                            <?php include(get_template_directory() . '/templates/modules/gallery-slider.php'); ?>
                        </div>

                        <!-- Right Column - Post Title and Content -->
                        <div class="w-full h-full flex flex-col justify-center">
                            <h3 class="text-3xl font-semibold mb-4 deal-title"><?php the_title(); ?></h3>
                            <?php if(get_field('cost_per_night')): ?>
                                <span class="text-xl font-semibold mb-4">Per Night: £<?php echo get_field('cost_per_night'); ?></span>
                            <?php endif; ?>

                            <div class="clamp-container">
                                <div class="line-clamp-6">
                                    <div class="max-w-[800px]">
                                        <?php echo get_field('property_description'); ?>
                                    </div>
                                </div>
                                <span class="read-more-btn font-bold underline cursor-pointer inline-block mt-2 ">Read More</span>
                            </div>

                            <div class="flex gap-4 flex-wrap max-w-[800px] mt-6">
                                
                                <?php if(get_field('property_bedrooms')): ?>
                                    <span>Bedrooms: <?php echo get_field('property_bedrooms'); ?></span>
                                <?php endif; ?>
                                
                                <?php if(get_field('property_bathrooms')): ?>
                                    <span>Bathrooms: <?php echo get_field('property_bathrooms'); ?></span>
                                <?php endif; ?>

                                <?php if(get_field('property_location')): ?>
                                    <span>Location: <?php echo get_field('property_location'); ?></span>
                                <?php endif; ?>
                                
                                <?php if(get_field('guest_capacity')): ?>
                                    <span>Guest Capacity: <?php echo get_field('guest_capacity'); ?></span>
                                <?php endif; ?>
                                
                                <?php if(get_field('check_in_time')): ?>
                                    <span>Check-in: <?php echo get_field('check_in_time'); ?></span>
                                <?php endif; ?>
                                
                                <?php if(get_field('check_out_time')): ?>
                                    <span>Check-out: <?php echo get_field('check_out_time'); ?></span>
                                <?php endif; ?>
                            </div>
                        
                            <div class="flex justify-start items-end mt-6">
                                <a href="#" class="text-white px-4 py-2 inline-block bg-black">Book on Airbnb</a>
                               
                            </div>
                        </div>
                    </div>
                <?php endif;
            endwhile; 
        endif; ?>
    </div>
</section>

