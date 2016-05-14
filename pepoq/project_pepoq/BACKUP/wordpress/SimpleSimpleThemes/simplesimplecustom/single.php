<?php
/****************************************

	single.php

	個別記事ページを表示するための
	テンプレートファイルです。
	カスタマイズした single.phpです。
	（CHAPTER 17）

*****************************************/

get_header(); ?>
<!-- single.php -->
<div id="main">
<?php
	// ループ開始
	while ( have_posts() ) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="post-meta">
				<span class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
				<span class="category">Category - <?php the_category( ', ' ) ?></span>
				<span class="comment-num"><?php comments_popup_link( 'Comment : 0', 'Comment : 1', 'Comments : %' ); ?></span>
			</p>

			<?php the_content();

			$args = array(
				'before'	  => '<div class="page-link">',
				'after'		  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			);
			wp_link_pages( $args ); ?>

			<p class="footer-post-meta">
				<?php the_tags( 'Tag : ', ', ' ); ?>
				<span class="post-author">作成者 : <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>
			</p>
		</div><!-- /#post -->

		<?php
		/**
		 * 投稿ナビゲーション（次の記事へ、前の記事へのリンク）
		 */
		 ?>
		<div class="post-navigation">
			<?php
				if ( get_next_post() ) : ?>
					<div class="nav-next"><?php next_post_link( '%link', '&laquo; %title' ); ?></div>
			<?php
				endif;

				if ( get_previous_post() ) : ?>
					<div class="nav-previous"><?php previous_post_link( '%link', '%title &raquo;' ); ?></div>
			<?php
				endif; ?>
		</div><!-- /.post-navigation -->


		<?php
		/**
		 * ここから関連記事の表示
		 */

		// カテゴリーIDの取得
		$categories 	= get_the_category( $post->ID );
		$category_ID	= array();
		foreach ( $categories as $category ) {
			array_push( $category_ID, $category->cat_ID);
		}

		// WordPressオブジェクトの作成
		$args = array(
			'post__not_in'		=> array( $post->ID ),
			'category__in'		=> $category_ID,
			'posts_per_page'	=> 3,
			'orderby'			=> 'rand',
		);
		$my_query = new WP_Query( $args ); ?>

		<div class="related-posts">
			<h3 id="related">Related Posts</h3>
		<?php // サブループ開始
			if ( $my_query->have_posts() ) : ?>
				<ul id="related-posts">
			<?php
				// ループ開始
				while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
					<li class="clearfix">
						<div class="content-box">
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<p class="date"><?php the_time( get_option( 'date_format' ) ); ?></p>
							<?php // the_excerpt(); ?>
							<p><?php echo esc_html( get_post_meta( $post->ID, 'short_description', true ) ); ?></p>
						</div>
						<p class="thumbnail-box">
							<a href="<?php the_permalink() ?>" title ="「<?php the_title(); ?>」の続きを読む">
								<?php if ( has_post_thumbnail() ) :
									the_post_thumbnail( array( 100, 100 ) );
								else : ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/noimage.gif" width = "100" height="100" alt="" />
								<?php endif; ?>
							</a>
						</p>
					</li>
			<?php
				// ループ終了
				endwhile; ?>
				</ul>
		<?php else : ?>
				<p>関連する記事はありませんでした ...</p>
		<?php
			// サブループ if 文終了
			endif;
			wp_reset_postdata(); ?>
		</div><!-- /.related-posts -->

		<?php
			/**
			 * comments.php の読み込み
			 */
			comments_template();
		?>
<?php
	// メインループ終了
	endwhile; ?>
</div><!-- /#main -->
<!-- /single.php -->

<?php get_sidebar(); ?>
<?php //get_sidebar( '2' ); ?>
<?php get_footer(); ?>