<?php
/**
 * The template for displaying the footer.
 *
 * @package Hipoul
 * @since hipoul 1.0
 */
global $graphene_settings;
?>

<?php if (!is_front_page()): ?>
  </div><!--/.container -->

  <div id="footer">
    <div class="container">
      <h4>Politecnico Open unix Labs</h4>
      <p>Piazza Leonardo da Vinci 32, Milano, Italy</p>
      <br>
      <p>Powered by <a href="http://wordpress.org/">WordPress</a>.
      Theme <a href="https://github.com/Politecnico-Open-unix-Labs/hipoul">Hipoul</a> by <a href="http://ferrai.io">0xff</a>.</p>
      <p>The website hosting is funded by the <a href="https://polimi.it/">Politecnico di Milano</a>.</p>
      <br>
      <p>&copy; 2001-<?php echo date("Y"); ?> Politecnico Open unix Labs</p>
    </div>
    
<?php endif; ?>

    <div class="social-footer">
      <ul class="social-icons-nav">
        <?php //do_action('hipoul_social_profiles'); TODO ?>
        <li class="twitter"><a href="https://twitter.com/poul_polimi"><i class="fa fa-twitter"></i></a></li>
        <li class="github"><a href="https://www.facebook.com/poul.polimi"><i class="fa fa-facebook"></i></a></li>
      </ul>
    </div>
  </div><!-- ends either the #footer or the #landing -->

  <?php wp_footer(); ?>
  <script src="https://code.jquery.com/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>