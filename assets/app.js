/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import $ from "jquery";

// start the Stimulus application
import './bootstrap';
import bsCustomFileInput from 'bs-custom-file-input';
bsCustomFileInput.init();

// jquery for bootstrap active link in navbar

$(".nav .nav-link").on("click", function(){
    $(".nav").find(".active").removeClass("active");
    $(this).addClass("active");
 });

 console.log("init");