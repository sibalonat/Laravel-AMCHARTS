@extends('layouts.app')

@section('content')
<div class="container-fluid px-5 py-3 border">
    <form action="{{route('aktivitet.update', [$aktivitete->id])}}" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
        <div class="mb-3 row">
            <div class="col-4">
                <div class="row">
                    <label for="inputText" class="col-sm-6 col-form-label">name of Activity</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" required value="{{$aktivitete->name}}" class="form-control" id="inputText">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <label for="inputText" class="col-sm-6 col-form-label">Author name</label>
                    <div class="col-sm-9">
                        <input type="text" name="kuratori" required value="{{$aktivitete->kuratori}}" class="form-control" id="inputText">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-sm-9">
                        <label for="inputText" class="col-form-label">Short description</label>
                        <div class="form-group form-group mb-0">
                            <select id="myselect" multiple name="projects[]">
                              <option value="" >Select An Option</option>
                              @foreach($projektet as $tag)
                              <option value="{{ $tag->id }}" {{ ($aktivitete->projects()->pluck('id')->contains($tag->id)) ? 'selected' : '' }}>{{ $tag->name }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="col-6">
                        <label for="post_content_al" class="badge badge-secondary p-1 w-100"> English </label>
                        <div class="col-sm-12">
                            <textarea name="description" required cols="30" rows="10" class="form-control" id="post_content_en">{{$en}}</textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="post_content_al" class="badge badge-secondary p-1 w-100"> Albanian </label>
                        <div class="col-sm-12">
                            <textarea name="description" required cols="30" rows="10" class="form-control" id="post_content_al">{{$al}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <label for="inputText" class="col-sm-12 col-form-label">Production date</label>
                            <div class="col-sm-9">
                              <input type="date" name="production_date" required value="{{$aktivitete->production_date}}" class="form-control" id="inputText">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <label for="inputText" class="col-sm-12 col-form-label">Where did it took place</label>
                            <div class="col-sm-9">
                              <input type="text" name="location" value="{{$aktivitete->location}}" class="form-control" id="inputText">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="display-4">Position</p>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="inputText">Fixed Position</label>
                                        <select class="form-control" id="source" name="fixed" value="{{$aktivitete->fixed}}">
                                            <option></option>
                                            <option {{ $aktivitete->fixed == 'true' ? 'selected' : '' }} >true</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <label for="inputText" class="col-sm-6 col-form-label"><small>xPosition</small></label>
                                    <div class="col-sm-12">
                                      <input type="number" name="xvalue" value="{{$aktivitete->xvalue}}" class="form-control" id="inputText">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <label for="inputText" class="col-sm-6 col-form-label"><small>yPosition</small></label>
                                    <div class="col-sm-12">
                                      <input type="number" name="yvalue" value="{{$aktivitete->yvalue}}" class="form-control" id="inputText">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <button type="submit" class="btn w-100 btn-primary mb-3">CREATE AKTIVITET</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('post_content_en');
    CKEDITOR.replace('post_content_al');
    $('#myselect').select2({
        width: '100%',
        placeholder: "Select an Option",
        allowClear: true
    });
</script>

@endpush
