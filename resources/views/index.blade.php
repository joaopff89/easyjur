@extends('layouts.app')

@section('content')
    <dicas-index-component urlBase="{{ getenv('APP_URL') }}"></dicas-index-component>
@endsection