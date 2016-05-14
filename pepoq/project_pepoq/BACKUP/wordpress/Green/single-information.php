<?php
/****************************************

	single-information.php

	カスタム投稿「information」の
	個別投稿用テンプレートファイル

	CHAPTER 24

*****************************************/

get_header(); ?>

<!-- single-information.php　-->
<div class="grid_9 push_3" id="main">
	<div class="box-top"></div>
	<article class="box-middle post">
		<?php
			// ループ開始
			while ( have_posts() ) : the_post(); ?>
				<h3><?php the_title(); ?></h3>
				<time class="post-date" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
				<?php the_content(); ?>
				<nav class="post-navi">
					<span id="next"><?php next_post_link( '%link','&laquo; %title' ); ?></span>
					<span id="prev"><?php previous_post_link( '%link','%title &raquo;' ); ?></span>
				</nav>
			<?php
			// ループ終了
			endwhile; ?>
	</article>
	<div class="box-bottom"></div>
</div><!-- /main -->
<!-- / single-information.php -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>