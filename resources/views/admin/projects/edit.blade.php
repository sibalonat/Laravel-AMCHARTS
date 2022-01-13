@extends('layouts.app')

@section('content')
    <div class="container-fluid px-5">
        <form action="{{ route('project.update', [$project->id]) }}" enctype="multipart/form-data" id="upload-form"
            class="class=" dropzone"" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="row p-3 border">
                <div class="col-2 px-0">
                    <div class="row">
                        <label for="inputText" class="col-sm-12 col-form-label">Category name</label>
                        <div class="col-sm-12">
                            <select name="category_id" class="form-control" id="category_id" required>
                                <option value="">--- SELECT CONTENT CATEGORY ---</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}" @if ($project->category_id == $cat->id) selected @endif>{{ $cat['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="row">
                        <label for="inputText" class="col-sm-6 col-form-label">name of name</label>
                        <div class="col-sm-12">
                            <input type="text" name="name" required value="{{ $project->name }}" class="form-control"
                                id="inputText">
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="row">
                        <label for="inputText" class="col-sm-6 col-form-label">Author name</label>
                        <div class="col-sm-12">
                            <input type="text" name="authorname" required value="{{ $project->authorname }}"
                                class="form-control" id="inputText">
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="row">
                        <label for="inputText" class="col-sm-6 col-form-label">Mediumi</label>
                        <div class="col-sm-12">
                            <input type="text" name="mediumi" required value="{{ $project->mediumi }}"
                                class="form-control" id="inputText">
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="row">
                        <label for="inputDate" class="col-sm-12 col-form-label">Production date {{ $dateOfPr }}</label>
                        <div class="col-sm-12">
                            <input type="date" name="production_date" value="{{$project->production_date }}"
                                class="form-control datepicker" id="inputDate">
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="row">
                        <label for="inputText" class="col-sm-12 col-form-label">Where did it took place</label>
                        <div class="col-sm-12">
                            <input type="text" name="location" value="{{ $project->location }}" class="form-control"
                                id="inputText">
                        </div>
                    </div>
                </div>
                <div class="col-8 px-0">
                    <div class="row">
                        <div class="col-6">
                            <label for="post_content_al" class="badge badge-secondary p-1 w-100"> English </label>
                            <div class="col-sm-12">
                                <textarea name="en_description" cols="30" rows="10" class="form-control"
                                    id="post_content_en">{{ $en }}</textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="post_content_al" class="badge badge-secondary p-1 w-100"> Albanian </label>
                            <div class="col-sm-12">
                                <textarea name="al_description" cols="30" rows="10" class="form-control"
                                    id="post_content_al">{{ $al }}</textarea>
                            </div>
                        </div>

                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <label for="inputText" class="col-sm-12 col-form-label">latitude</label>
                                <div class="col-sm-12">
                                    <input class="form-control" name="lat" id="lat" size=12
                                        value="{{ $project->lat }}">
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="inputText" class="col-sm-12 col-form-label">longitude</label>
                                <div class="col-sm-12">
                                    <input name="lon" class="form-control" id="lon" size=12
                                        value="{{ $project->lon }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <hr>
                    <div class="row">
                        <p class="display-4 text-left">Position</p>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label for="inputText">Fixed Position</label>
                                            <select class="form-control" id="source" name="fixed"
                                                value="{{ $project->fixed }}">
                                                <option></option>
                                                <option {{ $project->fixed == 'true' ? 'selected' : '' }}>true</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label for="inputText"
                                            class="col-sm-6 col-form-label"><small>xPosition</small></label>
                                        <div class="col-sm-12">
                                            <input type="number" name="xvalue" value="{{ $project->xvalue }}"
                                                class="form-control" id="inputText">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label for="inputText"
                                            class="col-sm-6 col-form-label"><small>yPosition</small></label>
                                        <div class="col-sm-12">
                                            <input type="number" name="yvalue" value="{{ $project->yvalue }}" class="form-control" id="inputText">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <label for="inputText" class="col-sm-12 col-form-label">Featured Image</label>
                                <div class="col-sm-12">
                                    <div class="col-md-4 my-auto">
                                        <div class="form-file-group mx-auto">
                                            <div class="form-file-group mx-auto">
                                                <input type="file" style="display: none" id="file-upload" name="featured"
                                                    onchange="previewFile(this)">
                                                <p onclick="document.querySelector('#file-upload').click()">drag your
                                                    file here</p>
                                            </div>
                                        </div>
                                        <br>
                                        <div id="previewBox" style="display: none">
                                            <img src="{{ $thumba }}" alt="" class="img-fluid" id="previewImage">
                                            <i style="coursor:pointer;" onclick="removePreview()">Delete</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-9">
                                    <label for="inputText" class="col-form-label">Aktivities</label>
                                    <div class="form-group form-group mb-0">
                                        <select id="myselect" multiple name="aktivitete[]">
                                            <option value="">Select An Option</option>
                                            @foreach ($aktivitete as $tag)
                                                <option value="{{ $tag->id }}"
                                                    {{ $project->aktivitete()->pluck('id')->contains($tag->id)? 'selected' : '' }}>
                                                    {{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row text-center bg-secondary text-white-50 justify-content-center">
                        <div class="form-group">
                            <label for="document" class="h3 my-b">MEDIA</label>
                            <div class="needsclick dropzone" id="document-dropzone">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-4">
                    <button type="submit" class="btn btn-primary w-100 mb-3">create</button>
                </div>
            </div>
        </form>

        <style>
            .form-file-group {
                width: 300px;
                height: 200px;
                border: 4px dashed #000;
            }

            .form-file-group p {
                width: 100%;
                height: 100%;
                text-align: center;
                line-height: 170px;
            }

            .bootstrap-tagsinput {
                margin: 0;
                width: 100%;
                padding: .5rem .75rem 0;
                transition: border-color 0.15s ease-in-out;
            }

        </style>
    @endsection

    @push('scripts')

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> --}}
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>


            CKEDITOR.replace('post_content_en');
            CKEDITOR.replace('post_content_al');

            $('#myselect').select2({
                width: '100%',
                placeholder: "Select an Option",
                allowClear: true
            });


            var uploadedDocumentMap = {}
            Dropzone.options.documentDropzone = {
                url: '{{ route('projects.storeMedia') }}',
                maxFilesize: 50, // MB
                addRemoveLinks: true,
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.mpg,.mp4",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(file, response) {
                    $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
                    uploadedDocumentMap[file.name] = response.name
                },
                removedfile: function(file) {
                    file.previewElement.remove()
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = uploadedDocumentMap[file.name]
                    }
                    $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
                },
                init: function() {
                    @if (isset($photos))
                        var files =
                        {!! json_encode($photos) !!}
                        for (var i in files) {
                        var file = files[i]
                        console.log(file);
                        file = {
                        ...file,
                        width: 226,
                        height: 324
                        }
                        this.options.addedfile.call(this, file)
                        this.options.thumbnail.call(this, file, file.original_url)
                        file.previewElement.classList.add('dz-complete')

                        $('form').append('<input type="hidden" name="photo[]" value="' + file.file_name + '">')
                        }
                    @endif
                }
            }

            $(document).ready(function() {
                let url = "{{ $thumba }}";
                if (url !== "") {
                    $("#previewBox").css('display', 'block');
                    $(".form-file-group").css('display', 'none');
                }
            });

            function previewFile(input) {
                let file = $("input[type=file]").get(0).files[0];

                if (file) {
                    let reader = new FileReader();
                    reader.onload = function() {
                        $("#previewImage").attr('src', reader.result);
                        $("#previewBox").css('display', 'block');
                    }
                    $(".form-file-group").css('display', 'none');
                    reader.readAsDataURL(file);
                }
            };

            function removePreview() {
                $("#previewImage").attr('src', '');
                $("#previewBox").css('display', 'none');
                $(".form-file-group").css('display', 'block');
            };
        </script>
    @endpush
