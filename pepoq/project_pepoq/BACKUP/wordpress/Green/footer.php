<?php
/****************************************

		Green footer.php

*****************************************/
?>

<!-- footer.php -->
	<div class="grid_12">
		<a href="#top" id="totop">TO TOP</a>
	</div>
</div><!-- / #container -->

<footer id="footer">
	<div id="white-bg">
		<h2 class="hidden">サイトのナビゲーション</h2>
		<div id="footer-area" class="container_12 clearfix">
			<div class="grid_8 offset">
				<nav id="footer-navi">
					<?php
					// カスタムメニュー CHAPTER 22
					wp_nav_menu( array( 'theme_location' => 'footer-navi' ) ); ?>
				</nav>
				<div class="grid_3 alpha column">
					<?php
					// カスタムメニュー CHAPTER 22
					wp_nav_menu( array( 'theme_location' => 'footer-left-column' ) ); ?>
				</div>
				<div class="grid_3 column">
					<?php
					// カスタムメニュー CHAPTER 22
					wp_nav_menu( array( 'theme_location' => 'footer-center-column' ) ); ?>
				</div>
				<div class="grid_2 omega column">
					<?php
					// カスタムメニュー CHAPTER 22
					wp_nav_menu( array( 'theme_location' => 'footer-right-column' ) ); ?>
				</div>
			</div>
			<div class="grid_4">
			<?php
				// ウィジット - メニュー → 外観 → ウィジットで設定可能
				if ( is_active_sidebar( 'footer-1' ) ) :
					dynamic_sidebar( 'footer-1' );
				else : ?>
					<div class="widget">
						<h2>ウィジットエリア</h2>
						<p>ここはフリーのウィジットエリアです。</p>
					</div>
				<?php
				// if文終了
				endif; ?>
			</div>
		</div><!-- /#footer-area -->
	</div><!-- /#white-bg -->
	<div id="bottom">
		<div class="wrapper">
			<small>&copy; <?php bloginfo('name'); ?> All Rights Reserved.</small>
		</div>
	</div>
</footer><!-- /#footer -->

<?php wp_footer(); ?>
<script>
/** jQuey UI Accodion */
jQuery( function($) {
	$(".accordion").accordion( {
 		header: ".header",
<?php if ( is_tax( 'item' ) ) : ?>
		active: 1,
<?php endif; ?>
 		heightStyle: "content"
	} );
} );
</script>
</body>
</html>
<!-- / footer.php -->