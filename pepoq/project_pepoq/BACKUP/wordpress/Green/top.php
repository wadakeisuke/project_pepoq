<?php
/****************************************

	Template Name: Top

	CHAPTER 22
	固定ページ「トップページ」用の
	テンプレートファイル

*****************************************/

get_header(); ?>

<!-- top.php -->
<div id="main-visual">
	<div class="wrapper">
		<?php
		/**
		 * カスタムヘッダー画像を表示
		 */
		?>
		<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
		<?php
		/**
		 * カスタム投稿タイプを表示（CHAPTER 23）
		 */
		?>
		<aside id="information">
			<h2>お知らせ</h2>
			<p class="right-align"><a href="<?php echo esc_url( home_url( '/' ) ); ?>information/">お知らせ一覧へ</a></p>
			<div class="scroll">
				<?php
				/**
				 * カスタム投稿タイプ「お知らせ」を表示
				 */
				$args = array(
					'post_type' 		=> 'information',
					'posts_per_page' 	=> 5,
				);

				$information = new WP_Query( $args );

				// 「お知らせ」用のサブループ
				if ( $information->have_posts() ) : ?>
					<ul>
						<?php
							// ループ開始
							while ( $information->have_posts() ) : $information->the_post(); ?>
							<li>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?>&nbsp;<span>- <?php the_time( get_option( 'date_format' ) ); ?></span></a>
							</li>
						<?php
							// ループ終了
							endwhile; ?>
					</ul>
				<?php else : ?>
					<p>現在お知らせはありません。</p>
				<?php
				// if文終了
				endif;
				wp_reset_postdata(); ?>
			</div><!-- /.scroll -->
		</aside><!-- /#information -->
	</div><!-- /.wrapper -->
</div><!-- / #main-visual -->

<div id="container" class="container_12 clearfix"><?php // #container の終了タグ </div> は footer.php に記述されています。 ?>
	<?php
		// メインループ開始
		while ( have_posts() ) : the_post();

			remove_filter ( 'the_content', 'wpautop' ); // 投稿に自動挿入される <p> タグを削除するコード
			the_content();

		// ループ終了
		endwhile; ?>
<!-- / top.php -->

<?php get_footer(); ?>