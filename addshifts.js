$(function () {
    var inputDate = $(".date").val();

    var addList = function (o) {
        if (o.length !== 0) {
            $(".list-group").html("<h5>Select Who Should Work The Shift</h5>");
        } else {
            $(".list-group").html("<h7>There are no employees available.</h7>");
        }

        for (let key in o) {
            $(".list-group").append("<li class=\"list-group-item\">   <input class=\"form-check-input me-1\" type=\"radio\" value=\"" + key + "\" aria-label=\"...\" name=\"employee[]\"> " + o[key] + "        </li>           ");
        }
    }

    $.ajax({
        url: "ajax.php",
        type: "POST",
        data: { inpDate: inputDate },
        dataType: "json",
        error: function () {
            alert('Error loading XML document');
        },
        success: function (data, status) {
            // console.log(status);
            console.log(data);
            addList(data);
        }
    });

    $(".date").bind('input propertychange', function () {
        inputDate = $(".date").val();
        //console.log(inputDate);
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: { inpDate: inputDate },
            dataType: "json",
            error: function () {
                alert('Error loading XML document');
            },
            success: function (data, status) {
                // console.log(status);
                console.log(data);
                addList(data);
            }
        });
    })
})