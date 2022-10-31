@extends('layout')
@section('content')
    @include('partials._hero')
    @include('partials._search')
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless(count($listings) == 0)
            @foreach ($listings as $listing)
                <x-listing-card :listing="$listing"></x-listing-card>
            @endforeach
        @else
            <p>No listings found</p>
        @endunless
    </div>
    <div class="mt-5 p-4">
        {{$listings->links()}}
    </div>
    @if(session('listingStatusMessage'))
        <x-flash-message message="{{session('listingStatusMessage')}}"></x-flash-message>
    @endif
    @if(session('userStatusMessage'))
        <x-flash-message message="{{session('userStatusMessage')}}"></x-flash-message>
    @endif
@endsection
