<div class="card-body row">
    <div class="form-group col-6">
        <label>الصيدليه</label>
        <select name="pharmacy_id" class="form-control select2 {{ $errors->has('pharmacy_id') ? 'border-danger' : '' }}"
                id="pharmacy">
            @foreach($pharmacy as $row)
                <option
                    @if(Request::segment(1)== 'shifts' && Request::segment(2)== 'edit')
                    {{ $row->id == old('pharmacy_id',  $data->pharmacy_id)  ? 'selected' : '' }}
                    @else
                    {{ $row->id == old('pharmacy_id') ? 'selected' : '' }}
                    @endif
                    value="{{ $row->id }}">{{ $row->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-6">
        <label>الموظف</label>
        <select name="user_id" class="form-control select2 {{ $errors->has('user_id') ? 'border-danger' : '' }}"
                id="user">
            @foreach($user as $row)
                <option
                    @if(Request::segment(1)== 'shifts' && Request::segment(2)== 'edit')
                    {{ $row->id == old('user_id',  $data->user_id)  ? 'selected' : '' }}
                    @else
                    {{ $row->id == old('user_id') ? 'selected' : '' }}
                    @endif
                    value="{{ $row->id }}">{{ $row->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-6">
        <label>اليوم</label>
        <select name="day" class="form-control select2 {{ $errors->has('day') ? 'border-danger' : '' }}" id="day">
            @php($day=['saturday','sunday','monday','tuesday','wednesday','thursday'])
            @foreach($day as $row)
                <option
                    @if(Request::segment(1)== 'shifts' && Request::segment(2)== 'edit')
                    {{ $row == old('day',  $data->day)  ? 'selected' : '' }}
                    @else
                    {{ $row == old('day') ? 'selected' : '' }}
                    @endif
                    value="{{$row}}">{{$row}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-3">
        <label class="">بدايه الدوام</label>
        <div class="">
            <div class="input-group timepicker">
                <div class="input-group-prepend">
       <span class="input-group-text">
        <i class="la la-clock-o"></i>
       </span>
                </div>
                <input class="form-control  {{ $errors->has('starts_at') ? 'border-danger' : '' }}" name="starts_at" id="starts_at" value="{{ old('starts_at', $data->starts_at ?? '') }}"
                       readonly placeholder="اختر بدايه الدوام" type="text"/>
            </div>
        </div>
    </div>
    <div class="form-group col-3">
        <label class="">نهايه الدوام</label>
        <div class="">
            <div class="input-group timepicker">
                <div class="input-group-prepend">
       <span class="input-group-text">
        <i class="la la-clock-o"></i>
       </span>
                </div>
                <input class="form-control  {{ $errors->has('ends_at') ? 'border-danger' : '' }}" name="ends_at" id="ends_at" value="{{ old('ends_at', $data->ends_at ?? '') }}"
                       readonly placeholder="اختر نهايه الدوام" type="text"/>
            </div>
        </div>
    </div>
</div>
<div class="card-footer text-left">
    <button type="Submit" id="submit" class="btn btn-success btn-default ">حفظ</button>
    <a href="{{ URL::previous() }}" class="btn btn-secondary">الغاء</a>
</div>

