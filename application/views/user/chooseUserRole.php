
<div id="listUser" class="tablegrid_stylefull"></div>

 <script>
$(function () {
    // define and render grid
    gridName='popupList';
    if (typeof w2ui[gridName] !== 'undefined') {
        $().w2destroy(gridName);
    }
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
            { field: 'us_sp_username', caption: 'Username', size: '100px', searchable: true,sortable: true  },
            { field: 'lk_sp_display_text', caption: 'Active/Non', size: '100px', searchable: true,sortable: true  },
            { field: 'us_sp_last_login', caption: 'Last Login', size: '150px', searchable: false,sortable: false  },
            { field: 'rl_sp_role_name', caption: 'Role', size: '100%', searchable: false,sortable: false  },
            
        ]
    });

    
});

}
</script>