<?php
/****************************************

		index.php

*****************************************/

get_header(); ?>

<!-- index.php -->
<div class="grid_9 push_3" id="main">
	<div class="box-top"></div>
	<div class="box-middle">
		<?php
		if ( have_posts() ) :
			// ループ開始
			while ( have_posts() ) : the_post(); ?>
				<article <div id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<time datetime="<?php echo get_the_date( 'Y-m-j' ) ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
					<p class="eyecatch">
						<?php
						// アイキャッチ画像
						if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
						<?php else : ?>
							<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="" /></a>
						<?php endif; ?>
					</p>
					<?php the_excerpt(); ?>
					<p class="right-align link">
						<a href="<?php the_permalink(); ?>">続きを読む &raquo;</a>
					</p>
				</article>
			<?php
			// ループ終了
			endwhile;
		else : ?>
				<article class="post">
					<?php get_template_part( 'content', 'none' ); ?>
				</article>
		<?php
		// if文終了
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
<!-- / index.php -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>