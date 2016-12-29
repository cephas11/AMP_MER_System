<?php

require_once '../classes/AccountClass.php';
require_once '../classes/LoginClass.php';
$response = array();
if (isset($_REQUEST)) {
//echo "Check here";
    $type = $_REQUEST['type'];
    if (!empty($type)) {
        if ($type == "saveUserGroup") {
            $name = $_POST['usergroup'];
            $save = new AccountClass();
            $save->setUserGroup($name);
        } else if ($type == "retreiveUserGroups") {

            $get = new AccountClass();
            $get->getUserGroups();
        } else if ($type == "updateUserGroupInformation") {
            $name = $_POST['usergroupdetail'];
            $id = $_POST['usergroupid'];
            $save = new AccountClass();
            $save->updateUserGroup($id, $name);
        } else if ($type == "retreiveForms") {

            $get = new AccountClass();
            $get->retreiveForms();
        } else if ($type == "savePermissionRoles") {
            $usergroup = $_POST['usergroup'];
            $data = $_POST['jsonObj'];

            $setGroupPermissions = new AccountClass();
            $setGroupPermissions->setPermissionsAndRoles($usergroup, $data);
        } else if ($type == "saveUser") {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phoneno = $_POST['phoneno'];
            $userGroup = $_POST['userGroup'];

            $save = new AccountClass();
            $save->setUser($name, $username, $email, $phoneno, $userGroup);
        } else if ($type == "retreiveUsers") {

            $get = new AccountClass();
            $get->getUsers();
        }else if ($type == "login") {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $save = new LoginClass();
            $save->login($username, $password);
        }else if ($type == "userGroupPermissions") {
            
            $get = new AccountClass();
            $get->getUserGroupPermissions();
        }
    } else {
        echo 'provide type';
    }
}
