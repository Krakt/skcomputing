            <!-- start footer -->
            <footer>
                <div class="skc-container">
                    <nav class="skc-nav skc-nav-footer">
                        <?php $args = array('theme_location' => 'footer'); ?>
                        <?php wp_nav_menu($args); ?>
                    </nav>
                    <div class="skc-copyright-footer-box text-center">
                        <div class="skc-social-footer">
                            <a href=""><span class="fa fa-facebook-square fa-2x"></span></a>
                            <a href=""><span class="fa fa-google-plus-square fa-2x"></span></a>
                            <a href=""><span class="fa fa-linkedin-square fa-2x"></span></a>
                        </div>
                        <?php bloginfo('name'); ?> &copy; <?php echo date('Y'); ?>
                    </div>
                </div>
            </footer> <!-- end footer -->
        </div> <!-- end whole content -->
        <?php if(is_home()): ?>
        <script type="application/javascript">
            /* <![CDATA[ */
            var myLatLng = {lat: 46.68773541721578, lng: 6.705138266262839};
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: myLatLng,
                    zoom: 12,
                    scrollwheel: false
                });
              
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    title: 'SK Computing'
                });
            }
            /* ]]> */
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwSmqoOjBtYQARMZVLGDhBCk__4biwi_U&callback=initMap" async defer></script>
        <?php endif; ?>
        <?php wp_footer(); ?>
    </body>
</html>