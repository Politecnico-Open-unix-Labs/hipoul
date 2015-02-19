<?php
/**
 * The Header for our theme.
 *
 * @package Hipoul
 * @since hipoul 1.0
 */
global $hipoul_settings;?>

<html <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

  <title><?php wp_title( '' ); ?></title>

  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 

  <!-- Bootstrap Core CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

  <!-- Custom Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,700,300italic,400italic,700italic|Roboto:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

  <?php wp_head(); ?>
</head>
<body>

<?php if (!is_front_page()): ?>

  <div id="header" style="background-image:url(<?php bloginfo('template_directory'); ?>/img/sedeblurscura.jpg); background-size: cover;">
    <a href="<?php echo home_url(); ?>" id="home-logo" title="<?php esc_attr_e('Go back to the front page', 'hipoul'); ?>">
      <img src="<?php bloginfo('template_directory'); ?>/img/newlogo.svg" alt="Politecnico Open unix Labs Logo">
    </a>

<?php else: /* little trick to hide the search bar in the homepage, and the "home" element */ ?>

  <style>
  .nav-justified > li.menu-item-search, .nav-justified > li:first-child {
    display: none;
  }
  </style>
  <div id="landing" class="row">

<?php endif; ?>

    <!-- Fixed navbar -->
    <div class="navbar navbar-custom navbar-inverse navbar-static-top" id="<?php if (is_front_page()) echo "landing-"; ?>nav">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse">
  		      <?php
              /* Header menu */
              wp_nav_menu(array(
                'theme_location' => 'header-menu',
                'container' => false,
                'menu_id' => '',
                'menu_class' => 'nav navbar-nav nav-justified',
                'depth' => 1,
                // This one is the important part:
                'walker' => new Hipoul_Walker_Nav_Menu
              )); ?>
          </div><!--/.nav-collapse -->
        </div><!--/.container -->
    </div><!--/.navbar -->

<?php if (!is_front_page()): ?>

  </div>
  <div class="container" id="blog">

<?php endif; ?>