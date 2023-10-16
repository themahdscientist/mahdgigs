@extends('layouts.main')
@section('content')
    @include('partials._hero')
    @include('partials._search')
    <div class="mx-4 gap-4 space-y-4 md:space-y-0 lg:grid lg:grid-cols-2">
        @if (count($listings))
            @foreach ($listings as $listing)
                <x-listing-card :listing="$listing" />
            @endforeach
        @else
            <p>There are no job listings</p>
        @endif
    </div>
    <div class="mt-6 p-4">
        {{ $listings->links() }}
    </div>
@endsection
