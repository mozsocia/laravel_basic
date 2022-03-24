@extends('layouts.app')

{{-- @section('title')
    This is title   
@endsection --}}

@section('title', 'This is title')

@section('body')
    <h1>This is this page</h1>

    @isset($name)
        <h2>{{ $name }}</h2>
    @endisset

    @json($age)

    {{ url('/this') }}
    <br>

    {{ route('thisme') }}
    <br>
    <br>


    {{-- <x-message type="error" msg = "this is new msg" :nam="$name"/> --}}
    <x-message type="error" :message="$name" />

    <x-message class="container mt-4"> this is content <x-slot name="title" age="234"> slot content </x-slot> </x-message>
@endsection
    
