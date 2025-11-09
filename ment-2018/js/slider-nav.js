/**
 * Theme scripting
 *
 * @package Ment Law Group
 * @author Postali
 */

jQuery( function ( $ ) {
  "use strict";

 $("#menu-icon").bind("click", function(event) {
    var body = $("html");
    event.preventDefault();
    if (body.hasClass("nav-open")) {
      body.removeClass("nav-open");
    } else {
      event.stopPropagation();
      body.one("click", function() {
        body.removeClass("nav-open");
        $("#slide-nav").removeClass("active");
      }).addClass("nav-open");
    }
  });
  $("#slide-nav").bind("click", function() {
    event.stopPropagation();
  });
  $("#menu-icon").on("click", function() {
    $("#slide-nav").toggleClass("active");
    $("#menu-icon").toggleClass("active");
    event.preventDefault();
  });
  
});