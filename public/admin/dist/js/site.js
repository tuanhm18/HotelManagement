/* dependencies
 *  - jQuery
 *  - PNotify
 *  - moment
 *  - js-cookie
 *  - pace.js
 *  - jquery.confirm
 *  - codemirror
 *  - summernote
*/
var lang = $('html').attr('lang');
var dataTableDateTimeFmt = 'DD-MMM-YY HH:mm';
var dataTableDateFmt = 'DD-MMM-YY';
var defaultDateTimeFmt = 'MM/DD/YYYY HH:mm';
var defaultDateFmt = 'MM/DD/YYYY';
var parseDateTimeFmt = 'YYYY-MM-DD HH:mm:ss';
var parseDateFmt = 'YYYY-MM-DD';
var dateRangePickerApplyLabel = 'Apply';
var dateRangePickerCancelLabel = 'Cancel';
$(function () {
    // configure Pnotify
    moment.locale($('html').attr('lang'));
    moment().isoWeekday(7); // SUNDAY = 1

    // $.fn.dataTable.moment(dataTableDateTimeFmt);
    if (lang == 'vi') {
        defaultDateTimeFmt = 'DD/MM/YYYY HH:mm';
        defaultDateFmt = 'DD/MM/YYYY';
        dateRangePickerApplyLabel = 'Chọn';
        dateRangePickerCancelLabel = 'Hủy';
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
$(document).ready(function () {
    $(document).ajaxStart(function () { Pace.restart(); });

    $('input[type="file"]').on('change', function (e) {
        //get the file name
        var fileName = e.target.files[0].name;
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
});
function capitalize(str) {
    if (typeof str !== 'string') return ''
    return str.charAt(0).toUpperCase() + str.slice(1)
}
function leftPad(value, maxLength, letter = '0') {
    return String(letter.repeat(maxLength) + value).slice(-maxLength);
}
function AjaxErrorProcess(jqXHR, textStatus, errorThrown, callBackFailure) {
    if (jqXHR.status == 401) {
        location.href = home_url + '/login';
    } else if (jqXHR.status == 301 || jqXHR.status == 302) {
        redirectUrl = jqXHR.getResponseHeader('Location');
        //if (redirectUrl.toLowerCase().endsWith("login")) {
            location.href = home_url + redirectUrl;
        //}
    } else if (callBackFailure) {
        callBackFailure(jqXHR, textStatus, errorThrown);
    }
}
function AjaxGet(url, callBackSuccess, callBackFailure) {
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        //headers: { 'Authorization': 'Bearer ' + key },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            callBackSuccess(result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            AjaxErrorProcess(jqXHR, textStatus, errorThrown, callBackFailure);
        }
    });
}
function AjaxPost(url, data, callBackSuccess, callBackFailure) {
    $.ajax({
        url: url,
        type: 'POST',
        data: JSON.stringify(data),
        dataType: 'json',
        //headers: { 'Authorization': 'Bearer ' + key },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            callBackSuccess(result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            AjaxErrorProcess(jqXHR, textStatus, errorThrown, callBackFailure);
        }
    });
}
function AjaxPostForm(url, data, callBackSuccess, callBackFailure) {
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        dataType: 'json',
        //enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        //headers: { 'Authorization': 'Bearer ' + key },
        success: function (result) {
            callBackSuccess(result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            AjaxErrorProcess(jqXHR, textStatus, errorThrown, callBackFailure);
        }
    });
}
function AjaxPut(url, data, callBackSuccess, callBackFailure) {
    $.ajax({
        url: url,
        type: 'PUT',
        data: JSON.stringify(data),
        dataType: 'json',
        //headers: { 'Authorization': 'Bearer ' + key },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            callBackSuccess(result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            AjaxErrorProcess(jqXHR, textStatus, errorThrown, callBackFailure);
        }
    });
}
function AjaxPutForm(url, data, callBackSuccess, callBackFailure) {
    $.ajax({
        url: url,
        type: 'PUT',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        //headers: { 'Authorization': 'Bearer ' + key },
        success: function (result) {
            callBackSuccess(result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            AjaxErrorProcess(jqXHR, textStatus, errorThrown, callBackFailure);
        }
    });
}
function AjaxPatch(url, data, callBackSuccess, callBackFailure) {
    $.ajax({
        url: url,
        type: 'PATCH',
        data: JSON.stringify(data),
        dataType: 'json',
        //headers: { 'Authorization': 'Bearer ' + key },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            callBackSuccess(result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            AjaxErrorProcess(jqXHR, textStatus, errorThrown, callBackFailure);
        }
    });
}
function AjaxDelete(url, callBackSuccess, callBackFailure) {
    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        //headers: { 'Authorization': 'Bearer ' + key },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            callBackSuccess(result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            AjaxErrorProcess(jqXHR, textStatus, errorThrown, callBackFailure);
        }
    });
}
function AjaxDeleteWithData(url, data, callBackSuccess, callBackFailure) {
    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        data: data,
        //headers: { 'Authorization': 'Bearer ' + key },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            callBackSuccess(result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            AjaxErrorProcess(jqXHR, textStatus, errorThrown, callBackFailure);
        }
    });
}
function AjaxGetFile(url, callBackSuccess, callBackFailure) {
    $.ajax({
        url: url,
        type: 'GET',
        //headers: { 'Authorization': 'Bearer ' + key },
        xhrFields: {
            responseType: 'blob'
        },
        success: function (result) {
            callBackSuccess(result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            AjaxErrorProcess(jqXHR, textStatus, errorThrown, callBackFailure);
        }
    });
}
function CreateDownload(fileName, data) {
    var a = document.createElement('a');
    var url = window.URL.createObjectURL(data);
    a.href = url;
    a.download = fileName;
    document.body.append(a);
    a.click();
    a.remove();
    window.URL.revokeObjectURL(url);
}
function OpenNewWindow(url) {
    var a = document.createElement('a');
    a.href = url;
    a.target = "_blank";
    document.body.append(a);
    a.click();
    a.remove();
}

function PostNewWindow(action, jsonData) {
    var form = document.createElement('form');
    form.method = 'post';
    form.target = '_blank';
    form.action = action;

    var input;
    for (var key of Object.keys(jsonData)) {
        input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = jsonData[key];
        form.appendChild(input);
    }

    document.body.appendChild(form);
    form.submit();
    form.remove();
}

function ShowPrint(action, id) {
    var form = document.createElement('form');
    form.method = 'post';
    form.target = '_blank';
    form.action = action;

    var input = document.createElement('input');
    input.type = 'hidden';
    input.value = id;
    input.name = 'id';
    form.appendChild(input); 

    document.body.appendChild(form);
    form.submit();
    form.remove();
}

function ShowConfirm(title, content, yesCaption, noCaption, callback) {
    $.confirm({
        animation: 'zoom',
        closeAnimation: 'scale',
        theme: 'material',
        type: 'blue',
        title: title,
        icon: 'fa fa-question',
        content: content,
        buttons: {
            yes: {
                text: yesCaption,
                action: function () {
                    callback(true);
                }
            },
            no: {
                text: noCaption,
                action: function () {
                    callback(false);
                },
                keys: ['esc']
            }
        }
    });
}
/* status
    0: success, 1: warning, 2: error
 */
function ShowAlert(title, content, status = 0) {
    if (status == 0) {
        
    } else if (status == 1) {
      
    } else {
       
    }
}
function CreateSummerNote(selector, height, placeholder) {
    $(selector).summernote({
        placeholder: placeholder,
        tabsize: 2,
        height: height,
        codemirror: {
            mode: 'xml',
            htmlMode: true,
            lineNumbers: true,
            lineWrapping: false,
            styleActiveLine: true,
            matchBrackets: true
        },
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            // ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['action', ['undo', 'redo']],
            ['view', ['fullscreen', 'codeview']],
            // ['help', ['help']]
        ]
    });
}
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
function GenUrlFriendly(str) {
    if (str != null) {
        newtext = str.toLowerCase();
                    
        newtext = newtext.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/ig, 'a');
        newtext = newtext.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/ig, 'e');
        newtext = newtext.replace(/ì|í|ị|ỉ|ĩ/ig, 'i');
        newtext = newtext.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/ig, 'o');
        newtext = newtext.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/ig, 'u');
        newtext = newtext.replace(/ỳ|ý|ỵ|ỷ|ỹ/ig, 'y');
        newtext = newtext.replace(/đ/ig, 'd');

        newtext = newtext.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
        newtext = newtext.replace(/ +/g,'-');
        return newtext;
    } else {
        return '';
    }
}