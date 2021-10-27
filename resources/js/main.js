window.Popper = require("popper.js").default;
window.$ = window.jQuery = require("jquery");
window.axios = require("axios");


$(document).ready(function() {
    setTimeout(function() {
        $(".trailer-video").trigger("click");
    }, 0);

    const videoUrl = $(".trailer-video").attr("href");

    $(".trailer-video").magnificPopup({
        type: "iframe",
        iframe: {
            patterns: {
                youtube: {
                    src: videoUrl
                }
            }
        }
    });
});

// mobile menu
const sidenav = document.querySelector(".movie-menu");
const menuToggler = document.querySelector(".menu-toggler");
const menuToggle = document.querySelector(".menu-toggle");
const closeBtn = document.querySelector(".closebtn");

if (menuToggle) {
    menuToggle.addEventListener("click", () => {
        sidenav.style.width = "250px";
        sidenav.style.marginLeft = "0px";
    });

    closeBtn.addEventListener("click", () => {
        sidenav.style.width = "";
        sidenav.style.marginLeft = "";
    });
}

// language picker
const nl = document.querySelector('[data-lang="nl"]');
const en = document.querySelector('[data-lang="en"]');

const urlNl = `${location.pathname}`;
const urlEn = `${location.pathname}_en`;
const isUrlNl = urlNl.includes("_");

if (isUrlNl) {
    let slicedUrl = urlEn.substr(0, urlEn.indexOf("_"));
    nl.addEventListener("click", () => (location.href = slicedUrl));
} else {
    en.addEventListener("click", () => (location.href = urlEn));
}

// localisation redirection
const c_fr = document.querySelector('[data-lang="cunningham_fr"]');

if (c_fr) {
    c_fr.addEventListener("click", () => (location.href = "/cunninghamBE_fr"));
}

//
const mapDiv = document.querySelector(".map");
const mapmarker = document.querySelector(".mapmarker");

mapmarker.addEventListener("click", () => mapDiv.classList.toggle("d-block"));

// mapbox
if (!("remove" in Element.prototype)) {
    Element.prototype.remove = function() {
        if (this.parentNode) {
            this.parentNode.removeChild(this);
        }
    };
}

mapboxgl.accessToken =
    "pk.eyJ1Ijoid2VhcmVkaXZhd29ybGR3aWRlIiwiYSI6ImNrYXplOHloYzBpa2syem1pZnkzNG9uMG8ifQ.tDXA7tNsSJ7_4FaOBdsAzg";

var map = new mapboxgl.Map({
    container: "map",
    style: "mapbox://styles/mapbox/dark-v10",
    center: [4.78218, 51.587471],
    zoom: 13,
    scrollZoom: false
});


var showtime = [];

var stores = {
    type: "FeatureCollection",
    features: []
};

// IF ROOT URL
var endpoint;

if (location.pathname === "/" || location.pathname === "/_en") {
    endpoint = `/api/shows`;
} else if (
    location.pathname === "/madre" ||
    location.pathname === "/madre_en"
) {
    endpoint = `/madre/api/shows`;
} else if (
    location.pathname === "/GliAnniPiuBelli" ||
    location.pathname === "/GliAnniPiuBelli_en"
) {
    endpoint = `/GliAnniPiuBelli/api/shows`;
} else if (
    location.pathname === "/Sibyl" ||
    location.pathname === "/Sibyl_en"
) {
    endpoint = `/Sibyl/api/shows`;
} else if (
    location.pathname === "/cunninghamBE_fr" ||
    location.pathname === "/cunningham" ||
    location.pathname === "/cunningham_en" ||
    location.pathname === "/cunninghamBE"
) {
    endpoint = `/cunningham/api/shows`;
} else if (location.pathname === "/lara" || location.pathname === "/lara_en") {
    endpoint = `/lara/api/shows`;
} else if (
    location.pathname === "/police" ||
    location.pathname === "/police_en"
) {
    endpoint = `/police/api/shows`;
} else if (
    location.pathname === "/Undine" ||
    location.pathname === "/Undine_en"
) {
    endpoint = `/Undine/api/shows`;
} else if (
    location.pathname === "/100UP" ||
    location.pathname === "/100UP_en"
) {
    endpoint = `/100UP/api/shows`;
} else if (
    location.pathname === "/dummy" ||
    location.pathname === "/dummy_en"
) {
    endpoint = `/dummy/api/shows`;
} else if (
    location.pathname === "/lesorellemacaluso" ||
    location.pathname === "/lesorellemacaluso_en"
) {
    endpoint = `/lesorellemacaluso/api/shows`;
} else if ( location.pathname === "/dearcomrades" || location.pathname === "/dearcomrades_en") {
    endpoint = `/dearcomrades/api/shows`;
} else if ( location.pathname === "/martinlutherking" || location.pathname === "/martinlutherking_en") {
    endpoint = `/martinlutherking/api/shows`;
} else if ( location.pathname === "/balladthewhitecow" || location.pathname === "/balladthewhitecow_en") {
    endpoint = `/balladthewhitecow/api/shows`;
}

axios
    .get(endpoint)
    .then(res => showtime.push(...res.data))
    .then(() => {
        for (i = 0; i < showtime.length; i++) {
            stores.features.push({
                type: "Features",
                geometry: {
                    type: "Point",
                    coordinates: [showtime[i].long, showtime[i].lat]
                },
                properties: {
                    id: showtime[i].id,
                    name: showtime[i].name,
                    address: showtime[i].address,
                    city: showtime[i].city,
                    zip: showtime[i].zip,
                    long: showtime[i].long,
                    lat: showtime[i].lat
                }
            });
        }
    })
    .catch(err => console.log(err));

stores.features.forEach(function(store, i) {
    store.properties.id = i;
});

map.on("load", function(e) {
    map.addSource("places", {
        type: "geojson",
        data: stores
    });

    buildLocationList(stores);
    addMarkers();
});

function addMarkers() {
    stores.features.forEach(function(marker) {
        var el = document.createElement("div");
        el.id = "marker-" + marker.properties.id;
        el.className = "marker";

        new mapboxgl.Marker(el, { offset: [0, -23] })
            .setLngLat(marker.geometry.coordinates)
            .addTo(map);

        el.addEventListener("click", function(e) {
            flyToStore(marker);
            createPopUp(marker);
            var activeItem = document.getElementsByClassName("active");
            e.stopPropagation();
            if (activeItem[0]) {
                activeItem[0].classList.remove("active");
            }
            var listing = document.getElementById(
                "listing-" + marker.properties.id
            );
            listing.classList.add("active");
        });
    });
}

function findMatches(wordToMatch, showtime) {
    return showtime.filter(show => {
        const regex = new RegExp(wordToMatch, "gi");
        return show.city.match(regex);
    });
}

function buildLocationList(data) {
    var searchForm = document.querySelector(".search-form");
    var searchInput = document.querySelector(".search-input");
    var searchButton = document.querySelector(".search-button");
    var mainAccordion = document.querySelector(".main-accordion");
    var cityAccordion = document.querySelector(".city-accordion");

    function displayMatches() {
        cityAccordion.classList.add("d-none");
        mainAccordion.classList.remove("d-none");
        const matchArr = findMatches(this.value, showtime);
        const html = matchArr
            .map(m => {
                const current_date = moment().format("YYYY-MM-DD");
                const api_date = m.date;
                const end_date = m.end_date;

                console.log('DATEEEEE', api_date);

                

                var st1;
                var st2;

                // <p class="m-timestamp">${isUrlNl ? moment(m.date).locale('en').format("LL") : moment(m.date).locale('nl').format("LL")}</p>

                var logic1 = current_date < api_date;
                var logic2 = current_date >= api_date;


                if (api_date === '1971-01-01') {
                    if (isUrlNl) {
                        st2 = "start date unknown";
                    } else {
                        st2 = "startdatum nog niet bekend";
                    }
                } else {
if (current_date < api_date) {
                    var dateTime;

                    if (isUrlNl) {
                        dateTime =
                            "From " +
                            moment(m.date)
                                .locale("en")
                                .format("LL");
                    } else {
                        dateTime =
                            "Vanaf " +
                            moment(m.date)
                                .locale("nl")
                                .format("LL");
                    }

                    st1 = dateTime;
                } else if (logic2) {
                    if (isUrlNl) {
                        st2 = "Now Showing In Theatre";
                    } else {
                        st2 = "In de bioscoop";
                    }
                } 
                }


                

                // check 2D / 3D
                var twod_threed = m.two_d === 1 && m.three_d === 1;
                var two_d = m.two_d === 1 && m.three_d === 0;
                var three_d = m.two_d === 0 && m.three_d === 1;
                var nothing_d = m.two_d === 0 && m.three_d === 0;

                return `
                <div class="city-accordion-js">
                    <div class="m-wrapper">
                      <div class="m-wrap-header">
                        <i class="fa fa-video"></i>
                        <h4 class="m-title">${m.name.toLowerCase()}</h4>
                      </div>
                      <div class="m-wrap-meta">
                        <p class="m-address">${m.address}, ${m.city}</p>

                        <p class="m-timestamp">
                        ${logic1 ? st1 : "" || logic2 ? st2 : ""}
                        ${twod_threed ? "2D & 3D" : ""}
                        ${two_d ? "2D" : ""}
                        ${three_d ? "3D" : ""}
                        ${nothing_d ? "" : ""}
                        </p>
                      </div>
                      <div class="m-wrap-footer">
                        <a id="book-button" class="m-book-btn p9-btn" target="_blank" href="${
                            m.url
                        }">${isUrlNl ? "To Theatre" : "Naar theater"}</a>
                        <a class="m-map-btn title" id="link-${m.id}" href="#">${
                    isUrlNl ? "Show On Map" : "Bekijk kaart"
                }</a>
                      </div>
                    </div>
                   </div>
                    `;
            })
            .join("");

        mainAccordion.innerHTML = html;

        var allTitles = document.querySelectorAll(".title");

        allTitles.forEach(title => {
            title.addEventListener("click", function(e) {
                e.preventDefault();
                for (var i = 0; i < data.features.length; i++) {
                    if (this.id === "link-" + data.features[i].properties.id) {
                        var clickedListing = data.features[i];
                        flyToStore(clickedListing);
                        createPopUp(clickedListing);
                    }
                }
                var activeItem = document.getElementsByClassName("active");
                if (activeItem[0]) {
                    activeItem[0].classList.remove("active");
                }
                this.parentNode.classList.add("active");
            });
        });
    }

    function hideSearchResults(e) {
        e.preventDefault();
        var cityAccordionJss = document.querySelectorAll(".city-accordion-js");
        cityAccordionJss.forEach(cityAccordionJs =>
            cityAccordionJs.classList.add("d-none")
        );
    }

    searchInput.addEventListener("change", displayMatches);
    searchInput.addEventListener("keyup", displayMatches);
    searchForm.addEventListener("submit", e => e.preventDefault());
    searchButton.addEventListener("click", hideSearchResults);

    // PART 02
    const cityUl = document.querySelector(".city-map-js");

    const city = [...new Set(showtime.map(item => item.city))].sort();

    const cityHtml = city
        .map(c => {
            return `
                 <li class="map-city-item city-item">
                   <a class="map-city-link city-link" href="#">${c}</a>
                 </li>
            `;
        })
        .join("");

    cityUl.innerHTML = cityHtml;

    const allCities = document.querySelectorAll(".city-link");
    allCities.forEach(singleCity => {
        singleCity.addEventListener("click", function(e) {
            e.preventDefault();
            mainAccordion.classList.add("d-none");
            cityAccordion.classList.remove("d-none");

            document.querySelector(".map-wrapper").classList.remove("d-none");
            const cityQuery = this.textContent;
            const filter = showtime.filter(el => el.city === cityQuery);

            const cHtml = filter
                .map(m => {
                    const current_date = moment().format("YYYY-MM-DD");
                    const api_date = m.date;
                    const end_date = m.end_date;

                    var st1;
                    var st2;

                    // <p class="m-timestamp">${isUrlNl ? moment(m.date).locale('en').format("LL") : moment(m.date).locale('nl').format("LL")}</p>

                    var logic1 = current_date < api_date;
                    var logic2 = current_date >= api_date;

                    if (api_date === '1971-01-01') {
                    if (isUrlNl) {
                        st2 = "start date unknown";
                    } else {
                        st2 = "startdatum nog niet bekend";
                    } 

                } else {

            

                    if (current_date < api_date) {
                        var dateTime;

                        if (isUrlNl) {
                            dateTime =
                                "From " +
                                moment(m.date)
                                    .locale("en")
                                    .format("LL");
                        } else {
                            dateTime =
                                "Vanaf " +
                                moment(m.date)
                                    .locale("nl")
                                    .format("LL");
                        }

                        st1 = dateTime;
                    } else if (logic2) {
                        if (isUrlNl) {
                            st2 = "Now Showing In Theatre";
                        } else {
                            st2 = "In de bioscoop";
                        }
                    } 
                }



                    // check 2D / 3D
                    var twod_threed = m.two_d === 1 && m.three_d === 1;
                    var two_d = m.two_d === 1 && m.three_d === 0;
                    var three_d = m.two_d === 0 && m.three_d === 1;
                    var nothing_d = m.two_d === 0 && m.three_d === 0;

                    return `
                       <div class="city-accordion-js">
                    <div class="m-wrapper">
                      <div class="m-wrap-header">
                        <i class="fa fa-video"></i>
                        <h4 class="m-title">${m.name.toLowerCase()}</h4>
                      </div>
                      <div class="m-wrap-meta">
                        <p class="m-address">${m.address}, ${m.city}</p>
                        <p class="m-timestamp">
                         ${logic1 ? st1 : "" || logic2 ? st2 : ""}
                         ${twod_threed ? "2D & 3D" : ""}
                        ${two_d ? "2D" : ""}
                        ${three_d ? "3D" : ""}
                        ${nothing_d ? "" : ""}
                        </p>
                      </div>
                      <div class="m-wrap-footer">
                        <a id="book-button" class="m-book-btn p9-btn" target="_blank" href="${
                            m.url
                        }">${isUrlNl ? "To Theatre" : "Naar theater"}</a>
                        <a class="m-map-btn title" id="link-${m.id}" href="#">${
                        isUrlNl ? "Show On Map" : "Bekijk kaart"
                    }</a>
                      </div>
                    </div>
                    </div>
                    `;
                })
                .join("");
            cityAccordion.innerHTML = cHtml;

            var allTitles = document.querySelectorAll(".title");

            allTitles.forEach(title => {
                title.addEventListener("click", function(e) {
                    e.preventDefault();
                    for (var i = 0; i < data.features.length; i++) {
                        if (
                            this.id ===
                            "link-" + data.features[i].properties.id
                        ) {
                            var clickedListing = data.features[i];
                            flyToStore(clickedListing);
                            createPopUp(clickedListing);
                        }
                    }
                    var activeItem = document.getElementsByClassName("active");
                    if (activeItem[0]) {
                        activeItem[0].classList.remove("active");
                    }
                    this.parentNode.classList.add("active");
                });
            });
        });
    });
}

function flyToStore(currentFeature) {
    map.flyTo({
        center: currentFeature.geometry.coordinates,
        zoom: 15
    });
}

function createPopUp(currentFeature) {
    var popUps = document.getElementsByClassName("mapboxgl-popup");
    if (popUps[0]) popUps[0].remove();
    var popup = new mapboxgl.Popup({ closeOnClick: false })
        .setLngLat(currentFeature.geometry.coordinates)
        .setHTML(
            `<h3 class="text-center">${currentFeature.properties.name}</h3><h4>${currentFeature.properties.address}, ${currentFeature.properties.zip}, ${currentFeature.properties.city}</h4>`
        )
        .addTo(map);
}


var nav = new mapboxgl.NavigationControl();
map.addControl(nav, 'top-right');


