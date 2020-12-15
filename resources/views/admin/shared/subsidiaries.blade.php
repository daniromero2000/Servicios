<ul class="list-unstyled">
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
    @if($subsidiary->children->count() >= 1)
    @include('generals::admin.shared.subsidiary-children', ['subsidiaries' => $casubsidiarytegory->children,
    'selectedIds' => $selectedIds]) @endif @endforeach
</ul>