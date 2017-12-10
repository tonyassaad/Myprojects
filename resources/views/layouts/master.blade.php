<!DOCTYPE html>
<html>

    <!--incude begins-->
    @include('include.header')
    <!--include ends-->

    <body>
        <div id="wrapper">
            <!-- nav template START-->
            @include('include.navbar')
            <!-- nav template END-->
            <div id="page-wrapper" class="gray-bg">
                <!-- menu template START-->
                @include('include.menu')
                <!-- menu template END-->
                @yield('content')
                <!--footer begins-->
               
                <!--footer ends-->
            </div>
        </div>
        @include('include.js_components')
 
    </body>

</html>