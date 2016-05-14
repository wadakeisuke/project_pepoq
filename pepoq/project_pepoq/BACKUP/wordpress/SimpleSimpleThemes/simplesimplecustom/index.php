<?php
/****************************************

	index.php

	アイキャッチ画像と抜粋でレイアウトしています。
	（CHAPTER14）

*****************************************/

get_header(); ?>
<!-- index.php -->
<div id="main">
<?php
	if ( have_posts() ) :
		// ループ開始
		while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="content-box">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="post-meta">
						<span class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
						<span class="category">Category - <?php the_category( ', ' ) ?></span>
						<span class="comment-num"><?php comments_popup_link( 'Comment : 0', 'Comment : 1', 'Comments : %' ); ?></span>
					</p>
				<?php
					// 抜粋（CHAPTER 14）
					the_excerpt(); ?>

				<?php
					// 続きを読むリンク
				?>
					<p class="more-link">
						<a href="<?php the_permalink(); ?>" title="「<?php the_title(); ?>」の続きを読む">続きを読む &raquo;</a>
					</p>
				</div><!-- /.content-box -->

				<?php
					// アイキャッチ画像（CHAPTER 14）
				?>
				<p class="thumbnail-box">
					<?php if( has_post_thumbnail() ) :
						the_post_thumbnail( 'thumbnail' );
					else : ?>
						<img src="<?php echo get_template_directory_uri(); ?>/images/noimage.gif" alt="" />
					<?php endif; ?>
				</p>
			</div>
	<?php
		// ループ終了
		endwhile;
	else : ?>
			<div class="post">
				<h2>記事はありません</h2>
				<p>お探しの記事は見つかりませんでした。</p>
			</div>
<?php
	// if 文終了
	endif; ?>

<?php
	//ページャー
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="posts-navigation">
			<div class="nav-next"><?php previous_posts_link( '&laquo; NEXT' ); ?></div>
			<div class="nav-previous"><?php next_posts_link( 'PREV &raquo;' ); ?></div>
		</div>
	<?php endif; ?>

</div><!-- /#main -->
<!-- / index.php -->

<?php get_sidebar(); ?>
<?php //get_sidebar( '2' ); ?>
<?php get_footer(); ?>