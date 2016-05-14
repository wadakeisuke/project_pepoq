<?php
/****************************************

		Green functions.php

		テーマ設定用ファイル

*****************************************/

/**
 * メインカラムの幅を指定する変数。下記は 600px を指定（記述推奨）
 * これを記述すると、アップロードした画像の「大」サイズが 600px になります。
 */

if ( ! isset( $content_width ) ) $content_width = 600;


/**
 * <head>内に RSSフィードのリンクを表示するコード
 */

add_theme_support( 'automatic-feed-links' );


/**
 * <head>内に<title>タグを表示するコード
 */

add_theme_support( 'title-tag' );


/**
 * 固定ページで抜粋を利用する場合のコード
 */

add_post_type_support( 'page', 'excerpt' );


/****************************************

		カスタムヘッダー

		カスタムヘッダーの設定は CHAPTER 15 参照

*****************************************/

$args = array(
	'width' 				=> 940,
	'height' 				=> 320,
	'header-text' 			=> false,
	'default-image'			=> get_template_directory_uri() . '/images/default-header.jpg',
);

add_theme_support( 'custom-header', $args );


/****************************************

	アイキャッチ画像

	アイキャッチ機能については、CHAPTER 14 参照

*****************************************/

add_theme_support( 'post-thumbnails' );


/****************************************

	カスタムメニュー

	カスタムメニューについては、CHAPTER 12 参照

*****************************************/

add_theme_support( 'menus' );


/**
 * メニューの「テーマの場所」を定義
 */

register_nav_menu( 'header-navi', 'メインナビゲーション' );
register_nav_menu( 'header-sub-navi', 'サブナビゲーション' );
register_nav_menu( 'footer-navi', 'フッターナビゲーション' );
register_nav_menu( 'footer-left-column', 'フッター左カラム' );
register_nav_menu( 'footer-center-column', 'フッターセンターカラム' );
register_nav_menu( 'footer-right-column', 'フッター右カラム' );


/****************************************

	ウィジット

	Green では、ウィジットはフッターに
	ひとつだけ定義しています。

	ウィジットについては、CHAPTER 11 参照

*****************************************/

register_sidebar( array(
	'name'          => 'フッターウィジット',
	'id' 			=> 'footer-1',
	'description' 	=> 'フッターのウィジットエリアです。',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' 	=> '</div>',
) );



/****************************************

	パンくずリスト

	パンくずリストについては、
	CHAPTER 16, 24, 25 参照

*****************************************/

function breadcrumb() {
	global $wp_query, $post;
	$str = '<nav id="breadcrumb" class="clearfix">' . "\n";
		$str .= '<ul>' . "\n";
			$str .= '<li><a href="' . esc_html( home_url( '/' ) ) . '" class="home">HOME</a></li>' . "\n";
			$str .= '<li>&gt;</li>' . "\n";

			/** 検索結果ページ */
			if ( is_search() ) {
				$total_results = $wp_query->found_posts;
				$str .= '<li>「' . esc_html( get_search_query() ) . '」で検索した結果、' . esc_html( $total_results ) . '件見つかりました。</li>' . "\n";
				wp_reset_postdata();
			}

			/** タグページ */
			elseif ( is_tag() ) {
				$str .= '<li><a href="' . esc_html( home_url( '/' ) ) . 'blog/">ブログ</a></li>' . "\n";
				$str .= '<li>&gt;</li>' . "\n";
				$str .= '<li>タグ : ' .single_tag_title( '' , false ) . '</li>' . "\n";
			}

			/** 404 Not Found ページ */
			elseif ( is_404() ) {
				$str .= '<li>404 Not found</li>' . "\n";
			}

			/** 時系列アーカイブページ */
			elseif ( is_date() ) {
				$str .= '<li><a href="' . esc_html( home_url( '/' ) ) . 'blog/">ブログ</a></li>' . "\n";
				$str .= '<li>&gt;</li>' . "\n";

				/** 日付別アーカイブページ */
				if ( is_day() ) {
					$str .= '<li><a href="' . get_year_link( get_query_var( 'year' ) ) . '">' . get_query_var( 'year' ) . '年</a></li>' . "\n";
					$str .= '<li>&gt;</li>' . "\n";
					$str .= '<li><a href="' . get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) ) . '">' . get_query_var( 'monthnum' ) . '月</a></li>' . "\n";
					$str .= '<li>&gt;</li>' . "\n";
					$str .= '<li>' . get_query_var( 'day' ) . '日</li>' . "\n";
				}

				/** 月別アーカイブページ */
				elseif ( is_month() ) {
					$str .= '<li><a href="' . get_year_link( get_query_var( 'year' ) ) . '">' . get_query_var( 'year' ) . '年</a></li>' . "\n";
					$str .= '<li>&gt;</li>' . "\n";
					$str .= '<li>' .  get_query_var( 'monthnum' ) . '月</li>' . "\n";
				}

				/** 年別アーカイブページ */
				elseif ( is_year() ) {
					$str .= '<li>' . get_query_var( 'year' ) . '年</li>' . "\n";
				}
			}

			/** カスタム投稿「お知らせ」のアーカイブページ */
			elseif ( is_post_type_archive ( 'information' ) ) {
				$str .= '<li>お知らせ一覧</li>' . "\n";
			}

			/** ブログのカテゴリーページ */
			elseif ( is_category() ) {
				$total_results = $wp_query->found_posts;
				$str .= '<li><a href="' . esc_html( home_url( '/' ) ) . 'blog/">ブログ</a></li>' . "\n";
				$str .= '<li>&gt;</li>' . "\n";
				$cat = get_queried_object();
				if ($cat->parent != 0) {
					$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
					foreach ( $ancestors as $ancestor ) {
						$str .= '<li><a href="' . esc_url( get_category_link( $ancestor ) ) . '">' . esc_html( get_cat_name( $ancestor ) ) . '</a></li>' . "\n";
						$str .= '<li>&gt;</li>' . "\n";
					}
				}
				$str .= '<li>' . esc_html( $cat->cat_name ) . '（' . $total_results . '件見つかりました）</li>' . "\n";
				wp_reset_postdata();
			}

			/** 投稿者ページ */
			elseif ( is_author() ) {
				$str .= '<li><a href="' . esc_html( home_url( '/' ) ) . 'blog/">ブログ</a></li>' . "\n";
				$str .= '<li>&gt;</li>' . "\n";
				$str .= '<li>投稿者 : ' .  esc_html( get_the_author_meta( 'display_name', get_query_var( 'author' ) ) ) . '</li>' . "\n";
			}

			/** ブログのメインページ */
			elseif ( is_home() ) {
				$str .= '<li>ブログ</li>';
			}

			/** 固定ページ */
			elseif ( is_page() ) {
				if ( $post->post_parent != 0 ) {
					$ancestors = array_reverse( $post->ancestors );
					foreach ( $ancestors as $ancestor ) {
						$str .= '<li><a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a></li>' . "\n";
						$str .= '<li>&gt;</li>' . "\n";
					}
				}
				$str .= '<li>' . esc_html( $post->post_title ) . '</li>' . "\n";
			}

			/** 添付ファイルページ */
			elseif ( is_attachment() ) {

				if ( $post->post_parent != 0 ) {
					$str .= '<li><a href="' . esc_url( get_permalink( $post->post_parent ) ) . '">' . esc_html( get_the_title( $post->post_parent ) ) . '</a></li>' . "\n";
					$str .= '<li>&gt;</li>' . "\n";
				}
				$str .= '<li>' . esc_html( $post->post_title ) . '</li>' . "\n";
			}

			/** カスタム投稿「お知らせ」の個別ページ */
			elseif ( is_singular( 'information') ) {
				$str .= '<li><a href="' . esc_html( home_url( '/' ) ) . 'information/">お知らせ一覧</a></li>' . "\n";
				$str .= '<li>&gt;</li>' . "\n";
				$str.= '<li>' . single_post_title( '' , false ). '</li>' . "\n";
			}

			/** カスタム投稿「製品」の個別ページ */
			elseif ( is_singular( 'product' ) ) {
				$str .= '<li><a href="' . esc_url( home_url( '/' ) ) . 'products/">製品一覧</a></li>' . "\n";
				$str .= '<li>&gt;</li>' . "\n";
				$terms = get_the_terms( $post->ID, 'roomtype' );
				if ( $terms ) {
					$term = array_shift( $terms );
					$str .= '<li><a href="' . esc_url( get_term_link( $term, 'roomtype' ) ) . '">' . esc_html( $term->name ) . '</a></li>' . "\n";
					$str .= '<li>&gt;</li>' . "\n";
				}
				$str.= '<li>' . single_post_title( '' , false ). '</li>' . "\n";
			}

			/** ブログの個別ページ */
			elseif ( is_singular('post') ) {
				$str .= '<li><a href="' . esc_html( home_url( '/' ) ) . 'blog/">ブログ</a></li>' . "\n";
				$str .= '<li>&gt;</li>' . "\n";
				$categories = get_the_category( $post->ID );
				$cat = $categories[0];
				if ( $cat->parent != 0) {
					$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
					foreach ( $ancestors as $ancestor ) {
						$str .= '<li><a href="' . esc_url( get_category_link( $ancestor ) ) . '">' . esc_html( get_cat_name( $ancestor ) ) . '</a></li>' . "\n";
						$str .= '<li>&gt;</li>' . "\n";
					}
				}
				$str .= '<li><a href="' . esc_url( get_category_link( $cat->cat_ID ) ) . '">' . esc_html( $cat->cat_name ) . '</a></li>' . "\n";
				$str .= '<li>&gt;</li>' . "\n";
				$str .= '<li>' . esc_html( $post->post_title ) . '</li>' . "\n";
			}

			/** タクソノミーページ */
			elseif ( is_tax() ) {
				$str .= '<li><a href="' . esc_url( home_url( '/' ) ) . 'products/">製品一覧</a></li>' . "\n";
				$str .= '<li>&gt;</li>' . "\n";
				$str .= '<li>' . single_cat_title( '' , false ) . '</li>' . "\n";
			}

			/** その他のページ */
			else{
				$str .= '<li>' . wp_title( '', true ) . '</li>' . "\n";
			}
		$str .= '</ul>' . "\n";
	$str .= '</nav>' . "\n";

	echo $str;
}


/****************************************

	JavaScript の読み込み

	CHAPTER 26 参照

*****************************************/

if ( ! is_admin() ) {
	function register_script() {
		wp_register_script( 'green', get_template_directory_uri() . '/js/green.js', array( 'jquery' ), '1.0', true);
	}
	function add_script() {
		register_script();
		wp_enqueue_script( 'green' );
		/** jQuery UI */
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-accordion' );
	}
	add_action( 'init', 'add_script', 10 );
}


/****************************************

	その他 テーマ内で利用しているオリジナル関数

*****************************************/

/**
 * 各ページの見出しを出力するテーマ関数 header.php 内で使用
 */

function green_headline() {
	global $wp_query, $post;
	if ( is_search() ) {
		$str = '<h2 id="search-header">検索結果</h2>' .
		'<h3>SEARCH</h3>';
	}
	elseif ( is_404() ) {
		$str = '<h2>お探しのページは見つかりませんでした ...</h2>' .
		'<h3>SORRY ... Not found</h3>';
	}
	elseif ( is_category() ) {
		$str = '<h2 id="category-header">カテゴリー</h2>' .
		'<h3>Category</h3>';
	}
	elseif ( is_tax() ) {
		$str = '<h2>' . single_cat_title( '' , false ) . '</h2>';
		$str .= '<h3>';
		if ( term_description() ) {
			remove_filter ( 'term_description', 'wpautop' );
			$str .= esc_html( term_description() );
		} else {
			$str .= 'Undefined';
		}
		$str .= '</h3>';
	}
	elseif ( is_home() ) {
		$str = '<h2>ブログ</h2>' .
		'<h3>Blog</h3>';
	}
	elseif ( is_page() ) {
		$str = '<h2>' . single_post_title( '' , false ) . '</h2>';
		if ( get_post_meta( $post->ID, 'sub-title' ) ) {
			$str .= '<h3>' . esc_html( get_post_meta($post->ID, 'sub-title', true ) ) . '</h3>';
		} else {
			$str .= '<h3>Subtitle</h3>';
		}
	}
	elseif ( is_singular( 'information') ) {
		$str = '<h2>お知らせ</h2>' .
		'<h3>Information</h3>';
	}
	elseif ( is_singular( 'product') ) {
		$str = '<h2>製品紹介</h2>' .
		'<h3>Products</h3>';
	}
	elseif ( is_single() ) {
		$str = '<h2>ブログ</h2>' .
		'<h3>Blog</h3>';
	}
	elseif ( is_post_type_archive( 'information' ) ) {
		$str = '<h2>お知らせ一覧</h2>' .
		'<h3>Information</h3>';
	}
	else {
		$str = '<h2>' . wp_title('', true) . '</h2>';
	}

	echo $str;
}


/**
 * タームのスラッグを取得するオリジナル関数（CHAPTER 25）
 */

function get_term_slug() {
	if ( is_tax() ) {
		$term_name = single_tag_title( '', false );
		if ( is_tax( 'roomtype' ) ) {
			$term_properties = get_term_by( 'name', $term_name, 'roomtype' );
		} else {
			$term_properties = get_term_by( 'name', $term_name, 'item' );
		}
		$term_slug = $term_properties->slug;
		return $term_slug;
	} else {
		return false;
	}
}



/**
 * 個別記事のタームを配列に格納するオリジナル関数（CHAPTER 25）
 */

function get_my_terms_array( $taxonomy ) {
	global $post;
	$terms_array = array();
	$terms = get_the_terms( $post->ID, $taxonomy );
	if ( $terms && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$terms_array[] = $term->slug;
		}
	}
	return $terms_array;
}


/**
 * the_excerpt() の [...]を ... に変更
 */

function green_excerpt_more($more) {
	return ' ... ';
}
add_filter('excerpt_more', 'green_excerpt_more');


/**
 * 本文内の任意の文字数を取得するオリジナル関数
 */

function green_excerpt( $length ) {
     global $post;
     $content = mb_substr( strip_tags( $post -> post_content ), 0, $length );
     $content = $content . " ...";
     return $content;
}


/**
 * taxonomy.php、single-product.php で使用 - 左端には alpha、右端には omega というクラスをつけるオリジナル関数
 */

function green_add_class( $obj ) {

	if ( ! $obj ) {
		global $wp_query;
		$obj = $wp_query;
	}
    $current_post = $obj->current_post;
    if ( ( $current_post % 3 ) === 0 ) {
	    $class = 'alpha';
    }
    elseif ( ( $current_post % 3 ) === 2 ) {
    	$class = 'omega';
    }
    else {
	    $class = '';
    }

    return $class;
}


/**
 * 画像表示用ショートコード ... サンプル記事内にダミー画像を利用するためのオリジナルショートコード
 * ダミー画像を使わない場合には削除してください。
 */

function green_default_image( $args ) {
	extract( shortcode_atts( array(
		'img' => '',
	), $args ) );

    if ( $img == 'square' ) {
    	return get_template_directory_uri() . '/images/sample-square.jpg';
    }
    elseif ( $img == 'phone' ) {
	    return get_template_directory_uri() . '/images/phone-number.png';
    }
    elseif ( $img == 'message' ) {
	  	return   get_template_directory_uri() . '/images/top-message.png';
    }
    else {
	    return get_template_directory_uri() . '/images/sample.jpg';
    }
}

add_shortcode( 'image_path', 'green_default_image' );


/**
 * ホームのURLを取得するショートコード ... サンプル記事内でサイト内リンクを貼るためのオリジナルショートコード
 */

function green_get_url() {
	return esc_url( home_url() );
}

add_shortcode( 'home_url', 'green_get_url');
?>