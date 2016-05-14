<?php
session_start();
include('../php/db_connect.php');
include('../php/user_data.php');

$user_group_data = get_user_group_data();

/**
 * ユーザーが参加しているグループのデータをを取得
 * @return array $user_group_data
 */
function get_user_group_data()
{
	include('../php/db_connect.php');
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
	include('../php/db_connect.php');
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
	include('../php/db_connect.php');
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
<link rel="stylesheet" type="text/css" href="../common/style/css/common_header.css">
<link href="./css/style.css" rel="stylesheet">
<script type="text/JavaScript">
<!--
function changeform() {
    doc = document.searchbox.pref;
    if (document.searchbox.area.value == 1) {
        doc.length = 8;
				doc.options[0].text = "全員";

				doc.options[1].text = "早稲田大学";
				doc.options[1].value = 1;

				doc.options[2].text = "慶應義塾大学";
				doc.options[2].value = 2;

				doc.options[3].text = "上智大学";
				doc.options[3].value = 3;

				doc.options[4].text = "学習院大学";
				doc.options[4].value = 4;

				doc.options[5].text = "明治大学";
				doc.options[5].value = 5;

				doc.options[6].text = "青山学院大学";
				doc.options[6].value = 6;

				doc.options[7].text = "立教大学";
				doc.options[7].value = 7;
    } else if (document.searchbox.area.value == 2) {
				doc.length = 9;
				doc.options[0].text = "選択してください";

				doc.options[1].text = "アクションゲーム";
				doc.options[1].value = 8;

				doc.options[2].text = "ロールプレイングゲーム";
				doc.options[2].value = 9;

				doc.options[3].text = "ノベルゲーム";
				doc.options[3].value = 10;

				doc.options[4].text = "ホラーゲーム";
				doc.options[4].value = 11;

    } else if (document.searchbox.area.value == 3) {
				doc.length = 2;
				doc.options[0].text = "全員";
				<?php
				$i = 1;
				$j = 15;
				foreach ($friend_personal_data_list as $key => $value) {
					echo 'doc.options['.$i.'].text = "'.$value[0]['name'].'";';
					echo 'doc.options['.$i.'].value = '.$j.';';
					$i++;
					$j++;
				}
				?>


    } else if (document.searchbox.area.value == 4) {
				doc.length = 6;
				doc.options[0].text = "選択してください";

				doc.options[1].text = "パチンコ";
				doc.options[1].value = 21;

				doc.options[2].text = "スロット";
				doc.options[2].value = 22;

				doc.options[3].text = "競馬";
				doc.options[3].value = 23;

				doc.options[4].text = "競輪";
				doc.options[4].value = 24;

				doc.options[5].text = "オートレース";
				doc.options[5].value = 25;
    } else if (document.searchbox.area.value == 5) {
				doc.length = 16;
				doc.options[0].text = "お選びください。";

				doc.options[1].text = "滋賀県";
				doc.options[1].value = 25;

				doc.options[2].text = "京都府";
				doc.options[2].value = 26;

				doc.options[3].text = "大阪府";
				doc.options[3].value = 27;

				doc.options[4].text = "兵庫県";
				doc.options[4].value = 28;

				doc.options[5].text = "奈良県";
				doc.options[5].value = 29;

				doc.options[6].text = "和歌山県";
				doc.options[6].value = 30;

				doc.options[7].text = "鳥取県";
				doc.options[7].value = 31;

				doc.options[8].text = "島根県";
				doc.options[8].value = 32;

				doc.options[9].text = "岡山県";
				doc.options[9].value = 33;

				doc.options[10].text = "広島県";
				doc.options[10].value = 34;

				doc.options[11].text = "山口県";
				doc.options[11].value = 35;

				doc.options[12].text = "徳島県";
				doc.options[12].value = 36;

				doc.options[13].text = "香川県";
				doc.options[13].value = 37;

				doc.options[14].text = "愛媛県";
				doc.options[14].value = 38;

				doc.options[15].text = "高知県";
				doc.options[15].value = 39;
    } else if (document.searchbox.area.value == 6) {
				doc.length = 10;
				doc.options[0].text = "お選びください。";
				doc.options[1].text = "鳥取県";
				doc.options[1].value = 31;
				doc.options[2].text = "島根県";
				doc.options[2].value = 32;
				doc.options[3].text = "岡山県";
				doc.options[3].value = 33;
				doc.options[4].text = "広島県";
				doc.options[4].value = 34;
				doc.options[5].text = "山口県";
				doc.options[5].value = 35;
				doc.options[6].text = "徳島県";
				doc.options[6].value = 36;
				doc.options[7].text = "香川県";
				doc.options[7].value = 37;
				doc.options[8].text = "愛媛県";
				doc.options[8].value = 38;
				doc.options[9].text = "高知県";
				doc.options[9].value = 39;
    } else if (document.searchbox.area.value == 7) {
				doc.length = 9;
				doc.options[0].text = "お選びください。";
				doc.options[1].text = "福岡県";
				doc.options[1].value = 40;
				doc.options[2].text = "佐賀県";
				doc.options[2].value = 41;
				doc.options[3].text = "長崎県";
				doc.options[3].value = 42;
				doc.options[4].text = "熊本県";
				doc.options[4].value = 43;
				doc.options[5].text = "大分県";
				doc.options[5].value = 44;
				doc.options[6].text = "宮崎県";
				doc.options[6].value = 45;
				doc.options[7].text = "鹿児島県";
				doc.options[7].value = 46;
				doc.options[8].text = "沖縄県";
				doc.options[8].value = 47;
    } else {
				doc.length = 1;
				doc.options[0].text = "お選びください。";
    }
}
//-->
</script>
</head>
<body> 
<div id="page_all" style="">
	<!-- begin header_all-->
	<div id="header_all">			
		<div id="upper_header">
			<div id="page_back">
				<a onclick="history.back()"><i class="fa fa-angle-left icon"></i></a>
			</div>
			<div id="page_title">検索する</div>
		</div>

	</div>
	<!--end header_all-->
 				
	<div class="content">
		<form method="post" action="../php/add_question.php" name="searchbox">
			<select class="select-box" name="area" onChange="changeform()">
				<option value="0" selected>質問相手の種類</option>
				<option value=1>大学</option>
				<option value=2>ゲーム</option>
				<option value=3>友達</option>
				<option value=4>ギャンブル</option>
				<option value=5>住んでいるところ</option>
			</select>
			<select class="select-box" name="pref">
				<option value="">選択してください</option>
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
</body>
</html>