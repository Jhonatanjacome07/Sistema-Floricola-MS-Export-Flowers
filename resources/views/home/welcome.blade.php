<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>MS EXPORT FLOWERS</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <section id="topbar" class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a
                        href="mailto:msexport@gmail.com">msexportflowers@gmail.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+593 989386555</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div>
        </div>
    </section><!-- End Top Bar -->

    <header id="header" class="header d-flex align-items-center">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="{{ route('home.welcome') }}" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="/images/logo.jpg" alt="Logo" width="90px" class="rounded-circle">
                <h1>MS EXPORT<span> FLOWERS</span></h1>
            </a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="#hero">Inicio</a></li>
                    <li><a href="#about">Sobre Nosotros</a></li>
                    <li><a href="#portfolio">Galeria</a></li>
                    <li><a href="#contact">Contacto</a></li>
                    <li>
                        @if (Route::has('login'))
                        @auth
                        <a href="{{ url('/dashboard') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @else
                        <a href="{{ route('login') }}" class="nav-link">Iniciar Sesión</a>
                        @endauth
                        @endif
                    </li>
                </ul>
            </nav><!-- .navbar -->
    
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        </div>

    </header><!-- End Header -->
    
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero">
        <div class="container position-relative">
            <div class="row gy-5" data-aos="fade-in">
                <div
                    class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                    <h2 class="fst-italic">Bienvenido a <span class="fst-italic">MS EXPORT FLOWERS</span></h2>
                    <p class="fst-italic" style="color:black;">MS Export Flowers es una empresa florícola ecuatoriana
                        con una amplia
                        experiencia en el cultivo y exportación de flores frescas de alta calidad.
                        Nos dedicamos a brindar a nuestros clientes un servicio integral, desde la producción hasta la
                        entrega final, con el objetivo de que disfruten de las mejores flores del Ecuador.</p>

                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="#about" class="btn-get-started">Get Started</a>
                        <a href="https://youtu.be/1o0qS9muB0E?si=Qsp41sq_V5WWFJVm"
                            class="glightbox btn-watch-video d-flex align-items-center"><i
                                class="bi bi-play-circle"></i><span>Watch Video</span></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <img src="assets/img/hero-img.svg" class="img-fluid" alt="" data-aos="zoom-out"
                        data-aos-delay="100">
                </div>
            </div>
        </div>

        <div class="icon-boxes position-relative">
            <div class="container position-relative">
                <div class="row gy-4 mt-5">

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-people"></i></div>
                            <h4 class="title"><a href="#about" class="stretched-link">
                                    <p class="fst-italic">Acerca de nosotros
                                </a></h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-flower3"></i></div>
                            <h4 class="title"><a href="#portfolio" class="stretched-link">
                                    <p class="fst-italic">Rosas
                                </a></h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-geo-alt"></i></div>
                            <h4 class="title"><a href="#contact" class="stretched-link">
                                    <p class="fst-italic">Contactanos
                                </a></h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-box-arrow-in-right"></i></div>
                            <h4 class="title"><a href="{{ route('login') }}" class="stretched-link">
                                    <p class="fst-italic">Iniciar sesión
                                </a></h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                </div>
            </div>
        </div>

        </div>
    </section>
    <!-- End Hero Section -->

    <main id="main">

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2 class="fst-italic">Sobre Nosotros</h2>
                    <p class="fst-italic" style="color:black;">Somos una empresa florícola ecuatoriana que nos dedicamos
                        al cultivo,
                        producción y exportación de flores frescas de la más alta calidad, satisfaciendo las necesidades
                        de nuestros clientes con un servicio personalizado y eficiente.</p>
                </div>

                <div class="row gy-4">
                    <div class="col-lg-6">
                        <h3 class="fst-italic">Nuestra Misión</h3>
                        <p class="fst-italic">Ser la empresa florícola líder en el mercado internacional, reconocida
                            por la calidad de nuestros
                            productos, la eficiencia de nuestro servicio y nuestro compromiso con la sostenibilidad.</p>
                        <img src="assets/img/frescura.jpg" class="img-fluid rounded-4 mb-4" alt="">

                    </div>
                    <div class="col-lg-6">
                        <div class="content ps-0 ps-lg-5">
                            <h3 class="fst-italic">Nuestra Visión</h3>
                            <p class="fst-italic">
                                Ser un referente global en la producción y exportación de flores, inspirando alegría y
                                belleza en el mundo.
                            </p>
                            <h3>Valores</h3>
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i>
                                    <p class="fst-italic"> Pasión por las flores: Creemos en el poder de las flores
                                        para transformar vidas y crear momentos especiales.</p>
                                </li>
                                <li><i class="bi bi-check-circle-fill"></i>
                                    <p class="fst-italic">Excelencia: Nos comprometemos con la más alta calidad en
                                        nuestros productos y servicios.
                                </li>
                                <li><i class="bi bi-check-circle-fill"></i>
                                    <p class="fst-italic">Sostenibilidad: Nos preocupamos por el cuidado del medio
                                        ambiente y la responsabilidad social.
                                </li>
                                <li><i class="bi bi-check-circle-fill"></i>
                                    <p class="fst-italic">Trabajo en equipo: Creemos en la fuerza del trabajo en equipo
                                        y en la colaboración para alcanzar objetivos comunes..
                                </li>
                            </ul>
                            <div class="position-relative mt-4">
                                <img src="assets/img/rosas.jpg" class="img-fluid rounded-4" alt="">
                                <a href="https://youtu.be/RgUxm9rwrIQ?si=9Mdfwgs-ssn2-nSf"
                                    class="glightbox play-btn"></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->
        <!-- ======= Galeria Section ======= -->
        <section id="portfolio" class="portfolio sections-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2 class="fst-italic">Galeria</h2>
                    <p class="fst-italic" style="color:black;">En MS EXPORT FLOWERS, nos apasionan las rosas.
                        Cultivamos una amplia variedad de rosas de la más alta calidad, desde clásicas hasta modernas,
                        en una paleta de colores vibrantes que cautivará sus sentidos.</p>
                </div>

                <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry"
                    data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

                    <div>
                        <ul class="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-product">Rojo</li>
                            <li data-filter=".filter-branding">Bicolor</li>
                            <li data-filter=".filter-books">Amarillo</li>
                        </ul><!-- End Portfolio Filters -->
                    </div>

                    <div class="row gy-4 portfolio-container">
                        <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
                            <div class="portfolio-wrap">
                                <a href="assets/img/portfolio/magic.jpg" data-gallery="portfolio-gallery-app"
                                    class="glightbox"><img src="assets/img/portfolio/highmagic.jpg" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">High & Magic</a></h4>
                                    <p>Bicolor</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->
                        <div class="col-xl-4 col-md-6 portfolio-item filter-product">
                            <div class="portfolio-wrap">
                                <a href="assets/img/portfolio/FREEDOM.jpg" data-gallery="portfolio-gallery-app"
                                    class="glightbox"><img src="assets/img/portfolio/FREEDOM.jpg" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Fredoom</a></h4>
                                    <p>Rojo</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
                            <div class="portfolio-wrap">
                                <a href="assets/img/portfolio/frutteto.jpg" data-gallery="portfolio-gallery-app"
                                    class="glightbox"><img src="assets/img/portfolio/frutteto.jpg" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Frutteto</a></h4>
                                    <p>Bicolor</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->
                        <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
                            <div class="portfolio-wrap">
                                <a href="assets/img/portfolio/mandala.jpg" data-gallery="portfolio-gallery-app"
                                    class="glightbox"><img src="assets/img/portfolio/mandala.jpg" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Mandala</a></h4>
                                    <p>Bicolor</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->
                        <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
                            <div class="portfolio-wrap">
                                <a href="assets/img/portfolio/frutteto.jpg" data-gallery="portfolio-gallery-app"
                                    class="glightbox"><img src="assets/img/portfolio/ocean.jpg" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Ocean Song</a></h4>
                                    <p>Bicolor</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-xl-4 col-md-6 portfolio-item filter-books">
                            <div class="portfolio-wrap">
                                <a href="assets/img/portfolio/brighton.jpg" data-gallery="portfolio-gallery-app"
                                    class="glightbox"><img src="assets/img/portfolio/brighton.jpg" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Brighton</a></h4>
                                    <p>Amarillo</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->
                    </div><!-- End Portfolio Container -->
                </div>
            </div>
        </section><!-- End Portfolio Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2 class="fst-italic">Contacto</h2>
                    <p class="fst-italic" style="color:black;">Llena tu vida de color y alegría con las flores de MS
                        EXPORT FLOWERS.</p>

                    <p class="fst-italic" style="color:black;"> Contáctanos y descubre la magia de nuestras flores. </p>
                </div>

                <div class="row gx-lg-0 gy-4">

                    <div class="col-lg-4">

                        <div class="info-container d-flex flex-column align-items-center justify-content-center">
                            <div class="info-item d-flex">
                                <a href="https://maps.app.goo.gl/zuFqbfR57WXFQqr66">
                                    <i class="bi bi-geo-alt flex-shrink-0"></i>
                                </a>
                                <div>
                                    <h4>Ubicación:</h4>
                                    <p>Pichincha, Cayambe</p>
                                </div>
                            </div>
                            <div class="info-item d-flex">
                                <a href="mailto:msexport@gmail.com">
                                    <i class="bi bi-envelope flex-shrink-0"></i>
                                </a>
                                <div>
                                    <h4>Email:</h4>
                                    <p>msexport@gmail.com</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex">
                                <a href="https://web.whatsapp.com/">
                                    <i class="bi bi-phone flex-shrink-0"></i>
                                </a>
                                <div>
                                    <h4>Celular</h4>
                                    <p>+593 989386555</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex">
                                <i class="bi bi-clock flex-shrink-0"></i>
                                <div>
                                    <h4>Horario de atención:</h4>
                                    <p>Lun-Sab: 7AM - 16PM</p>
                                </div>
                            </div><!-- End Info Item -->
                        </div>

                    </div>

                    <div class="col-lg-8">

                        <form action="forms/contact.php" method="post" role="form" class="php-email-form"
                            id="contact-form">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nombre"
                                        required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                                        required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Motivo"
                                    required>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" rows="7" placeholder="Mensaje"
                                    required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center">
                                <button type="submit">Enviar</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="#hero" class="logo d-flex align-items-center">
                        <span>Nuestras redes sociales</span>
                    </a>
                    <p>Para contactarnos, puede utilizar los siguientes canales.</p>
                    <div class="social-links d-flex mt-4">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Accesos rápidos</h4>
                    <ul>
                        <li><a href="#hero">Inicio</a></li>
                        <li><a href="#about">Sobre Nosotros</a></li>
                        <li><a href="#portfolio">Galeria</a></li>
                        <li><a href="#contact">Contacto</a></li>
                    </ul>
                </div>
                <!--
                <div class="col-lg-2 col-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Product Management</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </div>
                -->

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contactos</h4>
                    <p>
                        Cayambe, 3R7Q+84 <br>
                        Pichincha <br>
                        Ecuador <br><br>
                        <strong>Celular:</strong> +593 989386555<br>
                        <strong>Email:</strong> msexportflowers@gmail.com<br>
                    </p>

                </div>

            </div>
        </div>

        <div class="container mt-4">
            <div class="copyright">
                &copy; Copyright <strong><span>MS</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/impact-bootstrap-business-website-template/ -->
                Designed by MS EXPORT FLOWERS</a>
            </div>
        </div>

    </footer><!-- End Footer -->
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script>
        document.getElementById('contact-form').addEventListener('submit', function(event) {
            event.preventDefault();
            window.location.href = 'mailto:msexport@gmail.com';
        });
    </script>

</body>

</html>