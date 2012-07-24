<?php
try {

    if (!isset($_GET['id']))
        throw new Exception("Missing id");

    if ($_GET['id'] == "en")
        throw new Exception("Cannot delete the standard language");

    if (isset($_GET['confirm'])) {
        ?>
        <div class="user" style="float:left; margin: 3px; border: 1px solid #ddd; padding:5px; padding-bottom: 10px; background-color: #f8f8f8; width: 47%;">
            <center><?php echo _t("Are you sure you wish to delete this?") ?><br /><br />
                <a href="<?php echo page("admin", "translations", "delete", "", "", "id=" . $_GET['id']) ?>"><span class="btn red"><?php echo _t("Yes") ?></span></a> 
                <a href="<?php echo page("admin", "translations") ?>"><span class="btn"><?php echo _t("No") ?></span></center></a>
        </div>
        <?
    } else {
        $db = new DB("system_languages");
        $db->delete("language_id = '" . $db->escape($_GET['id']) . "'");
        header("location: " . page("admin", "translations"));
    }
} catch (Exception $e) {
    echo error(_t($e->getMessage()));
}
?>