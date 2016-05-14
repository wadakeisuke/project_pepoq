<?php
/****************************************

		taxonomy.php

		CHAPTER 25

		カスタム分類を表示するテンプレートファイルです。

*****************************************/

get_header(); ?>

<!-- taxonomy.php -->
<div class="grid_9 push_3" id="main">
<?php
	if ( have_posts() ) :
		// ループ開始
		while (have_posts()) : the_post(); ?>
			<article class="grid_3 box-link <?php echo green_add_class(); /** Green 独自関数 - テーマ用のクラスを付ける */ ?>">
				<div class="box-s-top"></div>
				<div class="box-s-middle equal-height">
					<div class="hgroup">
						<h3><?php the_title(); ?></h3>
						<h4 class="subtitle">
							<?php
							//カスタムフィールドを利用したサブタイトル
							if ( get_post_meta( $post->ID, 'sub-title') ) :
									echo esc_html( get_post_meta( $post->ID, 'sub-title', true ) );
							else : ?>
								Subtile
							<?php endif; ?>
						</h4>
					</div>
					<?php
					// アイキャッチ画像
					if ( has_post_thumbnail() ) :
						the_post_thumbnail();
					else : ?>
						<img src="<?php echo get_template_directory_uri(); ?>/images/default.jpg" alt="" />
					<?php endif; ?>
					<div class="excerpt">
						<?php echo green_excerpt( 60 ); /* Green 独自関数 - 半角60文字抜粋を表示する */ ?>
					</div>
					<p class="rigft-align link">
						<a href="<?php the_permalink(); ?>">詳しく見る</a>
					</p>
				</div>
				<div class="box-s-bottom"></div>
			</article>
		<?php
		// ループ終了
		endwhile;
	else : ?>
		<div class="box-top"></div>
		<article class="box-middle post">
			<?php get_template_part( 'content', 'none'); ?>
		</article>
		<div class="box-bottom"></div>
<?php
	// if 文終了
	endif;

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
<!-- / taxonomy.php -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>