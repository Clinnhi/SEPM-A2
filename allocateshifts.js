$(function () {

    var addList = function (o) {
        console.log(o.length);
        if (o && !(o instanceof Array)) {
            $(".list-group").html("");
            for (let key in o) {
                var content, id = key, name = o[key];
                content = `<div class="p-4 border bg-light"><input class="form-check-input" type="radio" name="employee" value="` + id + `" id="check` + id + `">
                <label class="form-check-label" for="check`+ id + `">
                    `+ name + `
                </label>
            </div>`;
                $(".list-group").append(content);
            }
        } else {
            $(".list-group").html("<h5>There is no available employee now.</h5>");
        }

    }

    var ajaxFiltList = function (inputDate) {
        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: { inpDate: inputDate },
            dataType: "json",
            error: function () {
                alert('Error loading XML document');
            },
            success: function (data, status) {
                console.log(data);
                addList(data);
            }
        });
    }

    $("#shiftList").on('change', function () {
        var inputDate;
        if ($(this).val()) {
            inputDate = $(this).find('option:selected').attr('class');
            console.log(inputDate);
            ajaxFiltList(inputDate);
        } else {
            $(".list-group").html("<h5>Please select a shift.</h5>");
        }
    });
})