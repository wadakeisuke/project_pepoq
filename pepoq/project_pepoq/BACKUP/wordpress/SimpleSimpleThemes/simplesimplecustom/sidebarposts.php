<?php
/****************************************

	sidebar-posts.php

	サイドバーのサブループ内のテンプレートファイルです。
	（CHAPTER 21）

*****************************************/
?>

<!-- sidebar-posts.php -->
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
<!-- /sidebar-posts.php -->