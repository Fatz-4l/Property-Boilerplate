import Swiper from 'swiper';
import { Navigation, Thumbs } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';

export default class GallerySlider {
    constructor() {
        // Get all slider containers
        const sliderContainers = document.querySelectorAll('.cards-slider-container');
        
        if (!sliderContainers.length) return;
        
        // Initialize each slider container
        sliderContainers.forEach((container, index) => {
            this.initializeSlider(container, index);
        });
    }

    initializeSlider(container, index) {
        // Get elements for this specific slider instance
        const mainSlider = container.querySelector('.main-swiper');
        const thumbSlider = container.querySelector('.thumb-swiper');
        const fullscreenPopup = container.nextElementSibling; // The popup is the next sibling
        const enlargeBtn = container.querySelector('.enlarge-btn');
        const closeBtn = fullscreenPopup.querySelector('.close-popup');
        const fullscreenMainSlider = fullscreenPopup.querySelector('.fullscreen-main-swiper');
        const fullscreenThumbSlider = fullscreenPopup.querySelector('.fullscreen-thumb-swiper');

        if (!mainSlider || !thumbSlider) return;

        // Initialize thumbnail swiper
        const thumbsSwiper = new Swiper(thumbSlider, {
            modules: [Navigation],
            spaceBetween: 8,
            slidesPerView: 4,
            watchSlidesProgress: true,
            breakpoints: {
                320: {
                    slidesPerView: 3,
                },
                480: {
                    slidesPerView: 4,
                }
            }
        });

        // Initialize main swiper
        const mainSwiper = new Swiper(mainSlider, {
            modules: [Navigation, Thumbs],
            spaceBetween: 0,
            navigation: {
                nextEl: mainSlider.querySelector('.swiper-button-next'),
                prevEl: mainSlider.querySelector('.swiper-button-prev'),
            },
            thumbs: {
                swiper: thumbsSwiper,
            },
        });

        // Initialize fullscreen thumbnail swiper
        const fullscreenThumbsSwiper = new Swiper(fullscreenThumbSlider, {
            modules: [Navigation],
            spaceBetween: 8,
            slidesPerView: 'auto',
            centerInsufficientSlides: true,
            watchSlidesProgress: true,
            slideToClickedSlide: true,
            breakpoints: {
                320: {
                    spaceBetween: 6,
                },
                768: {
                    spaceBetween: 16,
                }
            }
        });

        // Initialize fullscreen main swiper
        const fullscreenMainSwiper = new Swiper(fullscreenMainSlider, {
            modules: [Navigation, Thumbs],
            slidesPerView: 1,
            speed: 400,
            spaceBetween: 0,
            allowTouchMove: true,
            thumbs: {
                swiper: fullscreenThumbsSwiper,
            }
        });

        // Custom navigation handling
        const nextBtn = fullscreenPopup.querySelector('.swiper-button-next');
        const prevBtn = fullscreenPopup.querySelector('.swiper-button-prev');
        
        nextBtn.addEventListener('click', () => {
            if (fullscreenMainSwiper.isEnd) {
                fullscreenMainSwiper.slideTo(0);
            } else {
                fullscreenMainSwiper.slideNext();
            }
        });
        
        prevBtn.addEventListener('click', () => {
            if (fullscreenMainSwiper.isBeginning) {
                fullscreenMainSwiper.slideTo(fullscreenMainSwiper.slides.length - 1);
            } else {
                fullscreenMainSwiper.slidePrev();
            }
        });

        // Bind events for this slider instance
        this.bindEvents(enlargeBtn, closeBtn, fullscreenPopup, mainSwiper, fullscreenMainSwiper, fullscreenThumbsSwiper);

        // Handle orientation change for this instance
        window.addEventListener('resize', () => {
            if (fullscreenPopup && !fullscreenPopup.classList.contains('hidden')) {
                fullscreenMainSwiper.update();
                fullscreenThumbsSwiper.update();
            }
        });

        // Keyboard navigation for this instance
        document.addEventListener('keydown', (e) => {
            if (!fullscreenPopup.classList.contains('hidden')) {
                if (e.key === 'ArrowRight') {
                    nextBtn.click();
                } else if (e.key === 'ArrowLeft') {
                    prevBtn.click();
                }
            }
        });
    }

    bindEvents(enlargeBtn, closeBtn, fullscreenPopup, mainSwiper, fullscreenMainSwiper, fullscreenThumbsSwiper) {
        enlargeBtn.addEventListener('click', () => {
            // Sync the fullscreen slider with the current slide
            fullscreenMainSwiper.slideTo(mainSwiper.activeIndex, 0);
            fullscreenPopup.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scrolling

            // Update Swiper instances after becoming visible
            fullscreenMainSwiper.update();
            fullscreenThumbsSwiper.update();
        });

        closeBtn.addEventListener('click', () => {
            fullscreenPopup.classList.add('hidden');
            document.body.style.overflow = ''; // Restore scrolling
        });

        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !fullscreenPopup.classList.contains('hidden')) {
                closeBtn.click();
            }
        });
    }
}

// Initialize the gallery slider if the module is present on the page
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.cards-slider-container')) {
        new GallerySlider();
    }
}); 