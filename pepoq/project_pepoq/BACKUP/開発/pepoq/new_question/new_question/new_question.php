<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include('../../php/db_connect.php');
include('../../php/user_data.php');

$user_group_data = get_user_group_data();

$category_and_genre_list = get_category_and_genre();
$category_and_genre_distinct_list = get_category_and_genre_distinct();
foreach ($category_and_genre_distinct_list as $key => $value) {
    $genre_list[] = $value['category_name'];
}

foreach ($genre_list as $key1 => $value1) {
    foreach ($category_and_genre_list as $key2 => $value2) {
        if($value1 == $value2['category_name']) {
            $category_list[$key1][] = $value2;
        }
    }
}

// echo '<pre>';
// print_r($category_list);
// echo '</pre>';
// exit;


//exit;
function get_amount_of_genre()
{

}


function get_category_and_genre()
{
    include('../../php/db_connect.php');
    $sql = $pdo->prepare('SELECT * FROM category_and_genre');
    $sql->execute();
    while($data = $sql->fetch(PDO::FETCH_ASSOC)){
        $category_and_genre_list[] = $data;
    }
    return $category_and_genre_list;
}

function get_category_and_genre_distinct()
{
    include('../../php/db_connect.php');
    $sql = $pdo->prepare('SELECT DISTINCT category_name FROM category_and_genre');
    $sql->execute();
    while($data = $sql->fetch(PDO::FETCH_ASSOC)){
        $category_and_genre_distinct_list[] = $data;
    }
    return $category_and_genre_distinct_list;
}

/**
 * ユーザーが参加しているグループのデータをを取得
 * @return array $user_group_data
 */
function get_user_group_data()
{
    include('../../php/db_connect.php');
    $sql = $pdo->prepare('SELECT * FROM participating_group WHERE user_email = :user_email');
    $sql->bindValue(':user_email', $_SESSION['mypage']['email']);
    $sql->execute();
    while($data = $sql->fetch(PDO::FETCH_ASSOC)){
        $user_group_data[] = $data;
    }
    return $user_group_data;
}

$user_friend_data = get_user_friend_data();
foreach ($user_friend_data as $key => $value) {
    $friend_personal_data_list[] = get_personal_data($value['fr_email']);
}

/**
 * 
 */
function get_user_friend_data()
{
    include('../../php/db_connect.php');
    $sql = $pdo->prepare('SELECT * FROM friend WHERE my_email = :my_email');
    $sql->bindValue(':my_email', $_SESSION['mypage']['email']);
    $sql->execute();
    while($data = $sql->fetch(PDO::FETCH_ASSOC)){
        $user_friend_data[] = $data;
    }
    return $user_friend_data;
}


/**
 * emailからプロフィールデータを取得
 * @param string $email
 * @return array $personal_data
 */
function get_personal_data($email)
{
    include('../../php/db_connect.php');
    $sql = $pdo->prepare('SELECT * FROM personal_data WHERE email = :email');
    $sql->bindValue(':email', $email);
    $sql->execute();
    while($data = $sql->fetch(PDO::FETCH_ASSOC)){
        $personal_data[] = $data;
    }
    return $personal_data;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>コメント</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../common/style/css/common_header.css">
<link href="./css/style.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--drawer format===================================================================================-->
<!----><link rel="stylesheet" href="../../common/style/css/drawer.css"><!--=========================-->
<!----><link rel="stylesheet" type="text/css" href="../../common/style/css/header_style.css"><!--===-->
<!----><script type="text/javascript" src="../../common/style/js/jquery-1.7.2.min.js"></script><!--=-->
<!--================================================================================================-->
<!--loading-->
<script>
$(function() {
  var h = $(window).height();
 
  $('#wrap').css('display','none');
  $('#loader-bg ,#loader').height(h).css('display','block');
});
 
$(window).load(function () { //全ての読み込みが完了したら実行
  $('#loader-bg').delay(900).fadeOut(800);
  $('#loader').delay(600).fadeOut(300);
  $('#wrap').css('display', 'block');
});
 
//10秒たったら強制的にロード画面を非表示
$(function(){
  setTimeout('stopload()',10000);
});
 
function stopload(){
  $('#wrap').css('display','block');
  $('#loader-bg').delay(900).fadeOut(800);
  $('#loader').delay(600).fadeOut(300);
}
</script>
<!--loading-->
<script type="text/javascript">
function functionName()
    {
        var select1 = document.forms.formName.genre; //変数select1を宣言
        var select2 = document.forms.formName.category; //変数select2を宣言
        
        select2.options.length = 0; // 選択肢の数がそれぞれに異なる場合、これが重要
        
        if (select1.options[select1.selectedIndex].value == "not_select")
            {
                select2.options[0] = new Option("ジャンルが未選択です");
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[0]; ?>")
            {
                <?php
                    foreach ($category_list[0] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[1]; ?>")
            {
                <?php
                    foreach ($category_list[1] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[2]; ?>")
            {
                <?php
                    foreach ($category_list[2] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[3]; ?>")
            {
                <?php
                    foreach ($category_list[3] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[4]; ?>")
            {
                <?php
                    foreach ($category_list[4] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[5]; ?>")
            {
                <?php
                    foreach ($category_list[5] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[6]; ?>")
            {
                <?php
                    foreach ($category_list[6] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[7]; ?>")
            {
                <?php
                    foreach ($category_list[7] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[8]; ?>")
            {
                <?php
                    foreach ($category_list[8] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[9]; ?>")
            {
                <?php
                    foreach ($category_list[9] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[10]; ?>")
            {
                <?php
                    foreach ($category_list[10] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[11]; ?>")
            {
                <?php
                    foreach ($category_list[11] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[12]; ?>")
            {
                <?php
                    foreach ($category_list[12] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[13]; ?>")
            {
                <?php
                    foreach ($category_list[13] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[14]; ?>")
            {
                <?php
                    foreach ($category_list[14] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[15]; ?>")
            {
                <?php
                    foreach ($category_list[15] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[16]; ?>")
            {
                <?php
                    foreach ($category_list[16] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[17]; ?>")
            {
                <?php
                    foreach ($category_list[17] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[18]; ?>")
            {
                <?php
                    foreach ($category_list[18] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[19]; ?>")
            {
                <?php
                    foreach ($category_list[19] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[20]; ?>")
            {
                <?php
                    foreach ($category_list[20] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[21]; ?>")
            {
                <?php
                    foreach ($category_list[21] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[22]; ?>")
            {
                <?php
                    foreach ($category_list[22] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value['genre_name'].'");
                            select2.options['.$key.'].value = "'.$value['genre_name'].'";
                        ';
                    }
                ?>
            }

    }
</script>

</head>
<body onLoad="functionName()">

<?php
// echo '<pre>';
// print_r($amount_of_genre);
// echo '</pre>';
// exit;

?>
<div id="page_all" style="">
    <!-- begin header_all-->
    <?php
        include('../../common/header.html');
    ?>
    <!--end header_all-->

    <div class="content">
        <form method="post" action="../../php/add_question.php" name="formName">

            <input type="hidden" name="question_to" value="all">
            
            <select class="select-box" name = "genre" onChange="functionName()">
                <option value="not_select">ジャンルを選択して下さい</option>
                <?php
                foreach ($genre_list as $value) {
                    echo '<option value = "' . $value . '">' . $value . '</option>';
                }
                ?>
            </select>


            <select class="select-box" name = "category">
            </select>


            <div class="new_question_format">
                <textarea name="question" placeholder="何が知りたい？"></textarea>

                <div class="input-item">
                    <label for="checkbox-1">名前を表示して質問</label> 
                    <input style="" type="checkbox" name="register" id="checkbox-1" /> 
                </div>
                <input class="btn" type="submit" value="質問">
            </div>
        </form>
    </div>

</div>

<!--drawer format===========================================================-->
<!----><script src="../../common/style/js/iscroll-min.js"></script><!--=====-->
<!----><script src="../../common/style/js/jquery.drawer.js"></script><!--===-->
<!----><script src="../../common/style/js/side_menu.js"></script><!--=======-->
<!--========================================================================-->
</body>
</html>