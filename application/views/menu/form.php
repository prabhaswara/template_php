{message}
<form method="POST" id="formnya">
    <?= frm_('menu_id', $post, "hidden") ?>
    <table>
        <tr>
            <td>Parent</td>
            <td>
                <?= select_('active_non', $post,$parentList) ?>
            </td>
        </tr>
        <tr>
            <td>Menu Title</td>
            <td>
                <?= frm_('menu_title', $post) ?>
            </td>        
        </tr>
        <tr>
            <td>Url</td>
            <td>
                <?= frm_('url', $post) ?>
            </td>
        </tr>
        <tr>
            <td>Attributes</td>
            <td>
                <?= frm_('attributes', $post) ?>
            </td>
        </tr>
        <tr>
            <td>Ordering number</td>
            <td>
                <?= frm_('order_num', $post) ?>
            </td>
        </tr>
        <tr>
            <td>Active\non</td>
            <td>
                <?= select_('active_non', $post,$activeNonList,'',false) ?>
            </td>
        </tr>
    </table>
    <input type="submit" name="action" id="action" value="Save" />

</form>

<script>
    $(function () {
        $("#action").click(function () {
            $("#formnya").gn_popup_submit("{site_url}/admin/menu/showForm","menu_form",w2ui['listLookup']);
            return false;
        });
    });
</script>

