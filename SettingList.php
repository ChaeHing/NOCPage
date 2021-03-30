<?php

//DEVOPS-157

include("dbconnect.php");

$type = $_POST['type'];
$menu = $_POST['menu'];
$title = $_POST['title'];
$utype = $_POST['utype'];

if($type=="name") //  불러오는 목록에 따라 if로 분류 ($type)
{

	$option="";

	$sql = "select NAME from $menu where TITLE = '$title'";

	$result = mysqli_query($link, $sql);

	while ($row = mysqli_fetch_array($result))
	{
    	$option=$option.'<option value="'.$row['NAME'].'">'.$row['NAME'].'</option>'; // select option 저장
	}

	echo $option; // select option 출력 -> Setting.php

}


if($type=="title")
{

	$option="";

	$sql="select distinct TITLE from $menu";
	#echo $sql;

	$result = mysqli_query($link, $sql);

	while ($row = mysqli_fetch_array($result))
	{
    	$option=$option.'<option value="'.$row['TITLE'].'">'.$row['TITLE'].'</option>';
	}

	echo $option;
}

if($type=="update")
{
	$option="";

	$sql="select distinct $utype from $menu";
	#echo $sql;

	$result = mysqli_query($link, $sql);

	while ($row = mysqli_fetch_array($result))
	{
		if($utype=="TITLE") // $row['변수']로는 데이터를 가져올수 없어 if로 update할 타입을 분류하여 저장 
		{
    	$option=$option.'<option value="'.$row['TITLE'].'">'.$row['TITLE'].'</option>';
    	}
    	if($utype=="NAME")
		{
    	$option=$option.'<option value="'.$row['NAME'].'">'.$row['NAME'].'</option>';
    	}
    	if($utype=="URL")
		{
    	$option=$option.'<option value="'.$row['URL'].'">'.$row['URL'].'</option>';
    	}

	}

	echo $option;

}

?>