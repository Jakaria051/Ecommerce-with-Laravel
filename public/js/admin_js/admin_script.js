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
        })

    });


    //   $(".updateAttributeStatus").click(function(){
    //     alert("click");
    // });


     //update Product attribute status
     $(".updateAttributeStatus").click(function(){
        let status = $(this).text();
        let attribute_id = $(this).attr("attribute_id");
        $.ajax({
            type:'post',
            url:'/admin/update-attribute-status',
            data:{status:status,attribute_id:attribute_id},
            success:function(resp){
                if(resp['status']==0)
                {
                   $("#attribute-"+attribute_id).html("<a class='updateAttributeStatus' href='javascript:void(0)'>Inactive</a>");
                }else if(resp['status']==1){
                   $("#attribute-"+attribute_id).html("<a class='updateAttributeStatus' href='javascript:void(0)'>Active</a>");

                }
            },
            error:function(resp){
                alert(resp);
            }
        })

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

        //update Product Image status
        $(".updateImageStatus").click(function(){
         let status = $(this).text();
         let image_id = $(this).attr("image_id");

         $.ajax({
            type:'post',
            url:'/admin/update-image-status',
            data:{status:status,image_id:image_id},
            success:function(resp){
                if(resp['status']==0)
                {
                    $("#image-"+image_id).html("<a class='updateImageStatus' href='javascript:void(0)'>Inactive</a>");
                }else if(resp['status']==1){
                    $("#image-"+image_id).html("<a class='updateImageStatus' href='javascript:void(0)'>Active</a>");

                }
            },
            error:function(resp){
                alert(resp);
            }
         })

      });


    //Add remove product attrivute field
        let maxField = 10;
        let addButton = $('.add_button');
        let wrapper = $('.field_wrapper');
        let fieldHTML = '<div style="margin-top: 10px; margin-left:2px;"><input  type="text" name="size[]"  placeholder="Size" style="width: 100px;" required="">&nbsp;<input type="text" name="sku[]" placeholder="SKU" style="width: 100px;" required="">&nbsp;<input type="number" name="price[]"  placeholder="Price" style="width: 100px;" required="">&nbsp;<input  type="number" name="stock[]" placeholder="Stock" style="width: 100px;" required=""><a href="javascript:void(0);" class="remove_button">Remove</a></div>';
        var x = 1;
        //once add button is clicked
        $(addButton).click(function(){
            if( x < maxField ) {
                x++;
                $(wrapper).append(fieldHTML);
            }
        });

        //once remove button is clicked
        $(wrapper).on('click','.remove_button',function(e){
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });

        //








});
