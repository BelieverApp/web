@extends('layouts.client_layout')
@include('clients.includes.nav', ['section' => 'messages'])

@section('subnav')
<li class="nav-item">
    <a class="btn btn-primary" href="/client/messages/create" role="button"><i class="fa fa-plus"></i> Create a New Message</a>
</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h4>{{ $message->subject }}</h4></div>


    <div class="card-body">
        <img style="width: 100%;" src="https://res.cloudinary.com/believer/image/upload/c_fill,g_center,h_150,w_800,x_0/{{ $message->banner }}" />

        {!! $message->body !!}


        <a class="btn btn-outline-primary" target="_blank" href="{!! $message->action_url !!}">{{ $message->action_title }}</a>
    </div>

</div>
@endsection
