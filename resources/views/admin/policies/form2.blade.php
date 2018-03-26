@php
$roles = DB::table('privileges')->orderBy('privilege', 'asc')->get();
$sections = DB::table('sections')->selectRaw('*')->get();
@endphp

<div class="form-group {{ $errors->has('policy') ? 'has-error' : ''}}">
    <label for="policy" class="col-md-4 control-label">{{ 'Policy' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="policy" type="text" id="policy" value="{{ $policy->policy or ''}}" required>
        {!! $errors->first('policy', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('section_id') ? 'has-error' : ''}}">
    <label for="section_id" class="col-md-4 control-label">{{ 'Section' }}</label>
    <div class="col-md-6">        
        <select class="form-control" name="section_id" type="number" id="section_id" value="{{ $policy->section_id or ''}}" required>
            @php
                $sectionName = DB::table('sections')->where('id', $policy->section_id)->first();
            @endphp
            <option value={{$policy->section_id}} selected>{{strtoupper($sectionName->section)}}</option>
            @foreach ($sections as $section)
                <option value={{$section->id}}>{{strtoupper($section->section)}}</option>
            @endforeach
        </select> 
        {!! $errors->first('section_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!--*********************************************  MY CHECKBOXES  *********************************************-->
<div class="row">
@foreach ($roles as $privilege)
    <div class="col-md-4">
        <div class="form-group form-check form-check-inline">
            @php
            $column = $privilege->role_header;
            @endphp
            @if ($policy->$column == 1)
                <input class="form-check-input" name="{{$privilege->role_header}}" type="checkbox" id="{{$privilege->role_header}}" value=1 checked>
                <label class="form-check-label" for="{{$privilege->role_header}}">{{strtoupper($privilege->privilege)}}</label>
            @elseif ($policy->$column == 0)
                <input class="form-check-input" name="{{$privilege->role_header}}" type="checkbox" id="{{$privilege->role_header}}" value=1>
                <label class="form-check-label" for="{{$privilege->role_header}}">{{strtoupper($privilege->privilege)}}</label>
            @else
                <label class="form-check-label" for="{{$privilege->role_header}}">Problem loading database</label>
            @endif          
        </div>
    </div>
@endforeach
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
