@extends('layouts.app')

@section('bar-title')
	الفئات
@endsection

@section('page-title')
	الفئات
@endsection

@section('content')

	<div class="card mb-5 mb-xl-10">
		<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
			data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
			<div class="card-title m-0">
				<h3 class="fw-bolder m-0">صفحة البيانات الشخصية </h3>
			</div>
		</div>
		
		<div id="kt_account_profile_details" class="collapse show">
			<form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
				novalidate="novalidate">
				<div class="card-body border-top p-9">
					<div class="row mb-6">
						<label class="col-lg-4 col-form-label fw-bold fs-6">الصورة</label>
						
						<div class="col-lg-8">
							<div class="image-input image-input-outline" data-kt-image-input="true"
								style="background-image: url(assets/media/avatars/blank.png)">
								<div class="image-input-wrapper w-125px h-125px"
									style="background-image: url({assets/media/avatars/150-26.jpg})"></div>
								
								<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
									data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
									data-bs-original-title="Change avatar">
									<i class="bi bi-pencil-fill fs-7"></i>
									<input type="file" name="avatar" accept=".png, .jpg, .jpeg">
									<input type="hidden" name="avatar_remove">
									
								</label>
							
								<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
									data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title=""
									data-bs-original-title="Cancel avatar">
									<i class="bi bi-x fs-2"></i>
								</span>
							
								<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
									data-kt-image-input-action="remove" data-bs-toggle="tooltip" title=""
									data-bs-original-title="Remove avatar">
									<i class="bi bi-x fs-2"></i>
								</span>
							</div>
							
							<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
						</div>
					</div>
					<div class="row mb-6">
						<label class="col-lg-4 col-form-label required fw-bold fs-6">الاسم كامل</label>
						<div class="col-lg-8">
							<div class="row">
								<div class="col-lg-6 fv-row fv-plugins-icon-container">
									<input type="text" name="fname"
										class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
										placeholder="First name" value="Max">
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
								
								<div class="col-lg-6 fv-row fv-plugins-icon-container">
									<input type="text" name="lname" class="form-control form-control-lg form-control-solid"
										placeholder="Last name" value="Smith">
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row mb-6">
						<label class="col-lg-4 col-form-label required fw-bold fs-6">Company</label>
					
						<div class="col-lg-8 fv-row fv-plugins-icon-container">
							<input type="text" name="company" class="form-control form-control-lg form-control-solid"
								placeholder="Company name" value="Keenthemes">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
					</div>
					<div class="row mb-6">
						<label class="col-lg-4 col-form-label fw-bold fs-6">
							<span class="required">Contact Phone</span>
							<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title=""
								data-bs-original-title="Phone number must be active"
								aria-label="Phone number must be active"></i>
						</label>
					
						<div class="col-lg-8 fv-row fv-plugins-icon-container">
							<input type="tel" name="phone" class="form-control form-control-lg form-control-solid"
								placeholder="Phone number" value="044 3276 454 935">
							<div class="fv-plugins-message-container invalid-feedback"></div>
						</div>
					</div>
				
					<br>
					

				</div>
				
				<div class="card-footer d-flex justify-content-end py-6 px-9">
					<button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
					<button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save
						Changes</button>
				</div>
				<input type="hidden">
				<div></div>
			</form>
		</div>
</div>@endsection