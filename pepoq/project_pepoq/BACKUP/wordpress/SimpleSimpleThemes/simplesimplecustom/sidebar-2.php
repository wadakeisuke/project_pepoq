<?php
/****************************************

	sidebar-2.php

	サイドバーを表示するための
	テンプレートファイルです。
	カスタマイズしたサイドバーです。
	（CHAPTER 21）

*****************************************/
?>
<!-- sidebar-2.php -->

<div id="sidebar">
	<p>get_template_part()を使用したサイドバーです。</p>
	<!-- Recent Posts -->
	<div class="widget">
		<h2>Recent Posts</h2>
	<?php
		/**
		 * 最近の記事を 3件表示
		 */
		$args = array(
			'posts_per_page' => 3,
		);
		$my_query = new WP_Query( $args );

		// サブループ
		if ( $my_query->have_posts() ) :  ?>
			<ul id="sidebar-recent-posts" class="sidebar-posts">
		<?php
			// ループ開始
			while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

				<?php
				/**
				 * テンプレートファイル sidebar-posts.php を読み込む
				 */
				get_template_part( 'sidebarposts' ); ?>
		<?php
			//ループ終了
			endwhile; ?>
			</ul>
	<?php
		else :
			/**
			 * テンプレートファイル sidebar-posts-none.php を読み込む
			 */
			get_template_part( 'sidebarposts', 'none' );

		// サブループ if 文終了
		endif;
		wp_reset_postdata(); ?>
	</div>
	<!-- /Recent Posts -->

	<!-- Popular Posts -->
	<div class="widget">
		<h2>Popular Posts</h2>
	<?php
		/**
		 * コメントの多い順に 3件表示
		 */
		$args = array(
			'posts_per_page'	=> 3,
			'orderby' 			=> 'comment_count',
		);
		$my_query = new WP_Query( $args );

		// サブループ
		if ( $my_query->have_posts() ) : ?>
			<ul id="sidebar-recent-posts" class="sidebar-posts">
		<?php
			// ループ開始
			while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

				<?php
				/**
				 * テンプレートファイル sidebar-posts.php を読み込む
				 */
				 get_template_part( 'sidebarposts' ); ?>

		<?php
			//ループ終了
			endwhile; ?>
			</ul>
	<?php
		else :
			/**
			 * テンプレートファイル sidebar-posts-none.php を読み込む
			 */
			get_template_part( 'sidebarposts', 'none' );

		// サブループ if 文終了
		endif;
		wp_reset_postdata(); ?>
	</div>
	<!-- /Popular Posts -->

	<!-- Tag Cloud -->
	<div class="widget">
		<h2>Tag Cloud</h2>
		<?php $args = array(
			'smallest' 	=> 14,
			'largest' 	=> 18,
			'unit' 		=> 'px',
			'number' 	=> 0,
			'format' 	=> 'flat',
			'taxonomy' 	=> 'post_tag',
			'echo' 		=> true,
		); ?>
		<p class="tagcloud">
			<?php wp_tag_cloud( $args ); ?>
		</p>
	</div>
	<!-- /Tag Cloud -->

<?php
	// ウィジットがあったら表示
	if ( is_active_sidebar( 'sidebar-1' ) ) :
		dynamic_sidebar( 'sidebar-1' );
	endif; ?>

</div><!-- /#sidebar -->

<!-- /sidebar-2.php -->