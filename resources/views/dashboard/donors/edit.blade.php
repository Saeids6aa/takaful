<div class="row">
  <div class="col-sm-12">
    <form method="post" action="{{ route('donors.update', $doner->id) }}" class="ajaxForm">
      @csrf
      <input type="hidden" name="_method" value="POST"><!-- لو REST حقيقي: خليها PUT -->

      <div class="form-group row">
        <label for="name" class="col-3 col-form-label">الاسم :</label>
        <div class="col-8">
          <input class="form-control" name="name" id="name" type="text"
                 value="{{ $doner->name }}" autocomplete="off">
        </div>
      </div>

      <div class="form-group row">
        <label for="contact_phone" class="col-3 col-form-label">رقم التواصل :</label>
        <div class="col-8">
          <input class="form-control" name="contact_phone" id="contact_phone" type="text"
                 value="{{ $doner->contact_phone }}" autocomplete="off">
        </div>
      </div>

      <div class="form-group row">
        <label for="address" class="col-3 col-form-label">العنوان :</label>
        <div class="col-8">
          <input class="form-control" name="address" id="address" type="text"
                 value="{{ $doner->address }}" autocomplete="off">
        </div>
      </div>

      <div class="col-sm-8 offset-sm-4 pt-4">
        <button type="submit" data-refresh="true" class="btn btn-primary">تحديث</button>
        <a class="btn btn-default" data-bs-dismiss="modal">إلغاء</a>
      </div>
    </form>
  </div>
</div>

<script>PageLoadMethods();</script>
