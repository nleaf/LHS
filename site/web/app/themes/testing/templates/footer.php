<!-- <footer class="content-info">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>
</footer>
 -->

 <!-- Separator -->
<div class="container-fluid">
    <section class="row separator">
        <div class="col-lg-12">
            <div class="bar purple reverse"></div>
        </div>
    </section>
</div>

<footer>
    <div class="container">
        <section class="row">
            
            <div class="col-lg-3 newsletter">
                <h3>Newsletter</h3>
                <form action="//lawrencehumane.us5.list-manage.com/subscribe/post?u=24a6801d143fad0512187ac19&amp;id=8a9effcc37" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="john.doe@email.com">
                <input type="text" value="" name="FNAME" class="required input-xlarge" id="mce-FNAME" placeholder="John">
                <input type="text" value="" name="LNAME" class="required input-xlarge" id="mce-LNAME" placeholder="Doe">
                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_24a6801d143fad0512187ac19_8a9effcc37" tabindex="-1" value=""></div>
                <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button btn">
                </form>
            </div>
            <?php
				$args = array( 'numberposts' => '1', 'category' => 3 );
				$recent_posts = wp_get_recent_posts( $args );
				foreach( $recent_posts as $recent ){
					echo '<div class="col-lg-3 sup">
			                <h3>Recent blog articles</h3>
			                <h4>'.$recent["post_title"].'</h4>
			                <p>'.get_the_excerpt($recent["ID"]).'</p>
			                <a href="'.get_permalink($recent["ID"]).'" class="btn">Read More</a>
			            </div>';
				}
				wp_reset_query();
			?>
			<?php
				$args = array( 'numberposts' => '1', 'category' => 2 );
				$recent_posts = wp_get_recent_posts( $args );
				foreach( $recent_posts as $recent ){
					echo '<div class="col-lg-3 sup">
			                <h3>Press Release</h3>
			                <h4>'.$recent["post_title"].'</h4>
			                <p>'.get_the_excerpt($recent["ID"]).'</p>
			                <a href="'.get_permalink($recent["ID"]).'" class="btn">Read More</a>
			            </div>';
				}
				wp_reset_query();
			?>
            <?php
                $page_name = get_page_by_title( 'Foster' );
                $page_title = get_page_by_title( 'Foster' )->post_title;
                $page_excerpt = get_page_by_title( 'Foster' )->post_excerpt;
                $page_content = get_page_by_title( 'Foster' )->post_content;

                echo '<div class="col-lg-3 sup">
                        <h3>Foster Information</h3>
                        <p>'.$page_excerpt.'</p>
                        <a href="'.get_permalink($page_name).'" class="btn">Read More</a>
                    </div>';
                wp_reset_query();
            ?>
        </section>
    </div>
    <div class="container-fluid">
        <div class="container">
            <section class="row">
                <div class="col-lg-12 ">
                    <span>2017 Lawrence Humane Society, Inc.</span> <span>1805 E. 19th Street • Lawrence, KS 66046</span> <span>785-843-6835</span><span>Fax: 785-843-6554</span>     <span><a href="/about-us/contact-us/">CONTACT</a></span>     <span>a 501(c) 3 organization</span>
                </div>
            </section>
        </div>
    </div>
</footer>