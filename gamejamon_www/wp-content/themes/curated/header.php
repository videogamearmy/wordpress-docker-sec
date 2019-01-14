<!doctype html>
<head <?php language_attributes(); ?>>

	<!-- Meta Tags -->
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link href="//www.google-analytics.com" rel="dns-prefetch">

	<?php $maha_options = get_option('curated'); ?>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes"/>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php
	if ($maha_options['thefavicon'] != "" and is_array($maha_options['thefavicon'])) {
		echo "<link rel='icon' id='favicon' type='image/png' href='" . $maha_options['thefavicon']['url'] . "'>";
		echo "<link rel='apple-touch-icon' href='" . $maha_options['thefavicon_ios_144']['url'] . "'>";
		echo "<link rel='apple-touch-icon' sizes='76x76' href='" . $maha_options['thefavicon_ios_76']['url'] . "'>";
		echo "<link rel='apple-touch-icon' sizes='114x114' href='" . $maha_options['thefavicon_ios_114']['url'] . "'>";
		echo "<link rel='apple-touch-icon' sizes='144x144' href='" . $maha_options['thefavicon_ios_144']['url'] . "'>";
	}
	?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php
$fullbg = "";
if ( $maha_options['boxed_on'] == true ) {
	$fullbg .= 'style="';
	$fullbg .= 'background-color:'.$maha_options['full-background']['background-color'].';';
	$fullbg .= 'background-image:url('.$maha_options['full-background']['background-image'].');';
	$fullbg .= 'background-repeat:'.$maha_options['full-background']['background-repeat'].';';
	$fullbg .= 'background-position:'.$maha_options['full-background']['background-position'].';';
	$fullbg .= 'background-size:'.$maha_options['full-background']['background-size'].';';
	$fullbg .= 'background-attachment:'.$maha_options['full-background']['background-attachment'].';';
	$fullbg .= '"';
}
?>

	<div id="body-maha" class="body-maha" data-tmloader="<?php echo get_template_directory_uri().'/images/ellipsis.gif'; ?>" <?php echo $fullbg; ?>>

		<nav id="mobile-bar-sticky" role="navigation" class="mobile-bar bar-sticky">
			<div id="close-mobile-bar"><i class="tm-cancel"></i></div>
			<div id="search-mobile-bar"><?php get_search_form(); ?></div>
			<?php maha_navigation('header-nav','mobile-menu'); ?>
		</nav>

		<!-- START BODY BACKGROUND -->
		<div id='body-background'>

		<!-- START OFF CANVAS BODY -->
		<?php $animati_on = '';
		if ($maha_options['animati_on'] == true) {
			$animati_on = 'animati-on';
		} ?>
		<div id="off-canvas-body" class="off-canvas-body <?php echo $animati_on; ?>">

			<!-- START TOP BAR -->
			<div id="top-bar-sticky" class="bar-sticky">
				<div class="top-bar">

					<!-- start container -->
					<div class="container">
						<div class="row">
							<div class="col-sm-12">

								<div id="top-right-nav">
									<div class="social-top">
										<ul><?php maha_opt_social_network('th_social_network'); ?></ul>
									</div>

									<div class="top-user">
										<i class='tm-user'></i>
										<?php if ( is_user_logged_in() ) : ?>
										<a href="<?php echo wp_logout_url(); ?>"><?php _e('Logout', 'curated'); ?></a>
										<?php else : ?>
											<?php if ( get_option('users_can_register') ) : ?>
												<?php if ( class_exists('LoginWithAjax') ) : ?>
												<a class="login-modal-closer" data-reveal-id="cur-register" data-animation="fade" data-dismissmodalclass="register-reveal-modal"><?php _e('Register', 'curated'); ?></a>
												<?php else : ?>
												<a href="<?php echo wp_registration_url(); ?>"><?php _e('Register', 'curated'); ?></a>
												<?php endif; ?>
												<span>&nbsp/&nbsp</span>
											<?php endif; ?>
											<?php if ( class_exists('LoginWithAjax') ) : ?>
												<?php login_with_ajax( array( 'template' => 'modal' )); ?>
											<?php else : ?>
												<a href="<?php echo wp_login_url(); ?>"><?php _e('Login', 'curated'); ?></a>
											<?php endif; ?>
										<?php endif; ?>
									</div>
								</div>

								<nav id="top-nav-wrapper" class="ul-nav">
									<?php maha_navigation('top-nav'); ?>
								</nav>

								<nav id="top-mobile-wrapper" class="ul-nav">
									<ul><li><a><i class="tm-menu"></i></a></li></ul>
								</nav>

							</div>
						</div>
					</div>
					<!-- end container -->

				</div>
			</div>
			<!-- END TOP BAR -->

			<!-- START MAIN BAR -->
			<div class="main-logo-ads-wrap">
				<div class="main-logo-ads">

					<!-- start container -->
					<div class="container">
						<div class="row <?php if ($maha_options['header_alignment'] == 'center') echo 'main-logo-center';?>">
							<div class="col-sm-12">
								<!-- logo -->
								<?php maha_logo(); ?>

								<!-- adv -->
								<div id="main-ads" class="<?php if ($maha_options['header_alignment'] == 'center') echo 'main-ads-center';?>">
									<div class="vp-1170 vp-fluid"><?php echo $maha_options['ah_ads_768']; ?></div>
									<div class="vp-970 vp-750"><?php echo $maha_options['ah_ads_468']; ?></div>
									<div class="vp-320"><?php echo $maha_options['ah_ads_320']; ?></div>
								</div>
							</div>
						</div>
					</div>
					<!-- end container -->

				</div>
			</div>
			<!-- END MAIN BAR -->

			<!-- START MAIN NAV BAR -->
			<div id="main-nav">
			<div id="main-nav-bar" class="main-nav-bar clearfix <?php if ($maha_options['header_alignment'] == 'center') echo 'main-nav-center';?>">
				<div id="main-search" class=" clearfix">
					<div id="con-search">
						<div class="container">
							<div class="cols-sm12">

								<div id="main-search-form">
									<span class="close-search-form"><i class="tm-cancel"></i></span>
									<span class="loading-search-result"><img src="<?php echo get_template_directory_uri().'/images/ellipsis.gif'?>" alt=""></span>
									<?php get_search_form(); ?>
									<?php if ($maha_options['ajax_search_on'] == 1) { ?>
									<div class="search-result">
										<div class="container search-result-content"></div>
									</div>
									<?php } ?>
								</div>

							</div>
						</div>
					</div>
				</div>

				<div class='maha-notification container'><div id="main-notif"></div></div>

				<div class="container clearfix">

				</div>

				<!-- start container -->
				<div class="container clearfix">
					<div class="row clearfix">
						<div class="col-sm-12 clearfix">
							<!-- main search form -->

							<!-- search nav -->
							<?php if ($maha_options['search_on'] == 1) {?>
							<div id="search-nav" class="search-nav clearfix">
								<span class="open-search-form"><i class="tm-search"></i></span>
							</div>
							<?php }?>

							<!-- Cart nav -->
							<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
								<div id="cart-nav" class="cart-nav">
									<span class="cart-count">
										<span class="open-cart-form"><i class="tm-basket"></i></span>
										<span class='shop-cart'>
											<span class='count-arrow'></span>
											<?php //echo $woocommerce->cart->cart_contents_count; ?>
										</span>
									</span>
									<div id="shopping-cart-widget">
										<div class="cart-widget widget_shopping_cart_content"></div>
									</div>
								</div>
							<?php } ?>

							<!-- main nav -->
							<nav id="main-nav-wrapper" class="main-ul-nav clearfix">
							<?php
							maha_logo_small();
							maha_navigation('header-nav', 'mega-menu');
							?>

							</nav>
						</div>
					</div>
				</div>
				<!-- end container -->

			</div>
			</div>
			<!-- END MAIN NAV BAR -->

			<!-- START PAGE WRAPPER -->
			<div class="page-wrapper">
