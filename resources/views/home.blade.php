@extends('layouts.app')

@section('content')
    <style>
        html {
            /* font-size: calc(100vw / 1920 * 10); */
        }

    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card bg-secondary text-white-50">
                    <div class="card-header">{{ __('ABOUT') }}</div>
                    <div class="card-body">
                        <a href="{{ route('about.index') }}" class="text-white-50">
                            <p class="h6 text-decoration-none">All index</p>
                        </a>
                        <a href="{{ route('about.create') }}" class="text-white-50">
                            <p class="h4 text-uppercase text-decoration-none">CREATE About</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-secondary text-white-50">
                    <div class="card-header">{{ __('CATEGORIES') }}</div>
                    <div class="card-body">
                        <a href="{{ route('category.index') }}" class="text-white-50">
                            <p class="h6 text-decoration-none">All index</p>
                        </a>
                        <a href="{{ route('category.create') }}" class="text-white-50">
                            <p class="h4 text-uppercase text-decoration-none">CREATE Category</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-secondary text-white-50">
                    <div class="card-header">{{ __('PROJECTS') }}</div>
                    <div class="card-body">
                        <a href="{{ route('project.index') }}" class="text-white-50">
                            <p class="h6 text-decoration-none">All index</p>
                        </a>
                        <a href="{{ route('project.create') }}" class="text-white-50">
                            <p class="h4 text-uppercase text-decoration-none">CREATE Project</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-secondary text-white-50">
                    <div class="card-header">{{ __('ACTIVITIES') }}</div>
                    <div class="card-body">
                        <a href="{{ route('aktivitet.index') }}" class="text-white-50">
                            <p class="h6 text-decoration-none">All index</p>
                        </a>
                        <a href="{{ route('aktivitet.create') }}" class="text-white-50">
                            <p class="h4 text-uppercase text-decoration-none">CREATE Activity</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

