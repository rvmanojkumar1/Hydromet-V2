<script type="text/javascript">
$(document).ready(function() {
  $("#grid").shieldGrid({
    dataSource: {
      data: gridData,
      schema: {
        fields: {
          id: {
            path: "id",
            type: Number
          },
          age: {
            path: "age",
            type: Number
          },
          name: {
            path: "name",
            type: String
          },
          company: {
            path: "company",
            type: String
          },
          month: {
            path: "month",
            type: Date
          },
          isActive: {
            path: "isActive",
            type: Boolean
          },
          email: {
            path: "email",
            type: String
          },
          transport: {
            path: "transport",
            type: String
          }
        }
      }
    },
    rowHover: false,
    columns: [{
      field: "name",
      title: "Person Name",
      width: "120px"
    }, {
      field: "age",
      title: "Age",
      width: "80px"
    }, {
      field: "company",
      title: "Company Name"
    }, {
      field: "month",
      title: "Date of Birth",
      format: "{0:MM/dd/yyyy}",
      width: "120px"
    }, {
      field: "isActive",
      title: "Active"
    }, {
      field: "email",
      title: "Email Address",
      width: "250px"
    }, {
      field: "transport",
      title: "Custom Editor",
      width: "120px",
      editor: myCustomEditor
    }, {
      width: "104px",
      title: "Delete Row",
      buttons: [{
        cls: "deleteButton",
        commandName: "delete",
        caption: "<img src='https://www.prepbootstrap.com/Content/images/template/BootstrapEditableGrid/delete.png' /><span>Delete</span>"
      }]
    }],
    editing: {
      enabled: true,
      event: "click",
      type: "cell",
      confirmation: {
        "delete": {
          enabled: true,
          template: function(item) {
            return "Delete row with ID = " + item.id
          }
        }
      }
    },
    events: {
      getCustomEditorValue: function(e) {
        e.value = $("#dropdown").swidget().value();
        $("#dropdown").swidget().destroy();
      }
    }
  });

  function myCustomEditor(cell, item) {
    $('<div id="dropdown"/>')
      .appendTo(cell)
      .shieldDropDown({
        dataSource: {
          data: ["motorbike", "car", "truck"]
        },
        value: !item["transport"] ? null : item["transport"].toString()
      }).swidget().focus();
  }
});


</script>


<div class="container">

  <div class="page-header">
    <h1>An Editable Grid with jQuery, Bootstrap, and Shield UI Lite</h1>
  </div>

  <!-- Editable Grid - START -->

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="text-center">Click inside any of the content cells to edit the grid.<span class="fa fa-edit pull-right bigicon"></span></h4>
      </div>
      <div class="panel-body text-center">
        <div id="grid"></div>
      </div>
    </div>
  </div>
</div>

<p class="p">Demo by David Johnson. <a href="http://www.sitepoint.com/editable-grid-jquery-bootstrap-shield-ui-lite" target="_blank">See article</a>.</p>