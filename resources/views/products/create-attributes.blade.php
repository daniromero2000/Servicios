<h2>Has Ofertas</h2>
<div class="form-group">
    <ul class="list-unstyled attribute-lists">
        @foreach($attributes as $attribute)
        <li>
            <label for="attribute{{ $attribute->id }}" class="checkbox-inline">
                {{ $attribute->name }}
                <input name="attribute[]" class="attribute" type="checkbox" id="attribute{{ $attribute->id }}"
                    value="{{ $attribute->id }}">
            </label>

            <label for="attributeValue{{ $attribute->id }}" style="display: none; visibility: hidden"></label>
            @if(!$attribute->values->isEmpty())
            <select name="attributeValue[]" id="attributeValue{{ $attribute->id }}" class="form-control select2"
                style="width: 100%" disabled>
                @foreach($attribute->values as $attr)
                <option value="{{ $attr->id }}">{{ $attr->value }}</option>
                @endforeach
            </select> @endif
        </li>
        @endforeach
    </ul>
</div>
<input type="hidden" name="productAttributeQuantity" id="productAttributeQuantity" placeholder="Cantidad"
    class="form-control" value="1" required>


<div class="form-group">
    <label for="default">¿Asignar Oferta a producto?</label> <br />
    <select name="default" id="default" class="form-control select2">
        <option value="0" selected="selected">No</option>
        <option value="1">Sí</option>
    </select>
</div>
<div class="box-footer">
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-default" onclick="backToInfoTab()">Regresar</button>
        <button id="createCombinationBtn" type="submit" class="btn btn-sm btn-primary" disabled="disabled">Crear
            Oferta</button>
    </div>
</div>