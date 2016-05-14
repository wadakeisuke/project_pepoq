<?php
/****************************************

		page.php

		固定ページ用のデフォルトテンプレート

*****************************************/

get_header(); ?>

<!-- page.php -->
<div class="grid_9 push_3" id="main">
	<div class="box-top"></div>
	<article id="post-<?php the_ID(); ?>" <?php post_class('box-middle post'); ?>>
		<?php
			// ループ開始
			while ( have_posts() ) : the_post();
				the_content();
			// ループ終了
			endwhile; ?>
	</article>
	<div class="box-bottom"></div>
</div><!-- /#main -->
<!-- / page.php -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>