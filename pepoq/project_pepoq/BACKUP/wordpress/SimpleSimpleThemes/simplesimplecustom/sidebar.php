<?php
/****************************************

	sidebar.php

	サイドバーを表示するための
	テンプレートファイルです。
	カスタマイズしたサイドバーです。
	（CHAPTER 21）

*****************************************/
?>
<!-- sidebar.php -->

<div id="sidebar">
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
				<li class="clearfix">
					<div class="sidebar-posts-title">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="sidebar-date"><?php  the_time( get_option( 'date_format' ) ); ?></p>
						<p class="sidebar-comment-num"><?php comments_popup_link( 'Comment : 0', 'Comment : 1', 'Comments : %' ); ?></p>
					</div>
					<p class="sidebar-thumbnail-box">
						<a href="<?php the_permalink(); ?>" title="「<?php the_title(); ?>」の続きを読む">
						<?php // アイキャッチ画像
						if ( has_post_thumbnail() ) :
							the_post_thumbnail( array( 75, 75 ) );
						else : ?>
							<img src="<?php echo get_template_directory_uri(); ?>/images/noimage.gif" width="75" height="75" alt="" />
						<?php endif; ?>
						</a>
					</p>
				</li>
		<?php
			//ループ終了
			endwhile; ?>
			</ul>
	<?php
		else : ?>
			<p>記事はありません。</p>
	<?php
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
				<li class="clearfix">
					<div class="sidebar-posts-title">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="sidebar-date"><?php  the_time( get_option( 'date_format' ) ); ?></p>
						<p class="sidebar-comment-num"><?php comments_popup_link( 'Comment : 0', 'Comment : 1', 'Comments : %' ); ?></p>
					</div>
					<p class="sidebar-thumbnail-box">
						<a href="<?php the_permalink(); ?>" title="「<?php the_title(); ?>」の続きを読む">
						<?php // アイキャッチ画像
						if ( has_post_thumbnail() ) :
							the_post_thumbnail( array( 75, 75 ) );
						else : ?>
							<img src="<?php echo get_template_directory_uri(); ?>/images/noimage.gif" width="75" height="75" alt="" />
						<?php endif; ?>
						</a>
					</p>
				</li>
		<?php
			//ループ終了
			endwhile; ?>
			</ul>
	<?php
		else : ?>
			<p>記事はありません。</p>
	<?php
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

<!-- /sidebar.php -->