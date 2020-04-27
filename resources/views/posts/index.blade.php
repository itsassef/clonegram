@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($posts)<1)
        <p>No posts yet!</p>
        @endif
        @foreach($posts as $post)
                <div class="row col-6 offset-3 pb-2">
                    <div class="d-flex align-items-center">
                        <div class="pr-3">
                            <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
                        </div>
                        <div>
                            <div class="font-weight-bold">
                                <a href="/profile/{{ $post->user->id }}">
                                    <span class="text-dark">{{ $post->user->username }}</span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 offset-3 pb-2">
                        <a href="/p/{{$post->id}}">
                        <img src="/storage/{{ $post->image }}" class="w-100">
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 offset-3">
                        <div>


                    <p>
                    <span class="font-weight-bold">
                        <a href="/profile/{{ $post->user->id }}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </span> {{ $post->caption }}
                            </p>
                        </div>
                        <hr>
                    </div>
                </div>

        @endforeach
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{$posts->links()}}
            </div>
        </div>
    </div>
@endsection
