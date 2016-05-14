<!--bigin searchform-->
<?php
if($_SERVER['SCRIPT_NAME'] == '/pepoq/mypage_home/single_question.php'){
	echo '
<div class="search-boxs">
	<form method="post" action="./php/answer_question.php" name="input_form">
	  <input type="hidden" name="question_id" value="'.$_GET['question_id'].'">
	  <input type="text" name="comment" placeholder="'.$data['name'].'に質問してみる" required>
	  <button type="submit"><i class="fa fa-search"></i></button>
	</form>
</div>
';
}else{
	echo '
<div class="search-boxs">
	<form method="post" action="./php/answer_question.php" name="input_form">
	  <input type="text" name="comment" placeholder="***に質問してみる">
	  <button type="submit"><i class="fa fa-search"></i></button>
	</form>
</div>
';	
}
?>
<!--end searchform-->

<!--Bigin tabmenu-->
<div class="tab_menu">
  <ul>
    <li class="tab_menu_li"><a href="./index.php"><i class="fa fa-home tab_menu_icon"></i></a></li>
    <li class="tab_menu_li"><a href="./friend_all.php"><i class="fa fa-users tab_menu_icon"></i></a></li>
    <li class="tab_menu_li"><a href="#"><i class="fa fa-bell-o tab_menu_icon"></i></a></li>
    <li class="tab_menu_li"><a href="./profile.php"><i class="fa fa-question-circle tab_menu_icon"></i></a></li>
  </ul>
</div>
<!--Bigin tabumenu-->