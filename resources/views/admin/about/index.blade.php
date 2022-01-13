@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{route('about.create')}}" class="btn btn-block btn-outline-primary"> Create About Page </a>
            </div>
        </div>
        @if (!$onestart)
        @else

        @forelse ($onestart as $ab)
        <div class="row mt-5">
            <div class="col-8">
                <div class="row">
                    <div class="col-12">
                        <p>{{$ab->name}}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-6">
                        <a href="{{route('about.edit', [$ab->id])}}" class="btn btn-link btn-block">Edit</a>
                    </div>
                    <div class="col-6">
                        <form action="{{route('about.delete', [$ab->id])}}" method="POST">
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
