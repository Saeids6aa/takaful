<div class="row">
  <div class="col-sm-12">
    <form method="post" action="{{ route('campaign-deliveries.store') }}" class="ajaxForm" enctype="multipart/form-data">
      @csrf

      <div class="form-group row">
        <label class="col-3 col-form-label">الحالة :</label>
        <div class="col-8">
          <select class="form-control" name="status" id="status">
            <option value="completed">completed</option>
            <option value="incomplete">incomplete</option>
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-3 col-form-label">الحملة (ID) :</label>
        <div class="col-8">
          <input class="form-control" name="campaign_id" id="campaign_id" type="number" min="1" autocomplete="off">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-3 col-form-label">العائلة (ID) :</label>
        <div class="col-8">
          <input class="form-control" name="familiy_id" id="familiy_id" type="number" min="1" autocomplete="off">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-3 col-form-label">المسؤول (ID) :</label>
        <div class="col-8">
          <input class="form-control" name="admin_id" id="admin_id" type="number" min="1" autocomplete="off">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-3 col-form-label">الصورة :</label>
        <div class="col-8">
          <input class="form-control" name="image" id="image" type="file" accept="image/*">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-3 col-form-label">الوصف :</label>
        <div class="col-8">
          <textarea class="form-control" name="description" id="description" rows="3"></textarea>
        </div>
      </div>

      <div class="col-sm-8 offset-sm-4 pt-4">
        <button type="submit" data-refresh="true" class="btn btn-primary">حفظ</button>
        <a class="btn btn-default" data-bs-dismiss="modal">إلغاء</a>
      </div>
    </form>
  </div>
</div>

<script> PageLoadMethods(); </script>
