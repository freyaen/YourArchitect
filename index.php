<?php 
require_once('db_connect.php');

session_start();

$spesialis = $conn->query('SELECT * FROM spesialis');
$arsitek = $conn->query("SELECT * FROM user WHERE role = 'architect'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sistem Informasi Pakar Arsitektur</title>


  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="css/style.css" rel="stylesheet">
  <style>
    .info i::before {
      position: relative;
      left: 11px
    }
  </style>
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="mailto:contact@example.com">YourArchi@example.com</a>
        <i class="bi bi-phone"></i> +620987654321
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.php">YourArchitect</a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#home">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto" href="#archi">Architect</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="nav-link scrollto" href="riwayat_appointment.php">Riwayat</a></li>

          <?php if(isset($_SESSION['logged']) && $_SESSION['logged']) : ?>
          <li><a class="nav-link scrollto" href="profile.php">Hi, <?= $_SESSION['nama'] ?></a></li> <!-- Menu Login -->
          <?php else: ?>
          <li><a class="nav-link scrollto" href="login.php">Login</a></li> <!-- Menu Login -->
          <?php endif; ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span>
        Appointment</a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Home Section ======= -->
  <section id="home" class="d-flex align-items-center">
    <div class="container text-center">
      <h1>Welcome to <br> Your Architect</h1>
      <h2>We are team of Professional Architect.<br>"We help your dreams come true."</h2>
      <a href="#about" class="btn-get-started scrollto">Learn More</a>
    </div>
  </section><!-- End Home -->
  <br><br><br><br><br><br><br><br>
  <main id="main">

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="fas fa-home"></i></div>
              <h4 class="title"><a href="">Residential Developments</a></h4>
              <p class="description">Creating new housing or improving existing residential areas.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="fas fa-building"></i></div>
              <h4 class="title"><a href="">Commercial Developments</a></h4>
              <p class="description">Creation of spaces designed for business activities, including retail stores, office buildings, industrial parks, and mixed-use developments.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="fas fa-store"></i></div>
              <h4 class="title"><a href="">Current Selling</a></h4>
              <p class="description">Designs residential or commercial buildings and environments. They play a crucial role in creating functional, aesthetic spaces.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="fas fa-calendar-check"></i></div>
              <h4 class="title"><a href="">Appointment</a></h4>
              <p class="description">Making an appointment with an architect involves several steps to ensure both parties are prepared for a productive and informative meeting.
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Featured Services Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>About Us</h2>
          <p>Your Architect is a premier architectural firm dedicated to bringing visionary projects to life through innovative design,
             meticulous planning, and sustainable practices. Our mission is to create spaces that inspire, function flawlessly, and stand the test of time.
             Founded on the principles of creativity, integrity, and excellence, Your Architect has grown to become a trusted name in both residential and
              commercial architecture. Our team comprises highly skilled architects, designers, and planners with diverse backgrounds and extensive experience in the industry.
              At Your Architect, we believe that architecture is more than just building structures; it's about creating environments that enhance the lives of the people who use them. 
              Our approach is client-centered, ensuring that each project reflects the unique vision, needs, and goals of our clients.</p>
        </div>

        <div class="row">
          <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center
     align-items-stretch position-relative">
            <a href="https://youtu.be/PVOTa9A3YFc" class="glightbox play-btn mb-4"></a>
          </div>

          <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch
     justify-content-center py-5 px-lg-5">

            <div class="icon-box">
              <div class="icon"><i class="bx bx-building"></i></div>
              <h4 class="title"><a href="">YOUR HOUSE, YOUR PALACE</a></h4>
              <p class="description">Home is more than just a building; it's your sanctuary, your haven, your palace. That's why we're dedicated to partnering with you to create the perfect space that reflects your unique style, meets your practical needs, and provides the utmost comfort and security for you and your loved ones.</p>
            </div>

            <div class="icon-box">
              <div class="icon"><i class="bx bx-user"></i></div>
              <h4 class="title"><a href="">ARCHITECT</a></h4>
              <p class="description">Meet our architech for the best experience. We dedicated to transforming visionary ideas into tangible, innovative, and sustainable designs. Our expertise spans across residential, commercial, and urban planning projects, with a commitment to delivering excellence in every endeavor.</p>
            </div>

            <div class="icon-box">
              <div class="icon"><i class="bx bx-help-circle"></i></div>
              <h4 class="title"><a href="">SERVICES </a></h4>
              <p class="description">We offer a comprehensive range of architectural services designed to meet the diverse needs of our clients. Our commitment to excellence, innovation, and sustainability ensures that each project is executed with precision and creativity. </p>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row no-gutters">

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="fas fa-user"></i>
              <span data-purecounter-start="0" data-purecounter-end="100" data-purecounter-duration="1"
                class="purecounter"></span>
              <p><strong>Architect</strong> that working with us </p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="far fa-building"></i>
              <span data-purecounter-start="0" data-purecounter-end="36" data-purecounter-duration="1"
                class="purecounter"></span>
              <p><strong>Results</strong> from our Architech for our clients</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="fas fa-user"></i>
              <span data-purecounter-start="0" data-purecounter-end="23" data-purecounter-duration="1"
                class="purecounter"></span>
              <p><strong>Partners</strong> that collaborate with us</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="fas fa-award"></i>
              <span data-purecounter-start="0" data-purecounter-end="250" data-purecounter-duration="1"
                class="purecounter"></span>
              <p><strong>Awards</strong> Your Architech achieve</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Services</h2>
          <p>We provide services such as make appointment</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-building"></i></div>
              <h4><a href="">Professional</a></h4>
              <p>We are your dedicated professionals, committed to turning your dream of a perfect home into a reality. With our expertise and attention to detail, we ensure that your home not only meets but exceeds your expectations in terms of safety, comfort, and style.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-user-check"></i></div>
              <h4><a href="">Trusted</a></h4>
              <p>Proven track record, transparent communication, commitment to quality. That's why we are committed to being your trusted partners throughout the entire process, ensuring that your vision is realized with integrity, transparency, and reliability.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-clock"></i></div>
              <h4><a href="">Flexible</a></h4>
              <p>Simply prefer the convenience of virtual meetings, our flexible online options cater to your needs.  No matter where you're located, our online meetings make it easy to collaborate with us, ensuring that distance is never a barrier to achieving your dream home.</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Appointment Section ======= -->
    <section id="appointment" class="appointment section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Make an Appointment</h2>
          <p>We can help you reach your dream! kindly check us out for further information! our architect gladly to help
          </p>
        </div>

        <form action="submit_appointment.php" method="POST" role="form">
          <div class="row">
            <div class="col-md-6 form-group mt-3">
              <select name="id_spesialis" class="form-control" id="id_spesialis" required>
                <option selected disabled>Pilih Spesialis</option>
                <?php while($row = mysqli_fetch_assoc($spesialis)) : ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="col-md-6 form-group mt-3">
              <select name="id_arsitek" class="form-control" id="id_arsitek" required>
                <option selected disabled>Pilih Arsitek</option>
              </select>
            </div>

            <div class="col-md-12 form-group mt-3">
              <input type="datetime-local" name="date" class="form-control datepicker" id="date"
                placeholder="Appointment Date" required>
            </div>
            <div class="form-group col-md-12 mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
            </div>
          </div>
          <button type="submit" name="submit" class="btn btn-common btn-primary w-100 mt-3">Make an
            Appointment</button>
        </form>


      </div>
    </section><!-- End Appointment Section -->



    <!-- ======= Architect Section ======= -->
    <section id="archi" class="archi">
      <div class="container">

        <div class="section-title">
          <h2>Architect</h2>
          <p>Here we highlight our the most beloved architect that works with us</p>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="img/archi/1.png" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Zaha Hadid </h4>
                <span>Queen of Curve</span>
                <p>Zaha Hadid was an architect known for her radical deconstructivist designs1.She was the first woman to be awarded the Pritzker Architecture Prize, in 2004</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="img/archi/2.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Ir. H. Achmad Noe'man</h4>
                <span>Architect of a Thousand Mosques</span>
                <p> known for dedicating his life to building mosques, earning him the nickname "Maestro of Indonesian Mosque Architecture".</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="img/archi/3.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Vincentius Hadi Soetjiadi</h4>
                <span>Dedign Interior and Real Estate</span>
                <p>At Incentius Hadi Soetjiadi, we specialize in both interior design and real estate, offering a comprehensive approach to creating spaces that are both aesthetically pleasing and functionally practical.</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="img/archi/4.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Budi Pradone</h4>
                <span>Arsitek Residential</span>
                <p>Budi Pradone is your go-to expert for residential architecture. With a passion for crafting spaces that seamlessly blend functionality with beauty, Budi specializes in creating homes that reflect the unique lifestyles and personalities of their occupants.</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Archietect Section -->



    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Heres the iformation about our headquarter</p>
        </div>
      </div>

      <!--Google map-->
      <div class="mapouter">
        <div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no"
            marginheight="0" marginwidth="0"
            src="https://maps.google.com/maps?width=670&amp;height=363&amp;hl=en&amp;q=UPN VETERAN JAWA TIMUR, SURABAYA, INDONESIA&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a
            href="https://www.fnfgo.com/">FNF Mods</a></div>
        <style>
          .mapouter {
            position: relative;
            text-align: right;
            width: 100%;
            height: 363px;
          }

          .gmap_canvas {
            overflow: hidden;
            background: none !important;
            width: 100%;
            height: 363px;
          }

          .gmap_iframe {
            height: 363px !important;
          }
        </style>
      </div>

      <div class="container">
        <div class="row mt-5 align-items-center">
          <div class="col-lg-4">
            <div class="info">
              <div class="address m-0 d-flex align-items-center justify-content-start">
                <i class="bi bi-geo-alt"></i>
                <div>
                  <h4 class="ps-3">Location:</h4>
                  <p class="ps-3">Jl. Rungkut Madya No.1, Surabaya, Jawa Timur 60294</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="info">
              <div class="email m-0 d-flex align-items-center justify-content-start">
                <i class="bi bi-envelope"></i>
                <div>
                  <h4 class="ps-3">Email:</h4>
                  <p class="ps-3">YourArchi@example.com</p>
                </div>

              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="info">
              <div class="phone m-0 d-flex align-items-center justify-content-start">
                <i class="bi bi-phone"></i>
                <div>
                  <h4 class="ps-3">Phone:</h4>
                  <p class="ps-3">08998820723</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>YourArchitect</h3>
              <p>
                UPN "VETERAN" JAWA TIMUR<br>
                Surabaya, Jawa Timur<br><br>
                <strong>Phone:</strong> +62 8998820723<br>
                <strong>Email:</strong> YourArchi@example.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="facebook"><i
                    class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#archi">Architect</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#contact">Contact</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Extra Web Course</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Navbar Tutorial</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>YourArchitect</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a>Kelompok 12</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/glightbox/js/glightbox.min.js"></script>
  <script src="vendor/php-email-form/validate.js"></script>
  <script src="vendor/purecounter/purecounter.js"></script>
  <script src="vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#id_spesialis').on('change', function () {
        var id_spesialis = $(this).val();
        if (id_spesialis) {
          $.ajax({
            url: 'fetch_arsitek.php',
            type: 'POST',
            data: {
              id_spesialis: id_spesialis
            },
            success: function (response) {
              $('#id_arsitek').html(response);
            }
          });
        } else {
          $('#id_arsitek').html('<option selected disabled>Pilih Arsitek</option>');
        }
      });
    });
  </script>
</body>

</html>