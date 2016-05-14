<?php
/****************************************

		single.php

		ブログの個別記事を表示するファイル

*****************************************/

get_header(); ?>

<!-- single.php -->
<div class="grid_9 push_3" id="main">
	<div class="box-top"></div>
	<article class="box-middle single-post post clearfix">
	<?php
		// ループ開始
		while ( have_posts() ) : the_post(); ?>
			<h3><?php the_title(); ?></h3>
			<div class="metabox clearfix">
				<time datetime="<?php echo get_the_date( 'Y-m-j' ) ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
				<div>
					<span>カテゴリー：</span>
					<?php the_category( '' ); ?>
				</div>
			</div>
			<p class="eyecatch">
				<?php
				// アイキャッチ画像
				if ( has_post_thumbnail() ) :
					the_post_thumbnail();
				else : ?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" width="212" height="131" alt="" />
				<?php endif; ?>
			</p>

			<?php the_content(); ?>

			<?php
			/**
			 * 投稿ナビゲーション
			 */ ?>
			<nav class="post-navi">
				<span id="next"><?php next_post_link( '%link','&laquo; %title' ); ?></span>
				<span id="prev"><?php previous_post_link( '%link','%title &raquo;' ); ?></span>
			</nav>
	<?php
		// ループ終了
		endwhile; ?>
	</article>
	<div class="box-bottom"></div>
</div><!-- /#main -->
<!-- / single.php -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>