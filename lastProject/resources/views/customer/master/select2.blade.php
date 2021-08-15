<option>---------SELECT DISCTRICTS ADDRESS---------</option>
@foreach ($commune as $item)
    <option value="{{ $item->xaid }}">{{ $item->name }}</option>
@endforeach
