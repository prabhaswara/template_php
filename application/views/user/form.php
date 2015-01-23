<h2 class="form-title">{create_edit} User</h2>
{message}
<div class="form-tbl">
    

<form method="POST" id="formnya">
    <?= frm_('user_id', $postUser, "type='hidden'") ?>
    <table>
        <tr>
            <td>Username</td>
            <td>
                <?= frm_('username', $postUser) ?>
            </td>        
        </tr>
        <tr>
            <td>Password</td>
            <td>
                <?= frm_('password_1', $postUser,"type='password'") ?>
            </td>        
        </tr>
        <tr>
            <td>Repeat Password</td>
            <td>
                <?= frm_('password_2', $postUser,"type='password'") ?>
            </td>        
        </tr>
        <tr>
            <td>Active\non</td>
            <td>
                <?= select_('active_non', $postUser,$activeNonList,'',false) ?>
            </td>
        </tr>
        <tr>
            <td>Role
                <span id="copy">[copy]</span>
            </td>
            <td>
                <?php 
             
                    if(!empty($roles)){
                        
                      
                        
                        echo "<ul class='listcheckbox'>";
                        foreach ($roles as $role){
                            
                            echo "<li><label><input type='checkbox' name='role[]' value='".$role["role_id"]."' ".
                                    (in_array($role["role_id"], $postUserRole)?"checked='checked'":"")
                                    ." />".$role["name"]."</label> </li>";
                        }
                        echo "</ul>";
                    }
                ?>
            </td>
        </tr>

    </table>
    <input type="submit" name="action" id="action" value="Save" />
    <input type="button" name="action" id="cancel" value="Cancel" />
</form>
</div>



<script>
    $(function() {
        
         $().w2grid({
            name: 'foo',
            columns: [ { field: 'recid', caption: 'ID', size: '100%' } ],
            records: [ { recid: 'AAA' }, { recid: 'BBB' }, { recid: 'CCC' } ]
        });


        $("#action").click(function() {
            $("#formnya").gn_submit("{site_url}/admin/user/showForm/<?=isset($postUser["user_id"])?$postUser["user_id"]:"" ?>");
            return false;
        });
        $("#cancel").click(function() {
            $(this).gn_loadmain("{site_url}/admin/user");
            return false;
        });
        $("#copy").click(function() {
            
            $('#popup').w2popup('open', {
                onOpen: function () {
                    $('#w2ui-popup #grid').w2render('foo');
                }
            });
          
            return false;
        });
    });
</script>

