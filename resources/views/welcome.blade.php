@extends('layouts.master')

@section('content')
    <div class="row position-relative mx-0" style="width: 100vw;" id="lartFare">
        <div class="chart position-relative container-fluid px-0 mx-0" style="width: 100vw;">
            <div class="px-0 d-flex layer-two" style="width: 60vw;" id="grafiku">
                {{-- <div class="px-0 d-flex layer-two" style="width: 100vw;" id="grafiku"> --}}
                <div id="chartdiv"></div>
            </div>
            <div class="row position-absolute layer-two" style="visibility: hidden; width: 100vw; height: 100vh" id="harta">
            </div>
            <div class="row position-relative d-none layer-twofalf" id="galeria">
                <div class="col-12 d-flex" id="vendi">
                    <div class="canvas position-absolute w-100" id="paning">
                        <div class="column one pr-5 h-100"></div>
                        <div class="column two pl-5 h-100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper layer-three row mx-sm-2 mx-0">
            <div class="context-and-buttons container-fluid h-100 col-sm-6 col-12 px-0">
                <div class="buttons" id="buttonFormedia">
                    <div class="top">
                    </div>
                    <div class="bottom">
                        <button id="stateBtn" onclick="dataPrint()">M</button>
                    </div>
                </div>
                <div class="context">
                    <div class="pack">
                        <div class="history">
                            <div class="state init">
                            </div>
                        </div>
                        <div class="info">
                            <div class="row position-fixed stickyRow" style="background-color: #f7f8f7;">
                                <div class="container-fluid perMobile">
                                    <div class="row justify-content-between">
                                        <div class="col-1 my-auto px-sm-0 px-1">
                                            <div class="row">
                                                <a href="{{ url('/') }}">
                                                    <img src="{{ asset('images/logo.png') }}"
                                                        class="img-fluid w-100 px-sm-4 px-2" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-9 col-7 my-auto">
                                            <div class="row">
                                                <input
                                                    class="form-control mx-sm-2 bg-transparent shadow-none border-0 rounded-0"
                                                    type="text" placeholder="Search" id="searchBar" name="searchBar"
                                                    aria-label="Search">
                                            </div>
                                        </div>
                                        <div class="col-sm-1 col-2 px-1 my-auto">
                                            <button id="removeList"
                                                class="buttonTextX badge-pill d-block border border-dark mx-auto"
                                                style="visibility: hidden;">X</button>
                                        </div>
                                        <div class="col-1 px-1 my-auto">
                                            <button id="btnLang"
                                                class="buttonText px-0 d-block badge-pill mx-auto"></button>
                                        </div>
                                    </div>
                                    <div class="row" id="listaRow" style="display: none;">
                                        <ul id="autorList" class="w-100"></ul>
                                    </div>
                                </div>
                                <hr class="hrZeze w-100 my-0" id="hrToToggle">
                            </div>

                            <div class="row pl-sm-0 w-100 mx-0 px-0">
                                <div class="col-12 px-0">
                                    <article>
                                        <div class="row mt-0 px-0 overflow-hidden">
                                            <div class="col-12">
                                                <img src="{{ asset('images/square3.png') }}"
                                                    class="img-fluid px-5 mx-auto" alt="">
                                            </div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <p class="reg px-2 fadeContent en" id="content">
                                                Tirana Floating Archive is a digital platform initiated and implemented by <a href="http://tiranaartlab.org/en" target="_blank">
                                                Tirana Art Lab - Center for Contemporary Art </a>, documenting past and present
                                                art occurrences in public space in Tirana from the 1990???s until today.
                                                Tirana Floating Archive digital platform aims to
                                                document past and present public interventions by the independent art scene,
                                                which stand for artistic quality and meaningful contribution to public
                                                debate about public space.
                                                Due to missing structures and art spaces and as critique to violent changes
                                                in urban space in Tirana, many Albanian and foreign artists have used public
                                                space to make art works and interventions since the late 1990s. Independent
                                                institutions including Tirana Art Lab have produced a large part of their
                                                programs in public space as well. Most of these interventions are poorly or
                                                not at all documented.
                                                <br>
                                                <br>
                                            </p>
                                            <p class="reg px-2 fadeContent al" style="display: none;" id="content">
                                                Arkivi Lundrues i Tiran??s ??sht?? nj?? platform?? dixhitale nism?? e <a href="http://tiranaartlab.org/en" target="_blank"> Tirana Art
                                                Lab - Qend??r p??r Artin Bashk??kohor</a>, e cila dokumenton ngjarjet artistike ne
                                                hap??sir??n publike n?? Tiran?? prej 1990 e deri m?? sot. P??r shkak t?? munges??s
                                                s?? strukturave dhe hap??sirave artistike dhe si kritik?? ndaj ndryshimeve t??
                                                dhunshme n?? hapesir??n urbane n?? Tiran??, shum?? artist?? shqiptar?? e t?? huaj
                                                kan?? p??rdorur hapesir??n publike p??r t?? b??r?? vepra dhe nd??rhyrje artistike q??
                                                prej 1990. Institucione t?? pavarura sikund??r Tirana Art Lab kan?? prodhuar
                                                gjithashtu nj?? pjes?? t?? madhe t?? programeve t?? tyre n?? hap??sir??n publike.
                                                Shumica e k??tyre nd??rhyrjeve jan?? pak ose aspak t?? dokumentuara. Arkivi
                                                Lundrues i Tiran??s synon t?? dokumentoj?? nd??rhyrjet publike t?? s?? shkuar??s e
                                                s?? tashmes t?? sken??s s?? pavarur artistike, t?? cilat dallojn?? p??r cil??si
                                                artistike e mbi t?? gjitha mund t?? japin nj?? kontribut kuptimplot?? p??r
                                                debatet aktuale mbi hap??sir??n publike.
                                                <br>
                                                <br>
                                            </p>
                                            <p class="reg px-2 fadeContent en" style="text-indent: 5em;">
                                                The first stage of the Tirana Floating archive is dedicated to documenting with text, photos and video material projects by Silva Agostini, Fabrizio Bellomo, Lumturi Blloshmi, Nikolin Bujari, Enisa Cenaliaj, ??ETA, Donika ??ina, Adela Demetja, Haus am Gern, HAVEIT, Hanna Hildebrand, Sead Kazanxhiu, Ledia Kostandini, Georgia Kotretsos, Dren Maliqi, Alban Muja, Alketa Ramaj, Gabriele Rendina Cattani, Stefano Romano & Eri ??obo, Rena R??dle & Vladan Jeremic, Arjan Serjanaj, Syabhit Shkreli, Alexander Walmsley, Ergin Zaloshnja. The archive will continue to grow and include other relevant past and future interventions continuously. The second stage of the project will be dedicated to creating an App that can be used as a tool to explore the sites where the intervention happened and will offer the possibility of virtual guided tours with additional information through Tirana. The third stage of the project aims to recreate some of the interventions using virtual reality and augmented reality which will be added to the website version and the app version of the archive.
                                            </p>
                                            <p class="reg px-2 fadeContent al" style="text-indent: 5em; display: none;">
                                                Faz??n e par?? e Arkivit Lundrues t?? Tiran??s, i kushtohet dokumentimit t?? me tekst, materiale fotografike dhe video t?? projekteve nga Silva Agostini, Fabrizio Bellomo, Lumturi Blloshmi, Nikolin Bujari, Enisa Cenaliaj, ??ETA, Donika ??ina, Adela Demetja, Haus am Gern, HAVEIT, Hanna Hildebrand, Sead Kazanxhiu, Ledia Kostandini, Georgia Kotretsos, Dren Maliqi, Alban Muja, Alketa Ramaj, Gabriele Rendina Cattani, Stefano Romano & Eri ??obo, Rena R??dle & Vladan Jeremic, Arjan Serjanaj, Syabhit Shkreli, Alexander Walmsley, Ergin Zaloshnja. N?? vazhdim??si arkivi do t?? vazhdoj?? t?? rritet dhe t?? p??rfshij?? nd??rhyrje t?? tjera t?? r??nd??sishme t?? s?? kaluar??s dhe s?? ardhmes. Faza e dyt?? e projektit do t'i kushtohet krijimit t?? nj?? aplikacioni q?? mund t?? p??rdoret si nj?? mjet p??r t?? eksploruar vendet ku kan?? ndodhur nd??rhyrjet dhe do t?? ofroj?? mund??sin?? e guidave virtuale me informacion shtes?? n??p??r Tiran??. Faza e tret?? e projektit synon t?? rikrijoj?? disa nga nd??rhyrjet duke p??rdorur realitetin virtual dhe realitetin e augumentuar, t?? cilat do t'i shtohen versionit t?? faqes s?? internetit dhe versionit t?? aplikacionit t?? arkivit.
                                            </p>
                                        </div>
                                        <div class="additional px-0 pt-sm-4 pb-sm-4 p-0">
                                            <div class="row">
                                                <div class="col-sm-6 col-12 pl-1 pr-2">
                                                    <p class="small fadeContent en">
                                                        Tirana Floating Archive is supported by the Swiss Cultural Fund, a
                                                        project of the Swiss Agency for Development and Cooperation (SDC),
                                                        implemented by the Center for Business, Technology and Leadership
                                                        (CBTL).
                                                    </p>
                                                    <p class="small fadeContent al" style="display: none;">
                                                        Arkivi Lundrues i Tiran??s mb??shtetet nga Fondi Kulturor Zviceran,
                                                        nj?? projekt i Agjencis?? Zvicerane p??r Zhvillim dhe Bashk??punim
                                                        (SDC), zbatuar nga Qendra p??r Biznes, Teknologji dhe Lidership
                                                        (CBTL).
                                                    </p>
                                                    <img src="{{ asset('images/swiss.svg') }}" class="img-fluid"
                                                        alt="">
                                                </div>
                                                <div class="col-sm-6 col-12 pr-2 pl-2 pt-sm-0 pt-2">
                                                    <p class="small fadeContent en">
                                                        Tirana Floating Archive is part of the large-scale cooperation
                                                        project BEYOND MATTER. Cultural Heritage on the Verge of Virtual
                                                        Reality, dedicated to novel, digital approaches to exhibition
                                                        revival, documentation, and dissemination, and the artistic,
                                                        curatorial, and museological elaboration of the chances given by
                                                        virtual representation.
                                                        Beyond Matter is co-founded by the
                                                        Creative Europe Program of the European Union.
                                                    </p>
                                                    <p class="small fadeContent al" style="display: none;">
                                                        Arkivi Lundrues i Tiran??s ??sht?? pjes?? e projektit t?? bashk??punimit
                                                        ???Beyond Matter.Trash??gimia kulturore n?? prag t?? realitetit virtual???,
                                                        kushtuar qasjeve inovative dixhitale t?? rishfaqjes, dokumentimit dhe
                                                        shp??rndarjes s?? ekspozitave, si dhe p??rpunimit artistik, kuratorial
                                                        dhe muzeologjik t?? gjeneruara nga p??rfaq??simi virtual. Beyond Matter
                                                        ??sht?? i bashk??-financuar nga programi Evropa Krijuese i Bashkimit
                                                        Evropian.
                                                    </p>
                                                    <img src="{{ asset('images/EU-BM.svg') }}" class="img-fluid mt-n2"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="additional pt-sm-4 pb-sm-4 pl-sm-4 pr-sm-5 pr-3">
                                            <div class="row">
                                                <div class="col-12 px-sm-1 pl-4">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-12 px-0">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p class="regTit px-0 mb-0 en">Project Manager and
                                                                        Curator
                                                                    </p>
                                                                    <p class="regTit px-0 mb-0 al" style="display: none;">
                                                                        Menaxhere e projektit dhe kuratore
                                                                    </p>
                                                                </div>
                                                                <div class="col-sm-6 ml-auto">
                                                                    <p class="small px-0 text-right"> Adela Demetja
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-12 px-0">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p class="regTit px-0 mb-0 en">Content Manager and
                                                                        Curator
                                                                    </p>
                                                                    <p class="regTit px-0 mb-0 al" style="display: none;">
                                                                        Menaxhere e p??rmbajtjes dhe kuratore
                                                                    </p>
                                                                </div>
                                                                <div class="col-6 ml-auto">
                                                                    <p class="small px-0 text-right"> Eni Derhemi
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr class="hrZeze w-100 my-0">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6 col-12 px-0">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p class="regTit px-0 mb-0 en">Design
                                                                    </p>
                                                                    <p class="regTit px-0 mb-0 al" style="display: none;">
                                                                        Dizajni
                                                                    </p>
                                                                </div>
                                                                <div class="col-10 ml-auto">
                                                                    <p class="small px-0 text-right"> Denislav Golemanov
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-12 px-0">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p class="regTit px-0 mb-0 en">Code
                                                                    </p>
                                                                    <p class="regTit px-0 mb-0 al" style="display: none;">
                                                                        Kodi
                                                                    </p>
                                                                </div>
                                                                <div class="col-6 ml-auto">
                                                                    <p class="small px-0 text-right"> Marin Nikolli
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr class="hrZeze w-100 my-0">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6 col-12 px-0">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p class="regTit px-0 mb-0 en">Project Text
                                                                    </p>
                                                                    <p class="regTit px-0 mb-0 al" style="display: none;">
                                                                        Tekstet
                                                                    </p>
                                                                </div>
                                                                <div class="col-10 ml-auto">
                                                                    <p class="small px-0 text-right en"> Artists, edited by
                                                                        TFA
                                                                    </p>
                                                                    <p class="small px-0 text-right al"
                                                                        style="display: none;"> Artist??t, redaktuar nga TFA
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-12 px-0">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p class="regTit px-0 mb-0 en">Images
                                                                    </p>
                                                                    <p class="regTit px-0 mb-0 al" style="display: none;">
                                                                        Imazhet
                                                                    </p>
                                                                </div>
                                                                <div class="col-6 ml-auto">
                                                                    <p class="small px-0 text-right en"> Artists
                                                                    </p>
                                                                    <p class="small px-0 text-right al"
                                                                        style="display: none;"> Artist??t
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr class="hrZeze w-100 my-0">
                                                    </div>
                                                    <div class="row justify-content-between">
                                                        <div class="col-sm-4 col-5 my-auto">
                                                            <div class="row">
                                                                <div class="col-sm-5 col-6 px-0 my-auto">
                                                                    <p class="mb-0 px-0 text-left en"> Contact us
                                                                    </p>
                                                                    <p class="mb-0 px-0 text-left al"
                                                                        style="display: none;"> Contact us
                                                                    </p>
                                                                </div>
                                                                <div class="col-sm-5 col-4 px-sm-1 px-0">
                                                                    <a href="mailto:info@tiranaartlab.org">
                                                                        <img src="{{ asset('images/TFA-default.svg') }}"
                                                                            class="img-fluid p-sm-0 px-0 pt-1" alt="">
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-7 pr-0 my-auto">
                                                            <img src="{{ asset('images/TAL.svg') }}"
                                                                class="img-fluid" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu mobile">
                    <div class="button-mob">
                        <div class="row flex-column">
                            <div class="col-1 pt-2">
                                <button id="triggerToggle"
                                    class="buttonMbyll closes rounded-circle d-block border border-dark mx-auto"
                                    onclick="changeClose()">X</button>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="activeScreen mobile">
                    <div class="row grid mx-auto position-relative">
                        <button id="stateBtn2" onclick="dataPrint2()" style="z-index: 999;">M</button>
                        <div class="px-0 d-flex layer-two" style="width: 100vw;" id="grafikuMB">
                            <div id="chartdivi"></div>
                        </div>
                        <div class="row position-absolute layer-two mx-auto"
                            style="visibility: hidden; width: 99.5vw; height: 100vh" id="hartaMB">
                        </div>
                        <div class="row position-absolute d-none layer-twofalf mx-auto" id="galeriaMB">
                            <div class="col-12 d-flex" id="vendiMB">
                                <div class="canvas w-100" id="paningMB">
                                    <div class="column three pr-5 h-100"></div>
                                    <div class="column four pl-5 h-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @push('scripts')
        <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
        <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
        <script src="https://cdn.amcharts.com/lib/4/plugins/forceDirected.js"></script>
        <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>


        {{-- <script src="https://unpkg.com/@panzoom/panzoom@4.4.3/dist/panzoom.min.js"></script> --}}
        <script src='https://unpkg.com/panzoom@9.4.0/dist/panzoom.min.js'></script>

        {{-- slidetoggle --}}
        <script src='https://cdn.jsdelivr.net/npm/slidetoggle@3.3.2/dist/slidetoggle.js'></script>

        <script src="https://cdn.jsdelivr.net/npm/yall-js@3.2.0/dist/yall.min.js"></script>
        <script src="https://polyfill.io/v2/polyfill.min.js?features=IntersectionObserver"></script>

        {{-- leaflet --}}
        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                crossorigin=""></script>
        <script>
            var imagePlaceHolder = '{{ URL::asset('/images/placeholder.png') }}';
            document.addEventListener("DOMContentLoaded", function() {
                yall({
                    observeChanges: true,
                    idleLoadTimeout: 0,
                    events: {
                        load: function(event) {
                            if (!event.target.classList.contains("lazy") && event.target.nodeName ==
                                "IMG") {
                                event.target.classList.add("yall-loaded");
                            }
                        },
                        error: {
                            listener: function(event) {
                                if (!event.target.classList.contains("lazy") && event.target.nodeName ==
                                    "IMG") {
                                    event.target.classList.add("yall-error");
                                }
                            },
                            options: {
                                once: true
                            }
                        }
                    }
                });
            });

            var toggle1 = 0;

            function dataPrint() {
                var grafiku = document.getElementById("grafiku");
                var harta = document.getElementById("harta");
                var galeria = document.getElementById("galeria");
                var togling = document.getElementById('stateBtn');
                var infoCont = document.getElementsByClassName('history')[0];
                var searchBar = document.getElementsByClassName('stickyRow')[0];

                if (toggle1 === 0) {
                    document.querySelector('#stateBtn');
                    toggle1 = 1;
                    togling.innerText = 'G';
                    infoCont.style.visibility = 'hidden';
                    infoCont.style.opacity = '0';
                    infoCont.style.transition = 'visibility 0s 2s, opacity 2s linear';
                    searchBar.style.visibility = 'hidden';
                    searchBar.style.opacity = '0';
                    searchBar.style.transition = 'visibility 0s 2s, opacity 2s linear';
                    grafiku.classList.remove('d-flex');
                    grafiku.classList.add('d-none');
                    harta.style.visibility = 'visible';
                    harta.style.opacity = '1';
                    harta.style.transition = 'opacity 2s linear';
                } else if (toggle1 === 1) {
                    document.querySelector('#stateBtn');
                    toggle1 = 2;
                    togling.innerText = 'H';
                    harta.style.visibility = "hidden";
                    harta.style.opacity = "0";
                    harta.style.transition = "visibility 0s 2s, opacity 2s linear";
                    galeria.classList.remove("d-none");
                    galeria.classList.add("d-flex");
                } else if (toggle1 === 2) {
                    document.querySelector('#stateBtn'); //stop
                    toggle1 = 0;
                    togling.innerText = 'M';
                    infoCont.style.visibility = 'visible';
                    infoCont.style.opacity = '1';
                    infoCont.style.transition = 'opacity 2s linear';
                    searchBar.style.visibility = 'visible';
                    searchBar.style.opacity = '1';
                    searchBar.style.transition = 'opacity 2s linear';
                    galeria.classList.remove("d-flex");
                    galeria.classList.add("d-none");
                    grafiku.classList.remove("d-none");
                    grafiku.classList.add("d-flex");
                }
            }
            var toggle2 = 0;

            function dataPrint2() {
                var grafikuMB = document.getElementById("grafikuMB");
                var hartaMB = document.getElementById("hartaMB");
                var galeriaMB = document.getElementById("galeriaMB");
                var togling = document.getElementById('stateBtn2');

                if (toggle2 === 0) {
                    document.querySelector('#stateBtn2');
                    toggle2 = 1;
                    togling.innerText = 'G';
                    grafikuMB.classList.remove('d-flex');
                    grafikuMB.classList.add('d-none');
                    hartaMB.style.visibility = 'visible';
                    hartaMB.style.opacity = '1';
                    hartaMB.style.transition = 'opacity 2s linear';
                } else if (toggle2 === 1) {
                    document.querySelector('#stateBtn2');
                    toggle2 = 2;
                    togling.innerText = 'H';
                    hartaMB.style.visibility = "hidden";
                    hartaMB.style.opacity = "0";
                    hartaMB.style.transition = "visibility 0s 2s, opacity 2s linear";
                    galeriaMB.classList.remove("d-none");
                    galeriaMB.classList.add("d-flex");
                } else if (toggle2 === 2) {
                    document.querySelector('#stateBtn2');
                    toggle2 = 0;
                    togling.innerText = 'M';
                    galeriaMB.classList.remove("d-flex");
                    galeriaMB.classList.add("d-none");
                    grafikuMB.classList.remove("d-none");
                    grafikuMB.classList.add("d-flex");
                }
            }


            var toggleSlide = 0;

            function changeClose() {
                var btnClose = document.querySelector('#triggerToggle');
                var containMenu = document.querySelector('.activeScreen');
                if (toggleSlide === 1) {
                    btnClose.innerText = 'X';
                    containMenu.style.zIndex = '170';
                    containMenu.style.transition = "z-index .1s linear";

                } else if (toggleSlide === 0) {
                    btnClose.innerText = '???';
                    containMenu.style.zIndex = '0';
                    containMenu.style.transition = "z-index 4s linear";
                }
            }


            class DOMAnimations {
                /**
                 * @param {HTMLElement} element
                 * @param {Number} duration
                 * @returns {Promise<boolean>}
                 */

                static slideUp(element, duration = 500) {
                    return new Promise(function(resolve, reject) {
                        toggleSlide = 1;
                        element.style.height = element.offsetHeight + 'px'
                        element.style.transitionProperty = `height, margin, padding`
                        element.style.transitionDuration = duration + 'ms'
                        element.offsetHeight // eslint-disable-line no-unused-expressions
                        element.style.overflow = 'hidden'
                        element.style.height = 0
                        element.style.paddingTop = 0
                        element.style.paddingBottom = 0
                        element.style.marginTop = 0
                        element.style.marginBottom = 0
                        window.setTimeout(function() {
                            element.style.display = 'none'
                            element.style.removeProperty('height')
                            element.style.removeProperty('padding-top')
                            element.style.removeProperty('padding-bottom')
                            element.style.removeProperty('margin-top')
                            element.style.removeProperty('margin-bottom')
                            element.style.removeProperty('overflow')
                            element.style.removeProperty('transition-duration')
                            element.style.removeProperty('transition-property')
                            resolve(false)
                        }, duration)
                    })
                }

                /**
                 * @param {HTMLElement} element
                 * @param {Number} duration
                 * @returns {Promise<boolean>}
                 */
                static slideDown(element, duration = 500) {
                    return new Promise(function(resolve, reject) {
                        toggleSlide = 0;
                        element.style.removeProperty('display')
                        let display = window.getComputedStyle(element).display
                        element.style.display = display === 'none' ? 'block' : display
                        let height = element.offsetHeight
                        element.style.overflow = 'hidden'
                        element.style.height = 0
                        element.style.paddingTop = 0
                        element.style.paddingBottom = 0
                        element.style.marginTop = 0
                        element.style.marginBottom = 0
                        element.offsetHeight // eslint-disable-line no-unused-expressions
                        element.style.transitionProperty = `height, margin, padding`
                        element.style.transitionDuration = duration + 'ms'
                        element.style.height = height + 'px'
                        element.style.removeProperty('padding-top')
                        element.style.removeProperty('padding-bottom')
                        element.style.removeProperty('margin-top')
                        element.style.removeProperty('margin-bottom')
                        window.setTimeout(function() {
                            element.style.removeProperty('height')
                            element.style.removeProperty('overflow')
                            element.style.removeProperty('transition-duration')
                            element.style.removeProperty('transition-property')
                        }, duration)
                    })
                }

                /**
                 * @param {HTMLElement} element
                 * @param {Number} duration
                 * @returns {Promise<boolean>}
                 */

                //  var

                static slideToggle(element, duration = 500) {
                    if (window.getComputedStyle(element).display === 'none') {
                        return this.slideDown(element, duration)
                    } else {
                        return this.slideUp(element, duration)
                    }
                }

            }
            window.onload = function() {
                let ToggableGrid = true;

                document.querySelector('#triggerToggle').addEventListener('click', function(e) {
                    e.preventDefault();
                    DOMAnimations.slideToggle(document.querySelector('.grid'));
                });



                let btn = document.getElementById('btnLang');
                var elementsEn = document.getElementsByClassName('en');
                var elementsAl = document.getElementsByClassName('al');

                btn.innerText = 'AL';

                btn.addEventListener('click', () => {
                    if (btn.innerText === 'AL') {
                        btn.innerText = 'EN';
                        elementsEn.forEach(elementen => {
                            elementen.style.display = "none";
                        });
                        elementsAl.forEach(elemental => {
                            elemental.style.display = "block";
                        });
                    } else {
                        btn.innerText = 'AL';
                        elementsEn.forEach(elementen => {
                            elementen.style.display = "block";
                        });
                        elementsAl.forEach(elemental => {
                            elemental.style.display = "none";
                        });
                    }
                });
            }
        </script>
    @endpush
