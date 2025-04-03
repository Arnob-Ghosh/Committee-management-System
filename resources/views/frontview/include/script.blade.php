<!-- Vendor JS Files -->
<script src="{{ asset('frontview/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontview/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('frontview/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontview/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('frontview/vendor/waypoints/noframework.waypoints.js') }}"></script>
<script src="{{ asset('frontview/vendor/php-email-form/validate.js') }}"></script>

{{-- jQuery CDN Plugin --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

{{-- <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script> --}}
<script src="{{ asset('frontview/js/jquery.bootstrap.newsbox.min.js') }}" type="text/javascript"></script>

<!-- Template Main JS File -->
<script src="{{ asset('frontview/js/main.js') }}"></script>

<!-- Toastr JS  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{-- <script type="text/javascript" src="{{asset('scripts/toastr/toastr.min.js')}}"> --}}
<!-- Toastr calling JS Methods -->
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
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
</script>
<script>
    @if ( Session::has('message') )
        var type = "{{ Session::get('alert-type', 'info') }}" ;

        switch (type) {
            case 'info':
                toastr.info( "{{ Session::get('message') }}" );
            break;
            case 'success':
                toastr.success( "{{ Session::get('message') }}" );
            break;
            case 'warning':
                toastr.warning( "{{ Session::get('message') }}" );
            break;
            case 'error':
                toastr.error( "{{ Session::get('message') }}" );
            break;
        }
    @endif
</script>
