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
                <input type="email" value="" name="EMAIL" class="required email input-xlarge" id="mce-EMAIL" placeholder="john.doe@email.com">
                <input type="text" value="" name="FNAME" class="required input-xlarge" id="mce-FNAME" placeholder="John">
                <input type="text" value="" name="LNAME" class="required input-xlarge" id="mce-LNAME" placeholder="Doe">
                <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button btn">
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

            <div class="col-lg-3 sup">
                <h3>Foster Information</h3>
                <h4>Example Title here</h4>
                <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur nec velit ac magna dignissim porta. In lacus leo, ornare non mollis ut, consequat eu orci. Praesent ut tincidunt urna.</p>
                <a href="" class="btn">Read More</a>
            </div>
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