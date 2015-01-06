<!DOCTYPE html>

<html>
    <head>
        <title>Template</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <link rel="stylesheet" type="text/css" href="{base_url}style/global_style.css" />
        <link rel="stylesheet" type="text/css" href="{base_url}js/w2ui-1.4.2/w2ui-1.4.2.css" />
        <link rel="stylesheet" type="text/css" href="{base_url}style/notification/box.css" />
        <script type="text/javascript" src="{base_url}js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="{base_url}js/w2ui-1.4.2/w2ui-1.4.2.js"></script>
        <script type="text/javascript" src="{base_url}js/global_js.js"></script>
    </head>
    <body>

        <div id="layout" style="width: 100%; "></div>

        <script type="text/javascript">
            $(function() {
                var pstyle = 'border: 1px solid #dfdfdf; padding: 5px;';
                $('#layout').w2layout({
                    name: 'layout',
                    padding: 4,
                    panels: [
                        {type: 'top', size: 50, resizable: false, style: pstyle, content: 'top'},
                        {type: 'left', size: 200, resizable: true, style: pstyle, content: 'left'},
                        {type: 'main', style: pstyle, content: '{maincontent}'},
                      
                    ]
                });
                
                // then define the sidebar
w2ui['layout'].content('left', $().w2sidebar({
	name: 'sidebar',
	img: null,
	nodes: [ 
		{ id: 'level-1', text: 'Level 1', img: 'icon-folder', expanded: true, group: false,
		  nodes: [ { id: 'level-1-1', text: 'Level 1.1', icon: 'fa-home' },
				   { id: 'level-1-2', text: 'Level 1.2', icon: 'fa-star' },
				   { id: 'level-1-3', text: 'Level 1.3', icon: 'fa-check' }
				 ]
		}
	],
	onClick: function (event) {
		w2ui['layout'].content('main', 'id: ' + event.target);
	}
}));
            });
            
            function setLayoutContainerHeight()
            {
                // Get top position of layout container, subtract from screen height, subtract a bit for padding
                var y = $('#layout').position().top;
                var layoutHeight = $(window).height() - y - 10;
                $('#layout').css('height', layoutHeight + 'px');      
            }
            setLayoutContainerHeight();
            $(window).resize(setLayoutContainerHeight);
        </script>

    </body>
</html>
