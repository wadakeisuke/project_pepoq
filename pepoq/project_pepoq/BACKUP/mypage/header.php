  <!--begin header-->
  <header>
    <div class="tophead f_float" style="padding-top:10px;">
      <span class="logo" style="padding-left:10px;"><a href="../php/logout.php"><img src="../../img/logo.png" width="80px" height="40px"></a></span>
    </div>
    <!--start sidemenu-->
    <div class="drawer drawer-right f_float">
      <header role="banner">
        <div class="drawer-header">
          <button type="button" class="drawer-toggle drawer-hamburger">
            <span class="sr-only">navigation</span><span class="drawer-hamburger-icon"></span>
          </button>
        </div>
        <div class="drawer-main drawer-default">
          <nav class=" drawer-nav" role="navigation">
            <div class="drawer-brand" style="">
              <a href=""></a>
            </div>
            <ul class="drawer-menu">
              <li class="drawer-menu-item">
                <ul class="drawer-submenu">
                  <li class="drawer-submenu-item">
                    <div class="search_boxs">
                      <label for="search" class="off-left">Keyword</label>
                      <form action="../search/search.php" method="post" style="margin-bottom:30px;">
                        <input style="float:left;" type="text" name="search_word" id="search" placeholder="Keyword">
                        <button type="submit" style="float:left;background-color:;">
                          <i class="fa fa-search"></i>
                        </button>
                      </form>
                    </div>
                  </li>
                  <table>
                    <tr>
                      <td><i class="fa fa-home" style="font-size:18px;"></i></td>
                      <td style="padding-left:10px;" class="top_menu"><a href="../mypage/mypage.php" style="font-size:16px;">mypage</a></td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-eye" style="font-size:18px;"></i></td>
                      <td style="padding-left:10px;" class="top_menu"><a href="../profile/profile.php" style="font-size:16px;">you</a></td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-frown-o" style="font-size:18px;"></i></td>
                      <td style="padding-left:10px;" class="top_menu"><a href="../mypage/mypage.php#friends_all" style="font-size:16px;">friend</a></td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-question" style="font-size:18px;"></i></td>
                      <td style="padding-left:10px;" class="top_menu"><a href="../question/question.php" style="font-size:16px;">question</a></td>
                    </tr>

                  </table>
                </ul>
              </li>
              <li class="drawer-menu-item"><i class="fa fa-users" style="text-align:center"></i>
                <ul class="drawer-submenu">
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=#friends_all">すべて<span style="margin-left:5px;">(<?php echo $f_all_num; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=new#friends_all">友達リクエスト<span style="margin-left:5px;">(<?php echo $f_request_num; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=family#friends_all">家族<span style="margin-left:5px;">(<?php echo $f_type_num[0]; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=lover#friends_all">恋人<span style="margin-left:5px;">(<?php echo $f_type_num[1]; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=school#friends_all">小・中学校<span style="margin-left:5px;">(<?php echo $f_type_num[2]; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=high_school#friends_all">高校<span style="margin-left:5px;">(<?php echo $f_type_num[3]; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=college#friends_all">大学・専門<span style="margin-left:5px;">(<?php echo $f_type_num[4]; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=works#friends_all">勤務先<span style="margin-left:5px;">(<?php echo $f_type_num[5]; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=other#friends_all">その他<span style="margin-left:5px;">(<?php echo $f_type_num[6]; ?>)</span></a></li>
                </ul>
              </li>
              <li class="drawer-menu-item" style="background:#111;"><i class="fa fa-cogs"></i>
                <ul class="drawer-submenu">
                  <li class="drawer-submenu-item"><a href="../php/logout.php">ログアウト</a></li>
                  <li class="drawer-submenu-item"><a href="#">StandByについて</a></li>
                  <li class="drawer-submenu-item"><a href="../rules_etc/rules.html">利用規約</a></li>
                  <li class="drawer-submenu-item"><a href="../rules_etc/privacy.html">プライバシー</a></li>
                  <li class="drawer-submenu-item"><a href="../rules_etc/cookie.html">クッキー</a></li>
                  <li class="drawer-submenu-item"><a href="../rules_etc/help.html">ヘルプ</a></li>
                  <li class="drawer-submenu-item"><a href="../rules_etc/contact.php">コンタクト</a></li>
                  <li class="drawer-submenu-item"><a href="../delete/delete_account.php">アカウントの削除</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </div><!-- /.drawer-main -->
      </header><!-- /.site-header -->
    </div><!--end sidemenu-->
  </header>
  <!--end header-->