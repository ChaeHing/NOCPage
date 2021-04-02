<?php

$filepath = '/var/www/html/NOCPage-main/NOC+Page.doc';// 메뉴얼위치
$filesize = filesize($filepath);
$path_parts = pathinfo($filepath);
$filename = $path_parts[basename];
$extension = $path_parts[extension];

header("Pragma: public");
header("Expires: 0");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=$filename");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $filesize");

ob_clean();
flush();
readfile($filepath);

?>

<?php // 방문자 통계를 위한 코드 부분 DEVOPS-153

    $page=$_SERVER['REQUEST_URI']; //접속한 페이지주소 (도메인 제외)
    $date=date("Y-m-d H:i:s");//접속한 시간 저장
    $ip=$_SERVER['REMOTE_ADDR'];// 접속한 유저 ip 저장
    $count = "insert into visitor(page, date, ip) values('$page','$date','$ip')";
    // 접속정보 insert 쿼리문
    mysqli_query($link, $count); //데이터베이스에 저장

?>
