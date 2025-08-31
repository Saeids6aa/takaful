@extends('layouts.app')

@section('content')
	<div class="row gy-5 g-xl-8">
		{{-- Authors --}}
		<div class="col-xl-4">
			<div class="card card-xl-stretch mb-xl-8">
				<div class="card-header border-0">
					<h3 class="card-title fw-bolder text-dark">Authors</h3>
					<div class="card-toolbar"></div>
				</div>

				<div class="card-body pt-2">
					<div class="d-flex align-items-center mb-7">
						<div class="symbol symbol-50px me-5">
							<img src="{{ asset('backend/assets/media/avatars/150-1.jpg') }}" alt="">
						</div>
						<div class="flex-grow-1">
							<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Emma Smith</a>
							<span class="text-muted d-block fw-bold">Project Manager</span>
						</div>
					</div>

					<div class="d-flex align-items-center mb-7">
						<div class="symbol symbol-50px me-5">
							<img src="{{ asset('backend/assets/media/avatars/150-4.jpg') }}" alt="">
						</div>
						<div class="flex-grow-1">
							<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Sean Bean</a>
							<span class="text-muted d-block fw-bold">PHP, SQLite, Artisan CLI</span>
						</div>
					</div>

					<div class="d-flex align-items-center mb-7">
						<div class="symbol symbol-50px me-5">
							<img src="{{ asset('backend/assets/media/avatars/150-12.jpg') }}" alt="">
						</div>
						<div class="flex-grow-1">
							<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Brian Cox</a>
							<span class="text-muted d-block fw-bold">PHP, SQLite, Artisan CLI</span>
						</div>
					</div>

					<div class="d-flex align-items-center mb-7">
						<div class="symbol symbol-50px me-5">
							<img src="{{ asset('backend/assets/media/avatars/150-8.jpg') }}" alt="">
						</div>
						<div class="flex-grow-1">
							<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Francis Mitcham</a>
							<span class="text-muted d-block fw-bold">PHP, SQLite, Artisan CLI</span>
						</div>
					</div>

					<div class="d-flex align-items-center">
						<div class="symbol symbol-50px me-5">
							<img src="{{ asset('backend/assets/media/avatars/150-6.jpg') }}" alt="">
						</div>
						<div class="flex-grow-1">
							<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Dan Wilson</a>
							<span class="text-muted d-block fw-bold">PHP, SQLite, Artisan CLI</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		{{-- Notifications --}}
		<div class="col-xl-4">
			<div class="card card-xl-stretch mb-xl-8">
				<div class="card-header border-0">
					<h3 class="card-title fw-bolder text-dark">Notifications</h3>
					<div class="card-toolbar"></div>
				</div>

				<div class="card-body pt-0">
					<div class="d-flex align-items-center bg-light-warning rounded p-5 mb-7">
						<span class="svg-icon svg-icon-warning me-5">
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="black"/>
									<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="black"/>
								</svg>
							</span>
						</span>
						<div class="flex-grow-1 me-2">
							<a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-6">Group lunch celebration</a>
							<span class="text-muted fw-bold d-block">Due in 2 Days</span>
						</div>
						<span class="fw-bolder text-warning py-1">+28%</span>
					</div>

					<div class="d-flex align-items-center bg-light-success rounded p-5 mb-7">
						<span class="svg-icon svg-icon-success me-5">
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="black"/>
									<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="black"/>
								</svg>
							</span>
						</span>
						<div class="flex-grow-1 me-2">
							<a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-6">Navigation optimization</a>
							<span class="text-muted fw-bold d-block">Due in 2 Days</span>
						</div>
						<span class="fw-bolder text-success py-1">+50%</span>
					</div>

					<div class="d-flex align-items-center bg-light-danger rounded p-5 mb-7">
						<span class="svg-icon svg-icon-danger me-5">
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="black"/>
									<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="black"/>
								</svg>
							</span>
						</span>
						<div class="flex-grow-1 me-2">
							<a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-6">Rebrand strategy planning</a>
							<span class="text-muted fw-bold d-block">Due in 5 Days</span>
						</div>
						<span class="fw-bolder text-danger py-1">-27%</span>
					</div>

					<div class="d-flex align-items-center bg-light-info rounded p-5">
						<span class="svg-icon svg-icon-info me-5">
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="black"/>
									<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="black"/>
								</svg>
							</span>
						</span>
						<div class="flex-grow-1 me-2">
							<a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-6">Product goals strategy</a>
							<span class="text-muted fw-bold d-block">Due in 7 Days</span>
						</div>
						<span class="fw-bolder text-info py-1">+8%</span>
					</div>
				</div>
			</div>
		</div>

		{{-- Trends --}}
		<div class="col-xl-4">
			<div class="card card-xl-stretch mb-5 mb-xl-8">
				<div class="card-header border-0 pt-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bolder text-dark">Trends</span>
						<span class="text-muted mt-1 fw-bold fs-7">Latest tech trends</span>
					</h3>
					<div class="card-toolbar"></div>
				</div>

				<div class="card-body pt-5">
					<div class="d-flex align-items-sm-center mb-7">
						<div class="symbol symbol-50px me-5">
							<span class="symbol-label">
								<img src="{{ asset('backend/assets/media/svg/brand-logos/plurk.svg') }}" class="h-50 align-self-center" alt="">
							</span>
						</div>
						<div class="d-flex align-items-center flex-row-fluid flex-wrap">
							<div class="flex-grow-1 me-2">
								<a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Top Authors</a>
								<span class="text-muted fw-bold d-block fs-7">Mark, Rowling, Esther</span>
							</div>
							<span class="badge badge-light fw-bolder my-2">+82$</span>
						</div>
					</div>

					<div class="d-flex align-items-sm-center mb-7">
						<div class="symbol symbol-50px me-5">
							<span class="symbol-label">
								<img src="{{ asset('backend/assets/media/svg/brand-logos/telegram.svg') }}" class="h-50 align-self-center" alt="">
							</span>
						</div>
						<div class="d-flex align-items-center flex-row-fluid flex-wrap">
							<div class="flex-grow-1 me-2">
								<a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Popular Authors</a>
								<span class="text-muted fw-bold d-block fs-7">Randy, Steve, Mike</span>
							</div>
							<span class="badge badge-light fw-bolder my-2">+280$</span>
						</div>
					</div>

					<div class="d-flex align-items-sm-center mb-7">
						<div class="symbol symbol-50px me-5">
							<span class="symbol-label">
								<img src="{{ asset('backend/assets/media/svg/brand-logos/vimeo.svg') }}" class="h-50 align-self-center" alt="">
							</span>
						</div>
						<div class="d-flex align-items-center flex-row-fluid flex-wrap">
							<div class="flex-grow-1 me-2">
								<a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">New Users</a>
								<span class="text-muted fw-bold d-block fs-7">John, Pat, Jimmy</span>
							</div>
							<span class="badge badge-light fw-bolder my-2">+4500$</span>
						</div>
					</div>

					<div class="d-flex align-items-sm-center mb-7">
						<div class="symbol symbol-50px me-5">
							<span class="symbol-label">
								<img src="{{ asset('backend/assets/media/svg/brand-logos/bebo.svg') }}" class="h-50 align-self-center" alt="">
							</span>
						</div>
						<div class="d-flex align-items-center flex-row-fluid flex-wrap">
							<div class="flex-grow-1 me-2">
								<a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Active Customers</a>
								<span class="text-muted fw-bold d-block fs-7">Mark, Rowling, Esther</span>
							</div>
							<span class="badge badge-light fw-bolder my-2">+686$</span>
						</div>
					</div>

					<div class="d-flex align-items-sm-center mb-7">
						<div class="symbol symbol-50px me-5">
							<span class="symbol-label">
								<img src="{{ asset('backend/assets/media/svg/brand-logos/kickstarter.svg') }}" class="h-50 align-self-center" alt="">
							</span>
						</div>
						<div class="d-flex align-items-center flex-row-fluid flex-wrap">
							<div class="flex-grow-1 me-2">
								<a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Bestseller Theme</a>
								<span class="text-muted fw-bold d-block fs-7">Disco, Retro, Sports</span>
							</div>
							<span class="badge badge-light fw-bolder my-2">+726$</span>
						</div>
					</div>
				</div> {{-- card-body --}}
			</div> {{-- card --}}
		</div> {{-- col --}}
	</div> {{-- row --}}
@endsection
