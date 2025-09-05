
<?php
  $img = $admin->image ? asset('images/admin/admin_image/'.$admin->image) : asset('backend/assets/media/avatars/150-25.png');
?>
<div class="modal-body">
  <div class="d-flex gap-4 align-items-start">
    <img src="{{ $img }}" alt="صورة المسؤول" style="width:96px;height:96px;border-radius:12px;object-fit:cover">
    <div class="flex-grow-1">
      <h4 class="mb-2">{{ $admin->name }}</h4>

    </div>
<hr class="my-3">

  <div class="row gy-2">
    <div class="col-md-6"><strong>رقم الهوية:</strong> {{ $admin->id_number }}</div>
    <div class="col-md-6"><strong>تاريخ الإنشاء:</strong> {{$admin->created_at->format('Y-m-d') }}</div>
  </div>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-dark" data-bs-dismiss="modal">إغلاق</button>
</div>
