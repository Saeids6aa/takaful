  <div class="modal fade" id="complaintModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">إرسال شكوى</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="" class="ajaxForm" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
              <div class="col-12 col-md-6">
                <label class="form-label">الاسم الكامل</label>
                <input class="form-control" name="full_name" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">الهاتف</label>
                <input class="form-control" name="phone" required>
              </div>
              <div class="col-12">
                <label class="form-label">الموضوع</label>
                <input class="form-control" name="subject" required>
              </div>
              <div class="col-12">
                <label class="form-label">نص الشكوى</label>
                <textarea class="form-control" name="message" rows="4" required></textarea>
              </div>
              <div class="col-12">
                <label class="form-label">مرفق (اختياري)</label>
                <input type="file" class="form-control" name="file">
              </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
              <button type="submit" data-refresh="false" class="btn btn-primary">إرسال</button>
              <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
