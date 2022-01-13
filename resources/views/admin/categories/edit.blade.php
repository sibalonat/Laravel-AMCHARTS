@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        {{-- <div class="container"> --}}
        <div class="row justify-content-center">
            <div class="col-11 p-5 border">
                <form action="{{ route('category.update', [$category->id]) }}" enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="mb-3 row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <label for="inputText" class="col-sm-6 col-form-label">Category name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" value="{{ $category->name }}"
                                                class="form-control" id="inputText">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label for="inputText" class="col-sm-6 col-form-label">Category name</label>
                                        <div class="col-sm-12">
                                            <select name="about_id" class="form-control" id="about_id" required>
                                                <option value="">--- SELECT CONTENT CATEGORY ---</option>
                                                @foreach ($about as $cat)
                                                    <option value="{{ $cat->id }}" @if ($category->about_id == $cat->id) selected @endif>
                                                        {{ $cat['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 my-5">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="post_content_al" class="badge badge-secondary p-1 w-100"> English </label>
                                            <div class="col-sm-12">
                                               <textarea name="en_description" cols="30" rows="10" class="form-control" id="post_content_en">{{ $en }}</textarea>
                                            </div>
                                         </div>
                                         <div class="col-6">
                                            <label for="post_content_al" class="badge badge-secondary p-1 w-100"> Albanian </label>
                                            <div class="col-sm-12">
                                               <textarea name="al_description" cols="30" rows="10" class="form-control" id="post_content_al">{{ $al }}</textarea>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="inputText">Fixed Position</label>
                                    <select class="form-control" id="source" name="fixed" value="{{ $category->fixed }}">
                                        <option></option>
                                        <option {{ $category->fixed == 'true' ? 'selected' : '' }}>true</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <label for="inputText"
                                            class="col-sm-6 col-form-label"><small>xPosition</small></label>
                                        <div class="col-sm-12">
                                            <input type="number" name="xvalue" value="{{ $category->xvalue }}"
                                                class="form-control" id="inputText">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <label for="inputText"
                                            class="col-sm-6 col-form-label"><small>yPosition</small></label>
                                        <div class="col-sm-12">
                                            <input type="number" name="yvalue" value="{{ $category->yvalue }}"
                                                class="form-control" id="inputText">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn w-75 btn-success my-3">Krijo grup te dhenash</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- </div> --}}
    </div>


@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('post_content_en');
        CKEDITOR.replace('post_content_al');
    </script>

@endpush
