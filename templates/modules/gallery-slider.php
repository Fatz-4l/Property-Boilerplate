<?php
/**
 * Gallery Slider Module
 */

if (empty($images)) return;
?>

<div class="cards-slider-container mx-auto ">
    <div class="swiper main-swiper mb-4 relative select-none">
        <div class="cursor-pointer enlarge-btn absolute top-4 left-4 z-10 bg-black text-white p-2 rounded-md hover:bg-opacity-80 transition-all select-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
            </svg>
        </div>
        <?php if(get_field('property_type')): ?>
            <div class="absolute top-4 right-4 z-10 bg-black text-white p-2 rounded-md text-sm">
                <?php echo get_field('property_type'); ?>
            </div>
        <?php endif; ?>
        <div class="swiper-wrapper">
            <?php foreach($images as $image) : ?>
                <div class="swiper-slide aspect-[4/3]">
                    <img src="<?php echo esc_url($image['url']); ?>" 
                         alt="<?php echo esc_attr($image['alt']); ?>" 
                         class="w-full h-full object-cover">
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Navigation buttons -->
        <div class="swiper-button-next !text-white select-none"></div>
        <div class="swiper-button-prev !text-white select-none"></div>
    </div>

    <!-- Thumbnail Swiper -->
    <div class="swiper thumb-swiper">
        <div class="swiper-wrapper">
            <?php foreach($images as $image) : ?>
                <div class="swiper-slide aspect-[4/3] cursor-pointer">
                    <img src="<?php echo esc_url($image['url']); ?>" 
                         alt="<?php echo esc_attr($image['alt']); ?>" 
                         class="w-full h-full object-cover">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Fullscreen Popup -->
<div class="fullscreen-popup fixed inset-0 bg-black bg-opacity-90 z-50 hidden">
    <button class="close-popup absolute top-4 right-4 z-10 bg-white text-black px-4 py-2 rounded-md hover:bg-opacity-80 transition-all">
        Close
    </button>
    
    <div class="h-[100dvh] flex flex-col">
        <!-- Fullscreen Main Swiper Container -->
        <div class="flex-1 relative">
            <!-- Main Swiper -->
            <div class="swiper fullscreen-main-swiper h-full">
                <div class="swiper-wrapper h-full">
                    <?php foreach($images as $image) : ?>
                        <div class="swiper-slide h-full">
                            <div class="w-full h-full flex items-center justify-center">
                                <img src="<?php echo esc_url($image['url']); ?>" 
                                     alt="<?php echo esc_attr($image['alt']); ?>" 
                                     class="max-w-[85vw] max-h-[85vh] w-auto h-auto object-contain mx-auto">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Navigation Arrows -->
                <button class="swiper-button-prev !text-white absolute left-1 md:left-4 transform !top-[50%] z-10 hover:scale-110 transition-transform select-none"></button>
                <button class="swiper-button-next !text-white absolute right-1 md:right-4 transform !top-[50%] z-10 hover:scale-110 transition-transform select-none"></button>
            </div>
        </div>

        <!-- Fullscreen Thumbnail Swiper -->
        <div class="w-full px-4 md:px-32 py-4 md:py-8 bg-black bg-opacity-50">
            <div class="swiper fullscreen-thumb-swiper">
                <div class="swiper-wrapper">
                    <?php foreach($images as $image) : ?>
                        <div class="swiper-slide !w-16 !h-16 md:!w-24 md:!h-24 cursor-pointer">
                            <img src="<?php echo esc_url($image['url']); ?>" 
                                 alt="<?php echo esc_attr($image['alt']); ?>" 
                                 class="w-full h-full object-cover">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
