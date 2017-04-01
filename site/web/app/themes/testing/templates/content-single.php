<?php while (have_posts()) : the_post(); ?>
  <div class="col-md-9">
  <article <?php post_class(); ?>>
    <!-- <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header> -->
    <?php if ( has_post_thumbnail() ) : ?>
      <img src="<?php the_post_thumbnail_url() ?>" class="img-responsive">
    <?php endif; ?>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php //comments_template('/templates/comments.php'); ?>
  </article>

  <h3 class="recent">Recent Posts</h3>
    <ul class="list-inline recent">
    <?php
        $args = array( 'numberposts' => '3' );
        $recent_posts = wp_get_recent_posts( $args );
        $image_url = get_the_post_thumbnail();
        foreach( $recent_posts as $recent ){
            printf( '
              <li class="col-md-4">
                <img src="'.get_the_post_thumbnail_url($recent["ID"], 'recent-post').'" class="img-responsive">
                <a href="%1$s">'.$recent["post_title"].'</a>
              </li>
              ',
              esc_url( get_permalink( $recent['ID'] ) ),
              apply_filters( 'the_title', $recent['post_title'], $recent['ID'] )
            );
        }
    ?>
    </ul>
  </div>
<?php endwhile; ?>


