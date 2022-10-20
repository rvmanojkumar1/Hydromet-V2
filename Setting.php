<?php
include_once('database.php'); 
include_once('adminHeader.php');
?>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
    <script type="text/javascript">
    var Sourcefolder="",Processfolder="",Errorfolder="";


function getfolder(e) {
    var files = e.target.files;
    var path = files[0].webkitRelativePath;
    var Folder = path.split("/");
  Sourcefolder=Folder[0];
  alert(path);

   var drive=  document.getElementById('foldername').value.split("\\");
document.getElementById('driveSource').value=drive[0]+'/';
}
function getfolder2(e) {
    var files = e.target.files;
    var path = files[0].webkitRelativePath;
    var Folder = path.split("/");
       var drive2=  document.getElementById('foldername2').value.split("\\");
   //alert(drive[0]);

    Processfolder=Folder[0];
    document.getElementById('driveProcess').value=drive2[0]+'\\';
}
function getfolder3(e) {
    var files = e.target.files;
    var path = files[0].webkitRelativePath;
    var Folder = path.split("/");
    Errorfolder=Folder[0];
       var drive3=  document.getElementById('foldername3').value.split("\\");
   //alert(drive[0]);
   document.getElementById('driveError').value=drive3[0]+'\\';
 
}

function submitdata()
{
	if (document.getElementById('Source').value=="") 
	{
		alert('Please Select Drive');
	}else if (Sourcefolder=="") 
						{
							alert('Please Select Folder');
						}
		else if (document.getElementById('Process').value=="") 
		{
			alert('Please Select Drive');
		}
								else if (Processfolder=="") 
								{
									alert('Please Select Folder');
								}
				else if (document.getElementById('Error').value=="") 
				{
					alert('Please Select Drive');
				}
						
										else if (Errorfolder=="") 
										{
											alert('Please Select Folder');
										}
										else{
var driveSource=	document.getElementById('Source').value;
var driveProcess=	document.getElementById('Process').value;
var driveError=	document.getElementById('Error').value;

window.location.href='setting.php?driveSource='+driveSource+'&driveProcess='+driveProcess+'&driveError='+driveError+'&Sourcefolder='+Sourcefolder+'&Processfolder='+Processfolder+'&Errorfolder='+Errorfolder;
}
}
</script>
<?php
if (isset($_GET['Sourcefolder'])&&isset($_GET['Processfolder'])&&isset($_GET['Errorfolder'])) {


}
?>
 
<center>
<form>
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<table>
	<tr>
		<td>
			
		
	
<b>Source folder</b>
</td>
</tr>
<tr>
		<td>
			
		
<input type="text" name="driveSource" id="driveSource" />
</td>
<td>

<input type="file" name="foldername" id="foldername" class="btn btn-default" required style="width: 100%" webkitdirectory mozdirectory msdirectory odirectory directory multiple onchange="getfolder(event)">
</td>
</tr>
<tr>
		<td>
<b>Process folder</b>
</td>
</tr>
<tr>
		<td>
<input type="text" name="driveProcess" id="driveProcess">
</td>
<td>
<input type="file" name="foldername2" id="foldername2" class="btn btn-default" style="width: 100%"
 webkitdirectory mozdirectory msdirectory odirectory directory multiple onchange="getfolder2(event)" required>
</td></tr>
<tr>
		<td>
<b>Error folder</b>
</td>
</tr>
<tr>
		<td>
<input type="text" name="driveError" id="driveError">
</td>
<td>
<input type="file" name="foldername3" id="foldername3" class="btn btn-default" style="width: 100%" webkitdirectory mozdirectory msdirectory odirectory directory multiple onchange="getfolder3(event)" required>
</td>
</tr>
</table>
<br>
<button type="button" class="btn btn-primary" onclick="submitdata()">Submit</button>
<button type="button" class="btn btn-danger">Cancel</button>
</div>
</form>

</center>
