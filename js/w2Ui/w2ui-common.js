

function GetArray(data)
{
    var dataArray = new Array();
    if (data.length != 0)
    {
        var dataKey = Object.keys($(data)[0])[0];
    $(data).each(function (index) {
       
       if ($(this)[0][dataKey]!=null){
           dataArray.push($(this)[0][dataKey].toString())
       }
    });
    }
   

    return dataArray;

}




//add 'recid' extra column for show data in w2Ui grid and style for highlight row for read
function BindColumn(data) {
   
    $.each(data, function (i, item) {
        Count = i + 1;
        item["recid"] = Count;
        if (data[i].IsRead == false) {
            item["style"] = "background-color: #e4e4e4;font-weight: bold;";

        }
       
    });

}
function BindColumn1(data) {

    $.each(data, function (i, item) {
        Count = 'p' + i + 1;
        item["recid"] = Count;
        if (data[i].IsRead == false) {
            item["style"] = "background-color: #e4e4e4;font-weight: bold;";

        }

    });

}


//add 'recid' extra column for show data in w2Ui grid and if account is locked or user/group is inactive then background color of particular row has been changed
function BindColoredColumn(data) {
    
    $.each(data, function (i, item) {
        
        Count = i + 1;
        item["recid"] = Count;
        
        
        if (data[i].WorkOrderNumber == WoNoMapView) {
            item["style"] = "background-color: #fcc;";
        }
    });

}

function BindSelectedColumn(data) {

    $.each(data, function (i, item) {
        Count = i + 1;
        item["recid"] = Count;
        if (data[i].IsRead == false) {
            item["style"] = "background-color: #e4e4e4;font-weight: bold;";

        }
        if (i == 0) {
            item["style"] = "background-color: #0faf8b;font-weight: bold;";

        }
    });


}