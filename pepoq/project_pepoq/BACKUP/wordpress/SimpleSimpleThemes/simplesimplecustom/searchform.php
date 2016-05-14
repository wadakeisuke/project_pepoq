<?php
/****************************************

	searchform.php
	検索フォーム部分のテンプレートファイルです。

*****************************************/
?>
<!-- searchform.php -->
<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
	<input type="text" placeholder="検索" name="s" class="serach-field" value="" />
	<input type="submit" class="search-submit" value="" />
</form>
<!-- /searchform.php -->