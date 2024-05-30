<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href='{{asset("assets/bootstrap/bootstrap.min.css")}}'>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{asset('assets/sweet-alert/sweetalert.min.css')}}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 light:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white light:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script src='{{ asset("assets/jquery/jquery-3.6.0.min.js") }}'></script>
        <script src='{{ asset("assets/bootstrap/bootstrap.bundle.min.js") }}'></script>
        <script src='{{ asset("assets/sweet-alert/sweetalert2.js") }}'></script>
        <script src='{{ asset("assets/jquery-validate/jquery.validate.min.js") }}'></script>
        <script src='{{asset("assets/js/main.js")}}'></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".btn-delete-post").click(function () {
                    let id = $(this).data('id');
                    console.log('id = ', id);
                    Swal.fire({
                        html: "Are you sure you want to delete this post?",
                        type: "warning",
                        confirmButtonText: "Yes",
                        showCancelButton: true,
                        cancelButtonText: "No",
                        customClass: {
                            confirmButton: 'btn btn-primary',
                            cancelButton: 'btn btn-danger',
                        },
                    }).then((result) => {
                        if (!result.value) return;
                        $.ajax({
                            url: "{{route('post.delete', '')}}/" + id,
                            type: "DELETE",
                            dataType: "json",
                            cache: false,
                            success: function (res) {
                                if (res.type == "success") {
                                    toast(res.message, res.type);
                                    setTimeout(function (){
                                        window.location.reload();
                                    }, 500);
                                } else {
                                    toast(res.message, 'error');
                                }
                            },
                            error: function(xhr, error, thrown) {
                                if (xhr.status === 401) {
                                    toast("The session has been expired", "error");
                                    setTimeout(function () {
                                        window.location.href = "/";
                                    }, 3000);
                                } else {
                                    toast('Server error loading dialog', 'error');
                                }
                            }
                        });
                    });
                });
            })
        </script>
        <script>
            @include('components.response')
        </script>
    </body>
</html>
