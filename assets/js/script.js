$(document).ready(function(){
    
    var header_height = $('#header').height();
    
    /* parallax header */
	function parallax(){
	  var scrolled = $(window).scrollTop();
	  $('#header .backstretch img').css('top',''+-(scrolled*0.6)+'px');
      $('.heading').css('background-position', 'center '+-(scrolled*0.5)+'px');
	}

    /* backstretch slider */
    $('.header-slide').backstretch([
      "slide/bg01.jpg",
      "slide/bg02.jpg",
      "slide/bg03.jpg"
      ], {
        fade: 850,
        duration: 4000
    });

/* navbar */
	$(window).scroll(function(){
		parallax();
		if($(window).scrollTop() > header_height){
            //$('.navbar').css('border-bottom-color', '#3bafda');
		}else{
            //$('.navbar').css('border-bottom-color', '#fff');
		}
	});
	
	 /* nice scroll */
    $( 'html' ).niceScroll({
        cursorcolor: '#434a54',
        cursorwidth: '10px',
        cursorborder: '1px solid #434a54',
        cursoropacitymax: 0.9,                
        scrollspeed: 200,
        zindex: 1060
    });
    

});