(function($) {

    $.fn.init_js=function (url){
       $(".required").after("<img class='required-star'  src='"+url+"images/star_red.png' />");  
       
    };
    $.fn.gn_popup_submit = function(url, content_id, grid) {
        $.ajax({
            type: "POST",
            url: url,
            data: this.serialize(), // serializes the form's elements.
            beforeSend: function(xhr) {
                $('#' + content_id).html("please wait..");
            },
            success: function(data)
            {

                if (data == "close_popup") {
                    w2popup.close();
                } else {
                    $('#' + content_id).html(data);
                }
                grid.reload();

            }
        });
    };

    $.fn.gn_loadmain = function(url) {
       
        for (var widget in w2ui) {
            var nm = w2ui[widget].name;
            if (['main_layout', 'sidebar'].indexOf(nm) == -1)
                $().w2destroy(nm);
        }
        $.ajax({
            type: "POST",
            url: url,
            beforeSend: function(xhr) {

            },
            success: function(data)
            {
                w2ui['main_layout'].content('main', data);

            }
        });
    };

})(jQuery);