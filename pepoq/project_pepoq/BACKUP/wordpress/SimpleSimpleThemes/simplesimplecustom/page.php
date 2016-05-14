<?php
/****************************************

	page.php

	固定ページを表示するための
	テンプレートファイルです。

	page.php のコードに関しては、
	CHAPTER 12 で詳しく解説しています。

*****************************************/
?>

<?php get_header(); ?>

<!-- page.php -->
<div id="main">

	<?php
		// ループ開始
		while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

				<?php
					/**
					 * コンテンツを表示する
					 */
					the_content();
				?>

			</div><!-- /#post -->

	<?php
		// ループ終了
		endwhile; ?>

</div><!-- /#main -->
<!-- /page.php -->

<?php get_sidebar(); ?>
<?php //get_sidebar( '2' ); ?>
<?php get_footer(); ?>