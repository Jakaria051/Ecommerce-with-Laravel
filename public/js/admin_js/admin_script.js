$(document).ready(function(){
  //check current password is currect or not
  $("#current_pwd").keyup(function(){
      var current_pwd = $("#current_pwd").val();
     // alert(current_pwd);
      $.ajax({
          type:'post',
          url:'/admin/check-current-pwd',
          data:{current_pwd:current_pwd},
          success:function(resp){
             // alert(resp);
              if(resp == "false")
              {
                  $("#chkCurrentPwd").html("<font color=red>Current Password is Incorrect</font>");
              }else if(resp == "true"){
                $("#chkCurrentPwd").html("<font color=green>Current Password is Correct</font>");
              }
          },error:function(resp){
              alert("Error");
          }
      });
  });
});
