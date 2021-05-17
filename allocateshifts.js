$(function () {

    var addList = function (o) {
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
                addList(data);
            }
        });
    }

    $("#shiftList").on('change', function () {
        var selected, inputDate, id;
        if ($(this).val()) {
            selected = $(this).find('option:selected');
            inputDate = selected.attr('class');
            id = selected.val();
            $(".idInput").val(id);
            ajaxFiltList(inputDate);
        } else {
            $(".list-group").html("<h5>Please select a shift.</h5>");
        }
    });
})