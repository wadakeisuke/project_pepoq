<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include('../../php/db_connect.php');
include('../../php/user_data.php');

$genre_list = get_genre_list();
$category_list = get_category_list_for_user($genre_list);
/**
 * DB,genre_listのデータを取得
 * @return array $genre_list
 */
function get_genre_list()
{
    include('../../php/db_connect.php');
    $sql = $pdo->prepare('SELECT * FROM genre_list');
    $sql->execute();
    while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
        $genre_list[] = $data;
    }
    return $genre_list;
}

/**
 * DB,personal_dataのカテゴリを取得
 * @param array $genre_list
 * @return array $category_list
 */
function get_category_list_for_user($genre_list)
{
    include('../../php/db_connect.php');
    foreach ($genre_list as $key => $value) {
        $sql = $pdo->prepare('SELECT * FROM personal_data');
        $sql->bindValue(':genre_key', $value['genre_key']);
        $sql->execute();
        while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
            if($data[$value['genre_key']] == '--' || $data[$value['genre_key']] == '') {
                continue;
            }
            $category_list[$value['genre_key']][] = $data[$value['genre_key']];
        }
    }
    return $category_list;
    
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

        // 性別
        else if (select1.options[select1.selectedIndex].value == "性別")
            {
                <?php
                    $sex_list = [
                        '男性',
                        '女性',
                    ];
                    foreach ($sex_list as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }
        

        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[1]['genre_name']; ?>")
            {
                <?php
                    $age_list = [
                        '10代',
                        '20代',
                        '30代',
                        '40代',
                        '50代',
                        '60代',
                        '70代',
                        '80代',
                    ];
                    foreach ($age_list as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }
        
        // 血液型
        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[2]['genre_name']; ?>")
            {
                <?php
                    $blood_type_list = [
                        'A型',
                        'B型',
                        'O型',
                        'AB型',
                    ];
                    foreach ($blood_type_list as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }

        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[3]['genre_name']; ?>")
            {
                <?php
                    $category_list['settlement'] = array_merge(array_unique($category_list['settlement']));
                    foreach ($category_list['settlement'] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }

        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[4]['genre_name']; ?>")
            {
                <?php
                    $category_list['school'] = array_merge(array_unique($category_list['school']));
                    foreach ($category_list['school'] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }

        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[5]['genre_name']; ?>")
            {
                <?php
                    $category_list['job'] = array_merge(array_unique($category_list['job']));
                    foreach ($category_list['job'] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }

        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[6]['genre_name']; ?>")
            {
                <?php
                    $category_list['place_of_work'] = array_merge(array_unique($category_list['place_of_work']));
                    foreach ($category_list['place_of_work'] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }

        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[7]['genre_name']; ?>")
            {
                <?php
                    $category_list['hobby'] = array_merge(array_unique($category_list['hobby']));
                    foreach ($category_list['hobby'] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }

        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[8]['genre_name']; ?>")
            {
                <?php
                    $category_list['special_skill'] = array_merge(array_unique($category_list['special_skill']));
                    foreach ($category_list['special_skill'] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }

        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[9]['genre_name']; ?>")
            {
                <?php
                    $category_list['my_boom'] = array_merge(array_unique($category_list['my_boom']));
                    foreach ($category_list['my_boom'] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }

        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[10]['genre_name']; ?>")
            {
                <?php
                    $category_list['dream'] = array_merge(array_unique($category_list['dream']));
                    foreach ($category_list['dream'] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }

        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[11]['genre_name']; ?>")
            {
                <?php
                    $category_list['favorite_sports'] = array_merge(array_unique($category_list['favorite_sports']));
                    foreach ($category_list['favorite_sports'] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }

        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[12]['genre_name']; ?>")
            {
                <?php
                    $category_list['favorite_singer'] = array_merge(array_unique($category_list['favorite_singer']));
                    foreach ($category_list['favorite_singer'] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }

        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[13]['genre_name']; ?>")
            {
                <?php
                    $category_list['favorite_book'] = array_merge(array_unique($category_list['favorite_book']));
                    foreach ($category_list['favorite_book'] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }

        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[14]['genre_name']; ?>")
            {
                <?php
                    $category_list['favorite_movie'] = array_merge(array_unique($category_list['favorite_movie']));
                    foreach ($category_list['favorite_movie'] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }

        else if (select1.options[select1.selectedIndex].value == "<?php echo $genre_list[15]['genre_name']; ?>")
            {
                <?php
                    $category_list['favorite_animation'] = array_merge(array_unique($category_list['favorite_animation']));
                    foreach ($category_list['favorite_animation'] as $key => $value) {
                        echo '
                            select2.options['.$key.'] = new Option("'.$value.'");
                            select2.options['.$key.'].value = "'.$value.'";
                        ';
                    }
                ?>
            }
    }
</script>
<!--start google analytics-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-69530483-1', 'auto');
  ga('send', 'pageview');

</script>
<!--end google analytics-->
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
                    echo '<option value = "' . $value['genre_name'] . '">' . $value['genre_name'] . '</option>';
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