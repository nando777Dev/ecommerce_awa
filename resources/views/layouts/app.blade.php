<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>@yield('title')
    </title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-VpYfsHBZ0S4Sd//Vx2lJBnS5A8nG4z5w6WcT/EOm2FyXUjpxx6K8hOb/J+nl1XCUl7I6EowRbCm5w5cc2p3Gsg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .spinner-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            border: 0.25em solid #ccc;
            border-top: 0.25em solid #333;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    @include('layouts.partials.css')

</head>
<body>

<div class="loader">
    <div class="spinner-load">
        <div class="dot1"></div>
        <div class="dot2"></div>
    </div>
</div>

<!--HEADER-->
  @include('layouts.partials.header')
           @yield('content')
  <div class="container">
        <div class="spinner-overlay d-flex">
            <div class="spinner-border"></div>
            <div class="ml-2">Aguarde, redirecionando para a página de pagamento...</div>
        </div>
  </div>

<!--Footer-->
@include('layouts.partials.footer')

@include('layouts.partials.javascripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
        @endif
        @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
        @endif
        @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
        @endif
        @if(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
        @endif

        function redirectWithDelay(url, fallbackUrl) {
            var win = window.open(url, '_blank');
            if (win) {
                document.querySelector('.spinner-overlay').style.display = 'flex';
                setTimeout(function() {
                    window.location.href = fallbackUrl;
                }, 5000);
            } else {
                alert('Por favor, permita pop-ups para esta ação.');
            }
        }

        @if(Session::has('redirectUrl'))
        redirectWithDelay("{{ Session::get('redirectUrl') }}", "{{ route('minhas-compras') }}");
        @endif
    </script>
</body>
</html>
