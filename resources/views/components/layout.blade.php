<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
	<title>{{ $title ?? 'Dashboard' }} &mdash; Inventaris SMA 1 Pangkalan Kerinci</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}" />

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap4.css" />

	<!-- Template CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/css/components.css') }}" />

	<!-- External CSS (Tom Select) -->
	<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tom-select/1.4.0/css/tom-select.bootstrap4.min.css" />
</head>

<body>
	<div id="app">
		<div class="main-wrapper">
			<div class="navbar-bg"></div>
			<nav class="navbar navbar-expand-lg main-navbar">
				<form class="form-inline mr-auto">
					<ul class="navbar-nav mr-3">
						<li>
							<a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
								<i class="fas fa-bars"></i>
							</a>
						</li>
					</ul>
				</form>
				<ul class="navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
							<img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1" />
							<div class="d-sm-none d-lg-inline-block">Halo, {{ auth()->user()->name }}</div>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="dropdown-title">Akun sejak: {{ auth()->user()->created_at->diffForHumans() }}</div>
							@can('mengatur profile')
							<a href="{{ route('profile.index') }}" class="dropdown-item has-icon">
								<i class="fas fa-cog"></i> Pengaturan Profil
							</a>
							@endcan
							<div class="dropdown-divider"></div>
							<form id="logout-form" action="{{ route('logout') }}" method="POST">
								@csrf
								<button type="submit" class="dropdown-item has-icon text-danger">
									<i class="fas fa-sign-out-alt"></i> Logout
								</button>
							</form>
						</div>
					</li>
				</ul>
			</nav>

			<div class="main-sidebar">
				<aside id="sidebar-wrapper">
					<div class="sidebar-brand">
						<a href="{{ route('home') }}">
							<p>Inventaris <br> SMA 1 Pangkalan Kerinci</p>
						</a>
					</div>
					<div class="sidebar-brand sidebar-brand-sm">
						<a href="{{ route('home') }}">{{ substr(config('app.name'), 0, 2) }}</a>
					</div>
					<ul class="sidebar-menu">
						<li class="menu-header">Dashboard</li>
						<li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
							<a href="{{ route('home') }}" class="nav-link">
								<i class="fas fa-fire"></i><span>Dashboard</span>
							</a>
						</li>
						<li class="menu-header">Manajemen</li>
						@can('lihat barang')
						<li class="nav-item {{ request()->routeIs('barang.index') ? 'active' : '' }}">
							<a href="{{ route('barang.index') }}" class="nav-link">
								<i class="fas fa-boxes-stacked"></i> <span>Data Barang</span>
							</a>
						</li>
						@endcan
						@can('lihat bos')
						<li class="nav-item {{ request()->routeIs('bantuan-dana-operasional.index') ? 'active' : '' }}">
							<a class="nav-link" href="{{ route('bantuan-dana-operasional.index') }}">
								<i class="far fa-face-laugh"></i> <span>Data BOS</span>
							</a>
						</li>
						@endcan
						@can('lihat ruangan')
						<li class="nav-item {{ request()->routeIs('ruangan.index') ? 'active' : '' }}">
    						<a href="{{ route('ruangan.index') }}" class="nav-link">
        						<i class="fas fa-map-location-dot"></i> <span>Data Ruangan</span>
   					 		</a>
						</li>
						@endcan
						<!-- New Sidebar Link for "Data Item Baru" -->
						@can('lihat item')
						<li class="nav-item {{ request()->routeIs('item.index') ? 'active' : '' }}">
							<a href="{{ route('item.index') }}" class="nav-link">
								<i class="fas fa-clipboard-list"></i> <span>Data Item Baru</span>
							</a>
						</li>
						@endcan

						@can('lihat jadwal')
						<li class="nav-item {{ request()->routeIs('jadwal.index') ? 'active' : '' }}">
    						<a href="{{ route('maintenance-schedule.index') }}" class="nav-link">
       							<i class="fas fa-calendar-alt"></i> <span>Jadwal Pemeliharaan</span>
    						</a>
						</li>
						@endcan
						@can('lihat pengguna')
						<li class="nav-item {{ request()->routeIs('pengguna.index') ? 'active' : '' }}">
							<a href="{{ route('pengguna.index') }}" class="nav-link">
								<i class="fas fa-users"></i> <span>Data Pengguna</span>
							</a>
						</li>
						@endcan
						<li class="menu-header">Pengaturan</li>
						@can('mengatur profile')
						<li class="nav-item {{ request()->routeIs('profile.index') ? 'active' : '' }}">
							<a href="{{ route('profile.index') }}" class="nav-link">
								<i class="fas fa-cog"></i> <span>Pengaturan Profil</span>
							</a>
						</li>
						@endcan
						@can('lihat peran dan hak akses')
						<li class="nav-item {{ request()->routeIs('peran-dan-hak-akses.index') ? 'active' : '' }}">
							<a href="{{ route('peran-dan-hak-akses.index') }}" class="nav-link">
								<i class="fas fa-user-shield"></i> <span>Peran & Hak Akses</span>
							</a>
						</li>
						@endcan
					</ul>

					<div class="mt-4 mb-4 p-3 hide-sidebar-mini">
						<form id="logout-form" action="{{ route('logout') }}" method="POST">
							@csrf
							<button type="submit" class="btn btn-danger btn-lg btn-block btn-icon-split logout">
								<i class="fas fa-sign-out-alt"></i> Logout
							</button>
						</form>
					</div>
				</aside>
			</div>

			<!-- Main Content -->
			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>{{ $page_heading }}</h1>
					</div>

					{{ $slot }}
				</section>
			</div>
		</div>
	</div>

	<!-- General JS Scripts -->
	<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ asset('assets/js/popper.min.js') }}"></script>
	<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
	<script src="{{ asset('assets/js/moment.min.js') }}"></script>
	<script src="{{ asset('assets/js/stisla.js') }}"></script>

	<!-- JS Libraries -->
	<script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
	<script src="https://cdn.datatables.net/2.0.6/js/dataTables.bootstrap4.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<!-- Template JS File -->
	<script src="{{ asset('assets/js/scripts.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>

	<!-- Page Specific JS File -->
	<script src="{{ asset('assets/js/page/index-0.js') }}"></script>

	<!-- External JS (Tom Select, ApexCharts) -->
	<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

	<script>
		$(document).ready(function () {
			// Handle delete confirmation
			$(".delete-button").click(function (e) {
				e.preventDefault();
				Swal.fire({
					title: "Hapus?",
					text: "Data tidak akan bisa dikembalikan!",
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: "Ya",
					cancelButtonText: "Batal",
					reverseButtons: true,
				}).then((result) => {
					if (result.value) {
						$(this).parent().submit();
					}
				});
			});

			// Handle logout confirmation
			$(".logout").click(function (e) {
				e.preventDefault();
				Swal.fire({
					title: "Keluar?",
					text: "Anda akan keluar dari aplikasi!",
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: "Ya",
					cancelButtonText: "Batal",
					reverseButtons: true,
				}).then((result) => {
					if (result.value) {
						$(this).parent().submit();
					}
				});
			});
		});
	</script>

	@stack('modal')
	@stack('js')

</body>

</html>
