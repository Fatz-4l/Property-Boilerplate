<?php
/*
Section: Investment Deal Cards
*/

// Query for investment deals post
$args = array(
    'post_type' => 'investment_deals',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC'
);

$investment_query = new WP_Query($args);
?>

<section class="cards">
    <div class="container mx-auto px-4 py-8">
        <?php if ($investment_query->have_posts()) : 
            while ($investment_query->have_posts()) : 
                $investment_query->the_post(); 
                
                // Get all ACF image fields
                $images = array();
                for ($i = 1; $i <= 8; $i++) {
                    $image = get_field('investment_deal_image_' . $i);
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

                            <?php if(get_field('investment_amount')): ?>
                                <span class="text-xl font-semibold mb-4">Investment Amount: £<?php echo get_field('investment_amount'); ?></span>
                            <?php endif; ?>

                            <div class="clamp-container">
                                <div class="line-clamp-6">
                                    <div class="max-w-[800px]">
                                        <?php echo get_field('investment_description'); ?>
                                    </div>
                                </div>
                                <span class="read-more-btn font-bold underline cursor-pointer inline-block mt-2">Read More</span>
                            </div>

                            <div class="flex gap-4 flex-wrap max-w-[800px] mt-6">
                            
                            <?php if(get_field('expected_roi')): ?>
                                <span>Potential Return: £<?php echo get_field('expected_roi'); ?></span>
                            <?php endif; ?>
                            
                            <?php if(get_field('property_type')): ?>
                                <span>Property Type: <?php echo get_field('property_type'); ?></span>
                            <?php endif; ?>
                            
                            <?php if(get_field('area')): ?>
                                <span>Location: <?php echo get_field('area'); ?></span>
                            <?php endif; ?>
                            
                            <?php if(get_field('occupancy_rate')): ?>
                                <span>Occupancy Rate: <?php echo get_field('occupancy_rate'); ?>%</span>
                            <?php endif; ?>
                            
                            <?php if(get_field('number_of_bedrooms')): ?>
                                <span>Number of Bedrooms: <?php echo get_field('number_of_bedrooms'); ?></span>
                            <?php endif; ?>
                            
                            <?php if(get_field('number_of_bathrooms')): ?>
                                <span>Number of Bathrooms: <?php echo get_field('number_of_bathrooms'); ?></span>
                            <?php endif; ?>
                            
                            <?php if(get_field('number_of_tenants')): ?>
                                <span>Number of Tenants: <?php echo get_field('number_of_tenants'); ?></span>
                            <?php endif; ?>
                            
                            <?php if(get_field('nightly_rate')): ?>
                                <span>Nightly Rate: £<?php echo get_field('nightly_rate'); ?></span>
                            <?php endif; ?>
                            </div>

                            <div class="flex justify-start items-end mt-6">
                                <a href="#" class="text-white px-4 py-2 inline-block bg-black whatsapp-btn">Enquire via WhatsApp</a>
                               
                            </div>
                        </div>
                    </div>
                <?php endif;
            endwhile; 
        endif; ?>
    </div>
</section>

