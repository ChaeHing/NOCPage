<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// NULL 입력 검사
    	if (empty($_POST["title"]) || empty($_POST["name"]) || empty($_POST["url"]) ) {

        	$nameMsg = "입력값이 없습니다."; // NULL 값 입력시

  		} else { // 정상입력시

	    	$menu = $_POST['menu']; // 메뉴
			$title = $_POST['title']; // 타이틀
			$name = $_POST['name']; // 사이트명
			$url = $_POST['url']; // url

			include("dbconnect.php");

    		$sql = "insert into $menu (TITLE, NAME, URL) values('$title','$name','$url')"; // 선택한 메뉴에 입력받은값 insert

    		mysqli_query($link, $sql);

   		}
	}
	
?>

<script>
   history.go(-1); // 이전페이지로
</script>


<?php // 방문자 통계를 위한 코드 부분 DEVOPS-153

    $page=$_SERVER['REQUEST_URI']; //접속한 페이지주소 (도메인 제외)
    $date=date("Y-m-d H:i:s");//접속한 시간 저장
    $ip=$_SERVER['REMOTE_ADDR'];// 접속한 유저 ip 저장
    $count = "insert into visitor(page, date, ip) values('$page','$date','$ip')";
    // 접속정보 insert 쿼리문
    mysqli_query($link, $count); //데이터베이스에 저장

?>

