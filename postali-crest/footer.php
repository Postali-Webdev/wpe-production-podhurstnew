<?php
/**
 * Theme footer
 *
 * @package Postali Parent
 * @author Postali LLC
 */
?>
<footer>
    <section class="footer">

        <div class="columns">

            <!-- <div class="column-33"> -->
            <div class="column-full">
                <div class="col-footer col0">
                    <?php the_custom_logo(); ?>
                    <p><?php echo get_field('footer_copy', 'options'); ?></p>
                    <a href="tel:<?php echo get_field('phone_number', 'options'); ?>" class="btn phone"><span><?php echo get_field('phone_number', 'options'); ?></span></a>
                    <div class="mobile-ruler"></div>
                </div>
            <!-- </div>
            
            <div class="column-66"> -->
                <div class="col-footer col1">
                    <p class="footer-title">Contact</p>
                    <p><strong>Phone:</strong> <a href="tel:<?php echo get_field('phone_number', 'options'); ?>"><?php echo get_field('phone_number', 'options'); ?></a></p>
                    <p><strong>Email:</strong> <a href="mailto:<?php echo get_field('email_address', 'options'); ?>"><?php echo get_field('email_address', 'options'); ?></a></p>
                    <p><strong>Fax:</strong> <?php echo get_field('fax_number', 'options'); ?></p>
                </div>
                <div class="col-footer col2">
                    <p class="footer-title">Our Office</p>
                    <iframe src="<?php echo get_field('map_embed_url', 'options'); ?>" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <p><?php echo get_field('address', 'options'); ?></p>
                    <a href="<?php echo get_field('map_directions_link', 'options'); ?>">Directions</a>
                </div>
                <div class="col-footer col3">
                    <p class="footer-title">Quick Links</p>
                    <?php
                        $args = array(
                            'container' => false,
                            'theme_location' => 'footer-nav'
                        );
                        wp_nav_menu( $args );
                    ?>	
                </div>
                <div class="col-footer col4">
                    <p class="footer-title">Practice Areas</p>
                    <?php
                        $args = array(
                            'container' => false,
                            'theme_location' => 'practice-areas-nav'
                        );
                        wp_nav_menu( $args );
                    ?>	
                </div>
            </div>

        </div>
    </section>
    <div class="copyright">
        <?php echo get_field('footer_copyright', 'options'); ?>
    </div>
</footer>

<?php wp_footer(); ?>

<!-- callrail tracking code -->
<script type="text/javascript" src="//cdn.callrail.com/companies/876919637/34944a6f1cbe00606c23/12/swap.js"></script> 

<!-- clarity script -->
<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "ukiue250lc");
</script>

</body>
</html>