function ReadImageUrl(input, imgId, label) {
    if (input.files && input.files[0]) {
        document.getElementById(label).innerText = input.files[0].name;
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById(imgId).src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}