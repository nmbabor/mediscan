@foreach($radiologist as $id => $rad)
    <div class="min-padding">
        <label class="control-label"><input class="radio-check" type="checkbox" name="radiologist_id[]" value="{{$id}}"> {{$rad}}</label>
    </div>
@endforeach