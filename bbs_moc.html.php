<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
if (!empty($_POST)) {
 $nickname = htmlspecialchars($_POST['nickname']);
 $content = htmlspecialchars($_POST['content']);

// バリデーション フロントサイドで入力の制限をしているのでなし
// ニックネーム
//   if ($nickname == '') {
//     $nickname_result = 'カッコ悪い人のなまえが入力されていません。';
//   }
// コンテント
//   if ($content == '') {
//     $content_result = 'カッコ悪いコメントが入力されてません。';
//   } 

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
header('Location:http://localhost/bbs/oneline_bbs-master/bbs_moc.html.php', true, 303);
}
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
                  
<?php

  //コンテンツをデータベースからよび出す
  $dsn = 'mysql:dbname=phpkiso;host=localhost';
  $user = 'root';
  $password='';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');

   // ２．SQL文を実行する
  // $sql = "SELECT * FROM `survey`";
  $sql = "SELECT * FROM `survey` ORDER BY `modified` DESC";

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
    $_modified = $rec['modified'];
    $box = [];
    $box = "<div class='timeline-icon bg-success'>
                      <i class='entypo-feather'></i>
                      <i class='fab fa-earlybirds'></i>
            </div>
            <div class='timeline-label label-sita'>
              <h2>
                <a href='#'>$_nickname</a><span>$_modified</span>
              </h2>
              <p><i class='fab fa-jenkins'></i>$_content</p>
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



