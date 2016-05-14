<?php
/****************************************

	searchform.php

	検索フォームを表示するテンプレートファイル

*****************************************/
?>

<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" value="<?php the_search_query(); ?>" name="s" class="search-field" />
	<input type="submit" class="search-submit" value="" />
</form>