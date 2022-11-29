@extends('templates/master')

@section('title')
    Foobar
@endsection

@section('content')
    <h2 data-test='foobar-heading'>Foobar</h2>
    {{ $foo }}
@endsection
