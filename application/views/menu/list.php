 
<div id="listMenu" style="position: absolute;top:0;bottom: 10px;right: 0px;left: 0px"></div>

 <script>
$(function () {
    gridName='listMenu';

    $('#listMenu').w2grid({
        name    : gridName,
        url     : '{site_url}/admin/menu/json_list',
        header  : 'List of menu',
        show: {
            header        : true,
            toolbar       : true,
            footer        : true,
            toolbarAdd    : true,
            toolbarDelete : true
        },
        columns: [
            { field: 'pp.parent', caption: 'Type', size: '150px', searchable: true,sortable: true  },
            { field: 'mn.menu_title', caption: 'Value', size: '150px', searchable: true,sortable: true  },
            { field: 'mn.url', caption: 'Name', size: '100%', searchable: true,sortable: true  },
            { field: 'mn.attributes', caption: 'Ordering number', size: '150px', searchable: true,sortable: true  },
            { field: 'lk.active_non_v', caption: 'Ordering number', size: '150px', searchable: true,sortable: true  },
            { field: 'mn.order_num', caption: 'Ordering number', size: '150px', searchable: true,sortable: true  }
            
        ],
        onAdd: function (event) {
            editMenu(0);
        },
        onDelete: function (event) {          
            w2ui['listMenu'].url = '{site_url}/admin/menu/delete';
        },
        onLoad: function (event) {
         w2ui['listMenu'].url = '{site_url}/admin/menu/json_list';
        },
        onDblClick: function (event) {
            editMenu(event.recid);
        }
    });

    
});

function editMenu(recid) {
    $().w2popup('open', {
        name    : 'menu_form',
        title   : (recid == 0 ? 'Add Menu' : 'Edit Menu'),
        body    : '<div id="menu_form" class="framepopup">please wait..</div>',
        style   : 'padding: 15px 0px 0px 0px',
        width   : 500,
        height  : 300, 
        onOpen  : function (event) {
            event.onComplete = function () {
                
               $( "#menu_form" ).load( "{site_url}/admin/menu/showForm/"+recid, function() {});
            }
           
        }
    });
}
</script>