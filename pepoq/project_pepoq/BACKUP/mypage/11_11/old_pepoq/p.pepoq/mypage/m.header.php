  <!--begin header_all-->
  <div id="header_all">
    <div id="header">
      <div id="logo">
        <a href="../php/logout.php"><img src="../../img/logo.png" width="120px"></a>
      </div>
      <div id="serch_form">
        <form method="post" action="../search/search.php">
          <input name="serch" type="text" placeholder="Serch Friends" maxlength="20">
        </form>
      </div>
      <div id="menu">
        <ul id="idmenu" class="bluemenu">
          <li><a href="../mypage/mypage.php">mypage</a></li>
          <li><a href="../profile/profile.php">profile</a></li>
          <li>friends
            <ul>     
              <li><a href="../mypage/mypage.php#lower_content">全て<span class="friends_num">(<?php echo $f_all_num; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_content">友達リクエスト<span class="friends_num">(<?php echo $f_request_num; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_content">家族<span class="friends_num">(<?php echo $f_type_num[0]; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_content">恋人<span class="friends_num">(<?php echo $f_type_num[1]; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_content">小・中学校<span class="friends_num">(<?php echo $f_type_num[2]; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_content">高校<span class="friends_num">(<?php echo $f_type_num[3]; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_content">大学・専門<span class="friends_num">(<?php echo $f_type_num[4]; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_content">勤務先<span class="friends_num">(<?php echo $f_type_num[5]; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_contentt">その他<span class="friends_num">(<?php echo $f_type_num[6]; ?>)</span></a></li>
            </ul>
          </li>
          <li>Questions
            <ul>
              <li><a href="../question/question.php">New Question<span class="friends_num">(<?php echo $new_question_num; ?>)</span></a></li>
            </ul>
          </li>
          <li>Other
            <ul>
                <li><a href="../php/logout.php"><div class="friends_type">ログアウト</div><span class="friends_num"></span></a></li>
                <li><a href="../about/about.html"><div class="friends_type">pepoQについて</div><span class="friends_num"></span></a></li>
                <li><a href="../rules_etc/rules.html"><div class="friends_type">利用規約</div><span class="friends_num"></span></a></li>
                <li><a href="../rules_etc/help.html"><div class="friends_type">ヘルプ</div><span class="friends_num"></span></a></li>
                <li><a href="../rules_etc/contact.php"><div class="friends_type">お問い合わせ</div><span class="friends_num"></span></a></li>
                <li><a id="go" rel="leanModal" href="#delete_account"><div class="friends_type">アカウントの削除</div><span class="friends_num"></span></a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--end header_all-