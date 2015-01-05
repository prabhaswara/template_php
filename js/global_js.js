(function ($) {


    $.fn.popup_submit = function (url, content_id,grid) {

        $.ajax({
            type: "POST",
            url: url,
            data: this.serialize(), // serializes the form's elements.
            beforeSend: function (xhr) {
                $('#' + content_id).html("please wait..");
            },
            success: function (data)
            {
               
                if(data=="close_popup"){
                    w2popup.close();
                }else{
                    $('#' + content_id).html(data);
                }
                grid.reload();
                
            }
        });


    };


})(jQuery);