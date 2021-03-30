<?php

	$link=mysqli_connect("localhost","root","solbox", "nocpage");

	mysqli_set_charset($link, 'utf8');

    if(!$link){
      die("Connection failed: " . mysqli_connect_error());
    }

?>