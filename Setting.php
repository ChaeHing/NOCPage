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

    
    <script src="js/jquery-3.4.1.js"></script>

    <script> // DEVOPS-157
      $(document).ready(function(){ //insert menu 선택시 Title 목록 호출 -> SettingList.php
        $('#insertmenu').on('change', function(){

          $.post("SettingList.php",{menu:this.value,type:"title"}, function(data) {

          $('#inserttitle').empty();
          $('#inserttitle').append('<option value="">선택해주세요</option>');
          $('#inserttitle').append(data);
          $('#inserttitle').append('<option value="">직접입력</option>');
          
          });
        });
      });

      $(document).ready(function(){ //delete Menu 선택시 Title 목록 호출 
        $('#deletemenu').on('change', function(){

          $.post("SettingList.php",{menu:this.value,type:"title"}, function(data) {

          $('#deletetitle').empty();
          $('#deletettitle').append('<option value="">선택해주세요</option>');
          $('#deletetitle').append(data);
          
          });
        });
      });

      $(document).ready(function(){ //delete title 선택시 name 목록 호출 
        $('#deletetitle').on('change', function(){

          $.post("SettingList.php",{type:"name", title:this.value, menu:deletemenu.value}, function(data) {

          $('#deletename').empty();
          $('#deletename').append('<option value="">선택해주세요</option>');
          $('#deletename').append(data);
          
          });
        });
      });

      $(document).ready(function(){ //update type 선택시 type 목록 호출 
        $('#updatetype').on('change', function(){

          $.post("SettingList.php",{type:"update", utype:this.value, menu:updatemenu.value}, function(data) {

          $('#current').empty();
          $('#current').append('<option value="">선택해주세요</option>');
          $('#current').append(data);
          
          });
        });
      });


    function displaytitle(frm) { //insert에서 Title선택시 input에 해당값 입력

      var title = document.getElementById("inserttitle");
      title = title.options[title.selectedIndex].value;
      frm.title.value = title;
        
      return true; 
    }

    </script>

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
          <li><a href="Ism.php">ISM</a></li>
          <li><a href="Notice.php">Notice</a></li>
          <li class="active"><a href="Setting.php">Setting</a></li>
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
          <li>     
              <form class="navbar-form" role="search" action="Search.php">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="검색" name="serch">
                </div>
              <button type="submit" class="btn btn-default">검색</button>
              </form>
          </li>    
        </ul> 
      </div><!-- /.navbar-collapse -->
    </nav>

    <div class="row">
      <div class="col-md-4">  
        <div class="panel panel-default">
          <div class="panel-heading">
        <h2 class="panel-title">Insert</h3>
          </div>
          <div class="panel-body">
            <form action="Insert.php" method=post role="form" class="form-inline">
              <p>
              <strong>Menu</strong>
              <select class="form-control" name="menu" id="insertmenu">
                  <option value="" required>선택해주세요</option>
                  <option value="Monitoring">Monitoring</option>
                  <option value="Neocast">Neocast</option>
                  <option value="Etc">Etc</option>
                  <option value="Ism">Ism</option>
              </select>
              </p>
              <p>
                <label for="title">TITLE</label>
                <select class="form-control" id="inserttitle" onchange="displaytitle(this.form)" name="inserttitle"required>
                </select>
                <input type="text" class="form-control" name="title">
              </p>
              <p>
                <label for="name">NAME</label>
                <input type="text" class="form-control" placeholder="KTCDN 2.0" name="name"> 
              </p>
              <p>
                <label for="url">URL</label>
                <input type="text" class="form-control" placeholder="http://kt-ism.solbox.com/index.htm" name="url"> 
              </p>    
              <button type="submit" class="btn btn-default">insert</button>
            </form> 
          </div>
        </div>
      </div>
      <div class="col-md-4">  
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Delete</h2>
          </div>
          <div class="panel-body">
             <form action="Delete.php" method=post role="form" class="form-inline">
                <p>
                <strong>Menu</strong>
                <select class="form-control" name="menu" id="deletemenu">
                  <option value="">선택해주세요</option>
                  <option value="Monitoring">Monitoring</option>
                  <option value="Neocast">Neocast</option>
                  <option value="Etc">Etc</option>
                  <option value="Ism">Ism</option>
                </select>
                </p>
                <p>
                  <label for="title">TITLE</label>
                  <select class="form-control" id="deletetitle" name="title" required>
                  </select>
                </p>
                <p>
                  <label for="name">NAME</label>
                  <select class="form-control" id="deletename" name="name" required>
                  </select>
                </p>    
                <button type="submit" class="btn btn-default">Delete</button>
              </form> 
            </div>
          </div>
        </div>
      <div class="col-md-4">  
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Update</h2>
          </div>
            <div class="panel-body">
              <form action="Update.php" method=post role="form" class="form-inline">
                <p>
                <strong>Menu</strong>
                <select class="form-control" name="menu" id="updatemenu">
                  <option value="">선택해주세요</option>
                  <option>Monitoring</option>
                  <option>Neocast</option>
                  <option>Etc</option>
                  <option>Ism</option>
                </select>
                </p>
                <p>
                <strong>TYPE</strong>
                <select class="form-control" name="type" id="updatetype">
                  <option value="">선택해주세요</option>
                  <option>TITLE</option>
                  <option>NAME</option>
                  <option>URL</option>
                </select>
                </p>
                <p>
                  <label for="title">CURRENT</label>
                  <select class="form-control" id="current" name="current" required>
                  </select>
                </p>
                <p>
                  <label for="name">NEW</label>
                  <input type="text" class="form-control" placeholder="KTCDN 2.0" name="new">
                </p>    
                <button type="submit" class="btn btn-default">Update</button>
              </form> 
            </div>
          </div>
        </div>
      </div>
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





