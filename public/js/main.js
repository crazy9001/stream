var Stream = Stream || {};

Stream.showNotice = function (messageType, message, messageHeader) {
    toastr.options = {
        closeButton: true,
        positionClass: 'toast-top-right',
        onclick: null,
        showDuration: 1000,
        hideDuration: 1000,
        timeOut: 10000,
        extendedTimeOut: 1000,
        showEasing: 'swing',
        hideEasing: 'linear',
        showMethod: 'fadeIn',
        hideMethod: 'fadeOut'

    };
    toastr[messageType](message, messageHeader);
};

$(document).ready(function () {

    jQuery.ajaxSetup({
        headers: {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.source_stream').selectpicker();

    $('#button_stream').on('click', function () {

        var source_stream = $('#source_stream').val();
            url_server = $("input[name=url_server]").val(),
            stream_key = $("input[name=stream_key]").val(),
            source_video = $("input[name=source_video]").val();
        $.ajax({
            type: "POST",
            url: window.Json.api_stream,
            data: {
                source_stream: source_stream,
                url_server: url_server,
                stream_key: stream_key,
                source_video: source_video
            },
            dataType: "json",
            success: function (result) {
                console.log(result);
            },
            error: function(xhr, status, error) {
                xhr = jQuery.parseJSON(xhr.responseText);
                Stream.showNotice('error', xhr.data, 'Error');
            }
        });

    });

});