<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include('../php/db_connect.php');
include('../php/user_data.php');

$user_group_data = get_user_group_data();

$category_and_genre_list = get_category_and_genre();
$category_and_genre_distinct_list = get_category_and_genre_distinct();

$i = 0;
foreach ($category_and_genre_distinct_list as $value1) {
	foreach ($category_and_genre_list as $value2) {
		if ($value1['category_name'] == $value2['category_name']) {
			$genre_list[$i][] = $value2['category_name'];
		}

	}
	$amount_of_genre[] = count($genre_list[$i]);
	$i++;
}

// echo '<pre>';
// print_r($category_and_genre_list);
// print_r($category_and_genre_distinct_list);
// print_r($amount_of_genre);
// echo '</pre>';

//exit;
function get_amount_of_genre()
{

}


function get_category_and_genre()
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM category_and_genre');
	$sql->execute();
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		$category_and_genre_list[] = $data;
	}
	return $category_and_genre_list;
}

function get_category_and_genre_distinct()
{
	include('../php/db_connect.php');
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
    	//必要なもの
    	//要素数
        doc.length = <?php echo $amount_of_genre[0]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = 1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[0]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
        ?>



    } else if (document.searchbox.area.value == 2) {
    	doc.length = <?php echo $amount_of_genre[1]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[0]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[1]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>

    } else if (document.searchbox.area.value == 3) {
		doc.length = <?php echo $amount_of_genre[2]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[1]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[2]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 4) {
		doc.length = <?php echo $amount_of_genre[3]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[2]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[3]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 5) {
		doc.length = <?php echo $amount_of_genre[4]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[3]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[4]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 6) {
		doc.length = <?php echo $amount_of_genre[5]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[4]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[5]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 7) {
		doc.length = <?php echo $amount_of_genre[6]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[5]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[6]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 8) {
		doc.length = <?php echo $amount_of_genre[7]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[6]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[7]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 9) {
		doc.length = <?php echo $amount_of_genre[8]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[7]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[8]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 10) {
		doc.length = <?php echo $amount_of_genre[9]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[8]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[9]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 11) {
		doc.length = <?php echo $amount_of_genre[10]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[9]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[10]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 12) {
		doc.length = <?php echo $amount_of_genre[11]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[10]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[11]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 13) {
		doc.length = <?php echo $amount_of_genre[12]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[11]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[12]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 14) {
		doc.length = <?php echo $amount_of_genre[13]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[12]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[13]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 15) {
		doc.length = <?php echo $amount_of_genre[14]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[13]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[14]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 16) {
		doc.length = <?php echo $amount_of_genre[15]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[14]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[15]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 17) {
		doc.length = <?php echo $amount_of_genre[16]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[15]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[16]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 18) {
		doc.length = <?php echo $amount_of_genre[17]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[16]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[17]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 19) {
		doc.length = <?php echo $amount_of_genre[18]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[17]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[18]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 20) {
		doc.length = <?php echo $amount_of_genre[19]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[18]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[19]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 21) {
		doc.length = <?php echo $amount_of_genre[20]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[19]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[20]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 22) {
		doc.length = <?php echo $amount_of_genre[21]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[20]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[21]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else if (document.searchbox.area.value == 23) {
		doc.length = <?php echo $amount_of_genre[22]+1; ?>; //配列の要素数を決定する amount_of_genre 12
        doc.options[0].text = "選択してください";
        <?php

        $i = 1;
        $j = $amount_of_genre[21]+1;
        foreach ($category_and_genre_list as $key => $value) {
        	if ($value['category_name'] == $category_and_genre_distinct_list[22]['category_name']) {
        		echo '
        		doc.options['.$i.'].text = "'.$value['genre_name'].'";
				doc.options['.$i.'].value = '.$j.';
				';
        		$i++;
        		$j++;
        	}
        }
		?>
    } else {
				doc.length = 1;
				doc.options[0].text = "お選びください。";
    }
}
//-->
</script>
</head>
<body> 

<?php
// echo '<pre>';
// print_r($amount_of_genre);
// echo '</pre>';
// exit;

?>
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
				<?php 
				$i = 1;
				foreach ($category_and_genre_distinct_list as $key => $value) {
					echo '<option value=' .$i. '>' .$value['category_name'].'</option>';
					$i++;
				}
				?>
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