<div class="row">
    @csrf
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group  col-12">
                    <label>
                        اسم الوظيفة
                        <span class="text-danger">*</span>
                    </label>
                    <input name="name" id="name" placeholder="اسم الوظيفة" value="{{ old('name', $role->name ?? '') }}"
                           class="form-control  {{ $errors->has('name') ? 'border-danger' : '' }}" type="text"
                           maxlength="255"/>
                </div>
            </div>
        </div>
        <br>
        <br>
    </div>
</div>
<div class="row">
    @foreach($permissions as $row)
        @php $group_permissions = \Spatie\Permission\Models\Permission::where('path',$row->path)->get(); @endphp
        <div class="col-lg-4">
            <div class="card card-outline-primary" style="height: 350px;">
                <div class="card-header">
                    <h5 class="">{{trans("lang.".$row->path)}}</h5>
                </div>
                <br>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-from-label" for="banner"></label>
                        <div class="col-md-8">
                            @foreach($group_permissions as $permission)
                                <div class="row">
                                    <div class="col-md-10">
                                        <label class="col-from-label">{{ $permission->description }}</label>

                                    </div>
                                    <div class="col-md-2">
                                    <span class="switch switch-outline switch-icon swibtn-success">
                                        <label>
                                         <input type="checkbox" value="{{$permission->name}}"
                                                @if(request()->segment(3) == 'edit')   @php if(in_array($permission->id , $rolePermissions)) echo "checked"; @endphp  @endif name="permissions[]"/>
                                         <span></span>
                                        </label>
                                    </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    @endforeach
</div>
<div class="text-left">
    {{--    for avoid  edit admin permissions--}}

    @if(request()->segment(3) == 'edit' && $role->id == 1)
    @else
        <button type="Submit" id="submit" class="btn btn-success btn-default ">حفظ</button>
        <a href="{{ URL::previous() }}" class="btn btn-secondary">الغاء</a>
    @endif
</div>
