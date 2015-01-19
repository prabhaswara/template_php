<h2 class="form-title">{create_edit} User</h2>
{message}
<div class="form-tbl">
    

<form method="POST" id="formnya">
    <?= frm_('user_id', $post, "type='hidden'") ?>
    <table>
        <tr>
            <td>UserName</td>
            <td>
                <?= frm_('username', $post) ?>
            </td>        
        </tr>
        <tr>
            <td>Password</td>
            <td>
                <?= frm_('password_1', $post,"type='password'") ?>
            </td>        
        </tr>
        <tr>
            <td>Repeat Password</td>
            <td>
                <?= frm_('password_2', $post,"type='password'") ?>
            </td>        
        </tr>
        <tr>
            <td>Active\non</td>
            <td>
                <?= select_('active_non', $post,$activeNonList,'',false) ?>
            </td>
        </tr>
        <tr>
            <td>Role</td>
            <td>
                <?php 
                    if(!empty($roles)){
                        echo "<ul class='listcheckbox'>";
                        foreach ($roles as $role){
                            echo "<li><label><input type='checkbox' name='role[]' value='".$role["role_id"]."' />".$role["name"]."</label> </li>";
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
        $("#action").click(function() {
            $("#formnya").gn_submit("{site_url}/admin/user/showForm");
            return false;
        });
        $("#cancel").click(function() {
            $(this).gn_loadmain('{site_url}/admin/user/');
            return false;
        });
    });
</script>

