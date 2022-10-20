 

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




<?php
function myAlert($msg)
{
?>

 <div class="modal fade" id="myModal" role="dialog" style="margin-top: 15%;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
     
       <center><h4><?php echo "$msg";?></h4></center>   
     
        <div class="modal-footer">
        <center>
                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>

        </center>
        </div>
      </div>
      
    </div>
  </div>
<?php

  }
  ?>

  <?php
  function myConfirm($msg)
{
  ?>
<div id="dialog-confirm" title="Delete ?" style="display: none">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span><?php echo $msg;?></p>
</div>
<?php
}
  ?>