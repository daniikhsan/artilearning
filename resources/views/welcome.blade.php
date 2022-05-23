
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <title>Artilearning</title>
    <link href="{{asset('template/landing-page/assets/images/artilearning-logo.png')}}" rel="icon">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('template/landing-page/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('template/landing-page/assets/css/templatemo-chain-app-dev.css')}}">
    <link rel="stylesheet" href="{{asset('template/landing-page/assets/css/animated.css')}}">
    <link rel="stylesheet" href="{{asset('template/landing-page/assets/css/owl.css')}}">

  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index.html" class="logo">
              <img src="{{asset('template/landing-page/assets/images/artilearning-logo.png')}}" alt="Artilearning">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li class="scroll-to-section"><a href="#top" class="active">Beranda</a></li>
              <li class="scroll-to-section"><a href="#services">Layanan</a></li>
              <li class="scroll-to-section"><a href="#about">Tentang</a></li>
              <li class="scroll-to-section"><a href="#clients">Testimoni</a></li>
              <li class="scroll-to-section"><a href="#newsletter">Kontak</a></li>
              <li><div class="gradient-button"><a id="modal_trigger" href="{{ route('login') }}"><i class="fa fa-sign-in-alt"></i> Masuk</a></div></li> 
            </ul>        
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->
  
  <div id="modal" class="popupContainer" style="display:none;">
    <div class="popupHeader">
        <span class="header_title">Login</span>
        <span class="modal_close"><i class="fa fa-times"></i></span>
    </div>

    <section class="popupBody">
        <!-- Social Login -->
        <div class="social_login">
            <div class="">
                <a href="#" class="social_box fb">
                    <span class="icon"><i class="fab fa-facebook"></i></span>
                    <span class="icon_title">Connect with Facebook</span>

                </a>

                <a href="#" class="social_box google">
                    <span class="icon"><i class="fab fa-google-plus"></i></span>
                    <span class="icon_title">Connect with Google</span>
                </a>
            </div>

            <div class="centeredText">
                <span>Or use your Email address</span>
            </div>

            <div class="action_btns">
                <div class="one_half"><a href="#" id="login_form" class="btn">Login</a></div>
                <div class="one_half last"><a href="#" id="register_form" class="btn">Sign up</a></div>
            </div>
        </div>

        <!-- Username & Password Login form -->
        <div class="user_login">
            <form>
                <label>Email / Username</label>
                <input type="text" />
                <br />

                <label>Password</label>
                <input type="password" />
                <br />

                <div class="checkbox">
                    <input id="remember" type="checkbox" />
                    <label for="remember">Remember me on this computer</label>
                </div>

                <div class="action_btns">
                    <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
                    <div class="one_half last"><a href="#" class="btn btn_red">Login</a></div>
                </div>
            </form>

            <a href="#" class="forgot_password">Forgot password?</a>
        </div>

        <!-- Register Form -->
        <div class="user_register">
            <form>
                <label>Full Name</label>
                <input type="text" />
                <br />

                <label>Email Address</label>
                <input type="email" />
                <br />

                <label>Password</label>
                <input type="password" />
                <br />

                <div class="checkbox">
                    <input id="send_updates" type="checkbox" />
                    <label for="send_updates">Send me occasional email updates</label>
                </div>

                <div class="action_btns">
                    <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
                    <div class="one_half last"><a href="#" class="btn btn_red">Register</a></div>
                </div>
            </form>
        </div>
    </section>
</div>

  <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                <div class="row">
                  <div class="col-lg-12">
                    <h2>Artilearning</h2>
                    <p>Smart Quality Learning. Kuis asik tidak panik</p>
                  </div>
                  <!-- <div class="col-lg-12">
                    <div class="white-button first-button scr'oll-to-section">
                      <a href="#contact">Download me <i class="fab fa-apple"></i></a>
                    </div>
                    <div class="white-button scroll-to-section">
                      <a href="#contact">Download me <i class="fab fa-google-play"></i></a>
                    </div>
                  </div> -->
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="{{asset('template/landing-page/assets/images/test-online.png')}}" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="services" class="services section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
            <h4>Akses <em>Layanan Kami &amp; Fitur</em> untukmu</h4>
            <img src="{{asset('template/landing-page/assets/images/heading-line-dec.png')}}" alt="">
            <p>Gunakan semua fitur dengan navigasi yang mudah. Login sekarang dan buat kuismu sendiri. Hubungi kami langsung jika mengalami kesulitan.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="service-item second-service">
            <div class="icon"></div>
            <h4>Tambahkan Kursus </h4>
            <p>Tambahkan subjek pelajaran layaknya seperti yang ada di sekolah/kampus nyata.</p>
            <div class="text-button">
              <a href="{{ route('login') }}">Masuk Sekarang <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="service-item third-service">
            <div class="icon"></div>
            <h4>Jalankan Quiz</h4>
            <p>Mengerjakan kuis dari guru/dosen tidak ribet lagi. Masuk dan kerjakan sekarang.</p>
            <div class="text-button">
              <a href="{{ route('login') }}">Masuk Sekarang <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="service-item fourth-service">
            <div class="icon"></div>
            <h4>Dapatkan Analisis Quiz</h4>
            <p>Cek analisis hasil kuismu untuk ketahui kekuranganmu, jadi semangat latihan terus deh.</p>
            <div class="text-button">
              <a href="{{ route('login') }}">Masuk Sekarang <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="about" class="about-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="section-heading">
            <h4>Dukungan <em>Kami</em></h4>
            <img src="{{asset('template/landing-page/assets/images/heading-line-dec.png')}}" alt="">
            <p>Kami terus berusaha untuk selalu ada buat kamu. Dukung terus sistem belajar anti ribet bersama Artilearning</p>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="box-item">
                <h4><a href="#">Admin Email 24/7</a></h4>
                <p>admin@artilearning.co</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="box-item">
                <h4><a href="#">Pemeliharaan Sistem</a></h4>
                <p>Terjadwal dan berkala</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="box-item">
                <h4><a href="#">Cadangan Database</a></h4>
                <p>Aman dan tenang</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="box-item">
                <h4><a href="#">Sistem Up to Date</a></h4>
                <p>Selalu mengikuti perubahan</p>
              </div>
            </div>
            <div class="col-lg-12">
              <p>Kami akan terus berusaha meningkatkan layanan kami</p>
              <div class="gradient-button">
                <a href="{{ route('login') }}">Masuk Sekarang</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="right-image">
            <img src="{{asset('template/landing-page/assets/images/about-right-dec.png')}}" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="clients" class="the-clients">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading">
            <h4>Apa kata mereka <em>setelah menggunakan</em> Artilearning</h4>
            <img src="{{asset('template/landing-page/assets/images/heading-line-dec.png')}}" alt="">
            <p>Cek testimoni para pengguna kami dari setiap institusi yang sudah menggunakan Artilearing. Sekolah/kampusmu jangan sampai ketinggalan yaa.</p>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="naccs">
            <div class="grid">
              <div class="row">
                <div class="col-lg-7 align-self-center">
                  <div class="menu">
                    <div class="first-thumb active">
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-4 col-sm-4 col-12">
                            <h4>Zain Alfarizy</h4>
                            <span class="date">10 Maret 2022</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                            <span class="category">SMA Melati Samarinda</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 col-12">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <span class="rating">4.8</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-4 col-sm-4 col-12">
                            <h4>Bima Anggara</h4>
                            <span class="date">27 April 2022</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                            <span class="category">Universitas Mulia Samarinda</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 col-12">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <span class="rating">4.5</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-4 col-sm-4 col-12">
                            <h4>Na Jaemin</h4>
                            <span class="date">01 Mei 2022</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                            <span class="category">Universitas Lambung Mangkurat</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 col-12">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <span class="rating">4.7</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-4 col-sm-4 col-12">
                            <h4>Reynanda Alfi</h4>
                            <span class="date">07 Mei 2022</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                            <span class="category">STIE Madani Balikpapan</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 col-12">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <span class="rating">4.3</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="last-thumb">
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-4 col-sm-4 col-12">
                            <h4>Marky Arfis</h4>
                            <span class="date">23 Mei 2022</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                            <span class="category">SMA Negeri 1 Penajam</span>
                          </div>
                          <div class="col-lg-4 col-sm-4 col-12">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <span class="rating">4.3</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 
                <div class="col-lg-5">
                  <ul class="nacc">
                    <li class="active">
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="client-content">
                                <img src="{{asset('template/landing-page/assets/images/quote.png')}}" alt="">
                                <p>“Biasanya habis kurang jarang dikasih feedback, pakai Artilearning jadi tau kekurangan secara langsung tanpa
                                  harus nunggu feedback dari guru.”</p>
                              </div>
                              <div class="down-content">
                                <img src="{{asset('template/landing-page/assets/images/hyun.jpg')}}" alt="">
                                <div class="right-content">
                                  <h4>Zain Alfarizy</h4>
                                  <span>Kelas XII, IPA</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="client-content">
                                <img src="{{asset('template/landing-page/assets/images/quote.png')}}" alt="">
                                <p>“Dosen suka ngadain kuis dadakan, pas kebetulan lagi kerja karena kuliah sambil kerja,
                                  pakai artilearning jadi mudah bisa kerjain kapan aja dimana aja.”</p>
                              </div>
                              <div class="down-content">
                                <img src="{{asset('template/landing-page/assets/images/yedam.jpg')}}" alt="">
                                <div class="right-content">
                                  <h4>Bima Anggara</h4>
                                  <span>Teknik Informatika</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="client-content">
                                <img src="{{asset('template/landing-page/assets/images/quote.png')}}" alt="">
                                <p>“Kuis-kuis yang ada di Artilearning rinci banget ada history waktunya. Jadi gak ribet mencari 
                                  kuis yang sudah lama.”</p>
                              </div>
                              <div class="down-content">
                                <img src="{{asset('template/landing-page/assets/images/jae.jpg')}}" alt="">
                                <div class="right-content">
                                  <h4>Na Jaemin</h4>
                                  <span>Ilmu Komunikasi</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="client-content">
                                <img src="{{asset('template/landing-page/assets/images/quote.png')}}" alt="">
                                <p>“Analisis hasil kuis di artilearning membuat saya jadi lebih mudah mengetahui pelajaran yang 
                                  menjadi kesukaan saya dan yang tidak begitu saya pahami.”</p>
                              </div>
                              <div class="down-content">
                                <img src="{{asset('template/landing-page/assets/images/jojo.jpg')}}" alt="">
                                <div class="right-content">
                                  <h4>Reynanda Alfi</h4>
                                  <span>Perbankan</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="client-content">
                                <img src="{{asset('template/landing-page/assets/images/quote.png')}}" alt="">
                                <p>“Tampilannya sistemnya gak ribet. Sekali pakai langsung paham karena tidak terlalu 
                                  banyak fitur dalam satu sistem.”</p>
                              </div>
                              <div class="down-content">
                                <img src="{{asset('template/landing-page/assets/images/yoshi.jpg')}}" alt="">
                                <div class="right-content">
                                  <h4>Marky Arfis</h4>
                                  <span>Kelas X, IPA</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>          
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer id="newsletter">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading">
            <h4>Bergabung bersama kami</h4>
          </div>
        </div>
        <div class="col-lg-6 offset-lg-3">
          <form id="search" action="#" method="GET">
            <div class="row">
              <div class="col-lg-6 col-sm-6">
                <fieldset>
                  <input type="address" name="address" class="email" placeholder="Email Address..." autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-6 col-sm-6">
                <fieldset>
                  <button type="submit" class="main-button">newsletter <i class="fa fa-angle-right"></i></button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row text-center">
        <div class="col-lg-12">
          <div class="footer-widget">
            <h4>Hubungi Kami</h4>
            <p>Kampus ITK, Jl. Sein Wain, Balikpapan, Indonesia</p>
            <p><a href="#">(0542) 8530801</a></p>
            <p><a href="#">admin@artilearning.co</a></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="copyright-text">
            <p>Artilearning Dev
          <br><a href="https://www.instagram.com/ayyndrayy/" target="_blank" title="css templates">Re-designed by Team 6</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>


  <!-- Scripts -->
  <script src="{{asset('template/landing-page/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('template/landing-page/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('template/landing-page/assets/js/owl-carousel.js')}}"></script>
  <script src="{{asset('template/landing-page/assets/js/animation.js')}}"></script>
  <script src="{{asset('template/landing-page/assets/js/imagesloaded.js')}}"></script>
  <script src="{{asset('template/landing-page/assets/js/popup.js')}}"></script>
  <script src="{{asset('template/landing-page/assets/js/custom.js')}}"></script>
</body>
</html>