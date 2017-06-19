<?php

require_once '../classes/AccountClass.php';
require_once '../classes/LoginClass.php';
require_once '../classes/AuditClass.php';

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
        } else if ($type == "retreivePermissions") {

            $get = new AccountClass();
            $get->retreivePermissions();
        } else if ($type == "saveGroupPermissions") {
            $usergroup = $_POST['userGroup'];
            $data = $_POST['permissions'];
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
        } else if ($type == "login") {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $save = new LoginClass();
            $save->login($username, $password);
        } else if ($type == "userGroupPermissions") {

            $get = new AccountClass();
            $get->getUserGroupPermissions();
        } else if ($type == "formPermmission") {
            $formid = $_POST['formid'];
            $get = new AccountClass();
            $get->getFormPermissions($formid);
        } else if ($type == "retreiveUserGroupPermissions") {
            $id = $_POST['groupid'];
            $get = new AccountClass();
            $get->getGroupPermissions($id);
        } else if ($type == "retreiveUserInfo") {
            $id = $_POST['userid'];
            $get = new AccountClass();
            $get->getUserInfo($id);
        } else if ($type == "updateUserInfo") {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phoneno = $_POST['phoneno'];
            $userGroup = $_POST['userGroup'];
            $userid = $_POST['userid'];
            // print_r($_POST);
            $save = new AccountClass();
            $save->updateUserInfo($name, $username, $email, $phoneno, $userGroup, $userid);
        } else if ($type == "savePermission") {

            $permission = $_POST['permission'];
            $save = new AccountClass();
            $save->setPermission($permission);
        } else if ($type == "changePassword") {

            $password = $_POST['password_val'];
            $save = new AccountClass();
            $save->updatePassword($password);
        }else if ($type == "forgotpassword") {

            $email = $_POST['email'];
            $save = new AccountClass();
            $save->forgotPassword($email);
        }else if ($type == "resetpassword") {

            $password = $_POST['password'];
            $userid= $_POST['userid'];
            $save = new AccountClass();
           $save->resetPassword($password,$userid);
        }else if ($type == "auditlogs") {

           
            $get = new AuditClass();
           $get->auditlogs();
        }
    } else {
        echo 'provide type';
    }
}
