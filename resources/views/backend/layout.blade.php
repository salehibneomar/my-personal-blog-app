<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.includes.head')
</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- nav -->
            @include('backend.includes.nav')
            <!-- nav END -->

            <!-- Sidebar START -->
            @include('backend.includes.sidebar')
            <!-- Sidebar END -->

            <!-- Page Container START -->
            <div class="page-container">
                

                <!-- Content Wrapper START -->
                <div class="main-content">
                    @yield('main')
                </div>
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                @include('backend.includes.footer')
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->

        </div>
    </div>

    
    <!-- script -->
    @include('backend.includes.script')

</body>

</html>