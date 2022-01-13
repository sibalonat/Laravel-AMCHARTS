@extends('layouts.app')

@section('content')
    <div class="container-fluid px-5">
        <form action="{{ route('project.store') }}" enctype="multipart/form-data" id="upload-form" class="class="
            dropzone"" method="POST">
            {{ csrf_field() }}
            <div class="row p-3 border">
                <div class="col-12">
                    <div class="row">
                        <div class="col-2 px-0">
                            <div class="row">
                                <label for="inputText" class="col-sm-12 col-form-label"><small>Category name</small></label>
                                <div class="col-sm-12">
                                    <select name="category_id" class="form-control" id="category_id" required>
                                        <option value="">--- SELECT CONTENT CATEGORY ---</option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="row">
                                <label for="inputText" class="col-sm-6 col-form-label"><small>Name of
                                        Project</small></label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" class="form-control" id="inputText">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="row">
                                <label for="inputText" class="col-sm-6 col-form-label"><small>Author name</small></label>
                                <div class="col-sm-12">
                                    <input type="text" name="authorname" class="form-control" id="inputText">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="row">
                                <label for="inputText" class="col-sm-6 col-form-label"> <small>Mediumi </small></label>
                                <div class="col-sm-12">
                                    <input type="text" name="mediumi" class="form-control" id="inputText">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="row">
                                <label for="inputDate" class="col-sm-12 col-form-label"> <small>Production date
                                    </small></label>
                                <div class="col-sm-12">
                                    <input type="date" name="production_date" required class="form-control "
                                        id="inputDate">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="row">
                                <label for="inputText" class="col-sm-12 col-form-label"> <small>Location </small></label>
                                <div class="col-sm-12">
                                    <input type="text" name="location" id="location" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row w-75">
                        <div class="col-6">
                            <label for="inputText" class="col-sm-12 col-form-label"><b> <small>Address Lookup </small>
                                </b></label>
                            <div class="col-sm-12">
                                <div class="row" id="search">
                                    <div class="col-8">
                                        <input type="text" name="location" class="w-100 form-control" value="" id="addr" />
                                    </div>
                                    <div class="col-4">
                                        <button type="button" style="width: 100%; margin: auto 0;"
                                            class="my-auto align-middle" onclick="addr_search();"> Search</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <div id="results"></div>
                                    </div>
                                    <div class="col-2">
                                        <div id="map">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    <label for="inputText" class="col-sm-12 col-form-label"><small>latitude</small></label>
                                    <div class="col-sm-12">
                                        <input class="form-control" name="lat" id="lat" size=12 value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="inputText" class="col-sm-12 col-form-label">
                                        <small>longitude</small></label>
                                    <div class="col-sm-12">
                                        <input name="lon" class="form-control" id="lon" size=12 value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8 px-0">
                    <div class="row">
                        <div class="col-6">
                            <label for="post_content_al" class="badge badge-secondary p-1 w-100"> English </label>
                            <div class="col-sm-12">
                                <textarea name="en_description" cols="30" rows="10" class="form-control"
                                    id="post_content_en"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="post_content_al" class="badge badge-secondary p-1 w-100"> Albanian </label>
                            <div class="col-sm-12">
                                <textarea name="al_description" cols="30" rows="10" class="form-control"
                                    id="post_content_al"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <hr>
                    <div class="row">
                        <p class="display-4 text-left">Position</p>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label for="inputText"> <small> Fixed Position </small></label>
                                            <select class="form-control" id="source" name="fixed">
                                                <option></option>
                                                <option {{ $project->fixed == 'true' ? 'selected' : '' }}>true</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 pr-1 pl-0">
                                    <div class="row">
                                        <label for="inputText" class="col-sm-6 col-form-label">
                                            <small>xPosition</small></label>
                                        <div class="col-sm-12">
                                            <input type="number" name="xvalue" class="form-control border-0" id="inputText">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 pr-0 pl-1">
                                    <div class="row">
                                        <label for="inputText"
                                            class="col-sm-6 col-form-label"><small>yPosition</small></label>
                                        <div class="col-sm-12">
                                            <input type="number" name="yvalue" class="form-control border-0" id="inputText">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <label for="inputText" class="col-sm-12 col-form-label">Featured Image</label>
                                <div class="col-sm-12">
                                    <input type="file" name="featured" required id="featured" value=""
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-9">
                                    <label for="inputText" class="col-form-label">Aktivities</label>
                                    <div class="form-group form-group mb-0">
                                        <select id="myselect" multiple name="aktivitete[]">
                                            <option value="">Select An Option</option>
                                            @foreach ($aktivitete as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
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
    @endsection

    @push('scripts')


        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                crossorigin=""></script>

        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> --}}

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
        <script>
            // CKEDITOR.replace('post_content');

            $('#myselect').select2({
                width: '100%',
                placeholder: "Select an Option",
                allowClear: true
            });
        </script>

        <script>
            CKEDITOR.replace('post_content_en');
            CKEDITOR.replace('post_content_al');
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
                }
            }
        </script>
        <script type="text/javascript">
            // New York
            var startlat = 40.75637123;
            var startlon = -73.98545321;

            var options = {
                center: [startlat, startlon],
                zoom: 9
            }

            document.getElementById('lat').value = startlat;
            document.getElementById('lon').value = startlon;

            var map = L.map('map', options);
            var nzoom = 12;

            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: 'OSM'
            }).addTo(map);

            var myMarker = L.marker([startlat, startlon], {
                title: "Coordinates",
                alt: "Coordinates",
                draggable: true
            }).addTo(map).on('dragend', function() {
                var lat = myMarker.getLatLng().lat.toFixed(8);
                var lon = myMarker.getLatLng().lng.toFixed(8);
                var czoom = map.getZoom();
                if (czoom < 18) {
                    nzoom = czoom + 2;
                }
                if (nzoom > 18) {
                    nzoom = 18;
                }
                if (czoom != 18) {
                    map.setView([lat, lon], nzoom);
                } else {
                    map.setView([lat, lon]);
                }
                document.getElementById('lat').value = lat;
                document.getElementById('lon').value = lon;
                myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
            });

            function chooseAddr(lat1, lng1, display_name) {
                myMarker.closePopup();
                map.setView([lat1, lng1], 18);
                myMarker.setLatLng([lat1, lng1]);
                lat = lat1.toFixed(8);
                lon = lng1.toFixed(8);
                locationaddr = display_name;
                console.log(locationaddr);
                document.getElementById('lat').value = lat;
                document.getElementById('lon').value = lon;
                myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
            }

            function myFunction(arr) {
                var out = "<br />";
                var i;
                var locationaddr = '';

                if (arr.length > 0) {
                    for (i = 0; i < arr.length; i++) {
                        out += "<div class='address' title='Show Location and Coordinates' onclick='chooseAddr(" + arr[i].lat +
                            ", " + arr[i].lon + ");return false;'>" + arr[i].display_name + "</div>";
                        locationaddr = arr[i].display_name;
                    }

                    document.getElementById('results').innerHTML = out;
                    // document.getElementById('location').value = locationaddr;
                } else {
                    document.getElementById('results').innerHTML = "Sorry, no results...";
                }

            }

            function addr_search() {
                var inp = document.getElementById("addr");
                var xmlhttp = new XMLHttpRequest();
                var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + inp.value;
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var myArr = JSON.parse(this.responseText);
                        myFunction(myArr);
                    }
                };
                xmlhttp.open("GET", url, true);
                xmlhttp.send();
            }
        </script>
    @endpush
