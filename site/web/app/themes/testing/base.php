<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    
    <?php if ( is_front_page() ) {   ?>
      <!-- Front Page Specific  -->
      <?php include Wrapper\template_path(); ?>
    <?php }else{ ?>
      <!-- Secondary Pages -->
      <!-- BreadCrumbs -->
      <div class="container-fluid breadcrumbs">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <?php Roots\Sage\Extras\custom_breadcrumbs(); ?>
                  </div>
              </div>
          </div>
      </div>

      <!-- Sub-Header -->
      <!-- Sub-Header class needs to be populated with featured image as background! -->
      <div class="container-fluid subHeader">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <?php if( tribe_is_month() && !is_tax() ) { // The Main Calendar Page ?>
                          <h1 class="home">Events</h1>
                      <?php } elseif( tribe_is_month() && is_tax() ) { // Calendar Category Pages ?>
                          <h1 class="home">Calendar Category: <?php echo tribe_meta_event_category_name(); ?></h1>
                      <?php } elseif( tribe_is_event() && !tribe_is_day() && !is_single() && !is_tax() ) { // The Main Events List ?>
                          <h1 class="home">Events List</h1>
                      <?php } elseif( tribe_is_event() && !tribe_is_day() && !is_single() && is_tax() ) { // Category Events List ?>
                          <h1 class="home">Events List: <?php echo tribe_meta_event_category_name(); ?></h1>
                      <?php } elseif( tribe_is_event() && is_single() ) { // Single Events ?>
                          <h1><?php the_title(); ?></h1>
                      <?php } elseif( tribe_is_day() ) { // Single Event Days ?>
                          <h1><?php $title = 'Events on: ' . date('F j, Y', strtotime(get_query_var( 'eventDate' ))); ?></h1>
                      <?php } elseif( tribe_is_venue() ) { // Single Venues ?>
                          <h1><?php the_title(); ?></h1>
                      <?php } elseif( is_category() ) { // Single Venues ?>
                          <h1><?php single_cat_title(); ?></h1>
                      <?php } else { ?>
                          <h1><?php the_title(); ?></h1>
                      <?php } ?>
                  </div>
              </div>
          </div>
      </div>
      <!-- Sub-Content -->
      <div class="container content">
          <div class="row">
            <?php if (Setup\display_sidebar()) : ?>
              <aside class="col-lg-3 sidebar">
                <ul class="list-unstyled">
                    <?php
                      wp_list_pages( array(
                          'title_li'    => '',
                          'child_of'    => $post->ID
                      ) );
                    ?>
                </ul>
                <?php include Wrapper\sidebar_path(); ?>
              </aside><!-- /.sidebar -->

                <div class="col-lg-9 block">
                  <?php include Wrapper\template_path(); ?>
                </div>

            <?php else : ?>
              <?php if(is_page(array( 48,62))): ?>
                <!-- Check for Angular-->
                <div class="col-lg-12" ng-view></div>
              <?php else: ?>
                <div class="col-lg-12 block">
                  <?php include Wrapper\template_path(); ?>
                </div>
              <?php endif; ?>
            <?php endif; ?>
          </div>
      </div>
    <?php } ?>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
