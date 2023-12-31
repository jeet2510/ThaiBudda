<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 
    - primary meta tags
  -->
  <title>ThaiBudda</title>
  <meta name="title" content="ThaiBudda - The Orderman">
  <meta name="description" content="ThaiBudda restaurant website">

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./images/ThaiBudda.jpg" type="image/svg+xml">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Forum&display=swap" rel="stylesheet">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./css/menustyle.css">

  <!-- 
    - preload images
  -->
  <link rel="preload" as="image" href="./images/hero-slider-1.jpg">
  <link rel="preload" as="image" href="./images/hero-slider-2.jpg">
  <link rel="preload" as="image" href="./images/hero-slider-3.jpg">

</head>

<body id="top">

  <!-- 
    - #PRELOADER
  -->

  <div class="preload" data-preaload>
    <div class="circle"></div>
    <p class="text">ThaiBudda</p>
  </div>





  <!-- 
    - #TOP BAR
  -->

  <div class="topbar">
    <div class="container">

      <address class="topbar-item">
        <div class="icon">
          <ion-icon name="location-outline" aria-hidden="true"></ion-icon>
        </div>

        <span class="span">
          1/35 William St, Bathurst NSW 2795, Australia
        </span>
      </address>

      <div class="separator"></div>

      <div class="topbar-item item-2">
        <div class="icon">
          <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
        </div>

        <span class="span">Daily : 8.00 am to 10.00 pm</span>
      </div>

      <a href="tel:+11234567890" class="topbar-item link">
        <div class="icon">
          <ion-icon name="call-outline" aria-hidden="true"></ion-icon>
        </div>

        <span class="span"><a href="tel: +61 472 728 989">+61 472 728 989</a></span>
      </a>

      <div class="separator"></div>

      <a href="mailto:booking@restaurant.com" class="topbar-item link">
        <div class="icon">
          <ion-icon name="mail-outline" aria-hidden="true"></ion-icon>
        </div>

        <span class="span"><a href="mailto:thaibuddaonline@gmail.com">thaibuddaonline@gmail.com</a></span>
      </a>

    </div>
  </div>





  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <a href="/" class="logo">
        <img src="./images/ThaiBudda.jpg" width="100" height="100" alt="Grilli - Home">
      </a>

      <nav class="navbar" data-navbar>

        <button class="close-btn" aria-label="close menu" data-nav-toggler>
          <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
        </button>

        <a href="/" class="logo">
          <img src="./images/ThaiBudda.jpg" width="100" height="100" alt="Grilli - Home">
        </a>

        <ul class="navbar-list">

          <li class="navbar-item">
            <a href="/" class="navbar-link hover-underline active">
              <div class="separator"></div>

              <span class="span">Home</span>
            </a>
          </li>

          <li class="navbar-item">
            <a href="#menu" class="navbar-link hover-underline">
              <div class="separator"></div>

              <span class="span">Menus</span>
            </a>
          </li>

         

          <li class="navbar-item">
            <a href="/#reservation" class="navbar-link hover-underline">
              <div class="separator"></div>

              <span class="span">Contact</span>
            </a>
          </li>
          @if (isset(auth()->user()->name))
                        <li class="navbar-item">
                            <div class="navbar-link hover-underline dropdown">
                                {{-- <div class="separator"></div> --}}
                                <button class="span dropbtn">{{ Str::upper(auth()->user()->name) }}</button>
                                <div class="dropdown-content">
                                    <a href="{{ route('profile.edit') }}">Profile</a>
                                    <form method="post" action="{{ route('logout') }}">
                                        @csrf
                                        <a onclick="this.parentNode.submit();" class="cursor-pointer">Logout</a>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="navbar-item">
                            <a href="{{ route('login') }}" class="navbar-link hover-underline">
                                <div class="separator"></div>
                                <span class="span">Login</span>
                            </a>
                        </li>
                        <li class="navbar-item">
                            <a href="{{ route('register') }}" class="navbar-link hover-underline">
                                <div class="separator"></div>
                                <span class="span">Register</span>
                            </a>
                        </li>
                    @endif
        </ul>

        <div class="text-center">
          <p class="headline-1 navbar-title">Visit Us</p>

          <address class="body-4">
            1/35 William St, Bathurst NSW 2795, Australia
          </address>

          <p class="body-4 navbar-text">Open: 9.30 am - 2.30pm</p>

          <a href="mailto:thaibuddaonline@gmail.com">thaibuddaonline@gmail.com</a>

          <div class="separator"></div>

          <p class="contact-label">Booking Request</p>

          <a href="tel:+61 472 728 989" class="body-1 contact-number hover-underline">
            +61 472 728 989
          </a>
        </div>
        
      </nav>

      
       

       
      </a>

      <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
        <span class="line line-1"></span>
        <span class="line line-2"></span>
        <span class="line line-3"></span>
      </button>

      <div class="overlay" data-nav-toggler data-overlay></div>

    </div>
  </header>





  <main>
    <article>

      <!-- 
        - #SERVICE
      -->

      <!--<section class="section service bg-black-10 text-center" aria-label="service">
        <div class="container">

          <p class="section-subtitle label-2">Flavors For Royalty</p>

          <h2 class="headline-1 section-title">We Offer Top Notch</h2>

          <p class="section-text">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem Ipsum has been the industrys
            standard dummy text ever.
          </p>

          <ul class="grid-list">

            <li>
              <div class="service-card">

                <a href="#" class="has-before hover:shine">
                  <figure class="card-banner img-holder" style="--width: 285; --height: 336;">
                    <img src="./images/service-1.jpg" width="285" height="336" loading="lazy" alt="Breakfast"
                      class="img-cover">
                  </figure>
                </a>

                <div class="card-content">

                  <h3 class="title-4 card-title">
                    <a href="#">Breakfast</a>
                  </h3>

                  <a href="#" class="btn-text hover-underline label-2">View Menu</a>

                </div>

              </div>
            </li>

            <li>
              <div class="service-card">

                <a href="#" class="has-before hover:shine">
                  <figure class="card-banner img-holder" style="--width: 285; --height: 336;">
                    <img src="./images/service-2.jpg" width="285" height="336" loading="lazy" alt="Appetizers"
                      class="img-cover">
                  </figure>
                </a>

                <div class="card-content">

                  <h3 class="title-4 card-title">
                    <a href="#">Appetizers</a>
                  </h3>

                  <a href="#" class="btn-text hover-underline label-2">View Menu</a>

                </div>

              </div>
            </li>

            <li>
              <div class="service-card">

                <a href="#" class="has-before hover:shine">
                  <figure class="card-banner img-holder" style="--width: 285; --height: 336;">
                    <img src="./images/service-3.jpg" width="285" height="336" loading="lazy" alt="Drinks"
                      class="img-cover">
                  </figure>
                </a>

                <div class="card-content">

                  <h3 class="title-4 card-title">
                    <a href="#">Drinks</a>
                  </h3>

                  <a href="#" class="btn-text hover-underline label-2">View Menu</a>

                </div>

              </div>
            </li>

          </ul>

          <img src="./images/shape-1.png" width="246" height="412" loading="lazy" alt="shape"
            class="shape shape-1 move-anim">
          <img src="./images/shape-2.png" width="343" height="345" loading="lazy" alt="shape"
            class="shape shape-2 move-anim">

        </div>
      </section>

    -->



      <!-- 
        - #ABOUT
      -->

     <!-- <section class="section about text-center" aria-labelledby="about-label" id="about">
        <div class="container">

          <div class="about-content">

            <p class="label-2 section-subtitle" id="about-label">Our Story</p>

            <h2 class="headline-1 section-title">Every Fla vor Tells a Story</h2>

            <p class="section-text">
              Lorem Ipsum is simply dummy text of the printingand typesetting industry lorem Ipsum has been the
              industrys standard dummy text ever since the when an unknown printer took a galley of type and scrambled
              it to make a type specimen book It has survived not only five centuries, but also the leap into.
            </p>

            <div class="contact-label">Book Through Call</div>

            <a href="tel:+804001234567" class="body-1 contact-number hover-underline">+80 (400) 123 4567</a>

            <a href="#" class="btn btn-primary">
              <span class="text text-1">Read More</span>

              <span class="text text-2" aria-hidden="true">Read More</span>
            </a>

          </div>

          <figure class="about-banner">

            <img src="./images/about-banner.jpg" width="570" height="570" loading="lazy" alt="about banner"
              class="w-100" data-parallax-item data-parallax-speed="1">

            <div class="abs-img abs-img-1 has-before" data-parallax-item data-parallax-speed="1.75">
              <img src="./images/about-abs-image.jpg" width="285" height="285" loading="lazy" alt=""
                class="w-100">
            </div>

            <div class="abs-img abs-img-2 has-before">
              <img src="./images/badge-2.png" width="133" height="134" loading="lazy" alt="">
            </div>

          </figure>

          <img src="./images/shape-3.png" width="197" height="194" loading="lazy" alt="" class="shape">

        </div>
      </section>

-->



      <!-- 
        - #SPECIAL DISH
      -->

    <!--  <section class="special-dish text-center" aria-labelledby="dish-label">

        <div class="special-dish-banner">
          <img src="./images/special-dish-banner.jpg" width="940" height="900" loading="lazy" alt="special dish"
            class="img-cover">
        </div>

        <div class="special-dish-content bg-black-10">
          <div class="container">

            <img src="./images/badge-1.png" width="28" height="41" loading="lazy" alt="badge" class="abs-img">

            <p class="section-subtitle label-2">Special Dish</p>

            <h2 class="headline-1 section-title">Lobster Tortellini</h2>

            <p class="section-text">
              Lorem Ipsum is simply dummy text of the printingand typesetting industry lorem Ipsum has been the
              industrys standard dummy text ever since the when an unknown printer took a galley of type.
            </p>

            <div class="wrapper">
              <del class="del body-3">$40.00</del>

              <span class="span body-1">$20.00</span>
            </div>

            <a href="#" class="btn btn-primary">
              <span class="text text-1">View All Menu</span>

              <span class="text text-2" aria-hidden="true">View All Menu</span>
            </a>

          </div>
        </div>

        <img src="./images/shape-4.png" width="179" height="359" loading="lazy" alt="" class="shape shape-1">

        <img src="./images/shape-9.png" width="351" height="462" loading="lazy" alt="" class="shape shape-2">

      </section>

-->



      <!-- 
        - #MENU
      -->

      <section class="section menu menu-separate" aria-label="menu-label" id="menu">
        <div class="container">

          <!-- <p class="section-subtitle text-center label-2">Special Selection</p> -->

          <h2 class="headline-1 section-title text-center">Delicious Menu</h2>

          <ul class="grid-list">

          @foreach ($items as $item)
                            <li class="cardHover">
                                <div class="menu-card hover:card">
                                    <figure class="card-banner img-holder" style="--width: 100; --height: 100;">
                                        <img src="{{ asset('storage' . $item->image) }}" width="100"
                                            height="100" loading="lazy" alt="{{ $item->name }}" class="">
                                    </figure>

                                    <div>
                                        <div class="title-wrapper">
                                            <h3 class="title-3">
                                                {{ $item->name }}
                                            </h3>

                                            <span class="badge label-1">{{ $item->tag }}</span>

                                            <span class="span title-2">${{ $item->price }}</span>
                                        </div>

                                        <p class="card-text label-1">
                                            {{ $item->description }}
                                        </p>

                                        <div class="cardButtons">
                                            <a href="order/create?item_id={{ $item->id }}&type=book_table">
                                            <button class="demoBtn">Book a Table</button>                          </a>
                                            <a href="order/create?item_id={{ $item->id }}&type=pick_up">
                                            <button class="demoBtn">Pick Up</button>                      </a>
                                            <a href="order/create?item_id={{ $item->id }}&type=pick_up">
                                            <button class="demoBtn">Home Delivery</button>                        </a>
                                        </div>

                                    </div>
                                </div>
                            </li>
                        @endforeach
            
            <li>
              <div class="menu-card hover:card">

                <figure class="card-banner img-holder" style="--width: 100; --height: 100;">
                  <img src="./images/menu-6.png" width="100" height="100" loading="lazy" alt="Opu Fish"
                    class="img-cover">
                </figure>

                <div>

                  <div class="title-wrapper">
                    <h3 class="title-3">
                      <a href="#" class="card-title">Opu Fish</a>
                    </h3>

                    <span class="span title-2">$49.00</span>
                  </div>
                  <p class="card-text label-1">
                    Vegetables, cheeses, ground meats, tomato sauce, seasonings and spices
                  </p>
                </div>
              </div>
            </li>
            <li>
              <div class="menu-card hover:card">

                <figure class="card-banner img-holder" style="--width: 100; --height: 100;">
                  <img src="./images/menu-6.png" width="100" height="100" loading="lazy" alt="Opu Fish"
                    class="img-cover">
                </figure>

                <div>

                  <div class="title-wrapper">
                    <h3 class="title-3">
                      <a href="#" class="card-title">Opu Fish</a>
                    </h3>

                    <span class="span title-2">$49.00</span>
                  </div>
                  <p class="card-text label-1">
                    Vegetables, cheeses, ground meats, tomato sauce, seasonings and spices
                  </p>
                </div>
              </div>
            </li>
          </ul>
          
          <img src="./images/shape-5.png" width="921" height="1036" loading="lazy" alt="shape"
            class="shape shape-2 move-anim">
          <img src="./images/shape-6.png" width="343" height="345" loading="lazy" alt="shape"
            class="shape shape-3 move-anim">

        </div>
      </section>
    
  <!-- 
    - #FOOTER
  -->
  <footer class="footer section has-bg-image text-center"
    style="background-image: url('./images/footer-bg.jpg')">
    <div class="container">

      <div class="footer-top grid-list">

        <div class="footer-brand has-before has-after">

          <a href="#" class="logo">
            <img src="./images/ThaiBudda.jpg" width="100" height="100" loading="lazy" alt="grilli home">
          </a>

          <address class="body-4">
            1/35 William St, Bathurst NSW 2795, Australia
          </address>

          <a href="mailto:thaibuddaonline@gmail.com" class="body-4 contact-link">thaibuddaonline@gmail.com</a>

          <a href="tel:+61 472 728 989" class="body-4 contact-link">Booking Request : +61 472 728 989</a>

          <p class="body-4">
            Open : 09:00 am - 01:00 pm
          </p>

          <div class="wrapper">
            <div class="separator"></div>
            <div class="separator"></div>
            <div class="separator"></div>
          </div>

          <p class="title-1">Get News & Offers</p>

          <p class="label-1">
            Subscribe us & Get <span class="span">25% Off.</span>
          </p>

          <form action="{{route('subscribe')}}" class="input-wrapper">
            @csrf
            <div class="icon-wrapper">
              <ion-icon name="mail-outline" aria-hidden="true"></ion-icon>

              <input type="email" name="email" placeholder="Your email" autocomplete="off" class="input-field">
            </div>

            <button type="submit" class="btn btn-secondary">
              <span class="text text-1">Subscribe</span>

              <span class="text text-2" aria-hidden="true">Subscribe</span>
            </button>
          </form>

        </div>

        <ul class="footer-list">

          <li>
            <a href="/" class="label-2 footer-link hover-underline">Home</a>
          </li>

          <li>
            <a href="#menu" class="label-2 footer-link hover-underline">Menus</a>
          </li>

        

          

          <li>
            <a href="/#reservation" class="label-2 footer-link hover-underline">Contact</a>
          </li>

        </ul>

        <ul class="footer-list">

          <li>
            <a href="#" class="label-2 footer-link hover-underline">Facebook</a>
          </li>

          <li>
            <a href="#" class="label-2 footer-link hover-underline">Instagram</a>
          </li>

          <li>
            <a href="#" class="label-2 footer-link hover-underline">Twitter</a>
          </li>

          <li>
            <a href="#" class="label-2 footer-link hover-underline">Youtube</a>
          </li>

          <li>
            <a href="#" class="label-2 footer-link hover-underline">Google Map</a>
          </li>

        </ul>

      </div>

      <div class="footer-bottom">

        <p class="copyright">
          &copy; 2023 ThaiBudda. All Rights Reserved | Crafted by <a href="https://www.appcity.tech"
            target="_blank" class="link">AppCity</a>
        </p>

      </div>

    </div>
  </footer>





  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn active" aria-label="back to top" data-back-top-btn>
    <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="./js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>