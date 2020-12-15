<ul class="list-unstyled list-inline row">
    @foreach ($roles as $role)
        <li class="col">
            <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" id="role-asigne{{ $role->id . $data->id }}" type="checkbox"
                    {{ isset($selectedIds) && in_array($role->id, $selectedIds) ? 'checked="checked"' : '' }}
                    name="roles[]" value="{{ $role->id }}">
                <label class="custom-control-label"
                    for="role-asigne{{ $role->id . $data->id }}">{{ $role->display_name }}</label>
            </div>
        </li>
    @endforeach
</ul>
