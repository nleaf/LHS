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
      <div class="container-fluid breadcrumbs hidden-xs">
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
      <div class="container-fluid subHeader hidden-xs">
          <div class="colorBar"></div>
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
                    $parentId = wp_get_post_parent_id( $post->ID );
                    if( $parentId == '160' || is_page(160) ) { ?>
                      <li>
                          <a href="https://lhs.z2systems.com/np/clients/lhs/donation.jsp?campaign=143&" role="button" aria-haspopup="true" target="_new">Loyal Friends Monthly Giving</a>
                      </li>
                      <li>
                          <a href="https://lhs.z2systems.com/np/clients/lhs/donation.jsp?campaign=157&" role="button" aria-haspopup="true" target="_new">One-Time Donation</a>
                      </li>
                      <li>
                          <a href="https://lhs.z2systems.com/np/clients/lhs/donation.jsp?campaign=137&" role="button" aria-haspopup="true" target="_new">Honor and Memorial Donations</a>
                      </li>
                  <?php } ?>
                    <?php
                      $children = get_pages( array( 'child_of' => $post->ID ) );
                      if( count( $children ) == 0 ) {
                          wp_list_pages( array(
                          'title_li'    => '',
                          'child_of'    => $post->post_parent
                          ) );
                      }else{
                          wp_list_pages( array(
                          'title_li'    => '',
                          'child_of'    => $post->ID
                          ) );
                      };
                    ?>
                </ul>
                <?php Roots\Sage\Extras\wpb_list_child_pages(); ?>
                <?php include Wrapper\sidebar_path(); ?>
              </aside><!-- /.sidebar -->

              <?php if(is_page(array( 62))): ?>
                <div class="col-lg-9 block" ng-view>
                  <?php include Wrapper\template_path(); ?>
                </div>
              <?php else: ?>
                <div class="col-lg-9 block">
                  <?php include Wrapper\template_path(); ?>
                </div>
              <?php endif; ?>

            <?php else : ?>
              <?php if(is_page(array( 48))): ?>
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
