<?php
/*
Template Name: Default Page Template
*/
?>

<?php get_header();?>

<main id="primary-page-template">
    <div class="container">

        <div class="flex flex-col gap-4 items-center justify-center max-w-[800px] mx-auto text-center mb-10">
            <h1 class="text-4xl font-bold">Property Website Configurations </h1>
            <p class="mb-0">These showcase unstyled pages that are used to showcase investment deals and property booking and the different ways they can be configured all configuations are self managable and very easy to edit.</p>
        </div>

        <div class="bg-black/20 max-w-[80%] w-full mx-auto h-[1px] mb-10"></div>

        <div class="flex flex-col gap-4 items-center justify-center max-w-[800px] mx-auto text-center mb-10">
            <h1 class="text-4xl font-bold">Single Page Investment Deals</h1>
            <p class="mb-0">This is a single page that shows all investment deals on one page a user can see photos and info and get in touch via whatsapp or form submssion which will be unique to each investment deal 
                e.g <br> <span class="font-bold">Hi am interested in the [investment deal 1]</span>.</p>
            <a href="/investment-deals/" class="bg-black text-white px-4 py-2 inline-block">View Single Page Investment Deals</a>
        </div>

        <div class="bg-black/20 max-w-[80%] w-full mx-auto h-[1px] mb-10"></div>

        <div class="flex flex-col gap-4 items-center justify-center max-w-[800px] mx-auto text-center mb-10">
            <h1 class="text-4xl font-bold">Single Page Property Booking</h1>
            <p class="mb-0">This is a single page shows all properties that can be booked on one page bookings are made extenally on  airbnb or booking.com or any other booking platform of choice.</p>
            <a href="/booking-properties/" class="bg-black text-white px-4 py-2 inline-block">View Single Page Property Booking</a>
        </div>
        
     
    </div>
</main>

<?php get_footer();?>
