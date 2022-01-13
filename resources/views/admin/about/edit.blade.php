@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-10">
        <form action="{{route('about.update', [$about->id])}}" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="mb-3 row">
                <div class="col-12 my-5">
                    <div class="row w-100">
                        <div class="col-sm-6">
                            <label for="post_content_al" class="badge badge-secondary p-1 w-100"> English </label>
                            <textarea name="en_description" cols="30" rows="10" class="form-control" id="post_content_en">{{$en}}</textarea>
                        </div>
                        <div class="col-sm-6">
                            <label for="post_content_al" class="badge badge-secondary p-1 w-100"> Albanian </label>
                            <textarea name="al_description" cols="30" rows="10" class="form-control" id="post_content_al">{{$al}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="inputText">Fixed Position</label>
                            <select class="form-control" id="source" name="fixed">
                                <option></option>
                                <option {{ $about->fixed == 'true' ? 'selected' : '' }} >true</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <label for="inputText" class="col-sm-6 col-form-label">xvalue position</label>
                        <div class="col-sm-12">
                          <input type="number" name="xvalue" class="form-control" id="inputText">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <label for="inputText" class="col-sm-6 col-form-label">yvalue position</label>
                        <div class="col-sm-12">
                          <input type="number" name="yvalue" class="form-control" id="inputText">
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

@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('post_content_en');
    CKEDITOR.replace('post_content_al');
</script>

@endpush

