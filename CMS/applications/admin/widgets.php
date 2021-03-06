<?php

/**
 * Copyright 2012, openTracker. (http://opentracker.nu)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @link          http://opentracker.nu openTracker Project
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author Wuild
 * @package openTracker
 */

if(!defined("INCLUDED"))
    die("Access denied");

$this->setTitle("Admin - Widgets");
$this->addJavascript("sortable.js");
$this->setSidebar(true);
try {
    $acl = new Acl(USER_ID);
    if (!$acl->Access("x"))
        throw new Exception("Access denied");

    $action = isset($this->args["var_a"]) ? $this->args['var_a'] : "";

    
    $this->menu["Widgets"] = page("admin", "widgets");
    $this->menu["Install Widget"] = page("admin", "widgets", "install");
    
    $tpl = new Template(PATH_APPLICATIONS . "admin/tpl/widgets/");
    switch ($action) {
        default:
            $tpl->loadFile("main.php");
            break;

        case 'edit':
            $tpl->id = isset($_GET['id']) ? $_GET['id'] : false;
            $tpl->loadFile("edit.php");
            break;

        case 'delete':
            $tpl->loadFile("delete.php");
            break;

        case 'install':
            $tpl->loadFile("install.php");
            break;
    }
    $tpl->build();
} Catch (Exception $e) {
    echo error(_t($e->getMessage()));
}
?>

