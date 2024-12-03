<!DOCTYPE html>
<html lang="en">
<!-- ***** Head Start ***** -->

<head>
    @include('frontend.layout._head')
</head>
<!-- ***** Head end ***** -->

<body>
    <!-- ***** Preloader Start ***** -->
    @include('frontend.layout._preloader')
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    @extends('frontend.layout._header')
    @section('condition-header')
        @include('frontend.layout._headerHome')
    @endsection
    <!-- ***** Header Area End ***** -->


    <!-- ***** Reservation Us Area Starts ***** -->
    @include('frontend.layout._reservation')
    <!-- ***** Reservation Area Ends ***** -->

    <!-- ***** Footer Start ***** -->
    @include('frontend.layout._footer')
    <!-- ***** Footer End  ***** -->
    @yield('modal')
    @yield('script')
</body>

</html>
