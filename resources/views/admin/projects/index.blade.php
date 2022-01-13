@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{route('project.create')}}" class="btn btn-block btn-outline-primary"> Create Project </a>
            </div>
        </div>
        {{-- @if (!$projects) --}}
        @if (!empty($projects) && $projects->count())
        {{-- @else --}}
        {{-- @forelse ($projects as $projekti) --}}
        @foreach ( $projects as $key => $projekti )
        {{-- () --}}
        <div class="row mt-5">
            <div class="col-8">
                <div class="row">
                    <div class="col-3">
                        <p>{{$projekti->name}}</p>
                    </div>
                    <div class="col-9">
                        <!--@foreach ($projekti->getMedia($mediaCollection) as $media)-->
                        <!--<img src="{{ $media->getUrl() }}" style="height: 50px; width: 50px" class="img-thumbnail"-->
                        <!--   alt="{{ $media->getUrl() }}">-->
                        <!--@endforeach-->
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-6">
                        <a href="{{route('project.edit', [$projekti->id])}}" class="btn btn-link btn-block">Edit</a>
                    </div>
                    <div class="col-6">
                        <form action="{{route('project.delete', [$projekti->id])}}" method="POST">
                            {{ csrf_field() }}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger btn-block">DELETE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- @empty --}}
        @endforeach
        @else
        no data
        @endif
        {!! $projects->links() !!}
    </div>
</div>

@endsection
