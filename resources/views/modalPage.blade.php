<form>
    <div class="form-group">
        <label class="col-form-label">ID:</label>
        <label class="col-form-label">{{$view_user->id}}</label>
    </div>
    <div class="form-group">
        <label class="col-form-label">Name:</label>
        <label class="col-form-label">{{$view_user->fname}}</label>
    </div>
    <div class="form-group">
        <label class="col-form-label">Image:</label>
        <label class="col-form-label"><img src = "{{$view_user->img_path}}" height="40px" width="50px"></label>
    </div>
    <div class="form-group">
        <label class="col-form-label">Address:</label>
        <label class="col-form-label">{{$view_user->address}}</label>
    </div>
    <div class="form-group">
        <label class="col-form-label">Gender:</label>
        <label class="col-form-label">{{$view_user->gender}}</label>
    </div>
</form>