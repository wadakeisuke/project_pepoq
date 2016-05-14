<?php
/****************************************

	header.breadcrumb.php

	パンくずリストを直接記述した
	header.php です。

	パンくずリストのコードについては
	CHAPTER 16 で詳しく説明しています。

*****************************************/
?>
<!DOCTYPE html>
<html lang='ja'>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" media="screen" />
	<link href="http://fonts.googleapis.com/css?family=Josefin+Sans:400,600,700" rel="stylesheet" />
	<?php if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }
	/** コメント欄をポップアップで表示したいなら、下記を有効にする */
	// comments_popup_script(); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="container">
		<!-- header -->
		<div id="header" class="clearfix">
			<div class="alignleft">
				<h1 id="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span><?php bloginfo( 'name' ); ?></span></a></h1>
				<p id="description"><?php bloginfo( 'description' ); ?></p>
			</div>
			<div class="alignright">
				<?php get_search_form(); ?>
			</div>
			<?php wp_nav_menu( array( 'theme_location' => 'header-navi' ) ); ?>
		</div>
		<!-- /#header -->

		<?php // パンくずリスト（CHAPTER 16）
		if ( ! is_home() ) : ?>
			<div id="breadcrumb" class="clearfix">
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">HOME</a></li>
					<li>&gt;</li>
					<?php
					/* 検索結果ページ */
					if ( is_search() ) :  ?>
						<li>「<?php the_search_query(); ?>」で検索した結果</li>

					<?php
					/* タグアーカイブ */
					elseif ( is_tag() ) : ?>
						<li>タグ : <?php single_tag_title(); ?></li>

					<?php
					/* 404 Not Found ページ */
					elseif ( is_404() ) :  ?>
						<li>404 Not found</li>

					<?php
					/* 日付アーカイブ */
					elseif ( is_date() ) :

						/* 日別アーカイブ */
						if( is_day() ) : ?>
							<li><a href="<?php echo get_year_link( get_query_var( 'year' ) ); ?>">
								<?php echo get_query_var( 'year' ); ?>年</a></li>
							<li>&gt;</li>
							<li><a href="<?php echo get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) ); ?>">
								<?php echo get_query_var( 'monthnum' ); ?>月</a></li>
							<li>&gt;</li>
							<li><?php echo get_query_var( 'day' ); ?>日</li>

						<?php
						/* 月別アーカイブ */
						elseif( is_month() ) : ?>
							<li><a href="<?php echo get_year_link( get_query_var( 'year' ) ); ?>">
								<?php echo get_query_var( 'year' ); ?>年</a></li>
							<li>&gt;</li>
							<li><?php echo get_query_var( 'monthnum' ); ?>月</li>

						<?php
						/* 年別アーカイブ */
						elseif( is_year() ) : ?>
							<li><?php echo get_query_var( 'year' ); ?>年</li>
						<?php
						endif;

					/* カテゴリーアーカイブ */
					elseif ( is_category() ) :
						$cat = get_queried_object();
						if ( $cat->parent != 0 ) :
							$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
							foreach ( $ancestors as $ancestor ) : ?>
								<li><a href="<?php echo esc_url( get_category_link( $ancestor ) ); ?>">
									<?php echo esc_html( get_cat_name( $ancestor ) ); ?></a></li>
								<li>&gt;</li>
							<?php endforeach;
						endif; ?>
						<li><?php echo esc_html( $cat->cat_name ); ?></li>

					<?php
					/* 投稿者アーカイブ */
					elseif ( is_author() ) :  ?>
						<li>投稿者 : <?php the_author_meta( 'display_name', get_query_var('author') ); ?></li>

					<?php
					/* 固定ページ */
					elseif ( is_page() ) :
						if ( $post->post_parent != 0 ) :
							$ancestors = array_reverse( get_ancestors( $post->ID, 'page' ) );
							foreach ( $ancestors as $ancestor ) : ?>
								<li><a href="<?php echo esc_url( get_permalink( $ancestor ) ); ?>">
									<?php echo esc_html( get_the_title( $ancestor ) ); ?></a></li>
								<li>&gt;</li>
							<?php endforeach;
						endif; ?>
						<li><?php echo esc_html( $post->post_title ); ?></li>

					<?php
					/* 添付ファイルページ */
					elseif ( is_attachment() ) :
						if ( $post->post_parent != 0 ) : ?>
							<li><a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>">
								<?php echo esc_html( get_the_title( $post->post_parent ) ); ?></a></li>
							<li>&gt;</li>
						<?php endif; ?>
							<li><?php echo esc_html( $post->post_title ); ?></li>

					<?php
					 /* ブログ記事 */
					elseif ( is_single() ) :
						$categories = get_the_category( $post->ID );
						$cat = $categories[0];
						if ( $cat->parent != 0 ) :
							$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
							foreach ( $ancestors as $ancestor ) : ?>
								<li><a href="<?php echo esc_url( get_category_link( $ancestor ) ); ?>">
									<?php echo esc_html( get_cat_name( $ancestor ) ); ?></a></li>
								<li>&gt;</li>
							<?php endforeach;
						endif; ?>
						<li><a href="<?php echo esc_url( get_category_link( $cat->cat_ID ) ); ?>">
						<?php echo esc_html( $cat->cat_name );  ?></a></li>
						<li>&gt;</li>
						<li><?php echo esc_html( $post->post_title ); ?></li>

					<?php
					/* 上記以外 */
					else: ?>
						<li><?php wp_title( '', true ); ?></li>
					<?php endif; ?>
				</ul>
			</div>
		<?php endif; ?>

		<?php
		// ここからヘッダー画像（CHAPTER 15）
		if ( ( is_home() && !is_paged() ) || ( is_page() && has_post_thumbnail( $post->ID ) ) ) : ?>
			<div id="header-image">
			<?php
				if ( is_page() ) :
					echo get_the_post_thumbnail( $post->ID, 'header-image' );
				else : ?>
					<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
				<?php
				endif; ?>
			</div>
		<?php
		endif; ?>
<!-- /header.php -->