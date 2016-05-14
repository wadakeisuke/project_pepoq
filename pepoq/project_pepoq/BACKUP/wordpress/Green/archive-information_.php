<?php
/****************************************

	archive-information.php

	CHAPTER 24

	カスタム投稿「information」を表示する archive.php

*****************************************/

get_header(); ?>

<!-- archive-information.php -->
<div class="grid_9 push_3" id="main">
	<div class="box-top"></div>
	<div class="box-middle">
		<?php
			if ( have_posts() ) :
				// ループ開始
				while ( have_posts() ) : the_post(); ?>
					<article class="post">
						<h3><?php the_title(); ?></h3>
						<time datetime="<?php echo get_the_date( 'Y-m-j' ) ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
						<?php the_content(); ?>
					</article>
				<?php
				// ループ終了
				endwhile;
			else : ?>
					<article class="post">
						<?php get_template_part( 'content', 'none' ); ?>
					</article>
		<?php
			// if 文終了
			endif; ?>
	</div>
	<div class="box-bottom"></div>

	<?php
	/**
	 * ページネーション
	 */
	$args = array(
		'prev_text' => '&laquo; Next',
		'next_text' => 'Prev &raquo;',
		'mid_size'	=> 1,
	);
	the_posts_pagination( $args ); ?>

</div><!-- /#main -->
<!-- / archive-information.php -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>