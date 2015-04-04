<?php
/**
 * The template for displaying the footer.
 *
 * @package Hipoul
 * @since hipoul 1.0
 */
global $graphene_settings;
?>

  </div><!--/.container -->

  <div id="footer">
    <?php do_action('hipoul_social_profiles'); ?>

    <div class="container">
      <h4>Politecnico Open unix Labs</h4>
      <p>Piazza Leonardo da Vinci 32, Milano, Italy</p>
      <br>
      <p>Powered by <a href="http://wordpress.org/">WordPress</a>.
      Theme <a href="https://github.com/Politecnico-Open-unix-Labs/hipoul">Hipoul</a> by <a href="http://ferrai.io">0xff</a>.</p>
      <p>The website hosting is funded by the <a href="https://polimi.it/">Politecnico di Milano</a>.</p>
      <br>
      <p>&copy; 2001-<?php echo date("Y"); ?> Politecnico Open unix Labs</p>
      <br>
      <button class="btn btn-primary" id="backto90">Back to the 90ties!</button>
    </div>
  </div><!-- /#footer-->

  <?php wp_footer(); ?>
  <script src="https://code.jquery.com/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/bits.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    $('a[href^="#"]').on('click',function (e) {
        e.preventDefault();

        var target = this.hash;
        var $target = $(target);

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 600, 'swing', function () {
            window.location.hash = target;
        });
    });

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });

    $("#backto90").click(function(){
      loadCSS = function(href) {
        var cssLink = $("<link rel='stylesheet' type='text/css' href='<?php echo get_template_directory_uri(); ?>/"+href+"'>");
        $("head").append(cssLink); 
      };

      loadCSS("css/bootstrap.min.css");
      $("#header").css("background",'url("<?php echo get_template_directory_uri(); ?>/img/stars.gif") repeat scroll left top #000');
      $("#landing").css("background",'url("<?php echo get_template_directory_uri(); ?>/img/stars.gif") repeat scroll left top #000');
      $("#joinus").css("background",'url("<?php echo get_template_directory_uri(); ?>/img/mchammer.gif") repeat-x left top #000');
    });
  });
  </script>

</body>
</html>