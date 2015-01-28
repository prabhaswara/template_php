<!DOCTYPE html>

<html>
    <head>
        <title>Template</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="{base_url}js/w2ui-1.5.x/w2ui.css" />
        <link rel="stylesheet" type="text/css" href="{base_url}style/font-awesome/font-awesome.css" />
        <link rel="stylesheet" type="text/css" href="{base_url}style/notification/box.css" />
        <link rel="stylesheet" type="text/css" href="{base_url}style/global_style.css" />
        <link rel="stylesheet" type="text/css" href="{base_url}js/jquery-ui-1.11.2/jquery-ui.min.css" />
        <link rel="stylesheet" type="text/css" href="{base_url}js/jquery-ui-1.11.2/jquery-ui.theme.min.css" />
        <link rel="stylesheet" type="text/css" href="{base_url}js/jquery-ui-1.11.2/jquery-ui.structure.css" />
        
        
         <link href="{base_url}js/kendoui/css/kendo.common.min.css" rel="stylesheet" />
    <link href="{base_url}js/kendoui/css/kendo.default.min.css" rel="stylesheet" />
    
    
    
        <script type="text/javascript" src="{base_url}js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="{base_url}js/jquery-ui-1.11.2/jquery-ui.min.js"></script>
        <script type="text/javascript" src="{base_url}js/w2ui-1.5.x/w2ui.js"></script>
        <script type="text/javascript" src="{base_url}js/idle-timer.js"></script>
        <script src="{base_url}js/kendoui/js/kendo.ui.core.min.js"></script>
        <script type="text/javascript" src="{base_url}js/global_js.js"></script>
        
    </head>
    <body>

        <div id="main_layout" style="position: absolute;top:0;bottom: 0px;right: 0px;left: 0px"></div>
        
        <div id="top" style="display:none">          
            <span style="position: absolute;bottom: 4px;right: 10px">
                <div id="userinfo" class="imgbt" style="text-align: right">                    
                    <img src="{base_url}images/user.png"  style="width:30px;height:30px" />
                    <div><?=$ses_userdata["username"] ?></div>                
                </div>
                
            </span>
        </div>
        <div id="maincontent" style="display:none">          
            {maincontent}
        </div>
        
        <div id="userInfoData" style="display:none" >
            <table width="100%">
                <tr>
                    <td style="vertical-align: top;text-align: right;width:50px">
                        <img src="{base_url}images/user.png"  style="width:45px;height:45px" />
                    </td>
                    <td style="vertical-align: top;text-align: left">
                       <?=$ses_userdata["username"] ?>
                        
                    </td>
                    
                   
                   
                    
                </tr>
            </table>
             <div>
                        <button id="changepwd" class="w2ui-btn" >Change Password</button>
                        <button id="logout" class="w2ui-btn" onclick="window.location = '{site_url}/login/logout'" >Logout</button>
                    </div>
            
        </div>
        
        
        <form style="display:none" title='Relogin' id='relogin'><table ><tr><td width='80px'>Username</td><td><?=$ses_userdata["username"] ?><input type='hidden' name='username' id='username' value='<?=$ses_userdata["username"] ?>' /></td></tr><tr><td>Password</td><td><input type='password' name='password' id='password' /></td></tr><tr><td colspan=2><div style='color:red;display:none' id='login_message'>Login Failed</div></td></tr></table></form>
        
        
        <div id="ajaxDiv" class="ajax-hide">
            <img src="{base_url}/images/ajax-loader.gif" class="ajax-loader"/>
        </div>
       
        <script type="text/javascript">
            $(function() {
                var topstyle = 'border: 1px solid #dfdfdf; padding: 0px;';
                var leftstyle = 'border: 1px solid #dfdfdf; padding: 5px;';
                var centerstyle = 'border: 1px solid #dfdfdf; padding: 0px;';
                $('#main_layout').w2layout({
                    name: 'main_layout',
                    padding: 4,
                    panels: [
                        {type: 'top', size: 70, resizable: false, style: topstyle, content: $("#top").html()},
                        {type: 'left', size: 200, resizable: true, style: leftstyle, content: 'left'},
                        {type: 'main', style: centerstyle,content: $("#maincontent").html()}
                    ]
                });

                // then define the sidebar
                w2ui['main_layout'].content('left', $().w2sidebar({
                    name: 'sidebar',
                    img: null,
                    nodes: {sideMenu},
                    onClick: function(event) {
                        $(this).gn_loadmain('{site_url}/site/redirect/'+event.target);                    
                        
                    }
                }));             
                    
                    
                $("#userinfo").kendoTooltip({ 
                    showOn: "click",
                    autoHide: false,
                    content: $("#userInfoData").html()
                });
  
      
                    
                $( document ).ajaxError(function( event, request, settings ) {
                alert( "Error requesting page " + settings.url);
                });                
                
                $("#relogin").dialog({
                autoOpen:false,
                modal: true,
                height: 200,
                width: 300,
                buttons: {
                    Login: function() {
                        $(this).loadingShow(true);
                        $.ajax({
                            type: "POST",
                            url: "{site_url}/login/relogin",
                            data: $("#relogin").serialize(),

                            success: function(data) {
                                if (data == 1) {
                                    $("#relogin").dialog("close");
                                }
                                else {
                                    $("#login_message").show();
                                    $("#login_message").fadeOut("slow");

                                }
                                $(this).loadingShow(false);
                            }
                        });
                    }
                },
                dialogClass: "loginDialog",
                });

                $.idleTimer(5000);
                var userIsActive=true;   
                $(document).bind("idle.idleTimer", function(){userIsActive=false;});
                $(document).bind("active.idleTimer", function(){userIsActive=true});                
                setInterval(function() {
                    popupisopen=$("#relogin").dialog("isOpen");                   
                    if(!userIsActive && !popupisopen){                        
                        $.ajax({
                                url: "{site_url}/login/chek",                               
                                success: function(data) {
                                    if(data==0 && !popupisopen){
                                       w2popup.close();       
                                        $("#relogin").dialog("moveToTop");
                                        $("#relogin").dialog("open");
                                    }                                   
                                }
                            });  
                    }
                }, 5000)
            });
        </script>

    </body>
</html>
