// JavaScript Document

jQuery( function ( $ ) {
  "use strict";


 $('.slider-nav').slick({
   slidesToShow: 4,
   slidesToScroll: 1,
   asNavFor: '.slider-for',
   dots: false,
   focusOnSelect: true,
   autoplay: true
 });
  });