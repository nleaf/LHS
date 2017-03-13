/* jshint ignore:start */

var is_mobile = true;

if( $('#navbar').css('height')=='0px') {
    is_mobile = false;       
}
if(!is_mobile){
	console.log('Not Mobile');

	$('.dknav .dropdown-toggle').click(function() {
		current = $(this);
		$('.navoverlay').toggleClass('open');
		$('.dknav .navbar-toggle').toggleClass('collapsed');
		if ($('.dknav .navbar-toggle').hasClass('collapsed')){
			current.text('menu');
		}else{
			current.text('exit');
		}
	});
}

$(window).scroll(function() {
	if(!is_mobile){
		if ($(this).scrollTop() > 45){  
	    	$('.header').addClass("sticky");
	    	//$('body>.container-fluid').addClass("extra");
	  	}else{
	    	$('.header').removeClass("sticky");
	    	//$('body>.container-fluid').removeClass("extra");
	  	}
	  	if($('.sidebar')){
		  	var stucker = $('.sidebar').offset().top - 220;
		  	var stuckerWidth = $('.sidebar').outerWidth();
		  	var bodyOffset = $('.content').offset().top - 10;

		  	if ($(this).scrollTop() > stucker){
		    	$('.sidebar').addClass('stuck');
		    	$('.block').css('margin-left', stuckerWidth);
		    	console.log('Stuck');
		  	}
		  	
		  	if ($(this).scrollTop() < bodyOffset){  
		  		$('.sidebar').removeClass('stuck');
		  		$('.block').css('margin-left', 0);
		  		console.log('UNStuck');
		  	}
	  	}
  	}
});


if(is_mobile){
	var windowHeight = $( window ).height();
	var windowWidth = $( window ).width();
	var navBarHeaderHeight = $('.navbar-header').height();
	var totalMainLinks = $('#navbar.mnav .navbar-nav > li > a').size();

	var linkHeightCalc = (windowHeight - navBarHeaderHeight) / totalMainLinks;
	var lastLinkHeight = linkHeightCalc / 2;
	var linkHeight = (windowHeight - navBarHeaderHeight - lastLinkHeight) / (totalMainLinks - 1)

	$('.mnav .navbar-nav > li > a').css({
		"height": linkHeight,
		"line-height": linkHeight + 'px'
	});
	$('.mnav .navbar-nav li:last-child a').css({
		"height": lastLinkHeight,
		"line-height": lastLinkHeight + 'px'
	});
	$('#navbar.mnav .dropdown-menu').css({
			"left": windowWidth
		});
	$('.mnav .navbar-nav > li > a').click(function() {
		$( "#navbar.mnav" ).animate({
		    left: -(windowWidth)
		  });
	});

	$('.navbar-header button').click(function() {
		if($(this).hasClass('collapsed')){
			var delay = 0;
			$('.mnav .navbar-nav > li').each(function() {
			    var $li = $(this);
			    setTimeout(function() {
			      $li.toggleClass('show');
			    }, delay+=50); // delay 100 ms
		  	});
		}else{
			console.log('reset');
			var delay = 0;
			$($('.mnav .navbar-nav > li').get().reverse()).each(function() {
			    var $li = $(this);
			    setTimeout(function() {
			      $li.toggleClass('show');
			    }, delay+=50); // delay 100 ms
		  	});
			$('#navbar.mnav').css({
				left: ""
			});
		}
	});

	$('.return').click(function(e) {
		e.stopPropagation();	
		$( "#navbar.mnav" ).animate({
		    left: "+=" + windowWidth
		  }, {
		    duration: 500,
		    complete: function() {
		      $('.mnav .navbar-nav li.open').removeClass('open');
		    }
		});
	});
}