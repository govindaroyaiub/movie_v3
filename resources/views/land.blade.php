<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Movie Platform | Planetnine.com</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">
  <link href="{{ mix('css/main.css') }}" rel="stylesheet">
  <style>
    @font-face {
      font-family: 'PlanetNineBold';
      src: url('./fonts/p9-font/PlanetNineBold.woff');
    }
    
    @font-face {
      font-family: 'PlanetNineBoldCondensed';
      src: url('./fonts/p9-font/PlanetNineBoldCondensed.woff');
    }
    
    @font-face {
      font-family: 'PlanetNineBook';
      src: url('./fonts/p9-font/PlanetNineBook.woff');
    }
    
    @font-face {
      font-family: 'PlanetNineMedium';
      src: url('./fonts/p9-font/PlanetNineMedium.woff');
    }
    
    @font-face {
      font-family: 'PlanetNineMediumCondensed';
      src: url('./fonts/p9-font/PlanetNineMediumCondensed.woff');
    }
    
    :root {
      --brand: #4b4e6d;
      --text: #80e4da;
      --red: #a40707;
    }
    
    body {
      font-family: 'PlanetNineBook', sans-serif;
    }
    
    img {
      max-width: 100%;
      height: auto;
    }
    
    .p9-search-form {
      margin-right: 10px;
    }
    
    .p9-search-input {
      border: 0;
      padding: 5px 10px;
      min-width: 330px;
      font-family: inherit;
      font-size: 20px;
      border-top-left-radius: 2px;
      border-bottom-left-radius: 2px;
      margin-right: -5px;
      border: solid 1px #303436;
      background: #181a1b;
    }
    
    .p9-search-input:focus {
      outline: none;
    }
    
    .p9-search-btn {
      background: var(--red);
      border: 0;
      padding: 7px 12px;
      font-size: 18px;
      color: #fff;
      border-top-right-radius: 2px;
      border-bottom-right-radius: 2px;
    }
    
    .p9-header {
      background-color: var(--brand);
      color: #fff;
      padding: 20px 0;
    }
    
    .p9-header-top {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    
    .p9-header-top span:nth-of-type(2) {
      font-size: 20px;
      margin-top: 20px;
    }
    
    .p9-bar {
      color: var(--text);
      display: inline-block;
      margin: 1rem 1rem 0;
    }
    
    .p9-header-top p {
      font-size: 20px;
    }
    
    .p9-header-bottom {
      background-color: #20232a;
      color: #fff;
      padding: 20px 0;
    }
    
    .p9-login-btn {
      background: var(--red);
      border: solid 1px var(--red);
      display: inline-block;
      padding: 8px 38px;
      font-size: 20px;
      font-family: inherit;
      color: #fff;
      border-radius: 2px;
      transition: all .2s;
    }
    
    .p9-login-btn:hover {
      border: solid 1px var(--red);
      background: transparent;
      color: var(--text);
      text-decoration: none;
    }
    
    .p9-toggler {
      cursor: pointer;
      font-size: 30px;
      margin-left: 50px;
    }
    
    
    .p9-menu {
      position: relative;
    }
    
    .p9-menu ul {
      margin: 0;
      padding: 0;
      list-style: none;
    }
    
    #menu {
      background: rgba(0,0,0,.8);
      width: 90%;
      margin: 0 auto;
      position: fixed;
      top: 200px;
      right: 0;
      left: 0;
      z-index: 41;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      border-radius: 16px;
      padding: 100px 30px;
      opacity: 0;
      visibility: none;
      transition: all .5s;
      transform: translateY(100%);
    }
    
    .p9-toggler:hover {
      transform: translateY(0);
    }
    
    #menu a {
      font-size: 30px;
      color: #fff;
      margin: 1rem 0;
      transition: all .2s;
    }
    
    #menu a:hover {
      color: var(--text);
      text-decoration: none;
    }
    
    .p9-menu-close {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: transparent;
      border: 0;
      color: #fff;
      font-size: 30px;
    }
    
    .p9-menu-close:focus {
      outline: 0;
    }
    
    .p9-intro {
      background: url('./images/p9-bg.png');
      color: #fff;
      padding: 50px 0;
      font-family: 'PlanetNineMedium';
      font-size: 40px;
    }
    
    .p9-intro h3 {
      margin: 0;
      color: var(--text);
    }
    
    .p9-movies {
      background-color: #2a2f3a;
      color: #fff;
      padding: 35px 0;
    }
    
    .p9-features {
      background-color: #20232a;
      color: #fff;
      padding-top: 50px;
    }
    
    .p9-features h3 {
      color: var(--text);
      margin-bottom: 50px;
      font-family: 'PlanetNineMedium';
      font-size: 30px;
    }
    
    .p9-feature {
      display: flex;
      margin-bottom: 40px;
    }
    
    .p9-icon {
      background: var(--brand);
      padding: 1rem;
      margin-right: 20px;
      border-radius: 50%;
      width: 65px;
      height: 65px;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    
    .p9-content h4 {
      font-family: 'PlanetNineMediumCondensed';
      font-size: 24px;
    }
    
    .p9-content p {
      font-size: 15px;
    }
    
    .p9-footer {
      background-color: #2a2f3a;
      color: #828488;
      padding: 65px 0;
    }
    
    .p9-footer ul {
      margin: 0;
      padding: 0;
      list-style: none;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .p9-footer a {
      color: #fff;
      font-size: inherit;
      font-size: 15px;
    }
    
    .slide-arrow {
      position: absolute;
      top: 35%;
      display: block;
      background: rgba(0,0,0,.5);
      padding: 2rem 1rem;
      font-size: 20px;
      cursor: pointer;
      transition: all .2s;
      z-index: 10;
    }
    
    .slide-arrow:hover {
      background: rgba(0,0,0,1);
    }
    
    .prev-arrow{
      left: -22px;
    }
    
    .next-arrow{
      right: 5px;
    }
    
    .overlay-open {
      height: 100vh;
      overflow-y: hidden;
    }
    
    @media (max-width: 575.98px) { 
      .p9-header > .container {
        flex-direction: column
      }
      .p9-header-top {
        margin: 10px;
      }

      .p9-intro h3 {
        font-size: 15px;
      }

      .p9-header-top img {
        width: 150px;
      }
      
      .p9-login-btn {
        padding: 2px 30px;
      }
      
      .p9-bar {
        margin: .5rem 1rem 0 1rem;
      }

      .p9-search-input {
        min-width: 150px;
        padding: 1px 10px;
      }

      .p9-search-btn {
        padding: 4px 12px;
      }

      nav {
        justify-content: center;
        align-items: center;
      }

      #menu {
        padding: 30px;
      }

      #menu a {
        font-size: 20px;
        margin: 5px 0;
      }

      .p9-search-input {
        width: 155px;
      }
      
      .p9-header-top span:nth-of-type(2) {
        font-size: 13px;
        margin-top: 10px;
      }
      
      .p9-intro {
        padding: 20px 0;
      }
      
      .p9-movies {
        padding: 5px 0;
      }
      
      .p9-features {
        padding: 20px;
      }
      .p9-features h3 {
        font-size: 18px;
        margin-bottom: 20px;
      }
      
      .p9-content h4 {
        font-size: 18px;
      }
      
      .p9-content p {
        font-size: 12px;
      }
      
      .p9-icon {
        width: 50px;
        height: 50px;
      }
      
      .p9-feature {
        margin-bottom: 20px;
      }
      
      .p9-footer {
        padding: 20px 0;
      }
      
      .p9-footer a {
        font-size: 12px;
      }
      
      .next-arrow {
        right: -15px;
      }
    }
  </style>
</head>
<body>
  <header class="p9-header">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="p9-header-top">
        <a href=""><img src="{{ asset('/images/logo.png') }}" alt="planetnine"></a>
        <span class="p9-bar">|</span>
        <span>Movie Platform</span>
      </div>
      
      <nav class="d-flex">
        <a class="p9-login-btn" href="/login">Login</a>
        <div class="p9-toggler">☰</div>
      </nav>
    </div>
  </header>
  
  <section class="p9-menu">
    <ul id="menu">
      <button class="p9-menu-close">&times;</button>
      <li><a href="#">Movie Lists</a></li>
      <li><a href="#">Showtimes</a></li>
      <li><a href="#">See in Map</a></li>
      <li><a href="#">Find in your language</a></li>
    </ul>
  </section>
  
  <section class="p9-header-bottom">
    <div class="container d-flex justify-content-end">
      <form class="p9-search-form" class="d-flex" action="" method="POST">
        <input class="p9-search-input" type="search" name="q" placeholder="search" autocomplete="off">
        <button class="p9-search-btn"><i class="fa fa-search"></i></button>
      </form>
      
      <div class="d-flex">
        <img width="38" class="mr-2" src="{{ asset('images/us.svg') }}" alt="">
        <img width="38" src="{{ asset('images/nl.svg') }}" alt="">
      </div>
    </div>
  </section>
  
  <section class="p9-intro">
    <div class="container">
      <h3 class="text-center">- The easiest platform to promote arthouse cinema -</h3>
    </div>
  </section>
  
  <section class="p9-movies">
    <div class="container">
      <div class="slider movie-slider">
        <div>
          <a href="#"><img src="{{ asset('/images/poster0.jpg') }}" alt="poster"></a>
        </div>
        <div>
          <a href="#"><img src="{{ asset('/images/poster1.jpg') }}" alt="poster"></a>
        </div>
        <div>
          <a href="#"><img src="{{ asset('/images/poster2.jpg') }}" alt="poster"></a>
        </div>
        <div>
          <a href="#"><img src="{{ asset('/images/poster3.jpg') }}" alt="poster"></a>
        </div>
        <div>
          <a href="#"><img src="{{ asset('/images/poster4.jpg') }}" alt="poster"></a>
        </div>
        <div>
          <a href="#"><img src="{{ asset('/images/poster0.jpg') }}" alt="poster"></a>
        </div>
        <div>
          <a href="#"><img src="{{ asset('/images/poster1.jpg') }}" alt="poster"></a>
        </div>
        <div>
          <a href="#"><img src="{{ asset('/images/poster2.jpg') }}" alt="poster"></a>
        </div>
        <div>
          <a href="#"><img src="{{ asset('/images/poster3.jpg') }}" alt="poster"></a>
        </div>
        <div>
          <a href="#"><img src="{{ asset('/images/poster4.jpg') }}" alt="poster"></a>
        </div>
        <div>
          <a href="#"><img src="{{ asset('/images/poster0.jpg') }}" alt="poster"></a>
        </div>
        <div>
          <a href="#"><img src="{{ asset('/images/poster1.jpg') }}" alt="poster"></a>
        </div>
      </div>
    </div>
  </section>
  
  <section class="p9-features">
    <div class="container">
      <h3 class="text-center">Easy deployment of marketing campaigns featuring</h3>
      
      <div class="row">
        
        <div class="col-md-4">
          <div class="p9-feature">
            <div class="p9-icon"><img src="{{ asset('/images/trailer.png') }}" alt="trailer"></div>
            <div class="p9-content">
              <h4>TRAILER</h4>
              <p>All-inclusive ticketing available along with showtimes.</p>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="p9-feature">
            <div class="p9-icon"><img src="{{ asset('/images/responsive.png') }}" alt="responsive"></div>
            <div class="p9-content">
              <h4>RESPONSIVE</h4>
              <p>Watch YouTube trailers at the first glance.</p>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="p9-feature">
            <div class="p9-icon"><img src="{{ asset('/images/showtime.png') }}" alt="showtimes"></div>
            <div class="p9-content">
              <h4>SHOWTIMES</h4>
              <p>Exclusive content available for higher conversion and interest.</p>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="p9-feature">
            <div class="p9-icon"><img src="{{ asset('/images/multilang.png') }}" alt="multilang"></div>
            <div class="p9-content">
              <h4>MULTI LANGUAGE</h4>
              <p>Get all the cinemas along with their location on map.</p>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="p9-feature">
            <div class="p9-icon"><img src="{{ asset('/images/analytics.png') }}" alt="analytics"></div>
            <div class="p9-content">
              <h4>ANALYTICS</h4>
              <p>Read what the critics say about the movie.</p>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="p9-feature">
            <div class="p9-icon"><img src="{{ asset('/images/easy.png') }}" alt="easy"></div>
            <div class="p9-content">
              <h4>EASY</h4>
              <p>Read what the critics say about the movie.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <footer class="p9-footer">
    <div class="container">
      <ul>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms and Conditions</a></li>
        <li><a href="#">Credits</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
  </footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.movie-slider').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false,
        focusOnSelect: true,
        margin: 10,
        prevArrow: '<span class="slide-arrow prev-arrow"><i class="fa fa-chevron-left"></i></span>',
        nextArrow: '<span class="slide-arrow next-arrow"><i class="fa fa-chevron-right"></i></span>',
        responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true,
          }
        }
        ]
      });
      
      
      var p9Toggler = document.querySelector('.p9-toggler');
      var p9Close = document.querySelector('.p9-menu-close');
      var p9Menu = document.querySelector('#menu');
      
      p9Toggler.addEventListener('click', () => {
        p9Menu.style.opacity = '1';
        p9Menu.style.visibility = 'visible';
        p9Menu.style.transform = 'translateY(0%)';
      });
      
      p9Close.addEventListener('click', () => {
        p9Menu.style.opacity = '0';
        p9Menu.style.visibility = 'none';
        p9Menu.style.transform = 'translateY(100%)';
      });
    });
  </script>
</body>
</html>