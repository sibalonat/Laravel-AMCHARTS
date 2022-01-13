@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{route('category.create')}}" class="btn btn-block btn-outline-primary"> Create Category </a>
            </div>
        </div>
        @if (!$categories)
        @else

        @forelse ($categories as $cats)
        <div class="row mt-5">
            <div class="col-8">
                <div class="row">
                    <div class="col-12">
                        <p>{{$cats->name}}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-6">
                        <a href="{{route('category.edit', [$cats->id])}}" class="btn btn-link btn-block">Edit</a>
                    </div>
                    <div class="col-6">
                        <form action="{{route('category.delete', [$cats->id])}}" method="POST">
                            {{ csrf_field() }}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger btn-block">DELETE</button>
                        </form>
                        {{--  <a href="{{route('category.delete', [$cats->id])}}" class="btn btn-danger btn-block">Delete</a>  --}}
                    </div>
                </div>
            </div>
        </div>
        @empty

        @endforelse


        @endif

    </div>
</div>

@endsection
