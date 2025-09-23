<div class="col-lg-6 {{$div_class}}">
    <div class="form-group">
        <label class="form-label">{{$label}}</label>
        <select name="{{$name}}" id="{{$name}}" class="form-control custom-select" required>
            <option value="">-- Select --</option>
            @foreach($datas as $data)
            <option value="{{$data->id}}">{{$data->name}}</option>
            @endforeach
        </select>
    </div>
</div>