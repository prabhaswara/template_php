{message}
<form method="POST" id="formnya">
    <?= frm_('lookup_id', $post, "hidden") ?>
    <table>
        <tr>
            <td>Type</td>
            <td>
                <?= frm_('type', $post) ?>
            </td>
        </tr>
        <tr>
            <td>Value</td>
            <td>
                <?= frm_('value', $post) ?>
            </td>        
        </tr>
        <tr>
            <td>Name</td>
            <td>
                <?= frm_('name', $post) ?>
            </td>
        </tr>
    </table>
    <input type="submit" name="action" id="action" value="Save" />

</form>

<script>
    $(function () {
        $("#action").click(function () {
            $("#formnya").popup_submit("{site_url}/admin/lookup/showForm","lookup_form",w2ui['listLookup']);
            return false;
        });
    });
</script>

