<!DOCTYPE html>
<html>

	<head>
        @include('frontend.includes.head')
	</head>

	<body>
		<!-- Navigation -->
        @include('frontend.includes.nav')

		<!-- Banner -->
        @yield('banner')

		<!-- Content -->
		<div class="content">
			<div class="container">

                @yield('main')

			</div>
		</div>

		<!-- footer -->
        @include('frontend.includes.footer')
		
		<!-- Javascript -->
        @include('frontend.includes.script')

	</body>
</html>