    $(document).ready(function(){
      $('#selectmenu').on('change', function(){

          $.post("SettingList.php",{optVal:this.value}, function(data) {

          $('#selecttitle').empty();
          $('#selecttitle').append('<option value="">선택해주세요</option>');
          $('#selecttitle').append(data);
          $('#selecttitle').append('<option value="">직접입력</option>');
          
          });

      });
    });


function displaytitle(frm) {

var title = document.getElementById("selecttitle");

title = title.options[title.selectedIndex].value;

frm.title.value = title;
        
return true;
      
