<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta content="{{$description ?? ''}}" name="description">
		<meta content="wendel ulhoa" name="author">
		<meta name="keywords" content="{{isset($keywords) ? $keywords : $description ?? 'aas'}}"/>
		@laravelPWA

		<script src="{{asset('OneSignalSDKWorker.js')}}"></script>
		<!-- Title -->
		<link rel="sortcut icon" href="" type="image/x-icon" />
		<title>{{$title ?? 'Amigo oculto'}}</title>

		<!--Bootstrap css-->
		<link rel="stylesheet" href="{{ mix('/plugins/bootstrap/css/bootstrap.min.css') }}">

		<!--Style css -->
		<link href="{{ mix('/css/style.css') }}" rel="stylesheet" />
		<link href="{{ mix('/css/dark-style.css') }}" rel="stylesheet" />
		{{-- <link href="{{ mix('/css/skin-modes.css') }}" rel="stylesheet"> --}}
		<link href="{{ mix('/css/icons.css') }}" rel="stylesheet">
		<link href="{{ mix('/plugins/accordion/accordion.css') }}" rel="stylesheet">

		<!-- P-scrollbar css-->
		<link href="{{ mix('/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

		<!-- Sidemenu css -->
		<link href="{{ mix('/plugins/sidemenu/sidemenu.css') }}" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" />
		<!--Daterangepicker css-->
		<link href="{{ mix('/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" />

		<!-- Rightsidebar css -->
		<link href="{{ mix('/plugins/sidebar/sidebar.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<style>
			
			#global-loader img {
				position: inherit !important;
			}
			.global-hide{
				display: none;
			}
			.global-see{
				display: block !important;
			}
			.app-header, .app-sidebar{
				opacity: 0.9;
			}

			.app-sidebar{
				top: -1px !important;
			}
		</style>
		@yield('script-css')
	</head>

	<body class="app sidebar-mini rtl">
		<div id="global-loader">
			<img src="{{ mix('/images/loader.svg') }}" alt="loader">
		</div>
		
		<div class="page">
			<div class="page-main">
					{{-- header menu --}}
				@include('template.header-menu')
				
				@include('template.sidebar-menu')

				

                <!-- app-content-->
				<div class="app-content toggle-content">
					<div class="side-app">
					    <!-- page-header -->
						
						<div class="page-header">
							<h1 class="page-title">{{ $type ?? 'Amigo oculto' }}</h1>
						</div>
						@yield('content')
					</div>

				</div>
				<!-- End app-content-->

				<!--Footer-->
				<footer class="footer side-footer">
					<div class="container">
						<div class="row align-items-center">
							<div class="social">
								<ul class="text-center">
									<li>
										<a href="#" class="social-icon" href=""><i class="fab fa-facebook-square"></i></a>
									</li>
									<li>
										<a href="#" class="social-icon" href=""><i class="fa fa-rss"></i></a>
									</li>
									<li>
										<a href="#" class="social-icon" href="https://www.youtube.com/channel/UCidYh2oEwCPegcEvsZqhO7g"><i class="fab fa-youtube"></i></a>
									</li>
									<li>
										<a href="#" class="social-icon" href=""><i class="fab fa-instagram"></i></a>
									</li>
								</ul>
							</div>
							<div class="col-lg-12 col-sm-12   text-center">
								Copyright © 2021 <a href="#">Ulhoa developer</a>. Designed by <a href="#">Ulhoa</a> todos os direitos reservados.
							</div>
						</div>
					</div>
				</footer>
				<!-- End Footer-->

			</div>
		</div>
		<!-- End Page -->

		<!-- Back to top -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
		<!-- Jquery js-->
		<script src="{{ mix('/js/jquery-3.4.1.min.js') }}"></script>

		<!--Bootstrap.min js-->
		<script src="{{ mix('/plugins/bootstrap/js/popper.min.js') }}"></script>
		<script src="{{ mix('/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!--Jquery Sparkline js-->
		<script src="{{ mix('/js/jquery.sparkline.min.js') }}"></script>

		<!-- Chart Circle js-->
		<script src="{{ mix('/js/circle-progress.min.js') }}"></script>

		<!-- Daterangepicker js-->
		<script src="{{ mix('/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

		<!--Side-menu js-->
		<script src="{{ mix('/plugins/sidemenu/sidemenu.js') }}"></script>

		<!--Time Counter js-->
		<script src="{{ mix('/plugins/counters/jquery.missofis-countdown.js') }}"></script>
		<script src="{{ mix('/plugins/counters/counter.js') }}"></script>
		<script src="{{ mix('/plugins/accordion/accordion.min.js') }}"></script>
		<script src="{{ mix('/plugins/accordion/accordions.js') }}"></script>
		<script src="{{ mix('/plugins/input-mask/jquery.mask.min.js') }}"></script>

		<!-- Rightsidebar js -->
		<script src="{{ mix('/plugins/sidebar/sidebar.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<!-- Custom js-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
		<script src="{{ mix('/js/custom.js') }}"></script>
		@stack('script-js')
		@include('template.global-js', ['route'=> $route ?? '', 'type'=> $type ?? ''])
		<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
		<script>
			window.OneSignal = window.OneSignal || [];
			OneSignal.push(function() {
				OneSignal.getUserId().then(function(userId) {
					console.log("OneSignal User ID:", userId);
				});
				
				OneSignal.init({
					appId: "d5246ff5-fe8b-4fa5-ab49-f7e3bb647a0f",
					safari_web_id: "web.onesignal.auto.38b1a4de-a361-440e-ae28-b71c05790af2",
					notifyButton: {
						enable: true,
					}
				});

				OneSignal.on('notificationPermissionChange', function(permissionChange) {
					var currentPermission = permissionChange.to;
					console.log(permissionChange)
					// if(currentPermission == 'granted' || )

				});
			});

			setInterval(() => {
				
			}, 5);

			// console.log("Site notification permission: ", await OneSignal.getNotificationPermission());
			// console.log("Push enabled: ", await OneSignal.isPushNotificationsEnabled());
			// console.log("Player id: ", );
		</script>
	</body>
</html>
