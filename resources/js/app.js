require('./bootstrap');

function myFunction(x) {
    if (x.matches) {
        am4core.ready(function () {
            am4core.options.queue = true;
            am4core.options.deferredDelay = 4500;
            am4core.options.onlyShowOnViewport = true;
            am4core.useTheme(am4themes_animated);

            var chart = am4core.create("chartdivi", am4plugins_forceDirected.ForceDirectedTree);
            var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries())

            networkSeries.dataSource.url = "http://tfa.test/api/v1/arrayChild";
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

            networkSeries.events.on("inited", function () {
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

            networkSeries.nodes.template.events.on("hit", function (ev) {
                var selection = ev.target.dataItem.node;
                selection.circle.fill = am4core.color("#4c00ff");
                if (selection.isActive) {
                    networkSeries.nodes.each(function (node) {
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

            networkSeries.nodes.template.events.on("over", function (event) {
                var node = event.target;
                node.label.show();
                node.label.html = '<p class="otherlabel text-left mb-0">{name}</p>';
                // console.log(node.label.html);
            }, this);

            networkSeries.nodes.template.events.on("out", function (event) {
                var node = event.target;
                node.label.hide();
                node.label.html = '<div class="otherlabel"></div>';
            }, this);

            networkSeries.dataSource.events.on("parseended", function (ev) {
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
            window.addEventListener("load", function () {
                var retrievedObject = JSON.parse(localStorage.getItem('localNode'));
                searchBar.addEventListener('keyup', (e) => {
                    const searchString = e.target.value.toLowerCase();
                    console.log(searchString);
                    const filterProjectDT = retrievedObject.filter(projekti => {
                        return projekti.autori.toLowerCase().includes(searchString) || projekti.name.toLowerCase().includes(searchString);
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
                            // console.log(elem);
                            autorList.style.display = 'none';
                            searchBar.value = '';
                            resetList.style.visibility = 'hidden';
                            sepList.style.display = 'block';
                        }, false);
                    } else if (filterProjectDT.length > 1) {
                        document.querySelectorAll('.linkFromSearch').forEach(item => {
                            item.addEventListener('click', (event) => {
                                let elem = event.target.parentNode.attributes[1].textContent;

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
            });

            function justTheNode(item) {
                var nodeSearch = networkSeries.getDataItemById(networkSeries.dataItems, item);
                var nodeOfnodes = nodeSearch.node;

                if (!nodeOfnodes.isActive) {
                    nodeOfnodes.isActive = true;
                    var nodeParent = nodeSearch.parent.parent;
                    nodeParent.show();
                    nodeSearch.show();

                    nodeOfnodes.circle.fill = am4core.color("#4c00ff");
                    networkSeries.nodes.each(function (node) {
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

                    Array.prototype.inArray = function (comparer) {
                        for (var i = 0; i < this.length; i++) {
                            if (comparer(this[i])) return true;
                        }
                        return false;
                    };

                    Array.prototype.pushIfNotExist = function (element, comparer) {
                        if (!this.inArray(comparer)) {
                            this.push(element);
                        }
                    };

                    saved.pushIfNotExist(id, function (e) {
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

                        function getExtension(filename) {
                            return filename.substring(filename.lastIndexOf(".") + 1);
                        }

                        let firstColumn = thirdPart.map(function (element) {
                            // var ext = element.split('.').at(-1);
                            var ext = getExtension(element);
                            var elcontain;
                            if (ext == 'jpg') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                            } else if (ext == 'mp4') {
                                elcontain =
                                    `<video onclick="this.paused?this.play():this.pause();" preload="metadata" playsinline controlsList="nofullscreen nodownload" style="box-shadow: 0 4px 20px 0 rgba(1, 30, 255, 0.2), 0 6px 20px 0 rgba(1, 30, 255, 0.19);" class="img-fluid fadeContent"> <source src="${element}#t=2.5" type="video/mp4"> </video>`;
                            } else if (ext == 'JPEG') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                            } else if (ext == 'JPG') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                            } else if (ext == 'jpeg') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                            } else if (ext == 'png') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                            } else if (ext == 'gif') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                            }
                            return element.innerHTML =
                                `<div class="col-${getRandomInt(8, 12)} pr-${getRandomInt(1, 5)} py-${getRandomInt(1, 5)} pl-${getRandomInt(1, 5)}"> ${elcontain} </div>`;
                        }, this);

                        let firstWithoutComa = firstColumn.join(" ");
                        columnOne.innerHTML = `<div class="row"> ${firstWithoutComa} </div>`;

                        let secondColumn = secondPart.map(function (element) {
                            // var ext = element.split('.').at(-1);
                            var ext = getExtension(element);
                            var elcontain;
                            if (ext == 'jpg') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                            } else if (ext == 'mp4') {
                                elcontain =
                                    `<video onclick="this.paused?this.play():this.pause();" preload="metadata" playsinline controlsList="nofullscreen nodownload" style="box-shadow: 0 4px 20px 0 rgba(1, 30, 255, 0.2), 0 6px 20px 0 rgba(1, 30, 255, 0.19);" class="img-fluid fadeContent"> <source src="${element}#t=2.5" type="video/mp4"> </video>`;
                            } else if (ext == 'JPG') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                            } else if (ext == 'JPEG') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                            } else if (ext == 'jpeg') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                            } else if (ext == 'png') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                            } else if (ext == 'gif') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
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
                setTimeout(function () {
                    introImg.setAttribute('class',
                        'img-fluid introPic d-block pb-5 blured fade-in lazy');

                    introImg.setAttribute('src', featured);
                }, 200)


                let heading = document.createElement('p');

                if (featured) {
                    heading.setAttribute('class',
                        'first gou capitalize position-absolute fadeFaster pt-0 text-left pl-4 pr-0 text-break w-100'
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

                infoEl.scrollTop += pos - 50;

                Noob = [id, name, timeOf];

                return (Noob);

            }

            networkSeries.maxLevels = 1;

            networkSeries.nodes.template.expandAll = false;

            networkSeries.nodes.template.events.on("hit", function (ev) {
                var targetNode = ev.target;
                if (targetNode.isActive) {
                    networkSeries.nodes.each(function (node) {
                        if (targetNode !== node && node.isActive && targetNode.dataItem
                            .level == node.dataItem.level) {
                            node.isActive = false;
                        }
                    });
                }
            });

            networkSeries.nodes.template.events.on("out", function (event) {
                event.target.dataItem.childLinks.each(function (link) {
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

                Array.prototype.inArray = function (comparer) {
                    for (var i = 0; i < this.length; i++) {
                        if (comparer(this[i])) return true;
                    }
                    return false;
                };

                Array.prototype.pushIfNotExist = function (element, comparer) {
                    if (!this.inArray(comparer)) {
                        this.push(element);
                    }
                };

                saved.pushIfNotExist(id, function (e) {
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

                setTimeout(function () {
                    introImg.setAttribute('class',
                        'img-fluid introPic d-block pb-5 blured fade-in lazy');

                    introImg.setAttribute('src', featured);
                }, 200);



                let heading = document.createElement('p');

                if (featured) {
                    heading.setAttribute('class',
                        'first gou capitalize position-absolute pt-0 fadeFaster text-left pl-4 pr-0 text-break w-100'
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
                        setTimeout(function () {
                            if (timeoutInMs && Date.now() - startTimeInMs > timeoutInMs)
                                return;
                            loopSearch();
                        }, checkFrequencyInMs);
                    }
                })();
            }

            networkSeries.nodes.template.events.on("hit", saveState, this);

            networkSeries.nodes.template.events.on("hit", function (event) {
                var node = event.target;
                var media = node.dataItem.dataContext.photos;

                if (media && media !== null && media !== '') {
                    buttonNavigation.style.visibility = 'visible';
                    // console.log(media);

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

                    function getExtension(filename) {
                        return filename.substring(filename.lastIndexOf(".") + 1);
                    }

                    let firstColumn = thirdPart.map(function (element) {
                        // var ext = element.split('.').at(-1);
                        var ext = getExtension(element);
                        var elcontain;
                        if (ext == 'jpg') {
                            elcontain =
                                `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                        } else if (ext == 'mp4') {
                            elcontain =
                                `<video ontouchstart="this.paused?this.play():this.pause();" preload="metadata" playsinline controlsList="nofullscreen nodownload" class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(1, 30, 255, 0.2), 0 6px 20px 0 rgba(1, 30, 255, 0.19);"> <source src="${element}#t=2.5" type="video/mp4"> </video>`;
                        } else if (ext == 'jpeg') {
                            elcontain =
                                `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                        } else if (ext == 'JPG') {
                            elcontain =
                                `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                        } else if (ext == 'JPEG') {
                            elcontain =
                                `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                        } else if (ext == 'png') {
                            elcontain =
                                `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                        } else if (ext == 'gif') {
                            elcontain =
                                `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                        }
                        return element.innerHTML =
                            `<div class="col-${getRandomInt(4, 8)} pr-${getRandomInt(1, 5)} py-${getRandomInt(1, 5)} pl-${getRandomInt(1, 5)}"> ${elcontain} </div>`;
                    }, this);

                    let firstWithoutComa = firstColumn.join(" ");
                    columnOne.innerHTML = `<div class="row"> ${firstWithoutComa} </div>`;

                    let secondColumn = secondPart.map(function (element) {
                        // var ext = element.split('.').at(-1);
                        var ext = getExtension(element);
                        var elcontain;
                        if (ext == 'jpg') {
                            elcontain =
                                `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                        } else if (ext == 'mp4') {
                            elcontain =
                                `<video ontouchstart="this.paused?this.play():this.pause();" preload="metadata" playsinline controlsList="nofullscreen nodownload" class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(1, 30, 255, 0.2), 0 6px 20px 0 rgba(1, 30, 255, 0.19);"> <source src="${element}#t=2.5" type="video/mp4"> </video>`;
                        } else if (ext == 'JPEG') {
                            elcontain =
                                `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                        } else if (ext == 'JPG') {
                            elcontain =
                                `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                        } else if (ext == 'jpeg') {
                            elcontain =
                                `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                        } else if (ext == 'png') {
                            elcontain =
                                `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                        } else if (ext == 'gif') {
                            elcontain =
                                `<img class="img-fluid fadeContent lazy" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
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
        am4core.ready(function () {
            am4core.options.queue = true;
            am4core.options.deferredDelay = 1500;

            am4core.options.onlyShowOnViewport = true;
            am4core.useTheme(am4themes_animated);


            var chart = am4core.create("chartdiv", am4plugins_forceDirected.ForceDirectedTree);
            var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries())

            networkSeries.dataSource.url = "http://tfa.test/api/v1/arrayChild";

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

            networkSeries.nodes.template.events.on("hit", function (ev) {
                var selection = ev.target.dataItem.node;
                selection.circle.fill = am4core.color("#4c00ff");
                if (selection.isActive) {
                    networkSeries.nodes.each(function (node) {
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


            networkSeries.nodes.template.events.on("over", function (event) {
                var node = event.target;
                node.label.show();
                node.label.html = '<p class="otherlabel text-left mb-0">{name}</p>';
                // console.log(node.label.html);
            }, this);

            networkSeries.nodes.template.events.on("out", function (event) {
                var node = event.target;
                node.label.hide();
                node.label.html = '<div class="otherlabel"></div>';
            }, this);



            networkSeries.dataSource.events.on("parseended", function (ev) {
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
            // const autorLi = document.getElementById('autorList');
            const searchBar = document.getElementById('searchBar');
            let resetList = document.getElementById('removeList');
            let sepList = document.getElementById('hrToToggle');


            var hideButton = document.getElementById('buttonFormedia');
            hideButton.style.visibility = 'hidden';


            window.addEventListener("load", function () {
                var retrievedObject = JSON.parse(localStorage.getItem('localNode'));
                searchBar.addEventListener('keyup', (e) => {
                    const searchString = e.target.value.toLowerCase();
                    console.log(searchString);
                    const filterProjectDT = retrievedObject.filter(projekti => {
                        return projekti.autori.toLowerCase().includes(searchString) || projekti.name.toLowerCase().includes(searchString);
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
                                let elem = event.target.parentNode.attributes[1].textContent;
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
                // style="pointerEvents: 'none'"
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
            });

            function justTheNode(item) {
                var nodeSearch = networkSeries.getDataItemById(networkSeries.dataItems, item);
                var nodeOfnodes = nodeSearch.node;

                if (!nodeOfnodes.isActive) {
                    nodeOfnodes.isActive = true;
                    var nodeParent = nodeSearch.parent.parent;
                    nodeParent.show();
                    nodeSearch.show();

                    nodeOfnodes.circle.fill = am4core.color("#4c00ff");
                    networkSeries.nodes.each(function (node) {
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

                    Array.prototype.inArray = function (comparer) {
                        for (var i = 0; i < this.length; i++) {
                            if (comparer(this[i])) return true;
                        }
                        return false;
                    };

                    Array.prototype.pushIfNotExist = function (element, comparer) {
                        if (!this.inArray(comparer)) {
                            this.push(element);
                            historyEl.prepend(newState);
                        }
                    };

                    saved.pushIfNotExist(id, function (e) {
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

                        function getExtension(filename) {
                            return filename.substring(filename.lastIndexOf(".") + 1);
                        }

                        let firstColumn = thirdPart.map(function (element) {
                            // var ext = element.split('.').at(-1);
                            var ext = getExtension(element);
                            console.log(ext);
                            var elcontain;
                            if (ext == 'jpg') {
                                elcontain =
                                    `<img class="img-fluid lazy fadeContent" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" src="${imagePlaceHolder}" data-src="${element}" />`;
                            } else if (ext == 'mp4') {
                                elcontain =
                                    `<video onmouseover="this.play()" preload="metadata" style="box-shadow: 0 4px 20px 0 rgba(1, 30, 255, 0.2), 0 6px 20px 0 rgba(1, 30, 255, 0.19);" onmouseout="this.pause();" oncontextmenu="return false;" class="img-fluid fadeContent"> <source src="${element}#t=2.5" type="video/mp4"> </video>`;
                            } else if (ext == 'JPEG') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'JPG') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'jpeg') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'png') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'gif') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            }
                            return element.innerHTML =
                                `<div class="col-${getRandomInt(8, 12)} pr-${getRandomInt(1, 5)} py-${getRandomInt(1, 5)} pl-${getRandomInt(1, 5)}"> ${elcontain} </div>`;
                        }, this);

                        let firstWithoutComa = firstColumn.join(" ");
                        columnOne.innerHTML = `<div class="row"> ${firstWithoutComa} </div>`;

                        let secondColumn = secondPart.map(function (element) {
                            // var ext = element.split('.').at(-1);
                            var ext = getExtension(element);
                            console.log(ext);
                            var elcontain;
                            if (ext == 'jpg') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'mp4') {
                                elcontain =
                                    `<video onmouseover="this.play()" preload="metadata" style="box-shadow: 0 4px 20px 0 rgba(1, 30, 255, 0.2), 0 6px 20px 0 rgba(1, 30, 255, 0.19);" oncontextmenu="return false;" onmouseout="this.pause();" class="img-fluid fadeContent"> <source src="${element}#t=2.5" type="video/mp4"> </video>`;
                            } else if (ext == 'JPG') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'JPEG') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'jpeg') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'png') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'gif') {
                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
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
                setTimeout(function () {
                    introImg.setAttribute('class',
                        'img-fluid introPic lazy d-block pb-5 blured fade-in lazy');

                    introImg.setAttribute('src', featured);
                }, 200)


                let heading = document.createElement('p');

                if (featured) {
                    heading.setAttribute('class',
                        'first gou capitalize position-absolute pt-1 fadeFaster text-left pl-4 pr-0 text-break w-100'
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

            networkSeries.nodes.template.events.on("hit", function (ev) {
                var targetNode = ev.target;
                if (targetNode.isActive) {
                    networkSeries.nodes.each(function (node) {
                        if (targetNode !== node && node.isActive && targetNode.dataItem
                            .level == node.dataItem.level) {
                            if (node.dataItem.level == 1) {
                                node.isActive = false;
                            }
                        }
                    });
                }
            });


            networkSeries.nodes.template.events.on("out", function (event) {
                event.target.dataItem.childLinks.each(function (link) {
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

                Array.prototype.inArray = function (comparer) {
                    for (var i = 0; i < this.length; i++) {
                        if (comparer(this[i])) return true;
                    }
                    return false;
                };

                Array.prototype.pushIfNotExist = function (element, comparer) {
                    if (!this.inArray(comparer)) {
                        this.push(element);
                        historyEl.prepend(newState);
                    }
                };

                saved.pushIfNotExist(id, function (e) {
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

                setTimeout(function () {
                    introImg.setAttribute('class',
                        'img-fluid introPic lazy d-block pb-5 blured fade-in lazy');

                    introImg.setAttribute('src', featured);
                }, 200);



                let heading = document.createElement('p');

                if (featured) {
                    heading.setAttribute('class',
                        'first gou capitalize position-absolute pt-1 fadeFaster text-left pl-4 pr-0 text-break w-100'
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

                waitForElementToDisplay("#loadMore", function () {

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
                    networkSeries.nodes.each(function (node) {
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

                        function getExtension(filename) {
                            return filename.substring(filename.lastIndexOf(".") + 1);
                        }

                        let firstColumn = thirdPart.map(function (element) {
                            // var ext = element.split('.').at(-1);
                            var ext = getExtension(element);
                            console.log(ext);
                            var elcontain;
                            if (ext == 'jpg') {

                                elcontain =
                                    `<img class="img-fluid fadeContent lazy" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'mp4') {
                                elcontain =
                                    `<video onmouseover="this.play()" preload="metadata" style="box-shadow: 0 4px 20px 0 rgba(1, 30, 255, 0.2), 0 6px 20px 0 rgba(1, 30, 255, 0.19);" onmouseout="this.pause();" oncontextmenu="return false;" class="img-fluid fadeContent"> <source src="${element}#t=2.5" type="video/mp4"> </video>`;
                            } else if (ext == 'JPEG') {
                                elcontain =
                                    `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'JPG') {
                                elcontain =
                                    `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'jpeg') {
                                elcontain =
                                    `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'png') {
                                elcontain =
                                    `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'gif') {
                                elcontain =
                                    `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            }
                            return element.innerHTML =
                                `<div class="col-${getRandomInt(8, 12)} pr-${getRandomInt(1, 5)} py-${getRandomInt(1, 5)} pl-${getRandomInt(1, 5)}"> ${elcontain} </div>`;
                        }, this);

                        let firstWithoutComa = firstColumn.join(" ");
                        columnOne.innerHTML = `<div class="row"> ${firstWithoutComa} </div>`;


                        let secondColumn = secondPart.map(function (element) {
                            // var ext = element.split('.').at(-1);
                            var ext = getExtension(element);
                            console.log(ext);
                            var elcontain;
                            if (ext == 'jpg') {
                                elcontain =
                                    `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'mp4') {
                                elcontain =
                                    `<video onmouseover="this.play()" preload="metadata" style="box-shadow: 0 4px 20px 0 rgba(1, 30, 255, 0.2), 0 6px 20px 0 rgba(1, 30, 255, 0.19);" oncontextmenu="return false;" onmouseout="this.pause();" class="img-fluid fadeContent"> <source src="${element}#t=2.5" type="video/mp4"> </video>`;
                            } else if (ext == 'JPG') {
                                elcontain =
                                    `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'JPEG') {
                                elcontain =
                                    `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'jpeg') {
                                elcontain =
                                    `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'png') {
                                elcontain =
                                    `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                            } else if (ext == 'gif') {
                                elcontain =
                                    `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
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
                    // console.log(nodeItem.node.isActive);
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
                        setTimeout(function () {
                            if (timeoutInMs && Date.now() - startTimeInMs > timeoutInMs)
                                return;
                            loopSearch();
                        }, checkFrequencyInMs);
                    }
                })();
            }

            networkSeries.nodes.template.events.on("hit", saveState, this);


            networkSeries.nodes.template.events.on("hit", function (event) {
                var node = event.target;
                var media = node.dataItem.dataContext.photos;

                if (media && media !== null && media !== '') {
                    hideButton.style.visibility = 'visible';
                    // console.log(media.naturalHeight);
                    // console.log(media.width);
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

                    function getExtension(filename) {
                        return filename.substring(filename.lastIndexOf(".") + 1);
                    }

                    let firstColumn = thirdPart.map(function (element) {
                        // var ext = element.split('.').at(-1);
                        var ext = getExtension(element);
                        // let docSize = document.querySelector('img');
                        // console.log(docSize.width);

                        var elcontain;
                        if (ext == 'jpg') {
                            elcontain =
                                `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;

                        } else if (ext == 'mp4') {
                            elcontain =
                                `<video onmouseover="this.play()" onmouseout="this.pause();" preload="metadata" class="img-fluid fadeContent" oncontextmenu="return false;" style="box-shadow: 0 4px 20px 0 rgba(1, 30, 255, 0.2), 0 6px 20px 0 rgba(1, 30, 255, 0.19);"> <source src="${element}#t=2.5" type="video/mp4"> </video>`;
                        } else if (ext == 'jpeg') {
                            elcontain =
                                `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                        } else if (ext == 'JPG') {
                            elcontain =
                                `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                        } else if (ext == 'JPEG') {
                            elcontain =
                                `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                        } else if (ext == 'png') {
                            elcontain =
                                `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                        } else if (ext == 'gif') {
                            elcontain =
                                `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                        }
                        return element.innerHTML =
                            `<div class="col-${getRandomInt(8, 12)} pr-${getRandomInt(1, 5)} py-${getRandomInt(1, 5)} pl-${getRandomInt(1, 5)}"> ${elcontain}</div>`;
                            console.log(elcontain);
                    }, this);

                    let firstWithoutComa = firstColumn.join(" ");
                    columnOne.innerHTML = `<div class="row"> ${firstWithoutComa} </div>`;


                    let secondColumn = secondPart.map(function (element) {
                        // var ext = element.split('.').at(-1);
                        var ext = getExtension(element);
                        // console.log(ext);
                        // console.log(element.naturalHeight);
                        var elcontain;
                        if (ext == 'jpg') {
                            elcontain =
                                `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                        } else if (ext == 'mp4') {
                            elcontain =
                                `<video onmouseover="this.play()" oncontextmenu="return false;" preload="metadata" onmouseout="this.pause();" class="img-fluid fadeContent" style="box-shadow: 0 4px 20px 0 rgba(1, 30, 255, 0.2), 0 6px 20px 0 rgba(1, 30, 255, 0.19);"> <source src="${element}#t=2.5" type="video/mp4"> </video>`;
                        } else if (ext == 'JPEG') {
                            elcontain =
                                `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                        } else if (ext == 'JPG') {
                            elcontain =
                                `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                        } else if (ext == 'jpeg') {
                            elcontain =
                                `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                        } else if (ext == 'png') {
                            elcontain =
                                `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
                        } else if (ext == 'gif') {
                            elcontain =
                                `<img class="img-fluid lazy fadeContent" src="${imagePlaceHolder}" style="box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); pointer-events: none;" data-src="${element}" />`;
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
                    initialZoom: 2,
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

