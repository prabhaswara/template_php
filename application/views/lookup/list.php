 
<div id="listLookup" style="width: 100%; height: 600px;"></div>

 <script>
$(function () {
    // define and render grid
    $('#listLookup').w2grid({
        name    : 'listLookup',
        url     : '{site_url}/admin/lookup/json_list',
        header  : 'List of lookup',
        show: {
            header        : true,
            toolbar       : true,
            footer        : true,
            toolbarAdd    : true,
            toolbarDelete : true
        },
        columns: [
            { field: 'value', caption: 'Value', size: '150px', searchable: true,sortable: true  },
            { field: 'name', caption: 'Name', size: '150px', searchable: true,sortable: true  },
            { field: 'type', caption: 'Type', size: '100%', searchable: true,sortable: true  },
            { field: 'datecreate', caption: 'Date Create', size: '150px', searchable: false,sortable: true  }
        ],
        onAdd: function (event) {
            editUser(0);
        },
        onDelete: function (event) {          
            w2ui['listLookup'].url = '{site_url}/admin/lookup/delete';
        },
        onLoad: function (event) {
         w2ui['listLookup'].url = '{site_url}/admin/lookup/json_list';
        },
        onDblClick: function (event) {
            editUser(event.recid);
        }
    });

    
});

function editUser(recid) {
    $().w2popup('open', {
        name    : 'lookup_form',
        title   : (recid == 0 ? 'Add User' : 'Edit User'),
        body    : '<div id="lookup_form" class="framepopup">please wait..</div>',
        style   : 'padding: 15px 0px 0px 0px',
        width   : 500,
        height  : 300, 
        onOpen  : function (event) {
            event.onComplete = function () {
                
               $( "#lookup_form" ).load( "{site_url}/admin/lookup/showForm/"+recid, function() {});
            }
           
        }
    });
}
</script>