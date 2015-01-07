<!DOCTYPE html>

<html>
    <head>
        <title>Template</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <link rel="stylesheet" type="text/css" href="{base_url}style/global_style.css" />
        <link rel="stylesheet" type="text/css" href="{base_url}js/w2ui-1.5.x/w2ui.css" />
        <link rel="stylesheet" type="text/css" href="{base_url}style/font-awesome/font-awesome.css" />
        <link rel="stylesheet" type="text/css" href="{base_url}style/notification/box.css" />
        <script type="text/javascript" src="{base_url}js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="{base_url}js/w2ui-1.5.x/w2ui.js"></script>
        <script type="text/javascript" src="{base_url}js/global_js.js"></script>
    </head>
    <body>

        <div id="main_layout" style="position: absolute;top:0;bottom: 0px;right: 0px;left: 0px"></div>

       
        <script type="text/javascript">
            $(function() {
                var pstyle = 'border: 1px solid #dfdfdf; padding: 5px;';
                $('#main_layout').w2layout({
                    name: 'main_layout',
                    padding: 4,
                    panels: [
                        {type: 'top', size: 50, resizable: false, style: pstyle, content: 'top'},
                        {type: 'left', size: 200, resizable: true, style: pstyle, content: 'left'},
                        {type: 'main', style: pstyle},
                    ]
                });

                // then define the sidebar
                w2ui['main_layout'].content('left', $().w2sidebar({
                    name: 'sidebar',
                    img: null,
                    nodes: {sideMenu},
                    onClick: function(event) {
                        $(this).gn_loadmain('{site_url}/home/redirect/'+event.target);
                      
                        
                    }
                }));
            });

      


        </script>

    </body>
</html>
