<h1>Add new KPI</h1>
<?php
    if (current_user_can('edit_users')){
?>
<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="okmr-new-kpi">
    <input type="hidden" name="action" value="okrm_new_kpi_form_response">
    <input type="hidden" name="okmr_add_user_meta_nonce" value="<?php echo $okmr_add_meta_nonce ?>" />
    <label for="okmr_name">Name</label><br />
    <input type="text" name="okmr_name" id="okmr_name"><br />
    <label for="okmr_description">Description</label> <br />
    <textarea name="okmr_description" id="okmr_description" cols="30" rows="10"></textarea><br /><br />
    <input type="submit">
</form>
<?php
    }