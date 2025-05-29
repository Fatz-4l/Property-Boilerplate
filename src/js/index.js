console.log(`Vanilla Wordpress Theme by DNA © ${new Date().getFullYear()}`);

//Import CSS
import "../css/tailwind.css";


//Import JS
import "./base-template.js";
import MobileToggle from "./mobile-toggle.js";
import GallerySlider from "./gallery-slider.js";
import './whatsapp-button.js';
import TextClamp from './text-clamp.js';


// Initialize Scripts
document.addEventListener('DOMContentLoaded', () => {
    new MobileToggle();
    new GallerySlider();
    new TextClamp();
});


