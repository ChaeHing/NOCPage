<html lang="ko-kr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NOC Page</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/kfonts2.css" rel="stylesheet">

    <style>
      body{padding-top:70px;}
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

    <?php // DB내 공지사항데이터(content)를 가져오기 위한 부분
 
      include("dbconnect.php");

      $sql= "SELECT content FROM `notice`;";
      $result=mysqli_query($link,$sql);
      $row=mysqli_fetch_assoc($result);
      $nl2br=nl2br($row['content']); // n12br변수에 n12br 함수로 DB내 데이터를 저장

    ?>

<?php // 방문자 통계를 위한 코드 부분 DEVOPS-153

    $page=$_SERVER['REQUEST_URI']; //접속한 페이지주소 (도메인 제외)
    $date=date("Y-m-d H:i:s");//접속한 시간 저장
    $ip=$_SERVER['REMOTE_ADDR'];// 접속한 유저 ip 저장
    $count = "insert into visitor(page, date, ip) values('$page','$date','$ip')";
    // 접속정보 insert 쿼리문
    mysqli_query($link, $count); //데이터베이스에 저장

?>


  <body>

  <div class="container-fluid">  

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><p class="text-danger">NOC Page</p></a>
      </div>
     
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li><a href="Monitoring.php">Monitoring</a></li>
          <li><a href="Neocast.php">Neocast</a></li>
          <li><a href="Etc.php">Etc</a></li>
          <li><a href="Ism.php">ISM</a></li>
          <li class="active"><a href="Notice.php">Notice</a></li>
          <li><a href="Setting.php">Setting</a></li>
         <!-- <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">드롭다운 <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">서브메뉴 1</a></li>
              <li><a href="#">서브메뉴 2</a></li>
              <li><a href="#">서브메뉴 3</a></li>
            </ul>
          </li> -->
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="Download.php"><span class="glyphicon glyphicon-download-alt"></span> Manual Download</a> <!-- 메뉴얼 다운로드 -->
          </li>
          <li><!-- 검색을 위해 post로 Search.php로 값 넘기기 -->    
              <form class="navbar-form" role="search" action="Search.php" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="검색" name="search_word">
                </div>
              <button type="submit" class="btn btn-default">검색</button>
              </form>
          </li>    
        </ul> 
      </div><!-- /.navbar-collapse -->
    </nav>

    <div class="panel panel-default">
      <div class="panel-heading text-center">
        <h2 class="panel-title">공지사항</h3>
      </div>
      <div class="panel-body">
        <?php echo $nl2br; //공지사항내 데이터를 출력?>
      </div>
    </div>
    <div class="text-center">
      <a href="./Modify.php" class="btn btn-default" role="button">수정</a> <!-- 버튼 클릭시 수정페이지로 이동 -->
    </div>

  <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
  <center><img src="logo.png" alt="logo"></center>
  </nav>

  </div> <!-- container 끝 -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>