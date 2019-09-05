$(document).ready(function () {
    //Materialize animations
    $('.sidenav').sidenav();
    $('.carousel').carousel();
    $('.slider').slider();
    $('.fixed-action-btn').floatingActionButton();
    $('.dropdown-trigger').dropdown();
    $('.scrollspy').scrollSpy();
    $('.parallax').parallax();
    $('.tabs').tabs();

    //Biography title Random color
    $("#random-color").css("color", "hsla(" + Math.floor(Math.random() * (360)) + ", 75%, 58%, 1)");
    
    //To hide comments on chapters
    $( "#ghost2" ).hide();
    $( "#ghost3" ).hide();
   
});

$( "#ghost" ).click(function() {
  $( "#ghost2" ).slideToggle( "slow", function() {
    // Show max 5 comments
  });
    $( "#ghost1" ).toggle( "slow", function() {
    // Show All comments
  });
    $( "#ghost3" ).toggle(function() {
    // Change message button
  });
    $( "#ghost4" ).toggle(function() {
    // Change message button
  });
});

$(window).scroll(function() {
    if ($(this).scrollTop() >= 700) {        
        // If page is scrolled more than 150px
        $('#return-to-top').fadeIn(200);    
        // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   
        // Else fade out the arrow
    }
});

$('#return-to-top').click(function() {      
    // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       
        // Scroll to top of body
    }, 500);
});
 

