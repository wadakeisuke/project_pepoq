<?php
/****************************************

	sidebar.php

	サイドバーを表示するテンプレートファイル

*****************************************/
?>

<!-- sidebar.php -->
<div class="grid_3 pull_9" id="sidebar">
	<aside class="module" id="local-navi">
		<div class="hgroup">
			<?php
			/****************************************

			      サイドバーの見出し部分
			      CHAPTER 23, 24, 25

			*****************************************/

			/**
			 * 固定ページの場合（CHAPTER 23）
			 */

			if ( is_page() ) :
				// 親ページの場合
				if ( $post->post_parent == 0) : ?>
					<h2><?php single_post_title(); ?></h2>
					<?php
						// カスタムフィールド 'sub-title' の値を表示
						if ( get_post_meta ( $post->ID, 'sub-title' ) ) : ?>
							<h3><?php echo esc_html( get_post_meta( $post->ID, 'sub-title', true ) ); ?></h3>
					<?php else : ?>
							<h3>Subtitle</h3>
					<?php endif;

				// 子ページの場合
				else : ?>
					<h2><?php
						// 親ページのタイトルを表示
						echo esc_html( get_the_title( $post->post_parent ) ); ?></h2>
					<?php
						// 親ページのカスタムフィールド 'sub-title' の値を表示
						if ( get_post_meta( $post->post_parent, 'sub-title' ) ) : ?>
							<h3><?php echo esc_html( get_post_meta( $post->post_parent, 'sub-title', true ) ); ?></h3>
					<?php else: ?>
							<h3>Subtitle</h3>
					<?php endif;
				endif;


			/**
			 * 検索結果ページの場合（CHAPTER 23）
			 */

			elseif ( is_search() ) : ?>
				<h2>検索結果</h2>
				<h3>SEARCH</h3>


			<?php
			/**
			 * 404の場合（CHAPTER 23）
			 */

			elseif ( is_404() ) : ?>
				<h2>404</h2>
				<h3>NOT FOUND</h3>


			<?php
			/**
			 * ブログの場合（CHAPTER 23）
			 */

			elseif ( get_post_type() == 'post' ) : ?>
				<h2>ブログ</h2>
				<h3>BLOG</h3>


			<?php
			/**
			 * カスタム分類のアーカイブページ、カスタム投稿タイプ 'product'（製品）の個別投稿ページの場合（CHAPTER 25）
			 */

			elseif( is_tax() || get_post_type() == 'product' ) : ?>
				<h2>製品一覧</h2>
				<h3>PRODUCTS</h3>

			<?php
			/**
			 * カスタム投稿タイプ 'informations'（お知らせ）の個別ページ、またはアーカイブページの場合（CHAPTER 24）
			 */

			elseif ( get_post_type() == 'information' ) : ?>
				<h2>お知らせ</h2>
				<h3>INFORMATION</h3>

			<?php
			/**
			 * その他
			 */

			else : ?>
				<h2>ブログ</h2>
				<h3>BLOG</h3>

			<?php endif; ?>
		</div><!-- /.hgroup -->

		<?php
		/****************************************

			サイドバーのアイキャッチ画像

			CHAPTER 23, 24, 25

		*****************************************/
		?>

		<p class="eyecatch">

			<?php
			/**
			 * 検索結果ページ（CHAPTER 23）
			 */

			if ( is_search() ) : ?>
				<img src="<?php echo get_template_directory_uri(); ?>/images/search.jpg" width="214" height="132" alt="">

			<?php
			/**
			 * 404 Not Found（CHAPTER 23）
			 */

			elseif ( is_404() ) : ?>
				<img src="<?php echo get_template_directory_uri(); ?>/images/404.jpg" width="214" height="132" alt="">

			<?php
			/**
			 * ブログのアーカイブ、個別記事（CHAPTER 23）
			 */

			elseif ( get_post_type() == 'post' ) : ?>
				<img src="<?php echo get_template_directory_uri(); ?>/images/blog.jpg" width="214" height="132" alt="">

			<?php
			/**
			 * 固定ページ（CHAPTER 23）
			 */

			elseif ( is_page() ) :
				if ( has_post_thumbnail( $post->ID ) ) :
					echo get_the_post_thumbnail( $post->ID );
				else : ?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/no-image-sidebar.jpg" width="214" height="132" alt="">
				<?php endif;


			/**
			 * 「お知らせ」のアーカイブ、個別記事（CHAPTER 24）
			 */

			elseif ( get_post_type() == 'information' ) : ?>
				<img src="<?php echo get_template_directory_uri(); ?>/images/info.jpg" width="214" height="132" alt="">


			<?php
			/**
			 * 「製品」の個別ページ（CHAPTER 25）
			 */

			elseif ( is_singular( 'product' ) ) :
				$terms = get_the_terms( $post->ID, 'roomtype' );
				if ( $terms ) :
					$term = array_shift( $terms );
					/** 【重要】画像の名前をタームのスラッグと同じにする！ */ ?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo esc_html( $term->slug ); ?>.jpg" alt="">
				<?php else : ?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/no-image-sidebar.jpg" width="214" height="132" alt="">
				<?php endif;


			/**
			 * 部屋のタイプ、家具の種類 – taxonomy.php（CHAPTER 25）
			 */

			elseif ( is_tax() ) :
				/** 【重要】画像の名前をスラッグと同じにする！ */ ?>
				<img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo esc_html( get_term_slug() ); ?>.jpg" alt="">


			<?php
			/**
			 * その他（CHAPTER 23）
			 */

			else :
				if ( has_post_thumbnail() ) :
					echo get_the_post_thumbnail();
				else : ?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/no-image-sidebar.jpg" width="214" height="132" alt="">
				<?php endif;
			endif; ?>
		</p>


		<?php
		/****************************************

			ローカルナビ（リンク）
			CHAPTER 23, 24, 25

		*****************************************/
		?>

		<nav class="sidebar-navi">
			<?php
			/**
			 * お知らせの個別記事（CHAPTER 24）
			 */

			if ( is_singular( 'information' ) ) :
				$args = array(
					'post_type' 		=> 'information',
					'posts_per_page' 	=> 5,
				);
				$information = new WP_Query( $args );
				if ( $information->have_posts() ) : ?>
					<ul>
						<?php while ( $information->have_posts() ) : $information->the_post(); ?>
							<li class="brother"><a href="<?php the_permalink(); ?>"><?php the_title(); ?>&nbsp;<span class="date">- <?php the_time( get_option( 'date_format' ) ); ?></span></a></li>
						<?php endwhile;
				endif;
				wp_reset_postdata(); ?>
							<li><a href="<?php echo esc_url( home_url( '/' ) );?>information/">&raquo; お知らせ一覧</a></li>
					</ul>


			<?php
			/**
			 * 検索結果（CHAPTER 23）
			 */

			elseif ( is_search() ) :
				/** 表示したいものがあれば書き込む */


			/**
			 * ブログのメインページやカテゴリー、個別ページなど（CHAPTER 23）
			 */

			elseif ( get_post_type() == 'post' ) : ?>
				<ul class="blog-category">
					<?php wp_list_categories( 'title_li=' ); ?>
				</ul>


			<?php
			/**
			 * 固定ページ「products」、部屋タイプ、家具の種類、製品の個別ページ（CHAPTER 25）
			 */

			elseif ( is_page( 'products' ) || is_tax() || is_singular( 'product' ) ) : ?>
				<ul class="accordion">
					<?php $roomtype_args = array(
						'title_li' 	=> '<a class="header">ルームタイプから探す</a>',
						'orderby' 	=> 'id',
						'taxonomy' 	=> 'roomtype',
					);
					wp_list_categories( $roomtype_args );

					$item_args = array(
						'title_li' 	=> '<a class="header">家具の種類から探す</a>',
						'orderby' 	=> 'id',
						'taxonomy'	 => 'item',
					);
					wp_list_categories( $item_args ); ?>
				</ul>


			<?php
			/**
			 * 固定ページの場合（CHAPTER 23）
			 */

			elseif ( is_page () ) :
				// 親ページの場合
				if ( $post->post_parent == 0 ) :
					$args = array(
						'post_type' 	=> 'page',
						'post_parent' 	=> $post->ID,
						'order' 		=> 'ASC',
						'orderby' 		=> 'menu_order',
					);

					$child_posts = new WP_Query( $args );
					if ( $child_posts->have_posts() ) : ?>
						<ul class="accordion">
							<li class="current first"><span><?php the_title(); ?></span>
								<ul class="child">
									<?php while ( $child_posts->have_posts() ) : $child_posts->the_post(); ?>
		    							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
										<?php endwhile; ?>
								</ul>
							</li>
						</ul>
					<?php endif;
					wp_reset_postdata();

				// 子ページの場合
				else :
					$args = array(
						'post_type' 	=> 'page',
						'post_parent' 	=> $post->post_parent,
						'order' 		=> 'ASC',
						'orderby'		=> 'menu_order',
					);
					$current_ID 	= $post->ID;
					$brother_posts 	= new WP_Query( $args );
					if ( $brother_posts->have_posts() ) : ?>
						<ul class="accordion">
							<?php while ( $brother_posts->have_posts() ) : $brother_posts->the_post();
								if ( $current_ID == $post->ID ) : ?>
									<li class="current"><span><?php the_title(); ?></span></li>
								<?php else : ?>
		   							<li class="brother"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		   						<?php endif;
							endwhile; ?>
						</ul>
					<?php endif;
					wp_reset_postdata();
				endif; ?>

			<?php endif; ?>
		</nav>
	</aside>
</div><!-- /#sidebar -->
<!-- / sidebar.php -->