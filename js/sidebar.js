/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (jQuery.inArray("test", myarray) != -1) {
    console.log("is in array");
} else {
    console.log("is NOT in array");
}


var info = {
    type: "userGroupPermissions"
};

$.ajax({
    url: '../controllers/AccountController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    success: function (data) {

        console.log(data);

    }
});