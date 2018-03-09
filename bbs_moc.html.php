<?php
  // ここにDBに登録する処理を記述する
if (!empty($_POST)) {
 $nickname = htmlspecialchars($_POST['nickname']);
 $content = htmlspecialchars($_POST['content']);

// ニックネーム
  if ($nickname == '') {
    $nickname_result = 'ニックネームが入力されていません。';
  } else {
    $nickname_result = 'ようこそ' . $nickname .'様';
  }
 
  // お問い合わせ内容
  if ($content == '') {
    $content_result = 'お問い合わせ内容が入力されていません。';
  } else {
    $content_result = 'お問い合わせ内容：' . $content;
  }

 // １．データベースに接続する
  $dsn = 'mysql:dbname=phpkiso;host=localhost';
  $user = 'root';
  $password='';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');


  // ２．SQL文を実行する
  $sql = "INSERT INTO `survey` (`nickname`, `content`) VALUES ( ?, ?)";
  $data = array($nickname,$content);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);


  // ３．データベースを切断する
  $dbh = null;
}
?>


<?php

//コンテンツをデータベースからよび出す
  // $dsn = 'mysql:dbname=phpkiso;host=localhost';
  // $user = 'root';
  // $password='';
  // $dbh = new PDO($dsn, $user, $password);
  // $dbh->query('SET NAMES utf8');

  //  // ２．SQL文を実行する
  // $sql = "SELECT * FROM `survey`";


  // $stmt = $dbh->prepare($sql);
  // $stmt->execute();

  // // データを取得する
  //   while (1) {
  //     $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  //     if ($rec == false) {
  //       break;
  //     }
      
  //     $_nickname = $rec['nickname'];
  //     $_content = $rec['content'];
  //     $box = [];
  //     $box = "<div class='timeline-label label-sita'>
  //                     <h2>
  //                       <a href='#'>$_nickname</a> <span>2016-01-20</span></h2>
  //                     <p><i class='fab fa-jenkins'></i>
  //                       $_content
  //                     </p>
                    
  //                 </div>";
  //   }
  
  // // ３．データベースを切断する
  // $dbh = null;






?>








<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ごーちゃんねる</title>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/form.css">
  <link rel="stylesheet" href="assets/css/timeline.css">
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
  <!-- ナビゲーションバー -->
  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <div class="taitoru">
              <a class="navbar-brand" href="#page-top"><span class="strong-title"><i class="fab fa-earlybirds"></i>
              ごーちゃんねる
              〜この世のカッコ悪いセリフをつぶやく〜
              <i class="fab fa-earlybirds"></i></span></a>
            </div>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
  </nav>

  <!-- Bootstrapのcontainer -->
  <div class="container">
    <!-- Bootstrapのrow -->
    <div class="row">

      <!-- 画面左側 -->
      <div class="col-md-4 content-margin-top">
        <!-- form部分 -->
        <form method="post" action="bbs_moc.html.php">
          <!-- nickname -->
          <div class="form-group">
            <div class="input-group">
              <input type="text" name="nickname" class="form-control" id="validate-text" placeholder="カッコ悪い人のなまえ..." required>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
            </div>
          </div>
          <!-- content -->
          <div class="form-group">
            <div class="input-group" data-validate="length" data-length="4">
              <textarea type="text" class="form-control" name="content" id="validate-length" placeholder="カッコ悪いコメント..." required></textarea>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
            </div>
          </div>
          <!-- つぶやくボタン -->
          <button type="submit" class="btn btn-primary col-xs-12" disabled><i class="fab fa-earlybirds"></i>カッコつける<i class="fab fa-earlybirds"></i></button>
        </form>
      </div>

      <!-- 画面右側 -->
      <div class="col-md-8 content-margin-top">
        <div class="timeline-centered">
          <article class="timeline-entry">
              <div class="timeline-entry-inner">
                  <div class="timeline-icon bg-success">
                      <i class="entypo-feather"></i>
                      <!-- <i class="fa fa-cogs"></i> -->
                      <i class="fab fa-earlybirds"></i>
                  </div>
                  <div class="timeline-label label-sita">
                      <h2>
                        <a href="#">ルルーシュ・ランペルージ</a> <span>2016-01-20</span></h2>
                      <p><i class="fab fa-jenkins"></i>
                      「間違っていたのは俺じゃない、世界の方だ」by.ルルーシュ・ランペルージ</p>
                    
                  </div>
                  <div class="timeline-label label-sita">
                      <h2>
                        <a href="#">夜神月</a> <span>2016-01-20</span></h2>
                      <p><i class="fab fa-jenkins"></i>
                      「僕は新世界の神となる！」 by.夜神月</p>
                    
                  </div>
                  <div class="timeline-label label-sita">
                      <h2>
                        <a href="#">うちはサスケ</a> <span>2016-01-20</span></h2>
                      <p><i class="fab fa-jenkins"></i>
                      「この眼は闇が良く見える」 by.うちはサスケ</p>
                    
                  </div>
                  <div class="timeline-label label-sita">
                      <h2>
                        <a href="#">上条当麻</a> <span>2016-01-20</span></h2>
                      <p><i class="fab fa-jenkins"></i>
                      ｢その幻想をぶち殺す!!｣by.上条当麻</p>
                    
                  </div>
                  <div class="timeline-label label-sita">
                      <h2>
                        <a href="#">渚カヲル</a> <span>2016-01-20</span></h2>
                      <p><i class="fab fa-jenkins"></i>
                      「ガラスのように繊細だね。特に君の心は」by.渚カヲル</p>
                    
                  </div>
                  <div class="timeline-label label-sita">
                      <h2>
                        <a href="#">げん</a> <span>2016-01-20</span></h2>
                      <p><i class="fab fa-jenkins"></i>
                      「おれの水曜日だ！」 by.げん</p>
                    
                  </div>
<?php 
                  //コンテンツをデータベースからよび出す
  $dsn = 'mysql:dbname=phpkiso;host=localhost';
  $user = 'root';
  $password='';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');

   // ２．SQL文を実行する
  $sql = "SELECT * FROM `survey`";


  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  // データを取得する
  while (1) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rec == false) {
      break;
    }
    
    $_nickname = $rec['nickname'];
    $_content = $rec['content'];
    $box = [];
    $box = "<div class='timeline-label label-sita'>
                    <h2>
                      <a href='#'>$_nickname</a> <span>2016-01-20</span></h2>
                    <p><i class='fab fa-jenkins'></i>
                      $_content
                    </p>
                    
                  </div>";
    echo $box;
  }
        
  // ３．データベースを切断する
  $dbh = null;


  ?>







              </div>
          </article>

          <article class="timeline-entry begin">
              <div class="timeline-entry-inner">
                  <div class="timeline-icon" style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);">
                      <i class="entypo-flight"></i> 
                      <i class="fab fa-earlybirds"></i>
                  </div>
              </div>
          </article>
        </div>
      </div>

    </div>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/form.js"></script>
</body>
</html>



