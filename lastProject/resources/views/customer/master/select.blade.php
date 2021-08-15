<option>---------SELECT DISCTRICTS ADDRESS---------</option>
@foreach ($district as $item)
    <option value="{{ $item->maqh }}">{{ $item->name }}</option>
@endforeach
