$(document).ready(function(){
    // $('#sort').on('change',function(){
    //     this.form.submit();
    // });

    $('#sort').on('change',function(){
        let sort = $(this).val();
        let url = $('#url').val();
        $.ajax({
            url:url,
            sort:sort,
            data:{sort:sort,url:url},
            success:function(data)
            {
                $('.filter_products').html(data);
            }

        })
    });
});
