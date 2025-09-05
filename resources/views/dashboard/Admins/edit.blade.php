<div class="row">
    <div class="col-sm-12">
        <form method="post" action="{{ route('admins.update', $admin->id) }}" class="ajaxForm"
            eenctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="POST">

            <div class="form-group row">
                <label for="name" class="col-3 col-form-label">الاسم :</label>
                <div class="col-8">
                    <input class="form-control" name="name" id="name" type="text" autocomplete="off"
                        value="{{ $admin->name }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-3 col-form-label">رقم الهاتف :</label>
                <div class="col-8">
                    <input class="form-control" name="phone" id="phone" type="text" autocomplete="off"
                        value="{{ $admin->phone }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="id_number" class="col-3 col-form-label">رقم الهوية :</label>
                <div class="col-8">
                    <input class="form-control" name="id_number" id="id_number" type="text" autocomplete="off"
                        value="{{ $admin->id_number }}">
                </div>
            </div>



            <div class="form-group row">
                <label for="role" class="col-3 col-form-label">الدور :</label>
                <div class="col-8">
                    <select class="form-control" name="role" id="role">
                        <option value="super_admin" {{ $admin->role == 'super_admin' ? 'selected' : '' }}>Admin</option>
                        <option value="doner" {{ $admin->role == 'doner' ? 'selected' : '' }}>Donor</option>
                        <option value="field_staff" {{ $admin->role == 'field_staff' ? 'selected' : '' }}>Field Staff
                        </option>
                    </select>

                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-3 col-form-label">الصورة :</label>

                <div class="col-8">
                    <input class="form-control" name="image" id="image" type="file">
                    @if($admin->image)
                        <img src="{{ $admin->image ? asset('images/admin/admin_image/' . $admin->image) : asset('backend/images/placeholder.png') }}"
                            id="image_preview" class="img-thumbnail"
                            style="width: 120px; height: 120px; border-radius: 10px;"><br>
                    @endif
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