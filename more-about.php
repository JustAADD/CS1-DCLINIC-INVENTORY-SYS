<?php
session_start();

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
} elseif (isset($_SESSION['email'])) {

  header("Location: home.php");
  exit();
}

if (!isset($_SESSION['email'])) {

  header("Location: main.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>Document</title> -->
  <!-- ===== Bootstrap CSS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- ===== css ===== -->
  <link rel="stylesheet" href="assets/css/content-style.css">
  <!-- Animation-->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


</head>

<body>

  <header>
    <?php
    include 'app-header.php';
    ?>
  </header>

  <div class="margin" style="margin-top: 5rem;"></div>


  <section id="all-services">
    <div class="container-fluid">
      <div class="title-services">
        <h1 class="title mb-5">Our Services</h1>
      </div>

      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Dental Services</button>
          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Dental Prosthesis</button>
          <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Dentures</button>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">

        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" style="background-color: transparent;">
          <div class="title-services">
            <h1 class="title mb-4">Dental Services</h1>
          </div>

          <div class="row align-items-start" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine">
            <div class="col" id="service1">
              <div class="card" id="services-card1">
                <p>
                  Dental Checkups & Examinations

                <h5>At our dental clinic, we pride ourselves on providing
                  exceptional dental consultation services to all our patients.
                  Our dedicated team of experienced dentists is committed to offering
                  personalized care and attention to address your unique dental needs.</h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/wokrplace1.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>
            <div class="col" id="service1">
              <div class="card" id="services-card2">
                <p>
                  Oral Prophylaxis

                <h5> Embrace the bliss of a clean, fresh
                  mouth with our advanced Oral Prophylaxis.
                  Say goodbye to stubborn plaque and tartar,
                  as our gentle hygienists pamper your teeth
                  and gums, leaving them healthier and rejuvenated.</h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/oral prophylaxis.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>
            <div class="col" id="service1">
              <div class="card" id="services-card1">
                <p>
                  Dental Fillings

                <h5>Repair and restore the beauty of your
                  teeth with our top-of-the-line Dental Fillings.
                  Our skilled dentists use cutting-edge materials
                  and techniques to blend fillings seamlessly,
                  ensuring natural aesthetics and long-lasting
                  protection against decay.</h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/dental-filling.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>


          </div>

          <div class="row align-items-start mt-5" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine">
            <div class="col" id="service1">
              <div class="card" id="services-card1">
                <p>
                  Teeth Cleaning (Dental Prophylaxis)

                <h5> Experience the ultimate teeth-reviving
                  ritual with our invigorating Teeth Cleaning.
                  Our dental experts meticulously remove stains,
                  revealing your radiant pearly whites, and
                  leaving you with a fresh, confident smile.</h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/teeth-cleaning.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>
            <div class="col" id="service1">
              <div class="card" id="services-card2">
                <p>
                  Tooth Extraction

                <h5>Trust our gentle touch when it comes to
                  Tooth Extraction. Whether it's a troublesome
                  wisdom tooth or a damaged one, our caring approach
                  ensures a smooth and pain-free procedure.</h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/tooth-extraction.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>
            <div class="col" id="service1">
              <div class="card" id="services-card1">
                <p>
                  Tooth Restoration

                <h5>Rediscover the joy of eating and smiling
                  with our expert Tooth Restoration.
                  From chipped to worn-down teeth, our
                  artistic dentists work their magic, ensuring
                  every tooth looks as good as new.</h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/tooth-restoration.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>

          </div>

          <div class="row align-items-start mt-5" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine">
            <div class="col" id="service1">
              <div class="card" id="services-card1">
                <p>
                  Orthodontics (Braces)

                <h5>Embark on a transformative journey to a
                  perfectly aligned smile with our exceptional
                  Orthodontics. Our orthodontic experts create
                  customized treatment plans, guiding you towards
                  the confident and dazzling smile you've
                  always dreamed of.</h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/braces.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>
            <div class="col" id="service1">
              <div class="card" id="services-card2">
                <p>
                  Dental X-rays and Imaging

                <h5> Uncover the secrets hidden beneath the
                  surface with our precise Dental X-rays and Imaging.
                  Our state-of-the-art technology enables accurate
                  diagnoses, empowering us to deliver tailored
                  treatment solutions.</h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/tooth xray.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>
            <div class="col" id="service1">
              <div class="card" id="services-card1">
                <p>
                  Teeth whitening

                <h5>Reveal the brilliance of your smile with our
                  Teeth Whitening treatments. Whether in-office
                  or at-home, our teeth-whitening solutions brighten
                  your smile, boosting your self-assurance.</h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/whitening and cleaning.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>

          </div>

          <div class="row align-items-start mt-5" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine">
            <div class="col" id="service1">
              <div class="card" id="services-card1">
                <p>
                  Root Canal Treatment

                <h5>Bid farewell to toothaches with our exceptional
                  Root Canal Treatment. Our skilled endodontists save
                  your natural tooth, ensuring pain relief and preserving
                  your beautiful smile.</h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/root canal.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>
            <div class="col" id="service1">
              <div class="card" id="services-card2">
                <p>
                  Dental Bonding

                <h5>Perfect your smile effortlessly with our versatile
                  Dental Bonding. Conceal imperfections and enhance the
                  beauty of your teeth, achieving a flawless smile in no time.</h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/dental-bonding.jpeg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>
            <div class="col" id="service1">
              <div class="card" id="services-card1">
                <p>
                  Dental Restoration

                <h5>Our teeth cleaning service is designed to give you
                  a bright and healthy smile that you can be proud of.
                  We understand the importance of maintaining excellent
                  oral hygiene, and our team of skilled dental hygienists
                  is dedicated to providing you with a thorough and gentle
                  cleaning experience.</h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/whitening and cleaning.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>

          </div>
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" style="background-color: transparent;">

          <div class="row align-items-start mt-5" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine">
            <div class="col" id="service1">
              <div class="card" id="services-card1">
                <p>
                  Dental Crown

                <h5>Reignite the regal charm of your smile
                  with our exquisite Dental Crowns and Bridges.
                  Crafted with precision and artistry, our crowns
                  and bridges restore damaged teeth and fill gaps,
                  creating a seamless smile that commands attention.</h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/dental-crowns.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>
            <div class="col" id="service1">
              <div class="card" id="services-card2">
                <p>
                  Dental Implants

                <h5>Witness the marvel of modern dentistry with
                  our life-changing Dental Implants. Our experienced
                  implant specialists provide the most natural and
                  durable solution for replacing missing teeth,
                  allowing you to embrace life with confidence.</h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/dental-implant.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>
            <div class="col" id="service1">
              <div class="card" id="services-card1">
                <p>
                  Dental Bridges

                <h5>Bridge the gap in your smile with our elegant Dental Bridges.
                  Designed to perfection, our bridges blend seamlessly with your
                  natural teeth, restoring both function and aesthetics with a
                  touch of brilliance.</h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/dental-bridges.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>

          </div>



        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" style="background-color: transparent;">
          <div class="row align-items-start mt-5" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine">
            <div class="col" id="service1">
              <div class="card" id="services-card1">
                <p>
                  Removable Partiable Dentures & Complete Dentures

                <h5> designed to replace missing teeth and restore oral
                  functionality and aesthetics. Removable Partial Dentures
                  are ideal for patients who have some natural teeth remaining,
                  while Complete Dentures are suitable for those with no natural
                  teeth left. </h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/hansen-full-and-partial-dentures.jpeg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>
            <div class="col" id="service1">
              <div class="card" id="services-card2">
                <p>
                  Flexible Partial Dentures

                <h5>These dentures are specifically designed to provide a
                  comfortable and secure fit The flexibility of the material
                  allows the dentures to adapt closely to the patient's mouth contours,
                  reducing potential sore spots and providing a more
                  natural feel while eating and speaking. </h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/flexible.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>
            <div class="col" id="service1">
              <div class="card" id="services-card1">
                <p>
                  Acrylic Partial Dentures

                <h5>These dentures are carefully designed to replace one
                  or more missing teeth while providing excellent support
                  and stability. With their lightweight and customizable
                  features, patients can experience enhanced comfort and
                  ease of use. </h5>
                </p>

                <div class="card" id="owl-card-body2">
                  <img src="assets/image/acrylicparital.jpg" alt="">
                  <!-- php img -->
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>

    </div>
  </section>

  <div class="footer">

    <div class="owner">
      <p> ® Dalino Dental Clinic</p>
    </div>

  </div>


  <!-- ===== IONICONS ===== -->
  <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- Animation-->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

</body>

</html>