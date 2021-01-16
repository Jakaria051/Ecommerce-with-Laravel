$(document).ready(function(){
    // $('#sort').on('change',function(){
    //     this.form.submit();
    // });

    $('#sort').on('change',function(){
        var fabric = get_filter('fabric');
        var sort = $(this).val();
        var url = $('#url').val();
        $.ajax({
            url:url,
            sort:sort,
            data:{fabric:fabric,sort:sort,url:url},
            success:function(data)
            {
                $('.filter_products').html(data);
            }

        })
    });

      //Filter

      $(".fabric").on('click',function(){
     // console.log(JSON.stringify(this));
        var fabric = get_filter('fabric');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:url,
            fabric:fabric,
            sort:sort,
            data:{fabric:fabric,sort:sort,url:url},
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


});
