@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{$user->profile->profileImage()}}" class="rounded-circle text-center w-100" alt="">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-content-center pb-3">
                    <h2 class="mr-3" style="height: 10px !important;">{{ $user->username }} </h2> <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                </div>

                @can('update', $user->profile)
                <a href="/p/create" class="">Add New Post</a>
                @endcan
            </div>
            @can('update', $user->profile)
                <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">
                <div class="mr-5"><b>{{$postsCount}}</b> posts </div>
                <div class="mr-5"><b> {{$followersCount}}</b> followers </div>
                <div><b> {{$followingCount}}</b> followings </div>
            </div>
            <div class="pt-2 font-weight-bold">{{ $user->profile->title }} </div>
            <div>
                <span>{{ $user->profile->description }} </span>
            </div>
            <div><a href="https://{{ $user->profile->url }} " class="font-weight-bold">{{ $user->profile->url }} </a></div>
        </div>
    </div>
    <hr>


    <div class="row pt-4 d-flex">
        @if(count($user->posts)<1)
            <h5>No posts yet!</h5>
        @endif        @foreach($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="/p/{{$post->id}}">
                <img class="w-100" src="/storage/{{$post->image}}" alt="">
            </a>
        </div>
        @endforeach
    </div>



</div>
@endsection
