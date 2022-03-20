function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            $('#img').remove();
            $('#uploadForm + img').remove();
            $('#uploadForm').after('<img src="' + e.target.result + '"width="400" height="200"/>');
        }
    }
}

function filePreview2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            $('#img2').remove();
            $('#uploadForm2 + img').remove();
            $('#uploadForm2').after('<img src="' + e.target.result + '"width="200" height="200"/>');
        }
    }
}


$("#escritorio").change(function () {
    filePreview(this);
});

$("#movil").change(function () {
    filePreview2(this);
});