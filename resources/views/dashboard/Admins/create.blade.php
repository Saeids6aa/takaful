<div class="row">
    <div class="col-sm-12">
<form method="post" action="{{ route('admins.store') }}" class="ajaxForm" enctype="multipart/form-data">
    @csrf


        <div class="form-group row">
    <label for="name" class="col-3 col-form-label">الاسم :</label>
    <div class="col-8">
        <input class="form-control" name="name" id="name" type="text" autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <label for="phone" class="col-3 col-form-label">رقم الهاتف :</label>
    <div class="col-8">
        <input class="form-control" name="phone" id="phone" type="text" autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <label for="image" class="col-3 col-form-label">الصورة :</label>
    <div class="col-8">
        <input class="form-control" name="image" id="image" type="file" accept="image/*">
    </div>
</div>

<div class="form-group row">
    <label for="role" class="col-3 col-form-label">الدور :</label>
    <div class="col-8">
        <select class="form-control" name="role" id="role">
            <option value="super_admin">Admin</option>
            <option value="doner">doner</option>
            <option value="field_staff">field_staff</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-3 col-form-label">كلمة المرور :</label>
    <div class="col-8">
        <input class="form-control" name="password" id="password" type="password" autocomplete="new-password">
    </div>
</div>

<div class="form-group row">
    <label for="password_confirmation" class="col-3 col-form-label">تأكيد كلمة المرور :</label>
    <div class="col-8">
        <input class="form-control" name="password_confirmation" id="password_confirmation" type="password" autocomplete="new-password">
    </div>
</div>


            <div class="col-sm-8 offset-sm-4 pt-4">
                <button type="submit" data-refresh="true" class="btn green btn-primary">حفظ</button>
                <a class="btn btn-default" data-bs-dismiss="modal">الغاء</a>
            </div>
        </form>
    </div>
</div>

<script>
    PageLoadMethods();
</script>