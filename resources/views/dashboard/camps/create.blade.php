<div class="row">
  <div class="col-sm-12">
    <form method="post" action="{{ route('camps.store') }}" class="ajaxForm">
      @csrf

      <div class="form-group row">
        <label for="name" class="col-3 col-form-label">الاسم :</label>
        <div class="col-8">
          <input class="form-control" name="name" id="name" type="text" autocomplete="off">
        </div>
      </div>

      <div class="form-group row">
        <label for="address" class="col-3 col-form-label">العنوان :</label>
        <div class="col-8">
          <input class="form-control" name="address" id="address" type="text" autocomplete="off">
        </div>
      </div>

      <div class="col-sm-8 offset-sm-4 pt-4">
        <button type="submit" data-refresh="true" class="btn btn-primary">حفظ</button>
        <a class="btn btn-default" data-bs-dismiss="modal">الغاء</a>
      </div>
    </form>
  </div>
</div>

<script>PageLoadMethods();</script>
