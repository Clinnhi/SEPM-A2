$(function () {










    var addList = function (o) {
        for (let key in o) {
            var content, id = key, name = o[key];
            content = `<div class="p-4 border bg-light"><input class="form-check-input" type="radio" name="employee" value="` + id + `" id="check` + id + `">
            <label class="form-check-label" for="check`+ id + `">
                `+ name + `
            </label>
        </div>`;
            $(".list-group").html(content);
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
        }
    });
})