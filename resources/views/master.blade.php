
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Modern, flexible and responsive Bootstrap 5 admin &amp; dashboard template">
	<meta name="author" content="Bootlab">

	<title>Monitoring PT Tristar</title>

	@include('assets.css')
	<!-- END SETTINGS -->
</head>

<body>
	<div class="splash active">
		<div class="splash-icon"></div>
	</div>

	<div class="wrapper">
		@include('assets.sidebar')
		<div class="main">
			@include('assets.navbar')
			<main class="content">
				<div class="container-fluid">

					@yield('content')

				</div>
			</main>
			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-8 text-start">
							{{-- <ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Terms of Service</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Contact</a>
								</li>
							</ul> --}}
						</div>
						<div class="col-4 text-end">
							<p class="mb-0">
								&copy; 2025 - <a href="dashboard-default.html" class="text-muted">MONITORING PIPA</a>
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

    @include('assets.js')

</body>

</html>