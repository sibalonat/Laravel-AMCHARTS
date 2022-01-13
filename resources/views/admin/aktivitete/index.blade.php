@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{route('aktivitet.create')}}" class="btn btn-block btn-outline-primary"> Create Project </a>
            </div>
        </div>
        @if (!$aktivitete)
        @else

        @forelse ($aktivitete as $aktiviteti)
        <div class="row mt-5 p-4 border">
            <div class="col-8">
                <div class="row">
                    <div class="col-12">
                        <p>{{$aktiviteti->name}}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-6">
                        <a href="{{route('aktivitet.edit', [$aktiviteti->id])}}" class="btn btn-link btn-block">Edit</a>
                    </div>
                    <div class="col-6">
                        <form action="{{route('aktivitet.delete', [$aktiviteti->id])}}" method="POST">
                            {{ csrf_field() }}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger btn-block">DELETE</button>
                        </form>
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
