<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="{{ $movie_details->movie_title }} - {{ $movie_details->movie_description_short }}, with {{ $movie_details->actors }}. In cinemas {{ $first_release_date }}.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $movie_details->movie_title }} - {{ $movie_details->tagline_fr }}</title>
    <link rel='stylesheet' href='//api.tiles.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.css'/>
    <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"
            defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Thasadith&display=swap');

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

        .review-area {
            padding: 3rem 0;
            background: var(--secondary-light);
            color: #fff;
            font-family: 'Thasadith', sans-serif;
        }

        .sibyl-header {
            background-color: var(--color1) !important;
            color: #fff !important;
        }

        .sibyl-header h1 {
            color: inherit !important;
            font-family: 'Thasadith', sans-serif;
            font-weight: 400 !important;
        }


        .sibyl-review-slider {
            background-color: #f1e8d6 !important;
            font-family: 'Thasadith', sans-serif;
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

        .movie-menu a {
            font-family: 'Thasadith', sans-serif !important;
        }


        .footer-tab button {
            background-color: transparent;
            border: none;
            color: #fff;
        }

        .footer-tab button:focus {
            outline: none;
        }

        .localisation-dropdown {
            position: absolute;
            top: 15px;
            right: 20px;
            text-align: right;
            border-radius: 4px;
            z-index: 200;
        }

        .localisation-dropdown ul {
            margin: 0;
            padding: 0;
            list-style: none;
            background-color: transparent;
            border: solid 1px #fff;
            color: #fff;
        }

        .localisation-dropdown li:not(:first-child) {
            border-top: solid 1px #fff;
        }

        .localisation-dropdown a {
            display: inline-block;
            color: inherit;
            font-weight: 600;
            transition: all .2s;
            padding: 4px 8px;
        }

        .localisation-dropdown a:focus,
        .localisation-dropdown a:hover {
            color: #fff;
            text-decoration: none;
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
    <header class="movie-header sibyl-header position-relative text-white text-center py-3">
        <h1 class="text-center m-0">{{ $movie_details->movie_title }}
            - {{ $movie_details->tagline_fr }}</h1>

        {{--        <div class="flags">--}}
        {{--            <img data-lang="en" src="{{ asset('images/uk.png') }}" class="d-none" alt="">--}}
        {{--            <img data-lang="nl" src="{{ asset('images/nl.svg') }}" class="d-block" alt="">--}}
        {{--        </div>--}}

        <div class="localisation-dropdown" x-data="{ open: false }">
            <ul
                @mouseenter="open = true"
                @mouseleave="open = false"
            >
                <li><a href="javascript:void(0)">FR</a></li>
                <li x-show="open"><a href=" {{ URL::to('/') }}/cunninghamBE">NL</a></li>
            </ul>
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
                            <li><a href="#" class="menu-link tablink" onclick="openPage('bp', this)" id="defaultOpen">Cinémas</a>
                            </li>
                            <li><a href="#" class="menu-link tablink" onclick="openPage('vdo', this)">Vidéos</a></li>
                            <li><a href="#" class="menu-link tablink" onclick="openPage('sy', this)">Synopsis</a></li>
                        <!-- <li><a href="https://picl.nl/films/bacurau/" target="_blank" class="menu-link"><img
                                        class="menu-logo" src="{{ asset('/images/picl.png') }}" alt=""></a></li> -->
                            <li class="hastag">{{ $movie_details->hashtag }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>


    <div class="movie-content sib text-white">
        <div id="bp" class="tabcontent container-fluid">
            <div class="row">
                <div class="col-xl-4 col-lg-6 poster-hide">
                    <div class="poster">
                        <img
                            loading="lazy"
                            class="d-block mx-auto"
                            src="{{ $movie_details->image1 }}"
                            alt="{{ $movie_details->movie_title_fr }}.{{$movie_details->movie_description_short_fr}}">

                        <p class="d-md-none text-center m-0 mb-2">{{ $movie_details->movie_title_fr }}
                            - {{ $movie_details->movie_description_short_fr }}</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 ">
                    <div class="showtimes">
                        <form class="search-form">
                            <input class="search-input map-search" type="text" name="search"
                                   placeholder="Chercher.."
                                   autocomplete="off">
                            <button class="search-button" type="submit">&times;</button>
                        </form>

                        <div class="search-meta text-center my-2">
                            <p>ENTRER LIEU CI-DESSUS OU SÉLECTIONNER LE THÉÂTRE CI-DESSOUS</p>
                            <p>PLUS DE SÉANCES TROUVÉES DANS LES VILLES CI-DESSOUS</p>

                            <div class="main-accordion accordion d-none" id="mainAccordionId"></div>
                            <div class="city-accordion accordion d-none" id="cityAccordionId"></div>

                        </div>

                        <ul class="city-map-js my-3"></ul>


                        <div class="synopsis desk-sy">
                            <h3 class="text-center mb-2 my-3" style="text-decoration: none">
                                {{ $movie_details->movie_description_short_fr }}
                            </h3>
                            <p>
                                {{ $movie_details->movie_description_long_fr }}
                            </p>
                        </div>

                        <p class="text-center my-2">DÉCOUVREZ LA BANDE-ANNONCE</p>

                        <div class="youtube-trailer">
                            <div class="iframe-container mb-2">
                                <iframe src="{{ $youtube_url }}" class="iframe-video"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 ">
                    @include('madre._map')
                </div>
            </div>
        </div>

        <div id="vdo" class="tabcontent container">
            <div class="row">
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
                    <img class="d-block w-100" src="{{ $movie_details->image1 }}" alt="">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="synopsis">
                        <h3 class="text-center mb-2">
                            {{ $movie_details->movie_description_short_fr }}
                        </h3>
                        <p>
                            {{ $movie_details->movie_description_long_fr }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="synopsis">
                        <div class="synopsis-meta mt-2">
                            <p><span>Réalisé par:</span> {{ $movie_details->director }}</p>
                            <p><span>Écrit par:</span> {{ $movie_details->writer }}</p>
                            <p><span>Produit par:</span> {{ $movie_details->producer }}</p>
                            <p><span>Moulages:</span> {{ $movie_details->actors }}</p>
                            <p><span>Durée:</span> {{ $movie_details->duration }}</p>
                            @if($rating >= 6)
                                <p><span>Ratings:</span> {{ $rating }}</p>
                            @else

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(count($reviews) > 0)
        <section class="review-area sibyl-review-area">
            <div class="container">
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
        </section>
    @endif

    <footer class="movie-footer sibyl-movie-footer text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">

                    <!-- Tab goes here -->
                    <div class="footer-tab" x-data="{ tab: '' }">
                        <div class="d-flex justify-content-between align-items-center">
                            <button :class="{ 'active': tab === 'cookies' }" @click="tab = 'cookies'">Cookies</button>
                            <button :class="{ 'active': tab === 'gebruiksvoorwaarden' }"
                                    @click="tab = 'gebruiksvoorwaarden'">Conditions d'utilisation
                            </button>
                            <button :class="{ 'active': tab === 'privacyPolicy' }" @click="tab = 'privacyPolicy'">
                                Protection Des Données
                            </button>
                            <button :class="{ 'active': tab === 'credits' }" @click="tab = 'credits'">Credits</button>
                        </div>

                        <hr class="bg-secondary">

                        <div x-show="tab === 'cookies'">
                            {{ $movie_details->cookies_fr }}
                        </div>
                        <div x-show="tab === 'gebruiksvoorwaarden'">
                            {{ $movie_details->terms_of_use_fr }}
                        </div>
                        <div x-show="tab === 'privacyPolicy'">
                            {{ $movie_details->privacy_policy_fr }}
                        </div>
                        <div x-show="tab === 'credits'">
                            {{ $movie_details->credits_fr }}
                        </div>
                    </div>
                    <!-- end of Tab here -->


                    <div class="footer-dist-logos d-flex justify-content-between align-items-center">
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
                        <p class="sibyl-copy-text">&copy; Tous les droits sont réservés {{$d_details['name']}},
                            Planetnine - <?= Date('Y') ?></p>
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

</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment-with-locales.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.31/moment-timezone.min.js"></script>
<script src='//api.tiles.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.js'></script>
<script src="{{ mix('js/mainBE.js') }}"></script>
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
            autoplay: true,
            autoplaySpeed: 5000,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
        });
    });
</script>


</body>
</html>



