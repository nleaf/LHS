/* jshint ignore:start */
/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        var is_mobile = true;

        if( $('#navbar').css('height')=='0px') {
            is_mobile = false;       
        }
        if(!is_mobile){
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
              if($('.sidebar').length){
                console.log('here');
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
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page

        $.getJSON( "../ngservice/example/topFive.php", function( data ) {
          var items = [];
          $.each( data[0], function( key, val ) {
            items.push( "<div class='col-lg-6'><div><a href='/services/adoption/adopt/#/details/"+val.id+"' title='Learn More about "+val.name+"'><img src='"+val.image+"' class='img-responsive'></div></div>" );
          });
         
          $( "<div/>", {
            "class": "row",
            html: items.join( "" )
          }).appendTo( ".qAnimals .contain" );
        });

      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
