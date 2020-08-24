// SOURCE: https://codepen.io/doud/pen/yXWBJv

$(function () {
    $("#tableAdd").bind("click", function () {
        var div = $("<tr />");
        div.html(GetDynamicTextBox(""));
        $("#dataFields").append(div);
    });
    $("body").on("click", ".remove", function () {
        $(this).closest("tr").remove();
    });
});
function GetDynamicTextBox(value) {
    return  '<td><button type="button" class="btn btn-danger remove btn-json"><i class="fas fa-times-circle"></i> Remove</button></td>'
            + '<td><input oninput="formValidation(this.value);" class="form-control" name="nameMatch[]" type="text" value = "' + value + '" class="form-control" /></td>'
            + '<div class="invalid-feedback">Please fill out this field correctly.</div>'
            + '<td><input oninput="formValidation(this.value);" class="form-control" name="indexMatch[]" type="number"></td>'
            + '<div class="invalid-feedback">Please fill out this field correctly.</div>'
            + '<td><select name="dataType[]" class="form-control"><option value="txt">Texte</option><option value="date">Date</option><option value="url">URL</option><option value="ip">IP</option></select></td>'
            + '<div class="invalid-feedback">Please fill out this field correctly.</div>'
}