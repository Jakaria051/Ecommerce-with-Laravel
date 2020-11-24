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

     //SectionsStatus
     $(".updateSectionStatus").click(function(){
         var status = $(this).text();
         var section_id = $(this).attr("section_id");
        // alert(status);
         //alert(section_id);
         $.ajax({
             type:'post',
             url:'/admin/update-section-status',
             data:{status:status,section_id:section_id},
             success:function(resp){
                //  alert(resp['status']);
                //  alert(resp['section_id']);
                 if(resp['status']==0)
                 {
                    $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Inactive</a>");
                 }else if(resp['status']==1){
                    $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Active</a>");

                 }
             },
             error:function(resp){
                 alert(resp);
             }
         });
     });


     //update categories

     $(".updateCategoryStatus").click(function(){
        var status = $(this).text();
        var category_id = $(this).attr("category_id");
       // alert(status);
        //alert(section_id);
        $.ajax({
            type:'post',
            url:'/admin/update-category-status',
            data:{status:status,category_id:category_id},
            success:function(resp){
                if(resp['status']==0)
                {
                   $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Inactive</a>");
                }else if(resp['status']==1){
                   $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Active</a>");

                }
            },
            error:function(resp){
                alert(resp);
            }
        });
    });

    //Append Categories lavel

    $('#section_id').change(function(){
        var section_id = $(this).val();
       // alert(section_id);
       $.ajax({
           type:'post',
           url:'/admin/append-categories-level',
           data:{section_id:section_id},
           success:function(resp){
               $("#appendCategoriesLavel").html(resp);
           },error:function(resp){
               alert("Error");
           }
       });
    });

    ///update product status

    $(".updateProductStatus").click(function(){
        let status = $(this).text();
        let product_id = $(this).attr("product_id");
        $.ajax({
            type:'post',
            url:'/admin/update-product-status',
            data:{status:status,product_id:product_id},
            success:function(resp){
                if(resp['status']==0)
                {
                   $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)'>Inactive</a>");
                }else if(resp['status']==1){
                   $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)'>Active</a>");

                }
            },
            error:function(resp){
                alert(resp);
            }
        });

    });

    ///Confirm delete of record by simple jquery
    // $('.confirmDelete').click(function(){
    //     let name = $(this).attr("name");
    //     if(confirm("Are you sure to delete this "+name+"?")) {
    //         return true;
    //     }
    //     return false;
    // });

    ///Confirm delete of record by SweetAlert2
    $('.confirmDelete').click(function(){
        let record = $(this).attr("record");
        let recordId = $(this).attr("recordId");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
             window.location.href = "/admin/delete-"+record+"/"+recordId;
            }
          });
    });




});