var userRole=0;

$(document).ready(function () {    
    
  
// Initialize the tour
       
        //document.getElementById("dialog").style.display = 'none';



    $("#btnGenReport").click(function GenerateProjectReport(){   
        var projectId = $("#ddlProject option:selected").val();
        if(projectId==0)
        {
           alert("Please select project name.");
        }
        else{
         
           var projectName = $("#ddlProject option:selected").text();
           window.open("Report/Report.aspx?Type=KAPProject&Projectname=" + projectName + "&Lat=0&long=0", "KAV Project Report");
        }
    });
    
    $("#btnSummary").click(function () 
       {
      if(document.getElementById('rdoBenf').checked) 
       {
           
            window.open("ReportViewer.aspx?Type=AllBeneficiary&Lat=0" + "&long=0", "All Beneficiary Report");

  
       }
       else if(document.getElementById('rdoPDM').checked) 
       {
 
            window.open("Report/Report.aspx?Type=PDMSummary&Lat=0&long=0", "PDM Summary Report");
       }
             else if(document.getElementById('rdoPDM').checked) 
       {
 
            window.open("Report/Report.aspx?Type=PDMSummary&Lat=0&long=0", "PDM Summary Report");
             }
             else if (document.getElementById('rdoKAP').checked) {

                 window.open("Report/Report.aspx?Type=KAPProject&Lat=0&long=0", "KAP Summary Report");
             }
             else if (document.getElementById('rdoCons').checked) {
                 window.open("ReportViewer.aspx?Type=AllConstruction&Lat=0" + "&long=0", "All Construction Report");
                              }
            else if (document.getElementById('rdoProjMatrix').checked) {
                 window.open("ReportViewer.aspx?Type=AllProjMatrix&Lat=0" + "&long=0", "All Project Matrix Report");
                              }

//                var valuedrop=$("#KAP_PDMeport option:selected").val();
//                 if(valuedrop=="KAP")
//                 {
//                   var projectName=_Default.GetProjectName().Value;
//                   window.open("Report/Report.aspx?Type=KAPProject&Projectname=" + projectName + "&Lat=0&long=0", "KAV Project Report");
//                }
//                else
//                {
//                       window.open("Report/Report.aspx?Type=PDMSummary&Lat=0&long=0", "PDM Summary Report");
//                }
//        
    });

   


    

    $("#btnCreateProject").click(function () {

        var ProjectCode = $('#txtProjectCode').val();
        var ProjectName = $('#txtProjectName').val();
        
        if (ProjectCode.length == 0) {
            alert("Please enter Project Code.");
        }
        else if (ProjectName.length == 0) {
            alert("Please enter Project Name.");
        }       
        else {

            var result = _Default.CreateProject(ProjectCode, ProjectName).value;
            if (result == 1) {
                alert("Project created successfully.");                 
            }
            else if(result == 2)
            {
                  alert("Project Name or Code is aleady exist.");  
            }            
            else {
                alert("Project creation failed.");
            }
        }

    });

  

    $("#btnCeate").click(function () {

        var username = $('#txtUserName').val();
        var Password = $('#txtPassword').val();
        var CPassword = $('#txtCPassword').val();
        var RoleId = $('#ddlRole option:selected').val();

        if (RoleId == 0) {
            alert("Please select User Role.");
        }
        else if (username.length == 0) {
            alert("Please enter UserName.");
        }
        else if (Password.length == 0) {
            alert("Please enter Password.");
        }
        else if (CPassword.length == 0) {
            alert("Please enter Confirm Password.");
        }
        else if (!(Password === CPassword)) {
            alert("Password and Confirm Password are not matched.");
        }
        else {

            var result = _Default.CreateUser(username, Password, RoleId).value;
            if (result == 1) {
                alert("User created successfully.");                 
            }
            else if(result == 2)
            {
                  alert("This username is aleady exist.");  
            }
            else {
                alert("User creation failed.");
            }
        }

    });


    $("#btnCngUpdate").click(function () {

        var Password = $('#txtCngPassword').val();
        var newPassword = $('#txtCngNewPassword').val();
        var CPassword = $('#txtCngCPassword').val();

        if (Password.length == 0) {
            alert("Please enter current Password.");
        }
        else if (newPassword.length == 0) {
            alert("Please enter new Password.");
        }
        else if (CPassword.length == 0) {
            alert("Please enter Confirm Password.");
        }
        else if (!(Password === CPassword)) {
            alert("New Password and Confirm Password are not matched.");
        }
        else {

            var result = _Default.ChangePassword(Password, newPassword, CPassword).value;
            alert(result);

        }

    });

});

function ShowUserList(id, data) {

    try {
        BindColumn(data);
        $(id).w2grid(
		{
            name:$(id)[0].id,
            header: 'List of Users',
            show: {
                toolbar: true,
                footer: false,
                lineNumbers: true,
                toolbarDelete: true,
                toolbarColumns: false,
                toolbarReload: false,
                toolbarSearch: true,

            },
            reorderColumns: false,
            sortData: [{ field: 'Username', direction: 'asc' }],

            columns: [
             { caption: 'UserId', field: 'UserId', size: '50%', sortable: true, resizable: true },
             { caption: 'User Name', field: 'Username', size: '50%', sortable: true, resizable: true },
             { caption: 'User Role', field: 'Role', size: '50%', sortable: true, resizable: true },
            ],
            searches: [
               { field: 'UserId', caption: 'UserId', type: 'int' },
               { field: 'Username', caption: 'User Name', type: 'text' },
               { field: 'Role', caption: 'User Role', type: 'text' }
            ],           
            records: data,
             onDelete: function(event)
             {                
                var sel = this.getSelection();
                var DelUserId = this.records[sel[0] - 1]["UserId"]; 
                event.onComplete = function() 
				{ 
                 var result=  _Default.DeleteUser(DelUserId).value;
                 var UserList=_Default.UserList().value; 
                 $("#divGrid").w2destroy();
                 ShowUserList($("#divGrid"), UserList.Rows);              
                    
                } 
             }
             
       });
	}
    catch(e) 
    {
        var ex = e;
    }
}
function DownloadEdu() 
{ 
    window.open("DownloadPDM.aspx");
}

function DownloadKAP() 
{ 
    window.open("DownloadKAP.aspx");
}

function DownloadPDM() 
{ 
    window.open("DownloadPDM.aspx");
}

function DownloadConstruction_Trac() 
{ 
    window.open("Download_Construction.aspx");
}


function DownloadProj_Matr() 
{ 
    window.open("Download_pmatrix.aspx");
}



function onLogout() 
{ 
    window.location = "auth.aspx";
}

function onShowInfo()
{
    $( "#dialog" ).dialog({ width: "700px"});
}

function onWebTour()
{
 var tour = new Tour({
 placement: "left",
 smartPlacement: true,

  steps: [
  {
    element: "#maptools",
    title: "Map",
    content: "Click on the checkbox to see the layer on the map"
  },
  {
    element: "#maptoolsgis",
    title: "GIS Toolbar",
    content: "Use GIS Toolbar to naviagte through map"
  },
  {
    element: "#maptoolsreport",
    title: "Report",
    content: "Generate information report based on the survey data uploaded through mobile app"
  },
  {
    element: "#maptoolsdownload",
    title: "Download",
    content: "Download surveyed data uploaded through mobile app"
  }
]});

tour.init();
// Start the tour
tour.restart();

}



