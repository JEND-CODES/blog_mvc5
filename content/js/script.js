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
    
    //To hide chapter part 2
    $( "#chapter-part2" ).hide();
    $( "#chapter-part3" ).hide();
    
   
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

// Réglage de l'affichage de la première partie du chapitre

$( "#bookmark1" ).click(function() {
    
    $( "#chapter-part1" ).show();
    // Show chapter part 1
 
    $( "#chapter-part2" ).hide();
    // hide chapter part 2
 
    $( "#chapter-part3" ).hide();
    // hide chapter part 3
  
});

// Réglage de l'affichage de la deuxième partie du chapitre

$( "#bookmark2" ).click(function() {
    
    $( "#chapter-part2" ).show();
    // Show chapter part 2
 
    $( "#chapter-part1" ).hide();
    // hide chapter part 1
  
    $( "#chapter-part3" ).hide();
    // hide chapter part 3

});

// Réglage de l'affichage de la troisième partie du chapitre

$( "#bookmark3" ).click(function() {
    
    $( "#chapter-part3" ).show();
    // Show chapter part 3
 
    $( "#chapter-part1" ).hide();
    // hide chapter part 1
 
    $( "#chapter-part2" ).hide();
    // hide chapter part 2

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

// jQuery Method to replace Strings
// Cf. demo 1 : http://jsfiddle.net/ZSXb6/

// Cf. demo 2 : https://stackoverflow.com/questions/10689784/replace-remove-everything-between-two-characters

// 1. Remplacement de toutes les balises "<span style" avec la méthode .replace(/MOT1.*MOT2/, 'REMPLACEMENT')

// 2. Remplacement de toutes les balises "<a href"

// 3. Remplacement de toutes les balises "<img src"

// Explication -> Du MOT1 jusqu'à la fin du MOT2 tous les caractères sont remplacés par REMPLACEMENT (nouveau mot ou rien ' ', si on veut !)
/*
$('.element').each(function() {
    
    var text = $(this).text().replace(/<span style.*;">/, 'REMPLACEMENT SPAN STYLE ').replace(/<a href=.*">/, 'REMPLACEMENT A HREF ').replace(/<img src=.*>/, 'REMPLACEMENT IMG SRC ');
    $(this).text(text);
});
*/

// Ajout du Regex /g (to replace all occurrences of a word) :

// Problème de reconnaissance de caractères sépciaux ?voir cours sur le REGEX ! https://openclassrooms.com/fr/courses/146276-tout-sur-le-javascript/145569-lobjet-regexp

$('.element').each(function() {
    /*
    var text = $(this).text().replace(/<span style.*;">/g, 'REMPLACEMENT SPAN STYLE PARTOUT ').replace(/<img style=.*>/g, 'REMPLACEMENT IMG STYLE PARTOUT ').replace(/<img src=.*>/g, 'REMPLACEMENT IMG SRC PARTOUT ').replace(/<a href=.*>/g, 'REMPLACEMENT A HREF PARTOUT ');
    */
    var text = $(this).text().replace(/\<span style=.*\;">/g, 'REMPLACEMENT SPAN STYLE PARTOUT ').replace(/src.*\/>/g, 'REMPLACEMENT IMG PARTOUT').replace(/<a href.*"\>/g, 'REMPLACEMENT A HREF PARTOUT');
    $(this).text(text);
    
});


