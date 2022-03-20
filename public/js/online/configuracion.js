function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            $('#img').remove();
            $('#uploadForm + img').remove();
            $('#uploadForm').after('<img src="' + e.target.result + '"width="300" height="300"/>');
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
            $('#uploadForm2').after('<img src="' + e.target.result + '"width="300" height="300"/>');
        }
    }
}

function filePreview3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            $('#img3').remove();
            $('#uploadForm3 + img').remove();
            $('#uploadForm3').after('<img src="' + e.target.result + '"width="300" height="300"/>');
        }
    }
}

function filePreview4(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            $('#img4').remove();
            $('#uploadForm4 + img').remove();
            $('#uploadForm4').after('<img src="' + e.target.result + '"width="400" height="200"/>');
        }
    }
}


function filePreview5(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            $('#img5').remove();
            $('#uploadForm5 + img').remove();
            $('#uploadForm5').after('<img src="' + e.target.result + '"width="400" height="200"/>');
        }
    }
}

function filePreview6(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            $('#img6').remove();
            $('#uploadForm6 + img').remove();
            $('#uploadForm6').after('<img src="' + e.target.result + '"width="400" height="200"/>');
        }
    }
}



$("#imagen1").change(function () {
    filePreview(this);
});

$("#imagen2").change(function () {
    filePreview2(this);
});

$("#imagen3").change(function () {
    filePreview3(this);
});

$("#imagen4").change(function () {
    filePreview4(this);
});

$("#imagen5").change(function () {
    filePreview5(this);
});

$("#imagen6").change(function () {
    filePreview6(this);
});

