<div class="row">
    <div class="col-sm-12">
        <form method="post"  action="{{route("categories.store")}}" class="ajaxForm">
            {{ csrf_field() }}

            <div class="form-group row">
                <label class="col-3 col-form-label">الفئة :</label>
                <div class="col-8">
                    <input class="form-control" name="name" type="text" id="name" autocomplete="off">
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