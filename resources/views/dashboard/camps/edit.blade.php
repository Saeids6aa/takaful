<div class="row">
  <div class="col-sm-12">
    <form method="post" action="{{ route('camps.update', $camp->id) }}" class="ajaxForm">
      @csrf
      <input type="hidden" name="_method" value="POST"><!-- لو حاب REST: خلّيها PUT وعدّل الروت -->

      <div class="form-group row">
        <label for="name" class="col-3 col-form-label">الاسم :</label>
        <div class="col-8">
          <input class="form-control" name="name" id="name" type="text"
                 value="{{ $camp->name }}" autocomplete="off">
        </div>
      </div>

      <div class="form-group row">
        <label for="address" class="col-3 col-form-label">العنوان :</label>
        <div class="col-8">
          <input class="form-control" name="address" id="address" type="text"
                 value="{{ $camp->address }}" autocomplete="off">
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
