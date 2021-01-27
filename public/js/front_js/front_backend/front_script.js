$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $('#sort').on('change',function(){
    //     this.form.submit();
    // });

    $('#sort').on('change',function(){
        var occasion = get_filter('occasion');
           var pattern = get_filter('pattern');
           var fit = get_filter('fit');
           var sleeve = get_filter('sleeve');
           var fabric = get_filter('fabric');
           var sort = $("#sort option:selected").val();
           var url = $("#url").val();
        $.ajax({
            url:url,
            sort:sort,
            data:{fit:fit,pattern:pattern,occasion:occasion,sleeve:sleeve,fabric:fabric,sort:sort,url:url},
            success:function(data)
            {
                $('.filter_products').html(data);
            }

        })
    });

      //Filter

      $(".fabric").on('click',function(){
           // console.log(JSON.stringify(this));
           var occasion = get_filter('occasion');
           var pattern = get_filter('pattern');
           var fit = get_filter('fit');
           var sleeve = get_filter('sleeve');
           var fabric = get_filter('fabric');
           var sort = $("#sort option:selected").val();
           var url = $("#url").val();
        $.ajax({
            url:url,
            data:{fit:fit,pattern:pattern,occasion:occasion,sleeve:sleeve,fabric:fabric,sort:sort,url:url},
            success:function(data)
            {
                $('.filter_products').html(data);
            }

        })
    });

    //sleeeve
    $(".sleeve").on('click',function(){
              // console.log(JSON.stringify(this));
              var occasion = get_filter('occasion');
              var pattern = get_filter('pattern');
              var fit = get_filter('fit');
              var sleeve = get_filter('sleeve');
              var fabric = get_filter('fabric');
              var sort = $("#sort option:selected").val();
              var url = $("#url").val();
           $.ajax({
               url:url,
               data:{fit:fit,pattern:pattern,occasion:occasion,sleeve:sleeve,fabric:fabric,sort:sort,url:url},
               success:function(data)
               {
                   $('.filter_products').html(data);
               }

           })
       });

       //pattern
    $(".pattern").on('click',function(){
               // console.log(JSON.stringify(this));
               var occasion = get_filter('occasion');
               var pattern = get_filter('pattern');
               var fit = get_filter('fit');
               var sleeve = get_filter('sleeve');
               var fabric = get_filter('fabric');
               var sort = $("#sort option:selected").val();
               var url = $("#url").val();
           $.ajax({
               url:url,
               data:{fit:fit,pattern:pattern,occasion:occasion,sleeve:sleeve,fabric:fabric,sort:sort,url:url},
               success:function(data)
               {
                   $('.filter_products').html(data);
               }

           })
       });

       //fit
    $(".fit").on('click',function(){
        // console.log(JSON.stringify(this));
        var occasion = get_filter('occasion');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var sleeve = get_filter('sleeve');
        var fabric = get_filter('fabric');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();

           $.ajax({
               url:url,
               data:{fit:fit,pattern:pattern,occasion:occasion,sleeve:sleeve,fabric:fabric,sort:sort,url:url},
               success:function(data)
               {
                   $('.filter_products').html(data);
               }

           })
       });

       //occasion
    $(".occasion").on('click',function(){
             // console.log(JSON.stringify(this));
             var occasion = get_filter('occasion');
             var pattern = get_filter('pattern');
             var fit = get_filter('fit');
             var sleeve = get_filter('sleeve');
             var fabric = get_filter('fabric');
             var sort = $("#sort option:selected").val();
             var url = $("#url").val();
           $.ajax({
               url:url,
               data:{fit:fit,pattern:pattern,occasion:occasion,sleeve:sleeve,fabric:fabric,sort:sort,url:url},
               success:function(data)
               {
                   $('.filter_products').html(data);
               }

           })
       });


    function get_filter(class_name) {
        var filter = [];
            $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $("#getPrice").on('change',function(){
        let size = $(this).val();
        let product_id = $(this).attr('product-id');
        let url = '/get-product-price';
        if(size == "")
        {
            alert("Please Select Size");
            return false;
        }
        $.ajax({
            url:url,
            data:{
                size:size,
                product_id:product_id
            },
            type:'post',
            success:function(resp)
            {
                $(".getAttrPrice").html("Taka: "+resp);

             },error:function(){
                alert("Error");
            }
        });
    });


});
