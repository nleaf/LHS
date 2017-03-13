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
                      <h1><?php the_title(); ?></h1>
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
            <?php endif; ?>
            <div class="col-lg-9 block">
              <?php include Wrapper\template_path(); ?>
            </div>
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
