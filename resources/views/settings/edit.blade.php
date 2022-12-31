<div id="settings_edit" class="settings-edit">
    <form action="{{ route('settings.update',$settings->id) }}" method="POST" id="settings_edit_form" enctype="multipart/form-data">
        @csrf

        <legend>Edit Settings</legend>

        @if (Str::contains($settings->key,['Image','image','Picture','picture','Photo','photo']))

        <label for="settings_edit_value" class="form-label">Choose Image for {{ $settings->key }}</label>
        <img src="{{ (strcmp($settings->value,'')==0)?asset('images/settings-default.png'):asset('images/'.$settings->value) }}" alt="" id="settings_edit_tmp_img">
        <input type="file" accept="image/*" name="picture" id="settings_edit_picture" placeholder="select a picture" class="form-control" hidden>
        <span class="settings-edit-error" id="settings_edit_picture_error"></span>

        @else

        <label for="settings_edit_key" class="form-label">Enter Value For {{ $settings->key }}</label>
        <input type="text" name="value" id="settings_edit_value" placeholder="enter settings value" class="form-control" value="{{ $settings->value }}">
        <span class="settings-edit-error" id="settings_edit_value_error"></span>

        @endif

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('settings.index',$settings->id) }}" id="settings_edit_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
