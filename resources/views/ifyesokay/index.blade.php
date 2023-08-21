<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $movie_details->movie_title }} - {{ $movie_details->movie_description_short_nl }}, met {{ $movie_details->actors }}. In de bioscoop {{ $first_release_date }}.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $movie_details->movie_title }} - {{ $movie_details->tagline_nl }}</title>
    <link rel="shortcut icon" href="https://www.planetnine.com/wp-content/uploads/2020/06/cropped-favicon-32x32.png" type="image/x-icon">
    <link rel='stylesheet' href='//api.tiles.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.css'/>
    <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css'/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap');

        :root {
            --primary-light: {{ $primary_light }};
            --primary-dark: {{ $primary_dark }};;
            --secondary-light: {{ $secondary_light }};;
            --secondary-dark: {{ $secondary_dark }};;
            --extend: #353b48;

            --color1: #353b48;
            --color2: #171e2b;
            --gray1: #f1e8d6;
        }

        .mapboxgl-ctrl-bottom-left, .mapboxgl-ctrl-bottom-right{
            display: none;
        }

        .review-area {
            padding: 1rem 0!important;
            background: var(--secondary-light);
            color: #fff;
            font-family: 'ADLaM Display', cursive;
        }

        .sibyl-header {
            background-color: var(--color1) !important;
            color: #fff !important;
        }

        .sibyl-header h1 {
            color: inherit !important;
            font-family: 'ADLaM Display', cursive;
            font-weight: 400 !important;
        }


        .sibyl-review-slider {
            background-color: #f1e8d6 !important;
            font-family: 'ADLaM Display', cursive;
        }

        .sibyl-review-area {
            background-color: #353b48 !important;
        }

        .sibyl-movie-footer {
            background-color: var(--color1) !important;
            color: #52433d !important;
            padding: 3rem 0 !important;
        }

        .movie-content {
            background-color: var(--color1) !important;
            padding-top: 1rem !important;
            padding-bottom: 0 !important;
        }

        .sibyl-movie-menu {
            background-color: var(--color2) !important;
        }

        .movie-footer .tab-pane,
        .sibyl-copy-text {
            color: var(--gray1) !important;
        }

        .city-accordion-js {
            font-family: 'Thasadith', sans-serif !important;
        }

        .movie-menu{
            background-color: rgb(50, 111, 57)!important;
        }

        .movie-header, .movie-content, .movie-footer{
            background-color: rgb(249, 192, 173)!important;
        }

        .m-wrapper{
            background: rgb(76, 60, 85)!important;
        }

        .hastag{
            color: rgb(249, 192, 173)!important;
        }

        .m-title, .m-address, .m-timestamp{
            color: white!important;
        }

        .fa-video{
            color: white!important;
        }

        .city-map-js li{
            border-radius: 5px!important;
            border: 1px solid rgb(76, 60, 85)!important;
        }

        .movie-menu a {
            font-family: 'Thasadith', sans-serif !important;
        }

        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            .svDesk, .svTab{
                display: none;
            }

            .svMobile{
                display: block;
            }
        }

        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            .svDesk, .svTab{
                display: none;
            }

            .svMobile{
                display: block;
            }
        }

        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
            .svDesk, .svMobile{
                display: none;
            }

            .svTab{
                display: block;
            }
        }

        /* Medium devices (landscape tablets, 768px and up) */
        @media only screen and (min-width: 768px) {
            .svDesk, .svMobile{
                display: none;
            }

            .svTab{
                display: block;
            }
        }

        /* Large devices (laptops/desktops, 992px and up) */
        @media only screen and (min-width: 992px) {
            .svTab, .svMobile{
                display: none;
            }

            .svDesk{
                display: block;
            }
        }

        /* Extra large devices (large laptops and desktops, 1200px and up) */
        @media only screen and (min-width: 1200px) {
            .svTab, .svMobile{
                display: none;
            }

            .svDesk{
                display: block;
            }
        }

        .menu-toggler{
            background-color: rgb(50, 111, 57)!important;
        }

    </style>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://kenwheeler.github.io/slick/slick/slick-theme.css">
    <script defer src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link href="{{ mix('css/main.css') }}" rel="stylesheet">
    {!! $movie_details->fb_pixel !!}
    {!! $movie_details->google_pixel !!}
</head>
<body>

<a class="trailer-video d-none" href="{{ $youtube_url }}?autoplay=1&mute=1"></a>

<section id="root" class="mvoie-body">
    <header class="movie-header sibyl-header position-relative text-white py-3" style="text-align: center !important;">
        <h1 class="text-center m-0" style="color: rgb(229, 52, 34)!important;">{{ $movie_details->movie_title }}
            -
            <span class="movie-tagline">{{ $movie_details->tagline_nl }}</span>
        </h1>

        <div class="flags">
            <img data-lang="en" src="{{ asset('images/uk.png') }}" class="d-block" alt="">
            <img data-lang="nl" src="{{ asset('images/nl.svg') }}" class="d-none" alt="">
        </div>

    </header>

    <div class="menu-toggler">
        <div class="container">
            <span class="menu-toggle">&#9776;</span>
        </div>
    </div>

    <section class="movie-menu sibyl-movie-menu text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <a href="javascript:void(0)" class="closebtn">&times;</a>
                    <nav class="nav-menu">
                        <ul>
                            <li><a href="#" class="menu-link tablink" onclick="openPage('bp', this)" id="defaultOpen">Bioscopen</a>
                            </li>
                            <li><a href="#" class="menu-link tablink" onclick="openPage('vdo', this)">Videos</a></li>
                            <li><a href="#" class="menu-link tablink" onclick="openPage('sy', this)">Synopsis</a></li>
                            <li><a href="#" class="menu-link tablink" onclick="openPage('sv', this)">Speciale Vertoningen</a></li>
                            <!--  <li><a href="https://picl.nl/films/bacurau/" target="_blank" class="menu-link"><img
                                        class="menu-logo" src="{{ asset('/images/picl.png') }}" alt=""></a></li> -->
                            <li class="hastag">{{ $movie_details->hashtag }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>


    <div class="movie-content text-white">
        <div id="bp" class="tabcontent container-fluid">
            <div class="row">
                <div class="col-xl-4 col-lg-6 poster-hide">
                    <div class="poster">
                        <img
                            loading="lazy"
                            class="d-block mx-auto"
                            src="{{ $movie_details->image1 }}"
                            style="border: 2px solid rgb(229, 52, 34); border-radius: 1rem;"
                            alt="{{ $movie_details->movie_title }}.{{$movie_details->movie_description_short_nl}}">

                        <p class="d-md-none text-center m-0 mb-2" style="color: rgb(229, 52, 34);">{{ $movie_details->movie_title }}
                            - {{ $movie_details->movie_description_short_nl }}</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 ">
                    <div class="showtimes">
                        <form class="search-form">
                            <input class="search-input map-search" type="text" name="search"
                                   placeholder="Zoek je stad"
                                   autocomplete="off">
                            <button class="search-button" type="submit">&times;</button>
                        </form>

                        <div class="search-meta text-center my-2">
                            <div class="main-accordion accordion d-none" id="mainAccordionId"></div>
                            <div class="city-accordion accordion d-none" id="cityAccordionId"></div>

                        </div>

                        <ul class="city-map-js my-3"></ul>

                        <div class="synopsis desk-sy">
                            <h3 class="text-center mb-2 my-3" style="text-decoration: none; color: rgb(229, 52, 34)!important;">
                                {{ $movie_details->movie_description_short_nl }}
                            </h3>
                            <p style="white-space: pre-line; color: rgb(53, 59, 72)!important;">
                                {{ $movie_details->movie_description_long_nl }}
                            </p>
                        </div>

                        <br>

                        <p class="text-center my-3" style="color: rgb(229, 52, 34);">BEKIJK DE TRAILER</p>

                        <div class="youtube-trailer">
                            <div class="iframe-container mb-2">
                                <iframe src="{{ $youtube_url }}" class="iframe-video"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                        </div>
                        <br>

                        <div class="synopsis">
                            <h3 class="text-center mb-2 my-3" style="text-decoration: none; color: rgb(229, 52, 34)!important;">
                                <b>Over Dick Verdult (alias Dick El Demasiado):</b>
                            </h3>
                            <p style="white-space: pre-line; color: rgb(76, 60, 85);">
                                Beeldend kunstenaar, muzikant, auteur en filmmaker Dick Verdult (Eindhoven, 1954) is een cult-personage in Latijns-Amerika, Japan, en in sommige delen van Rusland en Europa. Als de aanjager van een geheel nieuwe kijk op de folkloristische cumbia-muziek staat hij bekend als Dick El Demasiado (Demasiado = mateloos ), wat in zijn geval een goed passende samenvoeging is. <br>
                                Daarnaast hield hij zich 20 jaar bezig met interactieve fictie (1975-1995), waardoor hij nog altijd ver blijft van de gangbare lineaire dramaturgie. Zijn laatste film was “Viva Matanzas” over een zeeslag zonder doden (2018, 50 min). Deze fictiefilm ging in première op het documentaire festival IDFA. Daarnaast dient te worden opgemerkt dat Verdult, als Dick El Demasiado, de film het bijzondere muzikale karakter heeft gegeven.
                            </p>
                            <br>
                            <p style="white-space: pre-line; color: rgb(76, 60, 85);">
                                Linken naar zijn website: <a href='https://www.dickverdult.com/' target="_blank">https://www.dickverdult.com/</a>
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 ">
                    @include('madre._map')
                </div>
            </div>
        </div>

        <div id="vdo" class="tabcontent container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="iframe-container">
                        <iframe src="{{ $youtube_url }}" class="iframe-video"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>


        <div id="sy" class="tabcontent container">
            <div class="row">
                <div class="col-md-3 mb-5 mx-auto">
                    <img class="d-block w-100" src="{{ $movie_details->image1 }}" alt="" style="border: 2px solid rgb(229, 52, 34); border-radius: 1rem;">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="synopsis">
                        <h3 class="text-center mb-2" style="color: rgb(229, 52, 34);">
                            {{ $movie_details->movie_description_short_nl }}
                        </h3>
                        <p style="color: rgb(53, 59, 72);">
                            {{ $movie_details->movie_description_long_nl }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="synopsis">
                        <div class="synopsis-meta mt-2">
                            <p><span>Regisseur:</span> {{ $movie_details->director }}</p>
                            {{-- <p><span>Schrijver:</span> {{ $movie_details->writer }}</p> --}}
                            <p><span>Producent:</span> {{ $movie_details->producer }}</p>
                            <p><span>Acteurs:</span> {{ $movie_details->actors }}</p>
                            <p><span>Speeltijd:</span> {{ $movie_details->duration }}</p>
                            @if($rating >= 6)
                            <p><span>Ratings:</span> {{ $rating }}</p>
                            @else

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="sv" class="tabcontent container">
            <div
                style="display: flex; flex-direction: column; justify-content: center; align-content: center; align-items: center;">

                <div class="svDesk"
                    style="max-width: 75%; background-color: rgb(249, 192, 173)!important; padding: 2em; border-radius: 1rem; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border: 2px solid; border-left-color:rgb(76, 60, 85); border-top-color:rgb(76, 60, 85); border-right-color: rgb(50, 111, 57); border-bottom-color:rgb(50, 111, 57);">
                    <h3 class="text-center mb-2" style="color: rgb(76, 60, 85)!important; text-decoration: underline;">
                        AMSTERDAM
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(76, 60, 85);">
                        <p><span>&#8226; Do 7 Sept</span> - De Balie, Filmvertoning It’s true but not here van Luuk Bouwman over Dick
                            Verdult.</p>
                        <p><span>&#8226; Zo 17 Sept</span> - De Balie, Film + concert Dick Verdult.</p>
                        <p><span>&#8226; Di 19 Sept</span> - Eye on Art, Film & Performance 'Ugly Poems’ Dick Verdult. Engels OT.</p>
                    </div>
                    <br>
                    <h3 class="text-center mb-2" style="color: rgb(76, 60, 85)!important; text-decoration: underline;">
                        BREDA
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(76, 60, 85);">
                        <p><span>&#8226; Do 14 Sept</span> - Chassé Cinema,  Film & Q&A Dick Verdult.</p>
                        <p><span>&#8226; Za 16 Sept</span> - Chassé Cinema, Film & Performance 'Lelijke Gedichten’ Dick Verdult.</p>
                    </div>
                    <br>
                    <h3 class="text-center mb-2" style="color: rgb(76, 60, 85)!important; text-decoration: underline;">
                        DEVENTER
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(76, 60, 85);">
                        <p><span>&#8226; Woe 27 Sept</span> - Mimik, Film & Performance 'Lelijke Gedichten’ Dick Verdult.</p>
                    </div>
                    <br>
                    <div class="heads" style="display: flex; flex-direction: column; justify-content: center; align-content: center;">
                        <div class="head1" style="margin-bottom: -38px; text-align: center;">
                            <img src="{{ asset('images/Meiden los Heads-1.png') }}" alt="head1" id="head1"
                                style="width: 30%;">
                        </div>
                        <div class="head2" style="text-align: center;">
                            <img src="{{ asset('images/Meiden los Heads-2-min.png') }}" alt="head2" id="head2"
                                style="width: 30%; transform: rotate(180deg); margin-left: 59px;">
                        </div>
                    </div>
                    <br>

                    <h3 class="text-center mb-2" style="color: rgb(50, 111, 57)!important; text-decoration: underline;">
                        EINDHOVEN
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(50, 111, 57);">
                        <p><span>&#8226; Wo 13 Sept</span> - Lab-1 Première in aanwezigheid van cast + crew.</p>
                        <p><span>&#8226; Vr 15 Sept</span> - Lab-1 Film & Performance 'Lelijke Gedichten’ Dick Verdult.</p>
                    </div>
                    <br>
                    <h3 class="text-center mb-2" style="color: rgb(50, 111, 57)!important; text-decoration: underline;">
                        TILBURG - Murf/Murw Festival
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(50, 111, 57);">
                        <p><span>&#8226; Do 28 &  Za 30</span> - Film & Performance 'Lelijke Gedichten’ Dick Verdult</p>
                    </div>
                    <br>
                    <h3 class="text-center mb-2" style="color: rgb(50, 111, 57)!important; text-decoration: underline;">
                        Online vertoning - PICL
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(50, 111, 57);">
                        <p><span>&#8226; Vanaf 14 September</span> - te zien op het online filmhuis PICL.</p>
                    </div>
                </div>

                <div class="svTab"
                    style="max-width: 100%; background-color: rgb(249, 192, 173)!important; padding: 2em; border-radius: 1rem; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border: 2px solid; border-left-color:rgb(76, 60, 85); border-top-color:rgb(76, 60, 85); border-right-color: rgb(50, 111, 57); border-bottom-color:rgb(50, 111, 57);">
                    <h3 class="text-center mb-2" style="color: rgb(76, 60, 85)!important; text-decoration: underline;">
                        AMSTERDAM
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(76, 60, 85);">
                        <p><span>&#8226; Do 7 Sept</span> - De Balie, Filmvertoning It’s true but not here van Luuk Bouwman over Dick
                            Verdult.</p>
                        <p><span>&#8226; Zo 17 Sept</span> - De Balie, Film + concert Dick Verdult.</p>
                        <p><span>&#8226; Di 19 Sept</span> - Eye on Art, Film & Performance 'Ugly Poems’ Dick Verdult. Engels OT.</p>
                    </div>
                    <br>
                    <h3 class="text-center mb-2" style="color: rgb(76, 60, 85)!important; text-decoration: underline;">
                        BREDA
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(76, 60, 85);">
                        <p><span>&#8226; Do 14 Sept</span> - Chassé Cinema,  Film & Q&A Dick Verdult.</p>
                        <p><span>&#8226; Za 16 Sept</span> - Chassé Cinema, Film & Performance 'Lelijke Gedichten’ Dick Verdult.</p>
                    </div>
                    <br>
                    <h3 class="text-center mb-2" style="color: rgb(76, 60, 85)!important; text-decoration: underline;">
                        DEVENTER
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(76, 60, 85);">
                        <p><span>&#8226; Woe 27 Sept</span> - Mimik, Film & Performance 'Lelijke Gedichten’ Dick Verdult.</p>
                    </div>
                    <br>
                    <div class="heads" style="display: flex; flex-direction: column; justify-content: center; align-content: center;">
                        <div class="head1" style="margin-bottom: -30px; text-align: center;">
                            <img src="{{ asset('images/Meiden los Heads-1.png') }}" alt="head1" id="head1"
                                style="width: 30%;">
                        </div>
                        <div class="head2" style="text-align: center;">
                            <img src="{{ asset('images/Meiden los Heads-2-min.png') }}" alt="head2" id="head2"
                                style="width: 30%; transform: rotate(180deg); margin-left: 51px;">
                        </div>
                    </div>
                    <br>

                    <h3 class="text-center mb-2" style="color: rgb(50, 111, 57)!important; text-decoration: underline;">
                        EINDHOVEN
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(50, 111, 57);">
                        <p><span>&#8226; Wo 13 Sept</span> - Lab-1 Première in aanwezigheid van cast + crew.</p>
                        <p><span>&#8226; Vr 15 Sept</span> - Lab-1 Film & Performance 'Lelijke Gedichten’ Dick Verdult.</p>
                    </div>
                    <br>
                    <h3 class="text-center mb-2" style="color: rgb(50, 111, 57)!important; text-decoration: underline;">
                        TILBURG - Murf/Murw Festival
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(50, 111, 57);">
                        <p><span>&#8226; Do 28 &  Za 30</span> - Film & Performance 'Lelijke Gedichten’ Dick Verdult</p>
                    </div>
                    <br>
                    <h3 class="text-center mb-2" style="color: rgb(50, 111, 57)!important; text-decoration: underline;">
                        Online vertoning - PICL
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(50, 111, 57);">
                        <p><span>&#8226; Vanaf 14 September</span> - te zien op het online filmhuis PICL.</p>
                    </div>
                </div>

                <div class="svMobile"
                    style="max-width: 100%; background-color: rgb(249, 192, 173)!important; padding: 2em; border-radius: 1rem; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border: 2px solid; border-left-color:rgb(76, 60, 85); border-top-color:rgb(76, 60, 85); border-right-color: rgb(50, 111, 57); border-bottom-color:rgb(50, 111, 57);">
                    <h3 class="text-center mb-2" style="color: rgb(76, 60, 85)!important; text-decoration: underline;">
                        AMSTERDAM
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(76, 60, 85);">
                        <p><span>&#8226; Do 7 Sept</span> - De Balie, Filmvertoning It’s true but not here van Luuk Bouwman over Dick
                            Verdult.</p>
                        <p><span>&#8226; Zo 17 Sept</span> - De Balie, Film + concert Dick Verdult.</p>
                        <p><span>&#8226; Di 19 Sept</span> - Eye on Art, Film & Performance 'Ugly Poems’ Dick Verdult. Engels OT.</p>
                    </div>
                    <br>
                    <h3 class="text-center mb-2" style="color: rgb(76, 60, 85)!important; text-decoration: underline;">
                        BREDA
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(76, 60, 85);">
                        <p><span>&#8226; Do 14 Sept</span> - Chassé Cinema,  Film & Q&A Dick Verdult.</p>
                        <p><span>&#8226; Za 16 Sept</span> - Chassé Cinema, Film & Performance 'Lelijke Gedichten’ Dick Verdult.</p>
                    </div>
                    <br>
                    <h3 class="text-center mb-2" style="color: rgb(76, 60, 85)!important; text-decoration: underline;">
                        DEVENTER
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(76, 60, 85);">
                        <p><span>&#8226; Woe 27 Sept</span> - Mimik, Film & Performance 'Lelijke Gedichten’ Dick Verdult.</p>
                    </div>
                    <br>
                    <div class="heads" style="display: flex; flex-direction: column; justify-content: center; align-content: center;">
                        <div class="head1" style="margin-bottom: -15px; text-align: center;">
                            <img src="{{ asset('images/Meiden los Heads-1.png') }}" alt="head1" id="head1"
                                style="width: 30%;">
                        </div>
                        <div class="head2" style="text-align: center;">
                            <img src="{{ asset('images/Meiden los Heads-2-min.png') }}" alt="head2" id="head2"
                                style="width: 30%; transform: rotate(180deg); margin-left: 23px;">
                        </div>
                    </div>
                    <br>

                    <h3 class="text-center mb-2" style="color: rgb(50, 111, 57)!important; text-decoration: underline;">
                        EINDHOVEN
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(50, 111, 57);">
                        <p><span>&#8226; Wo 13 Sept</span> - Lab-1 Première in aanwezigheid van cast + crew.</p>
                        <p><span>&#8226; Vr 15 Sept</span> - Lab-1 Film & Performance 'Lelijke Gedichten’ Dick Verdult.</p>
                    </div>
                    <br>
                    <h3 class="text-center mb-2" style="color: rgb(50, 111, 57)!important; text-decoration: underline;">
                        TILBURG - Murf/Murw Festival
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(50, 111, 57);">
                        <p><span>&#8226; Do 28 &  Za 30</span> - Film & Performance 'Lelijke Gedichten’ Dick Verdult</p>
                    </div>
                    <br>
                    <h3 class="text-center mb-2" style="color: rgb(50, 111, 57)!important; text-decoration: underline;">
                        Online vertoning - PICL
                    </h3>
                    <div class="texts" style="text-align: center; color:rgb(50, 111, 57);">
                        <p><span>&#8226; Vanaf 14 September</span> - te zien op het online filmhuis PICL.</p>
                    </div>
                </div>

            </div>
        </div>

        @if(count($reviews) > 0)
        <section class="sibyl-review-area review-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="reviews-slider sibyl-review-slider">
                            <div class="slider single-item">
                                @foreach($reviews as $review)
                                    <div class="text-center">
                                        @php $rating = $review->ratings; @endphp
                                        @if($rating > 0)
                                            @foreach(range(1, 5) as $i)
                                                <span class="fa-stack">
                                            <i class="far fa-star fa-stack-1x"></i>
                                        @if($rating >0)
                                                        @if($rating >0.5)
                                                            <i class="fas fa-star fa-stack-1x"></i>
                                                        @else
                                                            <i class="fas fa-star-half fa-stack-1x"></i>
                                                        @endif
                                                    @endif
                                                    @php $rating--; @endphp
                                        </span>
                                            @endforeach
                                        @else

                                        @endif

                                        {{-- <small>({{ $review->ratings }})</small>--}}

                                        <h3><i class="fa fa-quote-left"></i> {{ $review->review_text }} <i
                                                class="fa fa-quote-right"></i></h3>

                                        <p><a href="{{$review->source_link}}" target="_blank">{{ $review->source }}</a>
                                        </p>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <footer class="movie-footer sibyl-movie-footer text-white text-center">
            <div class="container">

                <div class="row">
                    <div class="col-md-8 mx-auto">

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#cookies">Cookies</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab"
                                   href="#Gebruiksvoorwaarden">Gebruiksvoorwaarden</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#privacy-policy">Privacy Policy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#credits">Credits</a>
                            </li>
                        </ul>
                        <hr class="bg-secondary">

                        <div class="tab-content pt-3" style="color:black;">
                            <div id="cookies" class="container tab-pane">
                                <p>
                                    {{ $movie_details->cookies_nl }}
                                </p>
                            </div>
                            <div id="Gebruiksvoorwaarden" class="container tab-pane fade">
                                <p>
                                    {{ $movie_details->terms_of_use_nl }}
                                </p>
                            </div>
                            <div id="privacy-policy" class="container tab-pane fade">
                                <p>
                                    {{ $movie_details->privacy_policy_nl }}
                                </p>
                            </div>
                            <div id="credits" class="container tab-pane fade">
                                <p>
                                    {{ $movie_details->credits_nl }}
                                </p>
                            </div>
                        </div>



                        <div class="footer-dist-logos d-flex  align-items-center">
                            <a href="{{ $d_details['email'] }}" target="_blank"><img
                                    src="/distributors/{{ $d_details['logo'] }}" alt="{{ $d_details['name'] }}"></a>
                            <a href="https://www.planetnine.com/" target="_blank"><img
                                        src="{{ asset('images/p9.png') }}"
                                        alt="planetnine.com"></a>
                            @if($mp_details != NULL)
                            <a href="{{ $mp_details['email'] }}" target="_blank"><img
                                    src="/media_partners/{{ $mp_details['logo'] }}" alt="{{ $mp_details['name'] }}"></a>
                            @else

                            @endif
                            
                        </div>

                        <hr class="bg-secondary">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="sibyl-copy-text">&copy; Alle rechten voorbehouden {{$d_details['name']}}, Planetnine - <?= Date('Y') ?></p>
                            <ul class="footer-social">
                                <li class="mr-2"><a target="_blank" href="{{ $movie_details->fb_link }}">
                                        <img src="{{ asset('images/facebook.svg') }}" alt="">
                                    </a>
                                <li><a target="_blank" href="{{ $movie_details->twitter_link }}">
                                        <img src="{{ asset('images/twitter.svg') }}" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </footer>
    </div>

</section>

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment-with-locales.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.31/moment-timezone.min.js"></script>
<script src='//api.tiles.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.js'></script>
<script src="{{ mix('js/main.js') }}"></script>
<script>
    document.querySelectorAll('.tablink').forEach(navTabLink => navTabLink.addEventListener('click', e => e.preventDefault()));

    function openPage(pageName, element) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        document.getElementById(pageName).style.display = "block";
    }

    document.getElementById("defaultOpen").click();

    $(document).ready(function () {
        $('.single-item').slick({
            dots: false,
            infinite: false,
            speed: 300,
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 1,
            slidesToScroll: 1,
        });
    });
</script>
</body>
</html>



