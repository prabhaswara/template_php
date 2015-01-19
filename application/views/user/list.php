
<div id="listUser" class="tablegrid_stylefull"></div>

 <script>
$(function () {
    // define and render grid
    gridName='listUser';
//    if (typeof w2ui[gridName] !== 'undefined') {
//        $().w2destroy(gridName);
//    }
    $('#listUser').w2grid({
        name    : gridName,
        url     : '{site_url}/admin/user/json_list',
        header  : 'List of user',
        show: {
            header        : true,
            toolbar       : true,
            footer        : true,
            toolbarAdd    : true,
            toolbarDelete : true
        },
        columns: [
            { field: 'user_id', caption: 'User Id', size: '150px', searchable: true,sortable: true  },
            { field: 'username', caption: 'Username', size: '100%', searchable: true,sortable: true  },
            { field: 'last_login', caption: 'Last Login', size: '150px', searchable: true,sortable: false  },
            
        ],
        onAdd: function (event) {
             $(this).gn_loadmain('{site_url}/admin/user/showForm/0');
        },
        onDelete: function (event) {          
            w2ui['listUser'].url = '{site_url}/admin/user/delete';
        },
        onLoad: function (event) {
         w2ui['listUser'].url = '{site_url}/admin/user/json_list';
        },
        onDblClick: function (event) {
            $(this).gn_loadmain('{site_url}/admin/user/showForm/'+event.recid);
        
        }
    });

    
});

function editUser(recid) {
    $().w2popup('open', {
        name    : 'user_form',
        title   : (recid == 0 ? 'Add User' : 'Edit User'),
        body    : '<div id="user_form" class="framepopup">please wait..</div>',
        style   : 'padding: 15px 0px 0px 0px',
        width   : 500,
        height  : 300, 
        onOpen  : function (event) {
            event.onComplete = function () {
                
               $( "#user_form" ).load( "{site_url}/admin/user/showForm/"+recid, function() {});
            }
           
        }
    });
}
</script>