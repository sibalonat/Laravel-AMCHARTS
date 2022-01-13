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
                                                <img src="{{ asset('images/logo') }}" alt="">
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
                                                Tirana Floating Archive is a digital platform initiated and implemented by
                                                Tirana Art Lab - Center for Contemporary Art, documenting past and present
                                                art occurrences in public space in Tirana from the 1990’s until today.
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
                                                Arkivi Lundrues i Tiranës është një platformë dixhitale nismë e Tirana Art
                                                Lab - Qendër për Artin Bashkëkohor, e cila dokumenton ngjarjet artistike ne
                                                hapësirën publike në Tiranë prej 1990 e deri më sot. Për shkak të mungesës
                                                së strukturave dhe hapësirave artistike dhe si kritikë ndaj ndryshimeve të
                                                dhunshme në hapesirën urbane në Tiranë, shumë artistë shqiptarë e të huaj
                                                kanë përdorur hapesirën publike për të bërë vepra dhe ndërhyrje artistike që
                                                prej 1990. Institucione të pavarura sikundër Tirana Art Lab kanë prodhuar
                                                gjithashtu një pjesë të madhe të programeve të tyre në hapësirën publike.
                                                Shumica e këtyre ndërhyrjeve janë pak ose aspak të dokumentuara. Arkivi
                                                Lundrues i Tiranës synon të dokumentojë ndërhyrjet publike të së shkuarës e
                                                së tashmes të skenës së pavarur artistike, të cilat dallojnë për cilësi
                                                artistike e mbi të gjitha mund të japin një kontribut kuptimplotë për
                                                debatet aktuale mbi hapësirën publike.
                                                <br>
                                                <br>
                                            </p>
                                            <p class="reg px-2 fadeContent en" style="text-indent: 5em;">
                                                This launching presents the first stage of the Tirana Floating archive which
                                                is dedicated to documenting the interventions with text, photos and video
                                                material. From now on the archive will continue to grow and include other
                                                relevant past and future interventions. The second stage of the project will
                                                be dedicated to creating an App that can be used as a tool to explore the
                                                sites where the intervention happened and will offer the possibility of
                                                virtual guided tours with additional information through Tirana. The third
                                                stage of the project aims to recreate some of the interventions using
                                                virtual reality and augmented reality which will be added to the website
                                                version and the app version of the archive.
                                            </p>
                                            <p class="reg px-2 fadeContent al" style="text-indent: 5em; display: none;">
                                                Fazën e parë e Arkivit Lundrues të Tiranës, i kushtohet dokumentimit të
                                                ndërhyrjeve me tekst dhe materiale fotografike dhe video. Prej tani e tutje,
                                                arkivi do të vazhdojë të rritet dhe të përfshijë ndërhyrje të tjera të
                                                rëndësishme të së kaluarës dhe së ardhmes. Faza e dytë e projektit do t'i
                                                kushtohet krijimit të një aplikacioni që mund të përdoret si një mjet për të
                                                eksploruar vendet ku kanë ndodhur ndërhyrjet dhe do të ofrojë mundësinë e
                                                guidave virtuale me informacion shtesë nëpër Tiranë. Faza e tretë e
                                                projektit synon të rikrijojë disa nga ndërhyrjet duke përdorur realitetin
                                                virtual dhe realitetin e augumentuar, të cilat do t'i shtohen versionit të
                                                faqes së internetit dhe versionit të aplikacionit të arkivit.
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
                                                        Arkivi Lundrues i Tiranës mbështetet nga Fondi Kulturor Zviceran,
                                                        një projekt i Agjencisë Zvicerane për Zhvillim dhe Bashkëpunim
                                                        (SDC), zbatuar nga Qendra për Biznes, Teknologji dhe Lidership
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
                                                        Arkivi Lundrues i Tiranës është pjesë e projektit të bashkëpunimit
                                                        “Beyond Matter.Trashëgimia kulturore në prag të realitetit virtual”,
                                                        kushtuar qasjeve inovative dixhitale të rishfaqjes, dokumentimit dhe
                                                        shpërndarjes së ekspozitave, si dhe përpunimit artistik, kuratorial
                                                        dhe muzeologjik të gjeneruara nga përfaqësimi virtual. Beyond Matter
                                                        është i bashkë-financuar nga programi Evropa Krijuese i Bashkimit
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
                                                                        Menaxhere e përmbajtjes dhe kuratore
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
                                                                <div class="col-6 ml-auto">
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
                                                                        style="display: none;"> Artistët, redaktuar nga TFA
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
                                                                        style="display: none;"> Artistët
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
                    <div class="row grid mx-auto">
                        <button id="stateBtn2" onclick="dataPrint2()" style="z-index: 999;">M</button>
                        <div class="px-0 d-flex layer-two" style="width: 100vw;" id="grafikuMB">
                            <div id="chartdivi"></div>
                        </div>
                        <div class="row position-absolute layer-two mx-auto"
                            style="visibility: hidden; width: 99.5vw; height: 100vh" id="hartaMB">
                        </div>
                        <div class="row position-relative d-none layer-twofalf mx-auto" id="galeriaMB">
                            <div class="col-12 d-flex" id="vendiMB">
                                <div class="canvas position-absolute w-100" id="paningMB">
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


        {{-- leaflet --}}
        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                crossorigin=""></script>
        <script>
            function myFunction(x) {
                if (x.matches) {
                    am4core.ready(function() {
                        am4core.options.queue = true;
                        am4core.options.deferredDelay = 4500;
                        am4core.options.onlyShowOnViewport = true;
                        am4core.useTheme(am4themes_animated);
                        am4core.addLicense("CH303491830");

                        var chart = am4core.create("chartdivi", am4plugins_forceDirected.ForceDirectedTree);
                        var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries())

                        networkSeries.dataSource.url = "https://tiranafloatingarchive.org/api/v1/arrayChild";
                        networkSeries.dataSource.parser = new am4core.JSONParser();

                        networkSeries.dataFields.id = "name";
                        networkSeries.dataFields.linkWith = "link";
                        networkSeries.dataFields.name = "name";
                        networkSeries.dataFields.children = "children";
                        networkSeries.dataFields.color = "color";

                        networkSeries.dataFields.collapsed = "on";

                        networkSeries.colors.list = [
                            am4core.color("#000000")
                        ];

                        chart.responsive.enabled = true;

                        chart.tapToActivate = true;
                        chart.tapTimeout = 5000;

                        networkSeries.events.on("inited", function() {
                            networkSeries.animate({
                                property: "velocityDecay",
                                to: .85
                            }, 3000);
                        });


                        networkSeries.fontSize = 12;

                        //animation
                        networkSeries.sequencedInterpolation = true;
                        networkSeries.interpolationDuration = 1000;

                        networkSeries.maxRadius = am4core.percent(10);
                        networkSeries.minRadius = am4core.percent(2.6);
                        // networkSeries.manyBodyStrength = -16;

                        // spacing between each bubble
                        networkSeries.links.template.distance = 3;


                        networkSeries.links.template.strokeWidth = 1;

                        networkSeries.links.template.strength = .6;
                        networkSeries.manyBodyStrength = -25;
                        networkSeries.centerStrength = 1;

                        networkSeries.nodes.template.outerCircle.strokeOpacity = 0;
                        networkSeries.nodes.template.outerCircle.fillOpacity = 0;

                        networkSeries.nodes.template.circle.strokeOpacity = 1;
                        networkSeries.nodes.template.circle.stroke = am4core.color("#000000");
                        networkSeries.nodes.template.circle.strokeWidth = 1;

                        networkSeries.nodes.template.circle.fillOpacity = 1;
                        networkSeries.nodes.template.circle.fill = am4core.color("#FFFFFF");
                        networkSeries.nodes.template.circle.filters.push(new am4core.DropShadowFilter());

                        chart.zoomable = true;
                        chart.zoomDuration = 2000;

                        networkSeries.nodes.template.events.on("hit", function(ev) {
                            var selection = ev.target.dataItem.node;
                            selection.circle.fill = am4core.color("#4c00ff");
                            if (selection.isActive) {
                                networkSeries.nodes.each(function(node) {
                                    if (selection !== node) {
                                        node.dataItem.node.circle.fill = am4core.color("#FFFFFF")
                                    }
                                });
                            }
                        });


                        networkSeries.colors.reuse = true;

                        networkSeries.dataFields.fixed = "fixed";

                        networkSeries.nodes.template.propertyFields.x = "x";
                        networkSeries.nodes.template.propertyFields.y = "y";

                        networkSeries.dragFixedNodes = true;

                        networkSeries.nodes.template.fillOpacity = 1;

                        networkSeries.nodes.template.label.verticalCenter = "bottom";
                        networkSeries.nodes.template.label.horizontalCenter = "left";
                        networkSeries.nodes.template.label.y = -10;
                        networkSeries.nodes.template.label.x = 20;

                        networkSeries.nodes.template.label.fontSize = 28;
                        networkSeries.nodes.template.label.scale = 2;
                        networkSeries.nodes.template.label.fill = am4core.color("#000");

                        networkSeries.nodes.template.events.on("over", function(event) {
                            var node = event.target;
                            node.label.show();
                            node.label.html = '<p class="otherlabel text-left mb-0">{name}</p>';
                            // console.log(node.label.html);
                        }, this);

                        networkSeries.nodes.template.events.on("out", function(event) {
                            var node = event.target;
                            node.label.hide();
                            node.label.html = '<div class="otherlabel"></div>';
                        }, this);

                        networkSeries.dataSource.events.on("parseended", function(ev) {
                            var data = ev.target.data;
                            var justProjects = ev.target.data;
                            data.forEach(item => {
                                item.children.forEach(outerCh => {
                                    outerCh.children.forEach(innerCh => {
                                        innerCh.children.forEach(aktCh => {
                                            var aktLink = aktCh.link;
                                            var aktArray = [].concat(...
                                                aktLink);
                                        });
                                    });
                                });
                            });

                            var storedProject = [];
                            justProjects.forEach(item => {
                                item.children.forEach(outerCh => {
                                    outerCh.children.forEach(aktAut => {
                                        var autoriAkt = aktAut;
                                        storedProject.push(autoriAkt);
                                    });
                                });
                            });
                            localStorage.setItem('localNode', JSON.stringify(storedProject));
                            data.forEach(element => {
                                element["x"] = new am4core.Percent(element["x"]);
                                element["y"] = new am4core.Percent(element["y"]);
                                element.children.forEach(child => {
                                    child["x"] = new am4core.Percent(child["x"]);
                                    child["y"] = new am4core.Percent(child["y"]);
                                    child.children.forEach(secondchild => {
                                        secondchild["x"] = new am4core.Percent(
                                            secondchild[
                                                "x"]);
                                        secondchild["y"] = new am4core.Percent(
                                            secondchild[
                                                "y"]);
                                        secondchild.children.forEach(thirchild => {
                                            thirchild["x"] = new am4core
                                                .Percent(
                                                    thirchild["x"]);
                                            thirchild["y"] = new am4core
                                                .Percent(
                                                    thirchild["y"]);
                                        });
                                    });
                                });
                            });
                        });

                        const autorList = document.getElementById('listaRow');
                        const autorLi = document.getElementById('autorList');
                        const searchBar = document.getElementById('searchBar');
                        let resetList = document.getElementById('removeList');
                        let sepList = document.getElementById('hrToToggle');
                        var buttonNavigation = document.getElementById('stateBtn2');


                        // var hideButton = document.getElementById('buttonFormedia');
                        // hideButton.style.visibility = 'hidden';
                        buttonNavigation.style.visibility = 'hidden';

                        var retrievedObject = JSON.parse(localStorage.getItem('localNode'));
                        searchBar.addEventListener('keyup', (e) => {
                            const searchString = e.target.value.toLowerCase();
                            const filterProjectDT = retrievedObject.filter(projekti => {
                                return projekti.autori.toLowerCase().includes(searchString) || projekti
                                    .name
                                    .toLowerCase().includes(searchString);
                            });

                            const lengthOfString = e.target.value;
                            if (lengthOfString.length === 0) {
                                resetList.style.visibility = 'hidden';
                                sepList.style.display = 'block';
                            } else if (lengthOfString.length > 0) {
                                resetList.style.visibility = 'visible';
                                autorList.style.display = 'block';
                                sepList.style.display = 'none';
                            }

                            displayAuthors(filterProjectDT);

                            var searchItem = document.querySelector('.linkFromSearch');

                            if (filterProjectDT.length === 1) {
                                searchItem.addEventListener('click', (event) => {
                                    let elem = event.target.innerHTML;
                                    justTheNode(elem);
                                    console.log(elem);
                                    autorList.style.display = 'none';
                                    searchBar.value = '';
                                    resetList.style.visibility = 'hidden';
                                    sepList.style.display = 'block';
                                }, false);
                            } else if (filterProjectDT.length > 1) {
                                document.querySelectorAll('.linkFromSearch').forEach(item => {
                                    item.addEventListener('click', event => {
                                        let elem = event.target.innerHTML;

                                        justTheNode(elem);
                                        autorList.style.display = 'none';
                                        searchBar.value = '';
                                        resetList.style.visibility = 'hidden';
                                        sepList.style.display = 'block';
                                        return;
                                    });
                                });
                            }
                        });

                        resetList.addEventListener('click', () => {
                            let searchBar = document.getElementById('searchBar');
                            searchBar.value = '';
                            resetList.style.visibility = 'hidden';
                            autorList.style.display = 'none';
                            sepList.style.display = 'block';
                        });

                        function displayAuthors(projekti) {
                            const htmlString = projekti
                                .map((projekti) => {
                                    let length = 30;
                                    let myString = projekti.name;
                                    let projectiTrunc = myString.substring(0, length);
                                    return `<li class="linkFromSearch" name="${projekti.name}">
                        <h2 class="d-inline searchText">${projectiTrunc}</h2>
                        <span class="searchTextSpan">${projekti.autori}</span>
                    </li>`;
                                }).join('');
                            autorList.innerHTML = htmlString;
                        }

                        function justTheNode(item) {
                            var nodeSearch = networkSeries.getDataItemById(networkSeries.dataItems, item);
                            var nodeOfnodes = nodeSearch.node;

                            if (!nodeOfnodes.isActive) {
                                nodeOfnodes.isActive = true;
                                var nodeParent = nodeSearch.parent.parent;
                                nodeParent.show();
                                nodeSearch.show();

                                nodeOfnodes.circle.fill = am4core.color("#4c00ff");
                                networkSeries.nodes.each(function(node) {
                                    if (nodeOfnodes !== node) {
                                        node.dataItem.node.circle.fill = am4core.color("#FFFFFF")
                                    }
                                });

                                let historyEl = document.querySelector('.history')
                                var evento = nodeOfnodes.dataItem.uid;

                                var fRM = evento.replace('id-', '');

                                var element = '';
                                if (saved.includes(fRM) == false) {
                                    element = appendNode(nodeOfnodes);
                                } else {
                                    return;
                                }

                                var [id, name, timeOf] = element;

                                Array.prototype.inArray = function(comparer) {
                                    for (var i = 0; i < this.length; i++) {
                                        if (comparer(this[i])) return true;
                                    }
                                    return false;
                                };

                                Array.prototype.pushIfNotExist = function(element, comparer) {
                                    if (!this.inArray(comparer)) {
                                        this.push(element);
                                    }
                                };

                                saved.pushIfNotExist(id, function(e) {
                                    return e === id;
                                });


                                $('#current').slideDown(300, () => {
                                    $('#current').removeAttr('id');
                                });

                                // hideButton.style.visibility = 'visible';


                                let cordinates = nodeSearch.dataContext.cordinates;

                                document.getElementById('hartaMB').innerHTML =
                                    `<div id="mapid" style="width: 100%; height: 100%; border-top-left-radius: 15px; border-top-right-radius: 15px;"></div>`;

                                if (cordinates && cordinates !== null && cordinates !== '') {
                                    let lat = cordinates.lat;
                                    let lng = cordinates.lon;
                                    let tileLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                                        attribution: false,
                                    });

                                    let latlng = L.latLng([lat, lng]);

                                    let mymap = L.map('mapid', {
                                        zoomControl: false,
                                        layers: [tileLayer],
                                        maxZoom: 17,
                                        minZoom: 5,
                                        tileSize: 512,
                                        center: latlng,
                                        edgeBufferTiles: 5,
                                    }).setView([lat, lng], 27);

                                    let marker = L.circleMarker([lat, lng], {
                                        color: '#4c00ff',
                                        radius: 15
                                    }).addTo(mymap);
                                }

                                let media = nodeSearch.dataContext.photos;

                                if (media && media !== null && media !== '') {
                                    buttonNavigation.style.visibility = 'visible';
                                    const threePartIndex = Math.ceil(media.length / 2);
                                    const thirdPart = media.slice().splice(0, threePartIndex);
                                    const secondPart = media.slice().splice(-threePartIndex);

                                    let columnOne = document.querySelector('.three');
                                    let columnTwo = document.querySelector('.four');

                                    function getRandomInt(min, max) {
                                        min = Math.ceil(min);
                                        max = Math.floor(max);
                                        return Math.floor(Math.random() * (max - min) + min);
                                    }

                                    let firstColumn = thirdPart.map(function(element) {
                                        var ext = element.split('.').at(-1);
                                        var elcontain;
                                        if (ext == 'jpg') {
                                            elcontain =
                                                `<img class="img-fluid" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'mp4') {
                                            elcontain =
                                                `<video onclick="this.paused?this.play():this.pause();" playsinline controlsList="nofullscreen nodownload" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" class="img-fluid fadeContent"> <source src="${element}" type="video/mp4"> </video>`;
                                        } else if (ext == 'JPEG') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'JPG') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'jpeg') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'png') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'gif') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        }
                                        return element.innerHTML =
                                            `<div class="col-${getRandomInt(8, 12)} pr-${getRandomInt(1, 5)} py-${getRandomInt(1, 5)} pl-${getRandomInt(1, 5)}"> ${elcontain} </div>`;
                                    }, this);

                                    let firstWithoutComa = firstColumn.join(" ");
                                    columnOne.innerHTML = `<div class="row"> ${firstWithoutComa} </div>`;

                                    let secondColumn = secondPart.map(function(element) {
                                        var ext = element.split('.').at(-1);
                                        var elcontain;
                                        if (ext == 'jpg') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'mp4') {
                                            elcontain =
                                                `<video onclick="this.paused?this.play():this.pause();" playsinline controlsList="nofullscreen nodownload" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" class="img-fluid fadeContent"> <source src="${element}" type="video/mp4"> </video>`;
                                        } else if (ext == 'JPG') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'JPEG') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'jpeg') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'png') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'gif') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        }
                                        return element.innerHTML =
                                            `<div class="col-${getRandomInt(8, 12)} pr-${getRandomInt(1, 5)} py-${getRandomInt(1, 5)} pl-${getRandomInt(1, 5)}"> ${elcontain} </div>`;
                                    }, this);
                                    let secondWithoutComa = secondColumn.join(" ");

                                    columnTwo.innerHTML = `<div class="row"> ${secondWithoutComa} </div> `;
                                } else {
                                    buttonNavigation.style.visibility = 'hidden';
                                }
                                var element = document.querySelector('#paningMB');
                                panzoom(element, {
                                    pinchSpeed: 2,
                                    initialZoom: 5,
                                    bounds: false,
                                    zoomSpeed: 0.065,
                                    boundsPadding: 0.1,
                                });
                            }
                        }

                        function appendNode(event) {
                            let Noob = '';

                            let retreetObject = event.dataItem.dataContext;

                            let infoEl = [...document.getElementsByClassName('info')][0];

                            let newArticle = document.createElement('div');

                            let date = new Date();
                            date = date.toString();
                            let timeOf = date.split(' ')[4];
                            let uid = event.dataItem.uid;
                            let formated = uid.replace('id-', '');
                            let id = formated;

                            let name = retreetObject.name;

                            let featured = retreetObject.featured;

                            let contenten = retreetObject.content_en;
                            let contental = retreetObject.content_al;
                            let autorDt = retreetObject.autori;
                            let vendi = retreetObject.zhvillohet;
                            let lloji = retreetObject.mediumi;
                            let viti = retreetObject.viti;


                            let pershkDt = retreetObject.pershkrimi;

                            newArticle.setAttribute('id', `${id}`);

                            newArticle.style.overflow = 'hidden';

                            let titling = document.createElement('div');
                            titling.classList.add('heading', 'mt-sm-5', 'mt-0');
                            let justRow = document.createElement('div');
                            justRow.classList.add('row', 'justify-content-end', 'position-relative', 'px-sm-3', 'pl-3',
                                'pr-1',
                                'pb-sm-5', 'pb-4');
                            let koloN = document.createElement('div');
                            koloN.classList.add('col-sm-6', 'mb-1', 'col-8', 'pr-sm-1', 'pr-0');

                            let introImg = document.createElement('img');
                            setTimeout(function() {
                                introImg.setAttribute('class',
                                    'img-fluid introPic d-block pb-5 transition-fade fade-in');

                                introImg.setAttribute('src', featured);
                            }, 2200)


                            let heading = document.createElement('p');

                            if (featured) {
                                heading.setAttribute('class',
                                    'first gou capitalize position-absolute fadeFaster text-left pl-4 pr-0 text-break w-100'
                                );
                            } else {
                                heading.setAttribute('class',
                                    'first gou capitalize text-left pl-0 fadeFaster text-break w-100 pb-5');
                            }

                            heading.innerHTML = name;

                            if (featured) {
                                koloN.appendChild(introImg);
                            }

                            justRow.appendChild(heading);
                            justRow.appendChild(koloN);
                            titling.appendChild(justRow);

                            let divWrap = document.createElement('div');
                            divWrap.classList.add('row', 'px-4');
                            let innerWrap = document.createElement('div');
                            innerWrap.classList.add('px-0', 'col-12');

                            let article = document.createElement('article');

                            let auTor = document.createElement('div');
                            auTor.classList.add('row', 'w-75', 'pl-2', 'pb-3', 'mb-5');

                            let textAutori = document.createElement('p');
                            textAutori.classList.add('small', 'mb-1', 'w-100');
                            textAutori.setAttribute('id', 'medium');
                            textAutori.innerHTML = autorDt;

                            let textMedium = document.createElement('p');
                            textMedium.classList.add('small', 'mb-1', 'w-100');
                            textMedium.setAttribute('id', 'medium');
                            textMedium.innerHTML = lloji;

                            let textVendodhje = document.createElement('p');
                            textVendodhje.classList.add('small', 'mb-1', 'w-100');
                            textVendodhje.setAttribute('id', 'kuzhvillohet');
                            textVendodhje.innerHTML = vendi;

                            let textViti = document.createElement('p');
                            textViti.classList.add('small', 'mb-2', 'w-100');
                            textViti.setAttribute('id', 'viti');
                            textViti.innerHTML = viti;


                            let addContent = document.createElement('div');
                            addContent.classList.add('row', 'mt-2');

                            let textContent = document.createElement('div');
                            textContent.classList.add('reg', 'px-2', 'mb-5', 'row', 'pt-2');
                            textContent.setAttribute('id', 'content');

                            if (contenten || contental) {
                                textContent.innerHTML =
                                    `<div class="col-12 pb-5 fadeContent mb-5 px-0 en" lang="en">${contenten}</div>` +
                                    `<div class="col-12 pb-5 mb-5 fadeContent px-0 al" lang="al" style="display: none;">${contental}</div>`;
                            } else {
                                console.log('nodata');
                            }

                            let addSim = document.createElement('div');
                            addSim.classList.add('additional');

                            let textDesk = document.createElement('p');
                            textDesk.classList.add('small');
                            textDesk.setAttribute('id', 'sim');
                            textDesk.innerHTML = pershkDt;

                            if (autorDt) {
                                auTor.appendChild(textAutori);
                            }
                            if (lloji) {
                                auTor.appendChild(textMedium);
                            }
                            if (vendi) {
                                auTor.appendChild(textVendodhje);
                            }
                            if (viti) {
                                auTor.appendChild(textViti);
                            }

                            article.appendChild(auTor);

                            if (contenten || contental) {
                                article.appendChild(textContent);
                            }
                            if (pershkDt) {
                                article.appendChild(textDesk);
                            }

                            newArticle.appendChild(titling);
                            newArticle.appendChild(divWrap);
                            divWrap.appendChild(innerWrap);
                            innerWrap.appendChild(article);

                            infoEl.appendChild(newArticle);

                            let pos = newArticle.getBoundingClientRect().top;

                            infoEl.scrollTop += pos + 5;


                            Noob = [id, name, timeOf];

                            return (Noob);

                        }

                        networkSeries.maxLevels = 1;

                        networkSeries.nodes.template.expandAll = false;

                        networkSeries.nodes.template.events.on("hit", function(ev) {
                            var targetNode = ev.target;
                            if (targetNode.isActive) {
                                networkSeries.nodes.each(function(node) {
                                    if (targetNode !== node && node.isActive && targetNode.dataItem
                                        .level == node.dataItem.level) {
                                        node.isActive = false;
                                    }
                                });
                            }
                        });

                        networkSeries.nodes.template.events.on("out", function(event) {
                            event.target.dataItem.childLinks.each(function(link) {
                                link.isHover = false;
                            });
                            if (event.target.dataItem.parentLink) {
                                event.target.dataItem.parentLink.isHover = false;
                            }
                        });


                        function dataOfmaps(ev) {
                            let nodeGrah = ev.target.dataItem;
                            let cordinates = nodeGrah.dataContext.cordinates;
                            document.getElementById('hartaMB').innerHTML =
                                `<div id="mapid" style="width: 100%; height: 100%; border-top-left-radius: 15px; border-top-right-radius: 15px;"></div>`;

                            if (cordinates && cordinates !== null && cordinates !== '') {
                                let lat = cordinates.lat;
                                let lng = cordinates.lon;
                                let tileLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                                    attribution: false,
                                });
                                let mymap = L.map('mapid', {
                                    zoomControl: false,
                                    layers: [tileLayer],
                                    maxZoom: 17,
                                    minZoom: 5,
                                    tileSize: 512,
                                    edgeBufferTiles: 5,
                                }).setView([lat, lng], 20);

                                let marker = L.circleMarker([lat, lng], {
                                    color: '#4c00ff',
                                    radius: 15
                                }).addTo(mymap);
                            }
                        }

                        networkSeries.nodes.template.events.on("hit", dataOfmaps, this);


                        var saved = [];

                        function saveState(ev) {
                            var evento = ev.target.dataItem.uid;
                            var links = ev.target.dataItem.linkWith;

                            var fRM = evento.replace('id-', '');

                            var element = '';
                            if (saved.includes(fRM) == false) {
                                element = appendArticle(ev);
                            } else {
                                return;
                            }

                            var [id, name, timeOf, nodeGrah] = element;

                            Array.prototype.inArray = function(comparer) {
                                for (var i = 0; i < this.length; i++) {
                                    if (comparer(this[i])) return true;
                                }
                                return false;
                            };

                            Array.prototype.pushIfNotExist = function(element, comparer) {
                                if (!this.inArray(comparer)) {
                                    this.push(element);
                                }
                            };

                            saved.pushIfNotExist(id, function(e) {
                                return e === id;
                            });
                        }

                        var numberOf = 0;

                        function appendArticle(event) {
                            let Noob = '';
                            numberOf++;

                            let retreetObject = event.target.dataItem.dataContext;

                            let infoEl = [...document.getElementsByClassName('info')][0];

                            let newArticle = document.createElement('div');

                            let nodeGrah = event.target;
                            let date = new Date();
                            date = date.toString();
                            let timeOf = date.split(' ')[4];
                            let uid = event.target.dataItem.uid;
                            let formated = uid.replace('id-', '');
                            let id = formated;

                            let name = retreetObject.name;

                            let featured = retreetObject.featured;

                            let contenten = retreetObject.content_en;
                            let contental = retreetObject.content_al;

                            let autorDt = retreetObject.autori;
                            let vendi = retreetObject.zhvillohet;
                            let lloji = retreetObject.mediumi;
                            let viti = retreetObject.viti;


                            let pershkDt = retreetObject.pershkrimi;

                            newArticle.setAttribute('id', `${id}`);
                            newArticle.setAttribute('value', `some-${id}`);
                            newArticle.style.overflow = 'hidden';


                            let titling = document.createElement('div');
                            titling.classList.add('heading', 'mt-sm-5', 'mt-0');
                            let justRow = document.createElement('div');
                            justRow.classList.add('row', 'justify-content-end', 'position-relative', 'px-sm-3', 'pl-3',
                                'pr-1',
                                'pb-sm-5', 'pb-4');
                            let koloN = document.createElement('div');
                            koloN.classList.add('col-sm-6', 'mb-1', 'col-8', 'pr-sm-1', 'pr-0');

                            let introImg = document.createElement('img');

                            setTimeout(function() {
                                introImg.setAttribute('class',
                                    'img-fluid introPic d-block pb-5 transition-fade fade-in');

                                introImg.setAttribute('src', featured);
                            }, 2200);



                            let heading = document.createElement('p');

                            if (featured) {
                                heading.setAttribute('class',
                                    'first gou capitalize position-absolute fadeFaster text-left pl-4 pr-0 text-break w-100'
                                );
                            } else {
                                heading.setAttribute('class',
                                    'first gou capitalize text-left pl-0 fadeFaster text-break w-100 pb-5');
                            }

                            heading.innerHTML = name;

                            if (featured) {
                                koloN.appendChild(introImg);
                            }

                            justRow.appendChild(heading);
                            justRow.appendChild(koloN);
                            titling.appendChild(justRow);

                            let divWrap = document.createElement('div');

                            divWrap.classList.add('row', 'px-4');
                            let innerWrap = document.createElement('div');
                            innerWrap.classList.add('px-0', 'col-12');

                            let article = document.createElement('article');

                            let auTor = document.createElement('div');
                            auTor.classList.add('row', 'w-75', 'pl-2', 'pb-3', 'mb-5');

                            let textAutori = document.createElement('p');
                            textAutori.classList.add('small', 'mb-1', 'w-100');
                            textAutori.setAttribute('id', 'medium');
                            textAutori.innerHTML = autorDt;

                            let textMedium = document.createElement('p');
                            textMedium.classList.add('small', 'mb-1', 'w-100');
                            textMedium.setAttribute('id', 'medium');
                            textMedium.innerHTML = lloji;

                            let textVendodhje = document.createElement('p');
                            textVendodhje.classList.add('small', 'mb-1', 'w-100');
                            textVendodhje.setAttribute('id', 'kuzhvillohet');
                            textVendodhje.innerHTML = vendi;

                            let textViti = document.createElement('p');
                            textViti.classList.add('small', 'mb-3', 'w-100');
                            textViti.setAttribute('id', 'viti');
                            textViti.innerHTML = viti;

                            let addContent = document.createElement('div');
                            addContent.classList.add('row', 'mt-2');

                            let textContent = document.createElement('div');
                            textContent.classList.add('reg', 'px-2', 'mb-5', 'row', 'pt-2');

                            textContent.setAttribute('id', 'content');

                            if (contenten || contental) {
                                textContent.innerHTML =
                                    `<div class="col-12 px-0 fadeContent pb-5 mb-5 en" lang="en">${contenten}</div>` +
                                    `<div class="col-12 pb-5 mb-5 px-0 fadeContent al" lang="al" style="display: none;">${contental}</div>`;
                            } else {
                                console.log('nodata');
                            }

                            let addSim = document.createElement('div');
                            addSim.classList.add('additional');

                            let textDesk = document.createElement('p');
                            textDesk.classList.add('small');
                            textDesk.setAttribute('id', 'sim');
                            textDesk.innerHTML = pershkDt;

                            if (autorDt) {
                                auTor.appendChild(textAutori);
                            }
                            if (lloji) {
                                auTor.appendChild(textMedium);
                            }
                            if (vendi) {
                                auTor.appendChild(textVendodhje);
                            }
                            if (viti) {
                                auTor.appendChild(textViti);
                            }
                            article.appendChild(auTor);


                            if (contenten || contental) {
                                article.appendChild(textContent);
                            }

                            if (pershkDt) {
                                article.appendChild(textDesk);
                            }

                            newArticle.appendChild(titling);
                            newArticle.appendChild(divWrap);
                            divWrap.appendChild(innerWrap);
                            innerWrap.appendChild(article);

                            infoEl.appendChild(newArticle);

                            let pos = newArticle.getBoundingClientRect().top;

                            infoEl.scrollTop += pos - 50;

                            Noob = [id, name, timeOf, nodeGrah];

                            return (Noob);
                        }

                        function waitForElementToDisplay(selector, callback, checkFrequencyInMs, timeoutInMs) {
                            var startTimeInMs = Date.now();
                            (function loopSearch() {
                                if (document.querySelector(selector) != null) {
                                    callback();
                                    return;
                                } else {
                                    setTimeout(function() {
                                        if (timeoutInMs && Date.now() - startTimeInMs > timeoutInMs)
                                            return;
                                        loopSearch();
                                    }, checkFrequencyInMs);
                                }
                            })();
                        }

                        networkSeries.nodes.template.events.on("hit", saveState, this);

                        networkSeries.nodes.template.events.on("hit", function(event) {
                            var node = event.target;
                            var media = node.dataItem.dataContext.photos;

                            if (media && media !== null && media !== '') {
                                buttonNavigation.style.visibility = 'visible';
                                console.log(media);

                                const threePartIndex = Math.ceil(media.length / 2);
                                const thirdPart = media.slice().splice(0, threePartIndex);
                                const secondPart = media.slice().splice(-threePartIndex);

                                let columnOne = document.querySelector('.three');
                                let columnTwo = document.querySelector('.four');

                                function getRandomInt(min, max) {
                                    min = Math.ceil(min);
                                    max = Math.floor(max);
                                    return Math.floor(Math.random() * (max - min) + min);
                                }

                                let firstColumn = thirdPart.map(function(element) {
                                    var ext = element.split('.').at(-1);
                                    var elcontain;
                                    if (ext == 'jpg') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'mp4') {
                                        elcontain =
                                            `<video ontouchstart="this.paused?this.play():this.pause();" playsinline controlsList="nofullscreen nodownload" class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> <source src="${element}" type="video/mp4"> </video>`;
                                    } else if (ext == 'jpeg') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'JPG') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'JPEG') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'png') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'gif') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    }
                                    return element.innerHTML =
                                        `<div class="col-${getRandomInt(4, 8)} pr-${getRandomInt(1, 5)} py-${getRandomInt(1, 5)} pl-${getRandomInt(1, 5)}"> ${elcontain} </div>`;
                                }, this);

                                let firstWithoutComa = firstColumn.join(" ");
                                columnOne.innerHTML = `<div class="row"> ${firstWithoutComa} </div>`;

                                let secondColumn = secondPart.map(function(element) {
                                    var ext = element.split('.').at(-1);
                                    var elcontain;
                                    if (ext == 'jpg') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'mp4') {
                                        elcontain =
                                            `<video ontouchstart="this.paused?this.play():this.pause();" playsinline controlsList="nofullscreen nodownload" class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> <source src="${element}" type="video/mp4"> </video>`;
                                    } else if (ext == 'JPEG') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'JPG') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'jpeg') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'png') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'gif') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    }
                                    return element.innerHTML =
                                        `<div class="col-${getRandomInt(4, 8)} pr-${getRandomInt(1, 5)} py-${getRandomInt(1, 5)} pl-${getRandomInt(1, 5)}"> ${elcontain} </div>`;
                                }, this);
                                let secondWithoutComa = secondColumn.join(" ");
                                columnTwo.innerHTML = `<div class="row"> ${secondWithoutComa} </div> `;
                            } else {
                                buttonNavigation.style.visibility = 'hidden';
                            }

                            var element = document.querySelector('#paningMB');
                            panzoom(element, {
                                pinchSpeed: 2,
                                initialZoom: 5,
                                bounds: false,
                                zoomSpeed: 0.065,
                                boundsPadding: 0.1,
                            });

                        }, this);
                        am4core.options.autoDispose = true;
                    });
                } else {
                    am4core.ready(function() {
                        am4core.options.queue = true;
                        am4core.options.deferredDelay = 1500;

                        am4core.options.onlyShowOnViewport = true;
                        am4core.useTheme(am4themes_animated);
                        am4core.addLicense("CH303491830");

                        var chart = am4core.create("chartdiv", am4plugins_forceDirected.ForceDirectedTree);
                        var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries())

                        networkSeries.dataSource.url = "https://tiranafloatingarchive.org/api/v1/arrayChild";

                        networkSeries.dataSource.parser = new am4core.JSONParser();

                        networkSeries.dataFields.id = "name";
                        networkSeries.dataFields.linkWith = "link";
                        networkSeries.dataFields.name = "name";
                        networkSeries.dataFields.children = "children";
                        networkSeries.dataFields.color = "color";

                        networkSeries.dataFields.collapsed = "on";

                        networkSeries.colors.list = [
                            am4core.color("#000000")
                        ];

                        networkSeries.fontSize = 12;

                        //animation
                        networkSeries.sequencedInterpolation = true;
                        networkSeries.interpolationDuration = 5000;


                        // networkSeries.maxRadius = am4core.percent(6);
                        networkSeries.minRadius = am4core.percent(1.7);



                        // spacing between each bubble
                        networkSeries.links.template.distance = 2;

                        // width property
                        networkSeries.links.template.strokeWidth = 1;

                        networkSeries.links.template.strength = 0;

                        networkSeries.manyBodyStrength = -60;


                        // chart.seriesContainer.events.on("hit", function(ev) {
                        //     console.log(ev.target.baseSprite);
                        // });

                        networkSeries.nodes.template.outerCircle.strokeOpacity = 0;
                        networkSeries.nodes.template.outerCircle.fillOpacity = 0;

                        networkSeries.nodes.template.circle.strokeOpacity = 1;
                        networkSeries.nodes.template.circle.stroke = am4core.color("#000000");
                        networkSeries.nodes.template.circle.strokeWidth = 1;

                        networkSeries.nodes.template.circle.fillOpacity = 1;
                        networkSeries.nodes.template.circle.fill = am4core.color("#FFFFFF");
                        networkSeries.nodes.template.circle.filters.push(new am4core.DropShadowFilter());

                        chart.zoomable = true;
                        chart.zoomDuration = 2000;

                        networkSeries.nodes.template.events.on("hit", function(ev) {
                            var selection = ev.target.dataItem.node;
                            selection.circle.fill = am4core.color("#4c00ff");
                            if (selection.isActive) {
                                networkSeries.nodes.each(function(node) {
                                    if (selection !== node) {
                                        node.dataItem.node.circle.fill = am4core.color("#FFFFFF")
                                    }
                                });
                            }
                        });

                        networkSeries.colors.reuse = true;

                        networkSeries.dataFields.fixed = "fixed";

                        networkSeries.nodes.template.propertyFields.x = "x";
                        networkSeries.nodes.template.propertyFields.y = "y";

                        networkSeries.dragFixedNodes = true;

                        networkSeries.nodes.template.fillOpacity = 1;

                        networkSeries.nodes.template.label.verticalCenter = "bottom";
                        networkSeries.nodes.template.label.horizontalCenter = "left";
                        networkSeries.nodes.template.label.y = -10;
                        networkSeries.nodes.template.label.x = 20;


                        networkSeries.nodes.template.label.fontSize = 28;
                        networkSeries.nodes.template.label.scale = 2;
                        networkSeries.nodes.template.label.fill = am4core.color("#000");


                        networkSeries.nodes.template.events.on("over", function(event) {
                            var node = event.target;
                            node.label.show();
                            node.label.html = '<p class="otherlabel text-left mb-0">{name}</p>';
                            // console.log(node.label.html);
                        }, this);

                        networkSeries.nodes.template.events.on("out", function(event) {
                            var node = event.target;
                            node.label.hide();
                            node.label.html = '<div class="otherlabel"></div>';
                        }, this);



                        networkSeries.dataSource.events.on("parseended", function(ev) {
                            var data = ev.target.data;

                            var justProjects = ev.target.data;

                            data.forEach(item => {
                                item.children.forEach(outerCh => {
                                    outerCh.children.forEach(innerCh => {
                                        innerCh.children.forEach(aktCh => {
                                            var aktLink = aktCh.link;
                                            var aktArray = [].concat(...
                                                aktLink);
                                        });
                                    });
                                });
                            }, this);

                            var storedProject = [];
                            justProjects.forEach(item => {
                                item.children.forEach(outerCh => {
                                    outerCh.children.forEach(aktAut => {
                                        var autoriAkt = aktAut;
                                        storedProject.push(autoriAkt);
                                    });
                                });
                            });
                            localStorage.setItem('localNode', JSON.stringify(storedProject));

                            data.forEach(element => {
                                element["x"] = new am4core.Percent(element["x"]);
                                element["y"] = new am4core.Percent(element["y"]);
                                element.children.forEach(child => {
                                    child["x"] = new am4core.Percent(child["x"]);
                                    child["y"] = new am4core.Percent(child["y"]);

                                    child.children.forEach(secondchild => {
                                        secondchild["x"] = new am4core.Percent(
                                            secondchild[
                                                "x"]);
                                        secondchild["y"] = new am4core.Percent(
                                            secondchild[
                                                "y"]);
                                        secondchild.children.forEach(thirchild => {
                                            thirchild["x"] = new am4core
                                                .Percent(
                                                    thirchild["x"]);
                                            thirchild["y"] = new am4core
                                                .Percent(
                                                    thirchild["y"]);
                                        });
                                    });
                                });
                            });
                        });

                        const autorList = document.getElementById('listaRow');
                        const autorLi = document.getElementById('autorList');
                        const searchBar = document.getElementById('searchBar');
                        let resetList = document.getElementById('removeList');
                        let sepList = document.getElementById('hrToToggle');


                        var hideButton = document.getElementById('buttonFormedia');
                        hideButton.style.visibility = 'hidden';



                        var retrievedObject = JSON.parse(localStorage.getItem('localNode'));
                        searchBar.addEventListener('keyup', (e) => {
                            const searchString = e.target.value.toLowerCase();
                            const filterProjectDT = retrievedObject.filter(projekti => {
                                return projekti.autori.toLowerCase().includes(searchString) || projekti
                                    .name
                                    .toLowerCase().includes(searchString);
                            });

                            const lengthOfString = e.target.value;
                            if (lengthOfString.length === 0) {
                                resetList.style.visibility = 'hidden';
                                sepList.style.display = 'block';
                            } else if (lengthOfString.length > 0) {
                                resetList.style.visibility = 'visible';
                                autorList.style.display = 'block';
                                sepList.style.display = 'none';
                            }

                            displayAuthors(filterProjectDT);

                            var searchItem = document.querySelector('.linkFromSearch');

                            if (filterProjectDT.length === 1) {
                                searchItem.addEventListener('click', (event) => {
                                    let elem = event.target.innerHTML;
                                    justTheNode(elem);
                                    autorList.style.display = 'none';
                                    searchBar.value = '';
                                    resetList.style.visibility = 'hidden';
                                    sepList.style.display = 'block';
                                }, false);
                            } else if (filterProjectDT.length > 1) {
                                document.querySelectorAll('.linkFromSearch').forEach(item => {
                                    item.addEventListener('click', event => {
                                        let elem = event.target.innerHTML;

                                        justTheNode(elem);
                                        autorList.style.display = 'none';
                                        searchBar.value = '';
                                        resetList.style.visibility = 'hidden';
                                        sepList.style.display = 'block';
                                        return;
                                    });
                                });
                            }
                        });



                        resetList.addEventListener('click', () => {
                            let searchBar = document.getElementById('searchBar');
                            searchBar.value = '';
                            resetList.style.visibility = 'hidden';
                            autorList.style.display = 'none';
                            sepList.style.display = 'block';
                        });

                        function displayAuthors(projekti) {
                            const htmlString = projekti
                                .map((projekti) => {
                                    let length = 30;
                                    let myString = projekti.name;
                                    let projectiTrunc = myString.substring(0, length);
                                    return `<li class="linkFromSearch" name="${projekti.name}">
                <h2 class="d-inline searchText">${projectiTrunc}</h2>
                <span class="searchTextSpan">${projekti.autori}</span>
            </li>`;
                                }).join('');
                            autorList.innerHTML = htmlString;
                        }

                        function justTheNode(item) {
                            var nodeSearch = networkSeries.getDataItemById(networkSeries.dataItems, item);
                            var nodeOfnodes = nodeSearch.node;

                            if (!nodeOfnodes.isActive) {
                                nodeOfnodes.isActive = true;
                                var nodeParent = nodeSearch.parent.parent;
                                nodeParent.show();
                                nodeSearch.show();

                                nodeOfnodes.circle.fill = am4core.color("#4c00ff");
                                networkSeries.nodes.each(function(node) {
                                    if (nodeOfnodes !== node) {
                                        node.dataItem.node.circle.fill = am4core.color("#FFFFFF")
                                    }
                                });

                                let historyEl = document.querySelector('.history')
                                var evento = nodeOfnodes.dataItem.uid;

                                var fRM = evento.replace('id-', '');

                                var element = '';
                                if (saved.includes(fRM) == false) {
                                    element = appendNode(nodeOfnodes);
                                } else {
                                    return;
                                }

                                var [id, name, timeOf] = element;

                                var newState = createElement(id, name, timeOf);

                                Array.prototype.inArray = function(comparer) {
                                    for (var i = 0; i < this.length; i++) {
                                        if (comparer(this[i])) return true;
                                    }
                                    return false;
                                };

                                Array.prototype.pushIfNotExist = function(element, comparer) {
                                    if (!this.inArray(comparer)) {
                                        this.push(element);
                                        historyEl.prepend(newState);
                                    }
                                };

                                saved.pushIfNotExist(id, function(e) {
                                    return e === id;
                                });

                                newState.setAttribute('id', 'current');
                                $('#current').slideDown(300, () => {
                                    $('#current').removeAttr('id');
                                });


                                let cordinates = nodeSearch.dataContext.cordinates;

                                document.getElementById('harta').innerHTML =
                                    `<div id="mapid" style="width: 100%; height: 100%;"></div>`;
                                if (cordinates && cordinates !== null && cordinates !== '') {
                                    let lat = cordinates.lat;
                                    let lng = cordinates.lon;
                                    let tileLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                                        attribution: false,
                                    });
                                    let mymap = L.map('mapid', {
                                        zoomControl: false,
                                        layers: [tileLayer],
                                        maxZoom: 17,
                                        minZoom: 5,
                                        tileSize: 512,
                                        edgeBufferTiles: 5,
                                    }).setView([lat, lng], 20);
                                    let marker = L.circleMarker([lat, lng], {
                                        color: '#4c00ff',
                                        radius: 15
                                    }).addTo(mymap);
                                }

                                let media = nodeSearch.dataContext.photos;
                                // if (condition) {

                                // }

                                if (media && media !== null && media !== '') {
                                    hideButton.style.visibility = 'visible';
                                    const threePartIndex = Math.ceil(media.length / 2);
                                    const thirdPart = media.slice().splice(0, threePartIndex);
                                    const secondPart = media.slice().splice(-threePartIndex);


                                    let columnOne = document.querySelector('.one');
                                    let columnTwo = document.querySelector('.two');


                                    function getRandomInt(min, max) {
                                        min = Math.ceil(min);
                                        max = Math.floor(max);
                                        return Math.floor(Math.random() * (max - min) + min);
                                    }

                                    let firstColumn = thirdPart.map(function(element) {
                                        var ext = element.split('.').at(-1);
                                        var elcontain;
                                        if (ext == 'jpg') {
                                            elcontain =
                                                `<img class="img-fluid" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'mp4') {
                                            elcontain =
                                                `<video onmouseover="this.play()" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" onmouseout="this.pause();" oncontextmenu="return false;" class="img-fluid fadeContent"> <source src="${element}" type="video/mp4"> </video>`;
                                        } else if (ext == 'JPEG') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'JPG') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'jpeg') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'png') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'gif') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        }
                                        return element.innerHTML =
                                            `<div class="col-${getRandomInt(8, 12)} pr-${getRandomInt(1, 5)} py-${getRandomInt(1, 5)} pl-${getRandomInt(1, 5)}"> ${elcontain} </div>`;
                                    }, this);

                                    let firstWithoutComa = firstColumn.join(" ");
                                    columnOne.innerHTML = `<div class="row"> ${firstWithoutComa} </div>`;

                                    let secondColumn = secondPart.map(function(element) {
                                        var ext = element.split('.').at(-1);
                                        var elcontain;
                                        if (ext == 'jpg') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'mp4') {
                                            elcontain =
                                                `<video onmouseover="this.play()" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" oncontextmenu="return false;" onmouseout="this.pause();" class="img-fluid fadeContent"> <source src="${element}" type="video/mp4"> </video>`;
                                        } else if (ext == 'JPG') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'JPEG') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'jpeg') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'png') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'gif') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        }
                                        return element.innerHTML =
                                            `<div class="col-${getRandomInt(8, 12)} pr-${getRandomInt(1, 5)} py-${getRandomInt(1, 5)} pl-${getRandomInt(1, 5)}"> ${elcontain} </div>`;
                                    }, this);
                                    let secondWithoutComa = secondColumn.join(" ");
                                    columnTwo.innerHTML = `<div class="row"> ${secondWithoutComa} </div> `;

                                } else {
                                    hideButton.style.visibility = 'hidden';
                                }

                                var element = document.querySelector('#paning');
                                panzoom(element, {
                                    pinchSpeed: 2,
                                    initialZoom: 1,
                                    bounds: false,
                                    zoomSpeed: 0.065,
                                    boundsPadding: 0.1,
                                });
                            }
                        }

                        function appendNode(event) {
                            let Noob = '';

                            let retreetObject = event.dataItem.dataContext;
                            let infoEl = [...document.getElementsByClassName('info')][0];
                            let newArticle = document.createElement('div');

                            // data from here
                            let date = new Date();
                            date = date.toString();
                            let timeOf = date.split(' ')[4];
                            let uid = event.dataItem.uid;
                            let formated = uid.replace('id-', '');
                            let id = formated;

                            let name = retreetObject.name;

                            let featured = retreetObject.featured;

                            let contenten = retreetObject.content_en;
                            let contental = retreetObject.content_al;
                            let autorDt = retreetObject.autori;
                            let vendi = retreetObject.zhvillohet;
                            let lloji = retreetObject.mediumi;
                            let viti = retreetObject.viti;

                            let pershkDt = retreetObject.pershkrimi;

                            newArticle.setAttribute('id', `${id}`);

                            newArticle.style.overflow = 'hidden';

                            let titling = document.createElement('div');
                            titling.classList.add('heading', 'mt-5');
                            let justRow = document.createElement('div');
                            justRow.classList.add('row', 'justify-content-end', 'position-relative', 'px-sm-3', 'pl-3',
                                'pr-1', 'pb-sm-5', 'pb-4');
                            let koloN = document.createElement('div');
                            koloN.classList.add('col-sm-6', 'mb-1', 'col-8', 'pr-sm-1', 'pr-0');

                            let introImg = document.createElement('img');
                            setTimeout(function() {
                                introImg.setAttribute('class',
                                    'img-fluid introPic d-block pb-5 transition-fade fade-in');

                                introImg.setAttribute('src', featured);
                            }, 2200)


                            let heading = document.createElement('p');

                            if (featured) {
                                heading.setAttribute('class',
                                    'first gou capitalize position-absolute fadeFaster text-left pl-4 pr-0 text-break w-100'
                                );
                            } else {
                                heading.setAttribute('class',
                                    'first gou capitalize text-left pl-0 fadeFaster text-break w-100 pb-5');
                            }

                            heading.innerHTML = name;

                            if (featured) {
                                koloN.appendChild(introImg);
                            }


                            justRow.appendChild(heading);
                            justRow.appendChild(koloN);
                            titling.appendChild(justRow);

                            let divWrap = document.createElement('div');
                            divWrap.classList.add('row', 'px-4');
                            let innerWrap = document.createElement('div');
                            innerWrap.classList.add('px-0', 'col-12');

                            let article = document.createElement('article');

                            let auTor = document.createElement('div');
                            auTor.classList.add('row', 'w-75', 'pl-2', 'pb-3', 'mb-5');

                            let textAutori = document.createElement('p');
                            textAutori.classList.add('small', 'mb-1', 'w-100');
                            textAutori.setAttribute('id', 'medium');
                            textAutori.innerHTML = autorDt;

                            let textMedium = document.createElement('p');
                            textMedium.classList.add('small', 'mb-1', 'w-100');
                            textMedium.setAttribute('id', 'medium');
                            textMedium.innerHTML = lloji;

                            let textVendodhje = document.createElement('p');
                            textVendodhje.classList.add('small', 'mb-1', 'w-100');
                            textVendodhje.setAttribute('id', 'kuzhvillohet');
                            textVendodhje.innerHTML = vendi;

                            let textViti = document.createElement('p');
                            textViti.classList.add('small', 'mb-2', 'w-100');
                            textViti.setAttribute('id', 'viti');
                            textViti.innerHTML = viti;

                            let addContent = document.createElement('div');
                            addContent.classList.add('row', 'mt-2');

                            let textContent = document.createElement('div');
                            textContent.classList.add('reg', 'px-2', 'mb-5', 'row', 'pt-2');
                            textContent.setAttribute('id', 'content');

                            if (contenten || contental) {
                                textContent.innerHTML =
                                    `<div class="col-12 pb-5 fadeContent mb-5 px-0 en" lang="en">${contenten}</div>` +
                                    `<div class="col-12 pb-5 mb-5 fadeContent px-0 al" lang="al" style="display: none;">${contental}</div>`;

                            } else {
                                console.log('nodata');
                            }


                            let addSim = document.createElement('div');
                            addSim.classList.add('additional');

                            let textDesk = document.createElement('p');
                            textDesk.classList.add('small');
                            textDesk.setAttribute('id', 'sim');
                            textDesk.innerHTML = pershkDt;

                            if (autorDt) {
                                auTor.appendChild(textAutori);
                            }
                            if (lloji) {
                                auTor.appendChild(textMedium);
                            }
                            if (vendi) {
                                auTor.appendChild(textVendodhje);
                            }
                            if (viti) {
                                auTor.appendChild(textViti);
                            }

                            article.appendChild(auTor);

                            if (contenten || contental) {
                                article.appendChild(textContent);
                            }
                            if (pershkDt) {
                                article.appendChild(textDesk);
                            }

                            newArticle.appendChild(titling);
                            newArticle.appendChild(divWrap);
                            divWrap.appendChild(innerWrap);
                            innerWrap.appendChild(article);

                            infoEl.appendChild(newArticle);
                            let pos = newArticle.getBoundingClientRect().top;

                            infoEl.scrollTop += pos - 30;

                            Noob = [id, name, timeOf];
                            return (Noob);
                        }


                        networkSeries.maxLevels = 1;

                        networkSeries.nodes.template.expandAll = false;

                        networkSeries.nodes.template.events.on("hit", function(ev) {
                            var targetNode = ev.target;
                            if (targetNode.isActive) {
                                networkSeries.nodes.each(function(node) {
                                    if (targetNode !== node && node.isActive && targetNode.dataItem
                                        .level == node.dataItem.level) {
                                        if (node.dataItem.level == 1) {
                                            node.isActive = false;
                                        }
                                    }
                                });
                            }
                        });


                        networkSeries.nodes.template.events.on("out", function(event) {
                            event.target.dataItem.childLinks.each(function(link) {
                                link.isHover = false;
                            });
                            if (event.target.dataItem.parentLink) {
                                event.target.dataItem.parentLink.isHover = false;
                            }
                        });


                        function dataOfmaps(ev) {
                            let nodeGrah = ev.target.dataItem;
                            let cordinates = nodeGrah.dataContext.cordinates;
                            document.getElementById('harta').innerHTML =
                                `<div id="mapid" style="width: 100%; height: 100%;"></div>`;

                            if (cordinates && cordinates !== null && cordinates !== '') {
                                let lat = cordinates.lat;
                                let lng = cordinates.lon;
                                let tileLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                                    attribution: false,
                                });
                                let mymap = L.map('mapid', {
                                    zoomControl: false,
                                    layers: [tileLayer],
                                    maxZoom: 17,
                                    minZoom: 5,
                                    tileSize: 512,
                                    edgeBufferTiles: 5,
                                }).setView([lat, lng], 20);

                                let marker = L.circleMarker([lat, lng], {
                                    color: '#4c00ff',
                                    radius: 15
                                }).addTo(mymap);
                            }
                        }

                        networkSeries.nodes.template.events.on("hit", dataOfmaps, this);


                        var saved = [];

                        function saveState(ev) {
                            let historyEl = document.querySelector('.history')
                            var evento = ev.target.dataItem.uid;

                            var links = ev.target.dataItem.linkWith;


                            var fRM = evento.replace('id-', '');


                            var element = '';
                            if (saved.includes(fRM) == false) {
                                element = appendArticle(ev);
                            } else {
                                return;
                            }

                            var [id, name, timeOf, nodeGrah] = element;

                            var newState = createElement(id, name, timeOf, nodeGrah);

                            Array.prototype.inArray = function(comparer) {
                                for (var i = 0; i < this.length; i++) {
                                    if (comparer(this[i])) return true;
                                }
                                return false;
                            };

                            Array.prototype.pushIfNotExist = function(element, comparer) {
                                if (!this.inArray(comparer)) {
                                    this.push(element);
                                    historyEl.prepend(newState);
                                }
                            };

                            saved.pushIfNotExist(id, function(e) {
                                return e === id;
                            });

                            newState.setAttribute('id', 'current');

                            $('#current').slideDown(300, () => {
                                $('#current').removeAttr('id');
                            });

                        }

                        var numberOf = 0;

                        function appendArticle(event) {
                            let Noob = '';
                            numberOf++;

                            let retreetObject = event.target.dataItem.dataContext;

                            let infoEl = [...document.getElementsByClassName('info')][0];

                            let newArticle = document.createElement('div');

                            let nodeGrah = event.target;
                            let date = new Date();
                            date = date.toString();
                            let timeOf = date.split(' ')[4];
                            let uid = event.target.dataItem.uid;
                            let formated = uid.replace('id-', '');
                            let id = formated;

                            let name = retreetObject.name;

                            let featured = retreetObject.featured;

                            let contenten = retreetObject.content_en;
                            let contental = retreetObject.content_al;

                            let autorDt = retreetObject.autori;
                            let vendi = retreetObject.zhvillohet;
                            let lloji = retreetObject.mediumi;
                            let viti = retreetObject.viti;


                            let pershkDt = retreetObject.pershkrimi;

                            newArticle.setAttribute('id', `${id}`);
                            newArticle.setAttribute('value', `some-${id}`);
                            newArticle.style.overflow = 'hidden';


                            let titling = document.createElement('div');
                            titling.classList.add('heading', 'mt-5');
                            let justRow = document.createElement('div');
                            justRow.classList.add('row', 'justify-content-end', 'position-relative', 'px-sm-3', 'pl-3',
                                'pr-1', 'pb-sm-5', 'pb-4');
                            let koloN = document.createElement('div');
                            koloN.classList.add('col-sm-6', 'mb-1', 'col-8', 'pr-sm-1', 'pr-0');

                            let introImg = document.createElement('img');

                            setTimeout(function() {
                                introImg.setAttribute('class',
                                    'img-fluid introPic d-block pb-5 transition-fade fade-in');

                                introImg.setAttribute('src', featured);
                            }, 1200);



                            let heading = document.createElement('p');

                            if (featured) {
                                heading.setAttribute('class',
                                    'first gou capitalize position-absolute fadeFaster text-left pl-4 pr-0 text-break w-100'
                                );
                            } else {
                                heading.setAttribute('class',
                                    'first gou capitalize text-left pl-0 fadeFaster text-break w-100 pb-5');
                            }

                            heading.innerHTML = name;

                            if (featured) {
                                koloN.appendChild(introImg);
                            }

                            justRow.appendChild(heading);
                            justRow.appendChild(koloN);
                            titling.appendChild(justRow);


                            let divWrap = document.createElement('div');

                            divWrap.classList.add('row', 'px-4');
                            let innerWrap = document.createElement('div');
                            innerWrap.classList.add('px-0', 'col-12');

                            let article = document.createElement('article');

                            let auTor = document.createElement('div');
                            auTor.classList.add('row', 'w-75', 'pl-2', 'pb-3', 'mb-5');

                            let textAutori = document.createElement('p');
                            textAutori.classList.add('small', 'mb-1', 'w-100');
                            textAutori.setAttribute('id', 'medium');
                            textAutori.innerHTML = autorDt;

                            let textMedium = document.createElement('p');
                            textMedium.classList.add('small', 'mb-1', 'w-100');
                            textMedium.setAttribute('id', 'medium');
                            textMedium.innerHTML = lloji;

                            let textVendodhje = document.createElement('p');
                            textVendodhje.classList.add('small', 'mb-1', 'w-100');
                            textVendodhje.setAttribute('id', 'kuzhvillohet');
                            textVendodhje.innerHTML = vendi;

                            let textViti = document.createElement('p');
                            textViti.classList.add('small', 'mb-3', 'w-100');
                            textViti.setAttribute('id', 'viti');
                            textViti.innerHTML = viti;


                            let addContent = document.createElement('div');
                            addContent.classList.add('row', 'mt-2');

                            let textContent = document.createElement('div');
                            textContent.classList.add('reg', 'px-2', 'mb-5', 'row', 'pt-2');

                            textContent.setAttribute('id', 'content');

                            if (contenten || contental) {
                                textContent.innerHTML =
                                    `<div class="col-12 px-0 fadeContent pb-5 mb-5 en" lang="en">${contenten}</div>` +
                                    `<div class="col-12 pb-5 mb-5 px-0 fadeContent al" lang="al" style="display: none;">${contental}</div>`;

                            } else {
                                console.log('nodata');
                            }

                            let addSim = document.createElement('div');
                            addSim.classList.add('additional');

                            let textDesk = document.createElement('p');
                            textDesk.classList.add('small');
                            textDesk.setAttribute('id', 'sim');
                            textDesk.innerHTML = pershkDt;

                            if (autorDt) {
                                auTor.appendChild(textAutori);
                            }
                            if (lloji) {
                                auTor.appendChild(textMedium);
                            }
                            if (vendi) {
                                auTor.appendChild(textVendodhje);
                            }
                            if (viti) {
                                auTor.appendChild(textViti);
                            }
                            article.appendChild(auTor);


                            if (contenten || contental) {
                                article.appendChild(textContent);
                            }

                            if (pershkDt) {
                                article.appendChild(textDesk);
                            }

                            newArticle.appendChild(titling);
                            newArticle.appendChild(divWrap);
                            divWrap.appendChild(innerWrap);
                            innerWrap.appendChild(article);

                            infoEl.appendChild(newArticle);

                            let pos = newArticle.getBoundingClientRect().top;

                            infoEl.scrollTop += pos - 50;

                            Noob = [id, name, timeOf, nodeGrah];

                            return (Noob);

                        }

                        function createElement(id, name, timeOf, nodeGrah) {
                            let bubble = document.createElement('div');
                            bubble.setAttribute('class', 'state');

                            let hr = document.createElement('hr');
                            let text = document.createElement('p');

                            let positionOf = nodeGrah;

                            text.setAttribute('data-src', `Go Back to ${name}`);


                            let innerTextual =
                                `<a href="#${id}" name="${name}" id="loadMore" class="forLinking"><b class="hel">${timeOf}</b> Went to ${name}</a>`;


                            text.innerHTML = innerTextual;

                            waitForElementToDisplay("#loadMore", function() {

                                let leading = document.getElementById('loadMore');
                                leading.addEventListener('click', (event) => {
                                    event.stopPropagation();
                                    event.preventDefault();
                                    let anchorId = event.target.attributes.href.value;

                                    let forLink = anchorId.replace('#', '');

                                    document.querySelector(`#${CSS.escape(forLink)}`).scrollIntoView({
                                        behavior: 'smooth',
                                        block: 'start'
                                    });
                                    let elem = event.target.name;
                                    goBack(elem);
                                }, false);

                            }, 1000, 9000);
                            bubble.appendChild(text);
                            bubble.appendChild(hr);
                            return bubble;
                        }

                        function goBack(item) {
                            var nodeItem = networkSeries.getDataItemById(networkSeries.dataItems, item);
                            var nodeOfnodes = nodeItem.node;

                            var nodeParent = nodeItem.parent.parent;

                            if (!nodeItem.isActive) {
                                nodeParent.show();
                                nodeItem.show();
                                nodeItem.isActive = true;

                                nodeOfnodes.circle.fill = am4core.color("#4c00ff");
                                networkSeries.nodes.each(function(node) {
                                    if (nodeOfnodes !== node) {
                                        node.dataItem.node.circle.fill = am4core.color("#FFFFFF")
                                    }
                                });


                                let cordinates = nodeItem.dataContext.cordinates;
                                document.getElementById('harta').innerHTML =
                                    `<div id="mapid" style="width: 100%; height: 100%;"></div>`;
                                if (cordinates && cordinates !== null && cordinates !== '') {
                                    let lat = cordinates.lat;
                                    let lng = cordinates.lon;
                                    let tileLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                                        attribution: false,
                                    });
                                    let mymap = L.map('mapid', {
                                        zoomControl: false,
                                        layers: [tileLayer],
                                        maxZoom: 17,
                                        minZoom: 5,
                                        tileSize: 512,
                                        edgeBufferTiles: 5,
                                    }).setView([lat, lng], 20);
                                    let marker = L.circleMarker([lat, lng], {
                                        color: '#4c00ff',
                                        radius: 15
                                    }).addTo(mymap);
                                }

                                let media = nodeItem.dataContext.photos;

                                if (media && media !== null && media !== '') {
                                    hideButton.style.visibility = 'visible';
                                    const threePartIndex = Math.ceil(media.length / 2);
                                    const thirdPart = media.slice().splice(0, threePartIndex);
                                    const secondPart = media.slice().splice(-threePartIndex);

                                    let columnOne = document.querySelector('.one');
                                    let columnTwo = document.querySelector('.two');

                                    function getRandomInt(min, max) {
                                        min = Math.ceil(min);
                                        max = Math.floor(max);
                                        return Math.floor(Math.random() * (max - min) + min);
                                    }

                                    let firstColumn = thirdPart.map(function(element) {
                                        var ext = element.split('.').at(-1);
                                        var elcontain;
                                        if (ext == 'jpg') {

                                            elcontain =
                                                `<img class="img-fluid" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'mp4') {
                                            elcontain =
                                                `<video onmouseover="this.play()" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" onmouseout="this.pause();" oncontextmenu="return false;" class="img-fluid fadeContent"> <source src="${element}" type="video/mp4"> </video>`;
                                        } else if (ext == 'JPEG') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'JPG') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'jpeg') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'png') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'gif') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        }
                                        return element.innerHTML =
                                            `<div class="col-${getRandomInt(8, 12)} pr-${getRandomInt(1, 5)} py-${getRandomInt(1, 5)} pl-${getRandomInt(1, 5)}"> ${elcontain} </div>`;
                                    }, this);

                                    let firstWithoutComa = firstColumn.join(" ");
                                    columnOne.innerHTML = `<div class="row"> ${firstWithoutComa} </div>`;


                                    let secondColumn = secondPart.map(function(element) {
                                        var ext = element.split('.').at(-1);
                                        var elcontain;
                                        if (ext == 'jpg') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'mp4') {
                                            elcontain =
                                                `<video onmouseover="this.play()" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" oncontextmenu="return false;" onmouseout="this.pause();" class="img-fluid fadeContent"> <source src="${element}" type="video/mp4"> </video>`;
                                        } else if (ext == 'JPG') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'JPEG') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'jpeg') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'png') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        } else if (ext == 'gif') {
                                            elcontain =
                                                `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                        }
                                        return element.innerHTML =
                                            `<div class="col-${getRandomInt(8, 12)} pr-${getRandomInt(1, 5)} py-${getRandomInt(1, 5)} pl-${getRandomInt(1, 5)}"> ${elcontain} </div>`;
                                    }, this);
                                    let secondWithoutComa = secondColumn.join(" ");

                                    columnTwo.innerHTML = `<div class="row"> ${secondWithoutComa} </div>`;

                                } else {
                                    hideButton.style.visibility = 'hidden';
                                }
                                var element = document.querySelector('#paning');
                                panzoom(element, {
                                    pinchSpeed: 2,
                                    initialZoom: 1,
                                    bounds: false,
                                    zoomSpeed: 0.065,
                                    boundsPadding: 0.1,
                                });
                            } else {
                                console.log(nodeItem.node.isActive);
                                nodeItem.node.isActive = false;
                            }
                        }

                        function waitForElementToDisplay(selector, callback, checkFrequencyInMs, timeoutInMs) {
                            var startTimeInMs = Date.now();
                            (function loopSearch() {
                                if (document.querySelector(selector) != null) {
                                    callback();
                                    return;
                                } else {
                                    setTimeout(function() {
                                        if (timeoutInMs && Date.now() - startTimeInMs > timeoutInMs)
                                            return;
                                        loopSearch();
                                    }, checkFrequencyInMs);
                                }
                            })();
                        }

                        networkSeries.nodes.template.events.on("hit", saveState, this);


                        networkSeries.nodes.template.events.on("hit", function(event) {
                            var node = event.target;
                            var media = node.dataItem.dataContext.photos;

                            if (media && media !== null && media !== '') {
                                hideButton.style.visibility = 'visible';
                                console.log(media);

                                const threePartIndex = Math.ceil(media.length / 2);
                                const thirdPart = media.slice().splice(0, threePartIndex);
                                const secondPart = media.slice().splice(-threePartIndex);

                                let columnOne = document.querySelector('.one');
                                let columnTwo = document.querySelector('.two');

                                function getRandomInt(min, max) {
                                    min = Math.ceil(min);
                                    max = Math.floor(max);
                                    return Math.floor(Math.random() * (max - min) + min);
                                }
                                let firstColumn = thirdPart.map(function(element) {
                                    var ext = element.split('.').at(-1);
                                    var elcontain;
                                    if (ext == 'jpg') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'mp4') {
                                        elcontain =
                                            `<video onmouseover="this.play()" onmouseout="this.pause();" class="img-fluid fadeContent" oncontextmenu="return false;" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> <source src="${element}" type="video/mp4"> </video>`;
                                    } else if (ext == 'jpeg') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'JPG') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'JPEG') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'png') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'gif') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    }
                                    return element.innerHTML =
                                        `<div class="col-${getRandomInt(4, 8)} pr-${getRandomInt(1, 5)} py-${getRandomInt(1, 5)} pl-${getRandomInt(1, 5)}"> ${elcontain} </div>`;
                                }, this);

                                let firstWithoutComa = firstColumn.join(" ");
                                columnOne.innerHTML = `<div class="row"> ${firstWithoutComa} </div>`;


                                let secondColumn = secondPart.map(function(element) {
                                    var ext = element.split('.').at(-1);
                                    var elcontain;
                                    if (ext == 'jpg') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'mp4') {
                                        elcontain =
                                            `<video onmouseover="this.play()" oncontextmenu="return false;" onmouseout="this.pause();" class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> <source src="${element}" type="video/mp4"> </video>`;
                                    } else if (ext == 'JPEG') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'JPG') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'jpeg') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'png') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    } else if (ext == 'gif') {
                                        elcontain =
                                            `<img class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${element}" />`;
                                    }
                                    return element.innerHTML =
                                        `<div class="col-${getRandomInt(4, 8)} pr-${getRandomInt(1, 5)} py-${getRandomInt(1, 5)} pl-${getRandomInt(1, 5)}"> ${elcontain} </div>`;
                                }, this);
                                let secondWithoutComa = secondColumn.join(" ");

                                columnTwo.innerHTML = `<div class="row"> ${secondWithoutComa} </div>`;
                            } else {
                                hideButton.style.visibility = 'hidden';
                            }

                            var element = document.querySelector('#paning');
                            panzoom(element, {
                                pinchSpeed: 2,
                                initialZoom: 1,
                                bounds: false,
                                zoomSpeed: 0.065,
                                boundsPadding: 0.1,
                            });

                        }, this);
                        am4core.options.autoDispose = true;
                    });
                }
            }

            var x = window.matchMedia("(max-width: 700px)");
            myFunction(x);
            x.addListener(myFunction);




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
            // var containMenu = document.querySelector('.activeScreen');

            function changeClose() {
                var btnClose = document.querySelector('#triggerToggle');
                var containMenu = document.querySelector('.activeScreen');
                if (toggleSlide === 1) {
                    btnClose.innerText = 'X';
                    containMenu.style.zIndex = '170';
                    containMenu.style.transition = "z-index .1s linear";

                } else if (toggleSlide === 0) {
                    // btnClose.innerText = '✺';
                    // btnClose.innerText = '❍';
                    // btnClose.innerText = '❘';
                    btnClose.innerText = '⚈';
                    // btnClose.innerText = '--';
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

                static slideToggle(element, duration = 1500) {
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
