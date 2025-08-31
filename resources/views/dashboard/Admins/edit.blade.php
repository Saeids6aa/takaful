<div class="row">
    <div class="col-sm-12">
        <form method="post" action="{{ route('admins.update', $admin->id) }}" 
              class="ajaxForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="POST">

            <div class="form-group row">
                <label for="name" class="col-3 col-form-label">الاسم :</label>
                <div class="col-8">
                    <input class="form-control" name="name" id="name" type="text"
                           value="{{ $admin->name }}" autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-3 col-form-label">رقم الهاتف :</label>
                <div class="col-8">
                    <input class="form-control" name="phone" id="phone" type="text"
                           value="{{ $admin->phone }}" autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-3 col-form-label">الصورة :</label>
                <div class="col-8">
                    <input class="form-control" name="image" id="image" type="file" accept="image/*">
                    @if($admin->image)
                        <div class="mt-2">
                            <img src="{{ asset('uploads/admins/'.$admin->image) }}" 
                                 alt="الصورة الحالية" style="width:80px;height:80px;border-radius:8px">
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="role" class="col-3 col-form-label">الدور :</label>
                <div class="col-8">
                    <select class="form-control" name="role" id="role">
                        <option value="super_admin" {{ $admin->role == 'super_admin' ? 'selected' : '' }}>Admin</option>
                        <option value="doner"       {{ $admin->role == 'doner' ? 'selected' : '' }}>doner</option>
                        <option value="field_staff" {{ $admin->role == 'field_staff' ? 'selected' : '' }}>field_staff</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-3 col-form-label">كلمة المرور :</label>
                <div class="col-8">
                    <input class="form-control" name="password" id="password" type="password" 
                           autocomplete="new-password" placeholder="اتركها فارغة إذا لا تريد التغيير">
                </div>
            </div>

            <div class="form-group row">
                <label for="password_confirmation" class="col-3 col-form-label">تأكيد كلمة المرور :</label>
                <div class="col-8">
                    <input class="form-control" name="password_confirmation" id="password_confirmation" type="password" 
                           autocomplete="new-password" placeholder="اتركها فارغة إذا لا تريد التغيير">
                </div>
            </div>

            <div class="col-sm-8 offset-sm-4 pt-4">
                <button type="submit" data-refresh="true" class="btn btn-primary">تحديث</button>
                <a class="btn btn-default" data-bs-dismiss="modal">إلغاء</a>
            </div>
        </form>
    </div>
</div>

<script>
    PageLoadMethods();
</script>
