<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
<script src="{{ asset('assets/js/scrollbar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('assets/js/sidebar-pin.js') }}"></script>
<script src="{{ asset('assets/js/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/js/header-slick.js') }}"></script>
@yield('scripts')
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    @if(session('error_horario'))
        Swal.fire({
            icon: 'error',
            title: 'Horario Ocupado',
            text: '{!! session('error_horario') !!}',
            confirmButtonText: '<span style="color: #ffffff; font-weight: bold;">Entendido</span>',
            confirmButtonColor: '#7366ff'
        });
    @endif

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Excelente!',
            text: '{!! session('success') !!}',
            timer: 2500,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'warning',
            title: 'Atención',
            text: '{!! session('error') !!}',
            confirmButtonColor: '#7366ff'
        });
    @endif
});
</script> 
