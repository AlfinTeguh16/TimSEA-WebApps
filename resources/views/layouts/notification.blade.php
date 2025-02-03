@extends('layouts.master')
@section('notification')
    

@if(session('notifications'))
    @foreach(session('notifications') as $notification)
        <x-badge-notification 
            :type="$notification['type']" 
            :message="$notification['message']" 
            class="mb-4"
        />
    @endforeach
@endif

@endsection
