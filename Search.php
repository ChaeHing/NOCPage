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
          <li><a href="ADP.php">ADP</a></li>
          <li><a href="Etc.php">Etc</a></li>
          <li><a href="Notice.php">Notice</a></li>
          <li><a href="Ism.php">ISM</a></li>
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

<?php

  function type($type) // 출력 함수  Search_word값을 $type으로 받음
  {

    include("dbconnect.php");

    $sql= "(select * from Monitoring where NAME like '%$type%' or TITLE like '%$type%') union (select * from Neocast where NAME like '%$type%' or TITLE like '%$type%') union (select * from Etc where NAME like '%$type%' or TITLE like '%$type%')"; // union 추가 DEVOPS-151

    $result=mysqli_query($link, $sql);

    //패널 생성
    echo "<div class='col-md-4'>\n";
    echo "<div class='panel panel-default'>\n";
    echo "<div class='panel-heading'>\n";
    echo "<h2 class='panel-title'>Search</h2>\n"; // 패널 제목
    echo "</div>\n";
    echo "<div class='panel-body'>\n";

    // 패널에 값넣기
    $check = mysqli_fetch_array($result); // 검색결과를 체크하기 위해 변수에 담기
  
    if(!$check) // 검색시 일치하는 결과가 없으면 출력 
    {
      echo "일치하는 결과가 없습니다.";
    }else{ // 검색결과가 있으면 출력

      $result=mysqli_query($link, $sql);    
      while($row = mysqli_fetch_array($result)){

        $url = $row['URL'];
        $name = $row['NAME'];

        echo "<a href='$url' target=_blank>$name</a>";
        echo "<br>";
      }
    }
    echo "</div>\n</div>\n</div>\n"; // 패널 닫기

  }

?>

<?php 

  $search_word = $_POST['search_word']; // form으로 입력받은 데이터를 변수에 저장

  type("$search_word"); // 출력 함수

?>

<?php // 방문자 통계를 위한 코드 부분 DEVOPS-153

    $page=$_SERVER['REQUEST_URI']; //접속한 페이지주소 (도메인 제외)
    $date=date("Y-m-d H:i:s");//접속한 시간 저장
    $ip=$_SERVER['REMOTE_ADDR'];// 접속한 유저 ip 저장
    $count = "insert into visitor(page, date, ip) values('$page','$date','$ip')";
    // 접속정보 insert 쿼리문
    mysqli_query($link, $count); //데이터베이스에 저장

?>

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

