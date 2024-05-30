$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function toast(title, type) {
    Swal.fire({
        toast: true,
        title: title,
        text: '',
        type: type,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        // timerProgressBar: true,
    });
}

function open_modal(url) {
    $.ajax({
        url: url,
        type: "GET",
        data: {},
        dataType: "json",
        cache: false,
        success: function (res) {
            $("#global-modal-title").html(res.title);
            $("#global-modal-body").html(res.html);
            $("#global-modal").modal("show");
        },
        error: function(xhr, error, thrown) {
            if(xhr.status === 401) {
                toast("The session has been expired", "error");
                setTimeout(function(){
                    window.location.href = "/";
                },3000);
            }
            else{
                toast('Server error loading dialog', 'error');
            }
        }
    });
}
