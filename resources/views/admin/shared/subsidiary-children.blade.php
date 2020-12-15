<ul class="list-unstyled" style="padding-left: 25px">
    @foreach($subsidiaries as $subsidiary)
    <li>
        <div class="checkbox">
            <label>
                    <input
                            type="checkbox"
                            @if(isset($selectedIds) && in_array($subsidiary->id, $selectedIds))checked="checked" @endif
                            name="subsidiaries[]"
                            value="{{ $subsidiary->id }}">
                            {{ $subsidiary->name }}
                </label>
        </div>
    </li>
    @endforeach
</ul>