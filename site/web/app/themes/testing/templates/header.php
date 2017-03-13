<!-- <header class="banner">
  <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <nav class="nav-primary">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
  </div>
</header> -->
<!-- <?php
wp_nav_menu( array( 
    'theme_location' => 'quick_navigation', 
    'container_class' => 'dknav hidden-xs',
    'menu_class' => 'nav navbar-nav' ) ); 
?> -->
<div class="header">
  <div class="container-fluid">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <h3 class="clear"><a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><span class="logo"></span><span class="logoText">Lawrence Humane Society</span></a></h3>
      </div>

      <div class="dknav hidden-xs">
          <ul class="nav navbar-nav">
              <li>
                  <a href="/services/adoption/adopt/" role="button" aria-haspopup="true">Adopt</a>
              </li>
              <li>
                  <a href="/services/other-services/lost-found/" role="button" aria-haspopup="true">Lost & Found</a>
              </li>
              <li>
                  <a href="/get-involved/" role="button" aria-haspopup="true">Get Involved</a>
              </li>
              <li>
                  <div class="arrow-left"></div>
                  <a href="/donate/" role="button" aria-haspopup="true">Donate</a>
              </li>
              <li>
                  <div class="arrow-left"></div>
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      Menu
                  </a>
              </li>
          </ul>
          <div class="navoverlay">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-md-3 adopt">
                          <h2>Services</h2>
                          <ul class="">
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Adoption</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Pet Surrender</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Other Services</a>
                              </li>
                          </ul>
                      </div>
                      <div class="col-md-3 news">
                          <h2>News</h2>
                          <ul class="">
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Events Calendar</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Host an Event</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">News</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Blog</a>
                              </li>
                          </ul>
                      </div>
                      <div class="col-md-3 donate">
                          <h2>Donate</h2>
                          <ul class="">
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Loyal Friends Monthly Giving</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">One-Time Donation</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Honor and Memorial Donations</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Special Funds</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Donate a Vehicle</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Wishlist</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Other Ways to Give</a>
                              </li>
                          </ul>
                      </div>
                      <div class="col-md-3 about">
                          <h2>About Us</h2>
                          <ul class="">
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Our Story</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Our Team</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Our Financials</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Measuring our Progress</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Media Kit</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Employment Opportunities</a>
                              </li>
                              <li>
                                  <a href="#" role="button" aria-haspopup="true">Directory</a>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div id="navbar" class="mnav navbar-collapse collapse visible-xs">

          <ul class="nav navbar-nav visible-xs">
              <li class="adopt"><a href="adopt.html" role="button">Adopt</a>
                  <!-- <ul class="dropdown-menu">
                      <li>
                          <a href="about.html">Stuff</a>
                      </li>
                  </ul> -->
              </li>
              <li class="donate">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Donate</a><!-- <div class="arrowRight">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </div> -->
                  <ul class="dropdown-menu">
                      <li class="arrowRight">
                          <a class="return">
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="text">Main Menu</span>
                          </a>
                      </li>
                      <li>
                          <a href="about.html">Loyal Friends Monthly Giving</a>
                      </li>
                      <li>
                          <a href="about.html">One-time donation</a>
                      </li>
                      <li>
                          <a href="about.html">Honor and Memorial</a>
                      </li>
                      <li>
                          <a href="about.html">Donations</a>
                      </li>
                      <li>
                          <a href="about.html">Special Funds</a>
                      </li>
                      <li>
                          <a href="about.html">Donate a vehicle</a>
                      </li>
                      <li>
                          <a href="about.html">Wishlist</a>
                      </li>
                      <li>
                          <a href="about.html">Other ways to give</a>
                      </li>
                  </ul>
              </li>
              <li class="involved"><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Get Involved</a>
                  <ul class="dropdown-menu">
                      <li class="arrowRight">
                          <a class="return">
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="text">Main Menu</span>
                          </a>
                      </li>
                      <li>
                          <a href="about.html">Stuff</a>
                      </li>
                  </ul>
              </li>
              <li class="lostfound"><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Lost & Found</a>
                  <ul class="dropdown-menu">
                      <li>
                          <a href="about.html">Stuff</a>
                      </li>
                  </ul>
              </li>
              <li class="more"><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">More</a>
                  <ul class="dropdown-menu">
                      <li>
                          <a href="about.html">Stuff</a>
                      </li>
                  </ul>
              </li>
          </ul>
      </div>
  </div>
</div>