function Validate() 
{
    var name = $("#txtUserName").val();
    var password = $("#txtPwd").val();
    var projectId = $("#ddlProject option:selected").val();
    if (projectId == 0) {
        alert("Please select project name.");
        return false;
    }
    else if (name.length == 0 && password.length == 0) {
        alert('Credentials are requied.');
        return false;
    }
    else if (name.length == 0 && password.length > 0) {
        alert('User Name is requied.');
        return false;
    }
    else if (name.length > 0 && password.length == 0) {
        alert('Password is requied.');
        return false;
    }
    return true;   
}
