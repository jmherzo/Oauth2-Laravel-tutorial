@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <passport-clients></passport-clients>
            <br>
            <passport-authorized-clients></passport-authorized-clients>
            <br>
            <passport-personal-access-tokens></passport-personal-access-tokens>
        </div>
    </div>
</div>
@endsection
