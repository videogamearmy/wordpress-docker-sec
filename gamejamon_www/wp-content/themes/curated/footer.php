		</div>
		<!-- END PAGE WRAPPER -->

		<?php $maha_options = get_option('curated'); ?>		
		<!-- START FOOTER -->
		<footer id="footer">

			<?php if ( $maha_options['footer_widget'] == true ) { ?>
			<!-- start footer sidebar -->
			<div id="footer-sidebar">
				<div class="container">
					<div class="row">

						<div class="col-sm-4">
							<?php dynamic_sidebar( 'Footer 1' ); ?>
						</div>

						<div class="col-sm-4">
							<?php dynamic_sidebar( 'Footer 2' ); ?>
						</div>

						<div class="col-sm-4">
							<?php dynamic_sidebar( 'Footer 3' ); ?>
						</div>
						
					</div>
				</div>
			</div>
			<!-- end footer sidebar -->
			<?php } ?>

			<!-- start f-copyright -->
			<div class="f-copyright">
				<div class="container">
					<div class="row">
						<div class="col-sm-8">
							<?php echo $maha_options['fc_copyright']; ?>
						</div>
						<div class="col-sm-4">
							<nav>
								<?php
								if ( isset($maha_options['fc_menu'])) {
									$fc_menus_items = wp_get_nav_menu_items($maha_options['fc_menu']);
									$cnt = count($fc_menus_items);
						            if ( $cnt > 0 && $maha_options['fc_menu'] != '' ) {
						                echo '<ul>';
						                foreach ($fc_menus_items as $key => $v_nav) {
						                    echo '<li><a href="'.$v_nav->url.'">'.$v_nav->title.'</a></li>';
						                    if ( $cnt != $key + 1 ) {
						                    	echo "<span>/</span>";
						                    }
						                }
						                echo '</ul>';
						            }
								}
								?>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- end f-copyright -->

		</footer>
		<!-- END FOOTER -->

	</div>
	<!-- END OFF CANVAS BODY -->

	</div>
	<!-- END BODY BACKGROUND -->

	<div id="scrolltop">
		<a><i class="tm-go-top"></i></a>
	</div>
	
	</div>

<?php wp_footer(); ?>
        
</body>
</html>