<?php
/****************************************

	404.php

	404 Not Found 表示用の
	テンプレートファイルです。

*****************************************/

get_header(); ?>

<!-- 404.php -->
<div class="grid_9 push_3" id="main">
	<div class="box-top"></div>
	<div class="box-middle single-post post clearfix">
		<?php get_template_part( 'content', 'none' ); ?>
	</div>
	<div class="box-bottom"></div>
</div><!-- /#main -->
<!-- / 404.php -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>