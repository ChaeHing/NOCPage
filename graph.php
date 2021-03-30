<!DOCTYPE html> <!-- DEVOPS-153 방문자통계 그래프 페이지 -->

<html lang="en"> <!-- <html lang="en" style="height: 100%"> --> 

<head> 
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
  <title>chart</title> 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> <!-- 차트 링크 --> 
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> 
</head> 


<?php

    function totalpagecount($page){ //page별 totla count 출력

    include("dbconnect.php");

    $sql= "select count(*) from visitor where page = '$page' and ip not in('192.168.0.105')"; // 페이지별로 count를 select 내 pc ip를 제외

    $result=mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    $count=$row[0];

    echo "$count"; // count 출력

  }

  function weekdate($date){ // week graph label에 날짜를 자동화 하기 위한 함수
  
  $date=date("Y-m-d", strtotime("$date days")); //입력받은 $date를 통해 날짜 구하기
  echo "$date";
  
  }

  function weekcount($date){ //전체페이지 week 카운터 출력 함수

    include("dbconnect.php");

    $week=date("Y-m-d", strtotime("$date days")); // 입력받은 $date를 통해 날짜 구하기

    $sql= "select count(*) from visitor where ip not in('192.168.0.105') and DATE(date)  = '$week'"; // 전체페이지 count를 select 내 pc ip를 제외

    $result=mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    $count=$row[0];

    echo "$count"; // count 출력

  }


  function todaypagecount($page){ //page별 today count 출력 함수

    include("dbconnect.php");

    $today=date("Y-m-d");

    $sql= "select count(*) from visitor where page = '$page' and ip not in('192.168.0.105') and DATE(date)  = '$today'"; // 페이지별로 count를 select 내 pc ip를 제외

    $result=mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    $count=$row[0];

    echo "$count"; // count 출력

  }

  function lastweek($page){ // page별 last week (-7) count 출력

    include("dbconnect.php");

    $lastweek=date("Y-m-d", strtotime("-7 days"));

    $sql= "select count(*) from visitor where page = '$page' and ip not in('192.168.0.105') and DATE(date)  = '$lastweek'"; // 페이지별로 count를 select 내 pc ip를 제외

    $result=mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    $count=$row[0];

    echo "$count"; // count 출력

  }

?>

<body> 
  <div class="container">
    <h3>total graph</h3>
    <canvas id="totalChart"></canvas>
    <h3>week graph</h3>
    <canvas id="WeekChart"></canvas> 
<!--  <div class="row my-3"> 
    <div class="col"> 
      <h4>Compare Today to Last Week Count</h4> 
    </div> 
  </div> 
  <div class="row my-2"> 
    <div class="col-md-6"> 
      <div class="card"> 
        <div class="card-body">  -->
          <h3>last week Compare grahp</h3>
          <canvas class="CompareChart"></canvas> 
        <!--</div> 
      </div> 
    </div> 
  </div> -->
</div> <!-- container --> 



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> 

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> 

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    
  </script> <!-- 차트 --> 


  <script>
    
    var ctx = document.getElementById('totalChart'); 
    var totalChart = new Chart(ctx, { 
      type: 'bar', 
      data: { 
        labels: 
        ['Main', 'Monitoring', 'Neocast', 'Etc', 'ISM', 'Notice', 'Setting'],
       datasets: [{ label: '# of Votes', 
       data: [ <?php totalpagecount('/'); ?>, <?php totalpagecount('/Monitoring.php'); ?>, <?php totalpagecount('/Neocast.php'); ?>, <?php totalpagecount('/Etc.php'); ?>, <?php totalpagecount('/Notice.php'); ?>, <?php totalpagecount('/Ism.php'); ?>, <?php totalpagecount('/Setting.php'); ?> ], 
       backgroundColor: [ 
       'rgba(255, 99, 132, 0.2)', 
       'rgba(54, 162, 235, 0.2)', 
       'rgba(255, 206, 86, 0.2)', 
       'rgba(75, 192, 192, 0.2)', 
       'rgba(153, 102, 255, 0.2)', 
       'rgba(255, 159, 64, 0.2)' ], 
       borderColor: [ 
       'rgba(255, 99, 132, 1)', 
       'rgba(54, 162, 235, 1)', 
       'rgba(255, 206, 86, 1)', 
       'rgba(75, 192, 192, 1)', 
       'rgba(153, 102, 255, 1)', 
       'rgba(255, 159, 64, 1)' 
       ], 
       borderWidth: 1 }] }, 
       options: {
        scales: { 
          yAxes: [{ 
            ticks: { 
              beginAtZero: true } }] } } });

    
    var ctx2 = document.getElementsByClassName("CompareChart"); 

    var mixedChart = { 
      type: 'bar', 
      labels: ['Main', 'Monitoring', 'Neocast', 'Etc', 'Ism', 'Notice', 'Setting' ], 
      datasets : [ 
      { 
        label: 'Bar Dataset', 
        data : [ <?php todaypagecount('/'); ?>, <?php todaypagecount('/Monitoring.php'); ?>, <?php todaypagecount('/Neocast.php'); ?>, <?php todaypagecount('/Etc.php'); ?>, <?php todaypagecount('/Notice.php'); ?>, <?php todaypagecount('/Ism.php'); ?>, <?php todaypagecount('/Setting.php'); ?> ],
        backgroundColor: 'rgba(256, 0, 0, 0.1)' 
      }, 
      { 
        label: 'Line Dataset', 
        data: [ <?php lastweek('/'); ?>, <?php lastweek('/Monitoring.php'); ?>, <?php lastweek('/Neocast.php'); ?>, <?php lastweek('/Etc.php'); ?>, <?php lastweek('/Notice.php'); ?>, <?php lastweek('/Ism.php'); ?>, <?php lastweek('/Setting.php'); ?> ],
        backgroundColor: 'transparent', 
        borderColor: 'skyblue', 
        type: 'line' 
      } 
      ] 
    }; 

    var CompareChart = new Chart(ctx2, { 
      type: 'bar', 
      data: mixedChart, 
      options: { 
        legend: { 
          display: true, 
        }
      }
    });

    
    var ctx3 = document.getElementById('WeekChart').getContext('2d'); 
    
    var chart = new Chart(ctx3, { 
    // 챠트 종류를 선택 
    type: 'line', 

    // 챠트를 그릴 데이타
    data: { 
    labels: [ '<?php weekdate('-6'); ?>', '<?php weekdate('-5'); ?>', '<?php weekdate('-4'); ?>', '<?php weekdate('-3'); ?>', '<?php weekdate('-2'); ?>', '<?php weekdate('-1'); ?>', '<?php weekdate('-0'); ?>(today)' ],
    datasets: 
    [{ 
    label: 'My First dataset', 
    backgroundColor: 'transparent', 
    borderColor: 'red', 
    data: [<?php weekcount('-6'); ?>, <?php weekcount('-5'); ?>, <?php weekcount('-4'); ?>, <?php weekcount('-3'); ?>, <?php weekcount('-2'); ?>, <?php weekcount('-1'); ?>, <?php weekcount('-0'); ?>] 
    }] 
    }, 
    // 옵션 
    options: { 
      legend: { 
        display: false 
      }, 
      title: { 
        display : true, 
        text: 'Week graph' 
      } 
    } 
  });



  </script>

</body> 

</html>
