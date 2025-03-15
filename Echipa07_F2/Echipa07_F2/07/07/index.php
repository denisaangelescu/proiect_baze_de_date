<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Săli de Fitness</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Include Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <style>
        .pricing-text {
            position: relative;
            overflow: hidden;
        }

        .pricing-carousel .owl-stage {
            display: flex;
            flex-direction: row;
        }
    </style>
</head>
<body>
    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="index.php" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-primary"><span class="text-dark">Ade</span>CC</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav m-auto py-0">
                    <a href="index.php" class="nav-item nav-link active">Acasă</a>
                    <a href="about.html" class="nav-item nav-link">Săli de Fitness</a>
                    <a href="service.html" class="nav-item nav-link">Camere</a>
                    <a href="price.html" class="nav-item nav-link">Abonamente</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pagini</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="opening.html" class="dropdown-item">Program</a>
                            <a href="team.html" class="dropdown-item">Echipa Noastra</a>
                            <a href="testimonial.html" class="dropdown-item">Păreri</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">Contact</a>
                </div>
                <a href="creditCard.html" class="btn btn-primary d-none d-lg-block">Cumpără Abonament</a>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 pb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                include 'db_connection.php';

                $sql = "SELECT COUNT(*) as count FROM tblSaliFitness";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $count = $row['count'];

                for ($i = 0; $i < $count; $i++) {
                    $activeClass = $i === 0 ? 'class="active"' : '';
                    echo "<li data-target='#header-carousel' data-slide-to='$i' $activeClass></li>";
                }
                ?>
            </ol>
            <div class="carousel-inner">
                <?php
                $sql = "SELECT sf.numeSala, sf.telefonSala, sf.orasSala, GROUP_CONCAT(DISTINCT c.tipCamera SEPARATOR ', ') AS camere, sf.imagineSala
                        FROM tblSaliFitness sf
                        LEFT JOIN tblCamere c ON sf.idSala = c.codSala
                        GROUP BY sf.idSala";
                $result = $conn->query($sql);
                $isActive = true;

                while ($row = $result->fetch_assoc()) {
                    $activeClass = $isActive ? 'active' : '';
                    $isActive = false;

                    echo "
                    <div class='carousel-item position-relative $activeClass' style='min-height: 100vh;'>
                        <img class='position-absolute w-100 h-100' src='img/{$row['imagineSala']}' style='object-fit: cover;'>
                        <div class='carousel-caption d-flex flex-column align-items-center justify-content-center'>
                            <div class='p-3' style='max-width: 900px;'>
                                <h6 class='text-white text-uppercase mb-3 animate__animated animate__fadeInDown' style='letter-spacing: 3px;'>Sala de Fitness</h6>
                                <h3 class='display-3 text-capitalize text-white mb-3'>{$row['numeSala']}</h3>
                                <p class='mx-md-5 px-5'>Camere Specializate: {$row['camere']}</p>
                                <p class='mx-md-5 px-5'>Locație: {$row['orasSala']}</p>
                                <p class='mx-md-5 px-5'> Contact: {$row['telefonSala']}</p>
                                <a class='btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp' href='creditCard.html'>Cumpără Abonament</a>
                            </div>
                        </div>
                    </div>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 pb-5 pb-lg-0">
                    <img class="img-fluid w-100" src="img/about.jpg" alt="">
                </div>
                <div class="col-lg-6">
                    <h6 class="d-inline-block text-primary text-uppercase bg-light py-1 px-2">Despre noi</h6>
                    <h1 class="mb-4">Cele mai bune centre de fitness din țară</h1>
                    <p class="pl-4 border-left border-primary">
                        Descoperă cele 10 săli de fitness unde excelența se întâlnește cu inovația, oferindu-ți cele mai avansate echipamente, camere de toate tipurile și o comunitate vibrantă care te motivează să depășești orice limită!</p>
                    <div class="row pt-3">
                        <div class="col-6">
                            <div class="bg-light text-center p-4">
                                <h3 class="display-4 text-primary" data-toggle="counter-up" id="numarAngajati">0</h3>
                                <h6 class="text-uppercase">Angajați</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-light text-center p-4">
                                <h3 class="display-4 text-primary" data-toggle="counter-up" id="numarClienti">0</h3>
                                <h6 class="text-uppercase">Clienți Fericiți</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->
    <div class="container-fluid px-0 py-5 my-5">
        <div class="row mx-0 justify-content-center text-center">
            <div class="col-lg-6">
                <h6 class="d-inline-block bg-light text-primary text-uppercase py-1 px-2">Serviciile Noastre</h6>
                <h1>Camere Specializate</h1>
            </div>
        </div>

        <div class="owl-carousel service-carousel">
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-1.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Bazin de Înot</h4>
                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-2.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Saună</h4>
                    <!--<p class="text-white px-3 mb-3">Elitr labore sit dolor erat est lorem diam sea ipsum diam dolor duo sit ipsum</p>-->
                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-3.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Kickboxing</h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-4.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Greutăți Libere</h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>
            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-5.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Pilates</h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>

            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-6.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Aerobic</h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>

            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-7.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Yoga</h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>

            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-8.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Ciclism</h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>

            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-9.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">CrossFit</h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>

            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-10.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Meditatie</h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>

            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-11.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Cardio</h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>

            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-12.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Zumba</h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>

            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-13.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Spin Cycling</h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>

            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-14.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Functional Training
                    </h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>

            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-15.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Saună cu Aromaterapie</h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>

            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-16.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Antrenament MMA
                    </h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>

            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-17.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Aqua Gym
                    </h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>

            <div class="service-item position-relative">
                <img class="img-fluid" src="img/service-18.jpg" alt="">
                <div class="service-text text-center">
                    <h4 class="text-white font-weight-medium px-3">Hot Yoga
                    </h4>

                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="creditCard.html">Cumpără Abonament</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row justify-content-center bg-appointment mx-0">
            <div class="col-lg-6 py-5">
                <div class="p-5 my-5" style="background: rgba(33, 30, 28, 0.7);">
                    <h1 class="text-white text-center mb-4">Înregistrare/Logare</h1>


                    <form action="inregistrare_actualizare_client.php" method="post">
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control bg-transparent p-4" name="nume" placeholder="Nume" required="required" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control bg-transparent p-4" name="prenume" placeholder="Prenume" required="required" />
                                </div>
                            </div>
                        </div>

                        <div class="flex-container" style="display: flex; width: 100%; justify-content: center;">
                            <div class="flex-item" style="flex: 1;">
                                <div class="form-group">
                                    <input type="text" class="form-control bg-transparent p-4" name="scop" placeholder="Scop" required="required" />
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="date" id="date" data-target-input="nearest">
                                        <input type="text" class="form-control bg-transparent p-4 datetimepicker-input" name="data_cumparare_abonament" placeholder="Data curentă" data-target="#date" data-toggle="datetimepicker" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="time" id="time" data-target-input="nearest">
                                        <input type="text" class="form-control bg-transparent p-4" name="telefon" placeholder="Numar Telefon" required="required" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="custom-select bg-transparent px-4" name="cod_abonament" style="height: 47px;" required>
                                        <option value="" selected disabled>Tipul Abonamentului</option>
                                        <option value="1">Zi</option>
                                        <option value="2">Lună</option>
                                        <option value="3">An</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary btn-block" style="height: 47px;">Finalizat</button>
                            </div>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Open Hours Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/opening.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="hours-text bg-light p-4 p-lg-5 my-lg-5">
                        <h6 class="d-inline-block text-white text-uppercase bg-primary py-1 px-2">Program</h6>
                        <h1 class="mb-4">Cele mai bune centre de fitness din țară</h1>
                        <p>La ADECC, poarta spre un stil de viață activ este mereu deschisă! Fiecare dintre cele 10 săli de fitness vă așteaptă cu programe flexibile, adaptate fiecărui stil de viață. De la răsărit până la apus, puteți alege oricând să vă antrenați în zonele noastre specializate.</p>
                        <ul class="list-inline">
                            <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Luni – Vineri : 9:00 - 19:00</li>
                            <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Sâmbătă : 9:00 - 18:00</li>
                            <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Duminică : Închis</li>
                        </ul>
                        <a href="creditCard.html" class="btn btn-primary mt-2">Cumpără Abonament</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Open Hours End -->


    <!-- Pricing Start -->
    <div class="container-fluid bg-pricing" style="margin: 90px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/abon1.jpeg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7 pt-5 pb-lg-5">
                    <div class="pricing-text bg-light p-4 p-lg-5 my-lg-5">
                        <div class="owl-carousel pricing-carousel" id="pricing-carousel">
                            <!-- Abonamentele vor fi încărcate aici din JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing End -->

    <!-- Team Start -->
        <div class="container-fluid py-5">
            <div class="container pt-5">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h6 class="d-inline-block bg-light text-primary text-uppercase py-1 px-2">Antrenori</h6>
                        <h1 class="mb-5">O parte din echipa noastră</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="team position-relative overflow-hidden mb-5">
                            <img class="img-fluid" src="img/antrenor1.jpg" alt="">
                            <div class="position-relative text-center">
                                <div class="team-text bg-primary text-white">
                                    <h5 class="text-white text-uppercase">Maria Ionescu</h5>
                                </div>
                                <div class="team-social bg-dark text-center">
                                    <a class="btn btn-outline-primary btn-square mr-2" href="https://www.facebook.com/mihaelacarnufitness/"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href="https://www.instagram.com/mihaelacarnu_fitness/"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="team position-relative overflow-hidden mb-5">
                            <img class="img-fluid" src="img/antrenor2.webp" alt="">
                            <div class="position-relative text-center">
                                <div class="team-text bg-primary text-white">
                                    <h5 class="text-white text-uppercase">Elena Dumitru</h5>
                                </div>
                                <div class="team-social bg-dark text-center">
                                    <a class="btn btn-outline-primary btn-square mr-2" href="https://www.facebook.com/AncaBucurMissFitness/?locale=ro_RO"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href="https://www.instagram.com/ancabucur.missfitness/?utm_source=ig_embed&ig_rid=529eae60-c7b5-40d5-aced-ceee5ba50b74"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="team position-relative overflow-hidden mb-5">
                            <img class="img-fluid" src="img/antrenor3.jpg" alt="">
                            <div class="position-relative text-center">
                                <div class="team-text bg-primary text-white">
                                    <h5 class="text-white text-uppercase">Ion Popescu</h5>
                                </div>
                                <div class="team-social bg-dark text-center">
                                    <a class="btn btn-outline-primary btn-square mr-2" href="https://www.facebook.com/biasutti.vladimir/?locale=ro_RO"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href="https://www.instagram.com/biasuttivladimir/"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="team position-relative overflow-hidden mb-5">
                            <img class="img-fluid" src="img/antrenor4.webp" alt="">
                            <div class="position-relative text-center">
                                <div class="team-text bg-primary text-white">
                                    <h5 class="text-white text-uppercase">Dan Marinescu</h5>
                                </div>
                                <div class="team-social bg-dark text-center">
                                    <a class="btn btn-outline-primary btn-square mr-2" href="https://www.facebook.com/florescualexander/?locale=ro_RO"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href="https://www.instagram.com/alexander_florescu/?utm_source=ig_embed&ig_rid=465e537c-9d93-4107-bb89-c3bd4c44ff18"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->

    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 pb-5 pb-lg-0">
                    <img class="img-fluid w-100" src="img/pareri.jpg" alt="">
                </div>
                <div class="col-lg-6">
                    <h6 class="d-inline-block text-primary text-uppercase bg-light py-1 px-2">Află mai multe</h6>
                    <h1 class="mb-4">Părerile clienților!</h1>
                    <div class="owl-carousel testimonial-carousel">
                        <div class="position-relative">
                            <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                            <div class="d-flex align-items-center mb-3">
                                <img class="img-fluid rounded-circle" src="img/testimonial-1.jpg" style="width: 60px; height: 60px;" alt="">
                                <div class="ml-3">
                                    <h6 class="text-uppercase">Enache Larisa</h6>
                                    <span>Student</span>
                                </div>
                            </div>
                            <p class="m-0">"Am fost extrem de impresionată de atmosfera prietenoasă și motivațională de la sala de fitness. Antrenorii sunt foarte profesioniști și te încurajează mereu să îți depășești limitele. Echipamentele sunt moderne și bine întreținute, iar programele de antrenament sunt variate și captivante. Recomand cu căldură această sală tuturor celor care își doresc rezultate rapide și sustenabile!"</p>
                        </div>
                        <div class="position-relative">
                            <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                            <div class="d-flex align-items-center mb-3">
                                <img class="img-fluid rounded-circle" src="img/testimonial-2.jpg" style="width: 60px; height: 60px;" alt="">
                                <div class="ml-3">
                                    <h6 class="text-uppercase">Anton Iulia</h6>
                                    <span>Inginer</span>
                                </div>
                            </div>
                            <p class="m-0">"Experiența mea la această sală de fitness a fost cu adevărat de neuitat. Personalul este extrem de amabil și dedicat, mereu dispus să ofere sfaturi și îndrumări personalizate. Mă simt cu adevărat motivată să vin în fiecare zi și să îmi ating obiectivele de fitness. Îmi place mult varietatea de clase și activități disponibile, fie că este vorba despre antrenamente intense sau sesiuni de yoga relaxante. Este cu siguranță un loc în care merită să investești în sănătatea și bunăstarea ta."</p>
                        </div>
                        <div class="position-relative">
                            <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                            <div class="d-flex align-items-center mb-3">
                                <img class="img-fluid rounded-circle" src="img/testimonial-3.jpg" style="width: 60px; height: 60px;" alt="">
                                <div class="ml-3">
                                    <h6 class="text-uppercase">Vasilescu Elena</h6>
                                    <span>Profesor</span>
                                </div>
                            </div>
                            <p class="m-0">"Am descoperit această sală de fitness recent și sunt încântată de experiența mea până acum. Atmosfera este energizantă și plină de viață, iar antrenorii sunt extrem de pasionați și motivați să te ajute să îți atingi obiectivele. Îmi place faptul că există o varietate mare de echipamente și clase disponibile, ceea ce îmi permite să îmi personalizez antrenamentele în funcție de nevoile mele."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div class="footer container-fluid position-relative bg-dark py-5" style="margin-top: 90px;">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6 pr-lg-5 mb-5">
                    <a href="index.php" class="navbar-brand">
                        <h1 class="mb-3 text-white"><span class="text-primary">Ade</span> CC</h1>
                    </a>
                    <p>Descoperă cele 10 săli de fitness unde excelența se întâlnește cu inovația, oferindu-ți cele mai avansate echipamente, camere de toate tipurile și o comunitate vibrantă care te motivează să depășești orice limită!</p>
                    <p><i class="fa fa-map-marker-alt mr-2"></i>Ne găsești în 8 orașe din țară: Iași, Constanța, Galați, Poliești, Cluj-Napoca, Timișoara, Brașov, Oradea</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>0735 126 562</p>
                    <p><i class="fa fa-envelope mr-2"></i>adecc@gmail.com</p>
                    <div class="d-flex justify-content-start mt-4">
                        <a class="btn btn-lg btn-primary btn-lg-square" href="https://www.instagram.com/adecc.gym/"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 pl-lg-5">
                    <div class="row">
                        <div class="col-sm-6 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Link-uri rapide</h5>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white-50 mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Acasă</a>
                                <a class="text-white-50 mb-2" href="about.html"><i class="fa fa-angle-right mr-2"></i>Săli de Fitness</a>
                                <a class="text-white-50 mb-2" href="service.html"><i class="fa fa-angle-right mr-2"></i>Camere</a>
                                <a class="text-white-50 mb-2" href="price.html"><i class="fa fa-angle-right mr-2"></i>Abonamente</a>
                                <a class="text-white-50" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact</a>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Camerele disponibile</h5>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white-50 mb-2" href="service.html"><i class="fa fa-angle-right mr-2"></i>Bazin de Inot, Aqua Gym</a>
                                <a class="text-white-50 mb-2" href="service.html"><i class="fa fa-angle-right mr-2"></i>Sauna, Sauna cu Aromaterapie</a>
                                <a class="text-white-50 mb-2" href="service.html"><i class="fa fa-angle-right mr-2"></i>Kickboxing</a>
                                <a class="text-white-50 mb-2" href="service.html"><i class="fa fa-angle-right mr-2"></i>Greutati libere</a>
                                <a class="text-white-50" href="service.html"><i class="fa fa-angle-right mr-2"></i>Pilates, Aerobic</a>
                                <a class="text-white-50 mb-2" href="service.html"><i class="fa fa-angle-right mr-2"></i>Yoga, Hot Yoga</a>
                                <a class="text-white-50 mb-2" href="service.html"><i class="fa fa-angle-right mr-2"></i>Ciclism, Spin Cycling</a>
                                <a class="text-white-50 mb-2" href="service.html"><i class="fa fa-angle-right mr-2"></i>MMA Training</a>
                                <a class="text-white-50 mb-2" href="service.html"><i class="fa fa-angle-right mr-2"></i>Functional Training</a>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Ești administrator?</h5>
                            <div class="w-100">
                                <form action="verificare_cod_administrator.php" method="post">
                                    <div class="input-group">
                                        <input type="text" class="form-control border-light" style="padding: 30px;" placeholder="Introdu codul" name="cod_administrator">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary px-4">Trimite</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-light border-top py-4" style="border-color: rgba(256, 256, 256, .15) !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                    <p class="m-0 text-white">&copy; <a href="index.php">Ade CC</a></p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <p class="m-0 text-white">Designed by <a href="https://htmlcodex.com">Denisa Alexandra Cosmin Eduard Christian</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <script>
        $(document).ready(function(){
            console.log('Document ready'); // Mesaj de depanare
            $.ajax({
                url: 'pret_tip_abonament.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log('Data received:', data); // Mesaj de depanare
                    var carousel = $('#pricing-carousel');
                    data.forEach(function(item) {
                        var pret = item.pretAbonament;
                        var descriere = item.descriereAbonament;
                        var tipAbonament = "";

                        // Setăm tipul abonamentului pe baza idAbonament
                        if (item.idAbonament == 1) {
                            tipAbonament = "Zilnic";
                        } else if (item.idAbonament == 2) {
                            tipAbonament = "Lunar";
                        } else if (item.idAbonament == 3) {
                            tipAbonament = "Anual";
                        }

                        var abonamentHTML = `
                            <div class="bg-white" style="margin: 10px;">
                                <div class="d-flex align-items-center justify-content-between border-bottom border-primary p-4">
                                    <h1 class="display-4 mb-0">
                                        <small class="align-top text-muted font-weight-medium" style="font-size: 22px; line-height: 45px;"></small>${pret}<small class="align-bottom text-muted font-weight-medium" style="font-size: 16px; line-height: 40px;">/lei</small>
                                    </h1>
                                    <h5 class="text-primary text-uppercase m-0">${tipAbonament}</h5>
                                </div>
                                <div class="p-4">
                                    <p><i class="fa fa-check text-success mr-2"></i>Acces nelimitat la echipamentele</p>
                                    <p><i class="fa fa-check text-success mr-2"></i>Acces la toate clasele</p>
                                    <a href="creditCard.html" class="btn btn-primary my-2">Cumpără Abonament</a>
                                </div>
                            </div>
                        `;
                        carousel.append(abonamentHTML);
                    });

                    // Initializează Owl Carousel
                    $('#pricing-carousel').owlCarousel({
    loop: true,
    margin: 10,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    },
    navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"]
});
                },
                error: function(error) {
                    console.log('Error:', error); // Mesaj de depanare
                }
            });
        });
        </script>



    <script>
        function countUp(element, start, end, duration) {
            let range = end - start;
            let current = start;
            let increment = end > start ? 1 : -1;
            let stepTime = Math.abs(Math.floor(duration / range));
            let timer = setInterval(function() {
                current += increment;
                element.innerText = current;
                if (current == end) {
                    clearInterval(timer);
                }
            }, stepTime);
        }

        function updateNumarClientiAngajati() {
            fetch("actualizare_numar.php")
                .then(response => response.json())
                .then(data => {
                    countUp(document.getElementById("numarClienti"), 0, data.numarClienti, 2000);
                    countUp(document.getElementById("numarAngajati"), 0, data.numarAngajati, 2000);
                })
                .catch(error => console.error("Eroare:", error));
        }

        window.onload = updateNumarClientiAngajati;
    </script>



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>



</body>

</html>