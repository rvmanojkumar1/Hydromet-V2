function setUpdateAction() {
	if(confirm("Are you sure want to Approve these user?")){
document.frmUser.action = "edit_user.php";
document.frmUser.submit();
}
}
function setDeleteAction() {
if(confirm("Are you sure want to delete these user?")) {
document.frmUser.action = "delete_user.php";
document.frmUser.submit();
}
}
function deleteUserforApproveList() {
if(confirm("Are you sure want to delete these user?")) {
document.frmUser.action = "delete_userfromtobeapprovelist.php";
document.frmUser.submit();
}
}
