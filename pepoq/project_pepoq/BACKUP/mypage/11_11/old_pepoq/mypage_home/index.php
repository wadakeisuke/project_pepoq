<?php
session_start();
require('./php/db_connect.php');
require('./php/mypage_data.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>drawer</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<!-- drawer css -->
<link rel="stylesheet" href="css/drawer.min.css">
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/question.css">
<!-- jquery & iscroll & dropdown -->
<script src="js/jquery.min.js"></script>
<script src="js/iscroll-min.js"></script>
<script src="js/dropdown.min.js"></script>

<!-- drawer js -->
<script src="js/jquery.drawer.min.js"></script>
<script>
$(document).ready(function() {
  $(".drawer").drawer();
});
</script>

</head>

<body>
<div class="pageall">
<!--bigin header-->
<?php
include('./header.html');
?>
<!--end header-->

<div class="content">

<div class="question_all">

<?php
$sql=$pdo->prepare('SELECT * FROM question');
$sql->execute();
while($question = $sql->fetch(PDO::FETCH_ASSOC)){
$questioner = $pdo->prepare('SELECT * FROM personal_data WHERE email = :email');
$questioner->bindValue(':email',$question['email']);
$questioner->execute();
$data = $questioner->fetch(PDO::FETCH_ASSOC);
echo'
    <div class="question_box">
      <div class="question_img_item float_left"><img src="../img/thumbnail/'.$data['thumbnail'].'" style="width=50px;height:50px;"></div>
      <div class="question_name_item float_left"><p>'.$data['name'].'</p></div>
        <div class="question_text_item">
        '.$question['question'].'
        </div>
        <div class="question_button">
          <ul class="question_button_ul">
            <li class="float_left">いいね</li><li class="float_left"><a href="single_question.php?question_id='.$question['id'].'">コメント</a></li>
          </ul>
        </div>
    </div>
';
}

?>
</div>


<!--begin menu-->
<?php
include('./menu.html');
?>
<!--end menu-->

</div>
<script>
// Option
$(".drawer").drawer({
  apiToggleClass: "element"
});

// Open
$('.element').on(function)() {
  $('.drawer').drawer('open');
});

// close
$('.element').on(function)() {
  $('.drawer').drawer('close');
});

// toggle
$('.element').on(function)() {
  $('.drawer').drawer('toggle');
});

// destroy
$('.element').on(function)() {
  $('.drawer').drawer('destroy');
});
</script>
</body>
</html>