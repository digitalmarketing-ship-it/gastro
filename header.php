<?php
session_start();
require_once("db_connect.php");
require_once("check_cookie.php");
require_once("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">

<head>
<meta name="google-site-verification" content="csIcTxrbAxmPuLFTOsJrJKo00Fu_qrYc0h6n7oPhBKo" />


    <?php
    $data = get_website_info();
    if ($data) {
        // print_r($data);
        foreach ($data as $seodetails) {
            $meta_title_home = $seodetails['meta_title'];
            $meta_keyword_home = $seodetails['meta_keyword'];
            $meta_description_home = $seodetails['meta_description'];
            $report =  $seodetails['report'];
            $whatsapp_number = $seodetails['whatsapp'];
            $zceppa_social = $seodetails['zceppa_social'];
        }
    }

    ?>
    <?php


    function getCurrentUrl()
    {
        // Determine the protocol (HTTP or HTTPS)
        $protocol = 'http';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $protocol .= 's';
        }

        // Get the server name
        $host = $_SERVER['SERVER_NAME'];

        // Get the server port
        $port = $_SERVER['SERVER_PORT'];

        // Get the request URI
        $requestUri = $_SERVER['REQUEST_URI'];

        // Construct the URL
        $url = $protocol . '://' . $host;

        // Append the port if it's not the default port (80 for HTTP, 443 for HTTPS)
        if ($protocol === 'http' && $port != 80) {
            $url .= ':' . $port;
        } elseif ($protocol === 'https' && $port != 443) {
            $url .= ':' . $port;
        }

        // Append the request URI
        $url .= $requestUri;

        return $url;
    }

    // Example usage
    $currentUrl = getCurrentUrl();
    // echo $currentUrl;

    // Remove trailing slash if present
    $currentUrl = rtrim($currentUrl, '/');

    // Extract the last part of the URL after the last slash
    $slug = substr($currentUrl, strrpos($currentUrl, '/') + 1);

    // Check if the slug is empty (indicating the homepage)
    if ($slug === '') {
        $slug = 'home'; // Set a default slug for the homepage
    }


    // echo $slug; 
    // Output: doctors

//Another working code for backup
// Check if slug exists (inner pages)
// if (!empty($slug)) {

//     $data = get_seocontent_info_by_slug($slug);
//     if ($data) {
//         $meta_title = $data['meta_title'];
//         $meta_keyword = $data['meta_keyword'];
//         $meta_description = $data['meta_description'];
//     } else {
//         // Fallback for inner pages only
//         $meta_title = 'Best Hospital in Ranchi, Jharkhand: Super Speciality Hospital|Orchid Medical Centre';
//         $meta_keyword = 'Super speciality hospital in ranchi, hospital in ranchi, top hospital in ranchi, Orchid Medical Centre...';
//         $meta_description = 'Orchid Medical Centre is leading Super specialty Hospital...';
//     }

// } else {
//     // Homepage SEO
//     $meta_title = $meta_title_home;
//     $meta_keyword = $meta_keyword_home;
//     $meta_description = $meta_description_home;
// }
    
    if ($_SERVER['REQUEST_URI'] == '/' || empty($slug)) {
        $meta_title = $meta_title_home;
        $meta_keyword = $meta_keyword_home;
        $meta_description = $meta_description_home;
    } else {
        $data = get_seocontent_info_by_slug($slug);
        if ($data) {
            $meta_title = $data['meta_title'];
            $meta_keyword = $data['meta_keyword'];
            $meta_description = $data['meta_description'];
        } else {
            $meta_title = 'Best Hospital in Ranchi, Jharkhand: Super Speciality Hospital|Orchid Medical Centre';
            $meta_keyword = 'Super speciality hospital in ranchi...';
            $meta_description = 'Orchid Medical Centre is leading Super specialty Hospital...';
        }
    }
    
    ?>


    <!-- =======  SEO  ======= -->
    <title><?= $meta_title ?></title>

    <meta name="keywords" content="<?= $meta_keyword ?>">
    <meta name="description" content="<?= $meta_description ?>">
	
	<meta property="og:title" content="<?= isset($meta_title) ? $meta_title : "Best Hospital in Ranchi, Jharkhand: Super Speciality Hospital|Orchid Medical Centre"; ?>">
    <meta property="og:description" content="<?= isset($meta_description) ? $meta_description : "Orchid Medical Centre is leading Super specialty Hospital offers outstanding healthcare services with 30+ specialities and 135- bed in Ranchi. best hospital in Ranchi, Jharkhand. Dial: 9117100100"; ?>">
    
    <meta property="og:image" content="<?= isset($meta_image) ? $meta_image : "https://www.orchidmedcentre.com/image_website/main_header.webp"; ?>">
	<meta property="og:url" content="<?= $currentUrl ?>">
    <meta property="og:type" content="website">

    <?php

    // Get the protocol (HTTP or HTTPS)
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

    // Get the host (e.g., www.example.com)
    $host = $_SERVER['HTTP_HOST'];

    // Get the request URI (e.g., /path/to/page.php)
    $requestUri = $_SERVER['REQUEST_URI'];

    // Combine to get the full URL
    $currentUrl = $protocol . $host . $requestUri;
    ?>

    
    <link rel="canonical" href="<?=$currentUrl?>" />

    <!-- Stylesheets -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">


    <link rel="shortcut icon" href="/image_website/favicon1.png" type="image/x-icon">
    <link rel="icon" href="/image_website/favicon1.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" /> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    
	<!-- Structrue Data Schema Starts -->
	
	<script type="application/ld+json">
		{
		  "@context": "https://schema.org",
		  "@type": "Hospital",
		  "name": "Orchid Medical Centre",
		  "url": "https://www.orchidmedcentre.com/",
		  "image": "https://www.orchidmedcentre.com/admin/patient_testimonial/testimonial/image/65f29a8352d54_orchid%20building.webp",
		  "telephone": "+91-9117100100",
		  "email": "info@orchidmedcentre.com",
		  "description": "Orchid Medical Centre is committed to delivering exceptional medical care and treatment services. We take pride in our recognition for excellence and accreditation by NABH, NABL, and NABH for Nursing Excellence.",
		  "priceRange": "₹₹",
		  "address": {
			"@type": "PostalAddress",
			"streetAddress": "H.B. Road",
			"addressLocality": "Ranchi",
			"addressRegion": "Jharkhand",
			"postalCode": "834001",
			"addressCountry": "IN"
		  },
		  "geo": {
			"@type": "GeoCoordinates",
			"latitude": 23.37159,
			"longitude": 85.33338
		  },
		  "openingHoursSpecification": {
			"@type": "OpeningHoursSpecification",
			"dayOfWeek": [
			  "Monday","Tuesday","Wednesday",
			  "Thursday","Friday","Saturday","Sunday"
			],
			"opens": "00:00",
			"closes": "23:59"
		  },
		  "sameAs": [
			"https://www.facebook.com/orchidmedcentre",
			"https://www.instagram.com/orchidmedcentre",
			"https://www.youtube.com/@orchidmedcentre"
		  ]
		}
    </script>
	
	<!-- Structrue Data Schema Ends -->
	
	<script>
  window.dataLayer = window.dataLayer || [];
</script>

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PV78DND9');</script>


</head>


<style>
    :root {
        --white-100: #fff;
        --white-200: #e4e6e7;
        --white-300: #c9cccf;
        --white-400: #a1a6aa;
        --white-500: #6d7478;
        --black-100: #181f25;
        --black-200: #12171c;
        --black-300: #0c0f13;
        --black-400: #060809;
        --black-500: #020303;
        --night-100: #253041;
        --night-200: #1e2634;
        --night-300: #161d27;
        --night-400: #0f131a;
        --night-500: #070a0d;
        --pink-100: #fbd0e8;
        --pink-200: #f8a0d0;
        --pink-300: #f471b5;
        --blue-400: #13bfb3;
        --pink-500: #da2576;
        --shadow-small: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        --shadow-medium: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-large: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    *,
    *::before,
    *::after {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        list-style: none;
        list-style-type: none;
        text-decoration: none;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-rendering: optimizeLegibility;
    }

    html {
        font-size: 100%;
        box-sizing: inherit;
        scroll-behavior: smooth;
        height: -webkit-fill-available;
    }

    main {
        overflow: hidden;
    }

    a,
    button {
        cursor: pointer;
        user-select: none;
        border: none;
        outline: none;
        background: none;
    }

    .container {
        max-width: 75rem;
        height: auto;
        margin-inline: auto;
        padding-inline: 1.5rem;
    }

    .centered {
        text-align: center;
        vertical-align: middle;
        margin-bottom: 1rem;
    }

    @media only screen and (min-width: 993px) {
        .menu-dropdown:hover>.submenu {
            opacity: 1;
            visibility: visible;
            margin-top: 1rem;
        }
    }

    .submenu {
        position: absolute;
        width: 100%;
        height: auto;
        margin-top: 2rem;
        padding: 1rem 2rem;
        z-index: 100;
        opacity: 0;
        visibility: hidden;
        border-radius: 0.25rem;
        border-top: 2px solid var(--blue-400);
        background-color: var(--white-100);
        box-shadow: var(--shadow-medium);
        transition: all 0.25s ease-in-out;
    }

    .darkmode .submenu {
        border-top: 2px solid var(--pink-300);
        background-color: var(--night-300);
    }

    .submenu-inner {
        /* flex: 0 0 25%;
        padding: 0 1rem; */
        flex: 0 0 20.5%;
        padding: 0 0rem;
    }

    .submenu-title {
        font-family: inherit;
        font-size: inherit;
        font-weight: 500;
        line-height: 1;
        padding: 0.75rem 0;
        color: var(--pink-500);
        text-transform: uppercase;
        transition: all 0.3s ease;
    }

    .darkmode .submenu-title {
        color: var(--pink-300);
    }

    .submenu-item {
        display: block;
        line-height: 30px;
        margin: 0 auto;
        font-size: 15px;
        color: black !important;

    }

    .submenu-link {
        display: inline-block;
        font-family: inherit;
        font-size: inherit;
        font-weight: 500;
        line-height: inherit;
        padding: 0.75rem 0;
        white-space: nowrap;
        text-transform: capitalize;
        color: var(--black-300);
        transition: all 0.25s ease-in-out;
        width: 35ch;
    }

    .darkmode .submenu-link {
        color: var(--white-100);
    }

    .submenu-image {
        display: block;
        width: 100%;
        height: auto;
        margin-block: 0.5rem;
        object-fit: cover;
    }

    @media only screen and (max-width: 992px) {
        .submenu {
            position: absolute;
            display: none;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            max-width: none;
            min-width: auto;
            margin: 0;
            padding: 1rem;
            padding-top: 4rem;
            opacity: 1;
            overflow-y: auto;
            visibility: visible;
            box-shadow: none;
            transform: translateX(0%);
        }

        .submenu.is-active {
            display: block;
        }

        .submenu-inner {
            flex: 0 0 100%;
            padding: 0rem;
        }

        .submenu-list {
            margin-bottom: 1rem;
        }

        .submenu-link {
            display: block;
        }

        .submenu-image {
            margin-top: 0;
        }
    }

    .megamenu {
        left: 46%;
        width: 100% !important;
        height: auto;
        margin: 0 auto;
        transform: translateX(-47%);
    }

    .megamenu-column-1 {
        left: 65%;
        max-width: 15rem;
        width: 100%;
        height: auto;
    }

    .megamenu-column-4 {
        display: flex;
        flex-wrap: wrap;
        /* max-width: 58rem; */
        height: auto;
        margin: 0 auto;
    }

    @media only screen and (max-width: 992px) {
        .megamenu {
            position: absolute;
            display: none;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            max-width: none;
            min-width: auto;
            margin: 0;
            padding: 1rem;
            padding-top: 4rem;
            opacity: 1;
            overflow-y: auto;
            visibility: visible;
            transform: translateX(0%);
            box-shadow: none;
        }
    }

    /* Styles for desktop view (default) */
    .desktop-content {
        display: block;
        /* Show on desktop */
    }

    .mobile-content {
        display: none;
        /* Hide on desktop */
    }

    /* Media query for screens with a maximum width of 768px (typical for mobile devices) */
    @media (max-width: 768px) {
        .desktop-content {
            display: none;
            /* Hide on mobile */
        }

        .whatsapp-float-icon {
            display: none;
            /* Hide on mobile */
        }

        .mobile-content {
            display: block;
            /* Show on mobile */
        }

        .hide-on-scroll {
            display: none;
            /* Hide on mobile */
        }
    }

    #report-btn {
        background-color: #13bfb3;
        border-radius: 19px 5px 19px 5px;
    }
</style>

<body>

    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PV78DND9"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	
	
    <div class="page-wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader" loading="lazy"></div> -->

        <!-- floating whatsapp icon -->
        <a class="whatsapp-float-icon" href="https://wa.me/<?php echo $whatsapp_number; ?> " target='_blank' style="border:none;border-radius:50%;position:fixed;bottom:43px;left:20px;z-index:1000;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 20px 0 rgba(0, 0, 0, 0.19);">
            <img src="https://o2osell.com/nutantv/wp-group.webp" style="width:3.5rem;float:right;" alt="whatsapp-icon" loading="lazy">
        </a>
        <!-- floating whatsapp icon end -->



        <!-- Main Header-->
        <header class="main-header header-style-one">

            <style>
                .second {
                    font-weight: 600;
                    background-color: #13bfb3;
                    border-color: #13bfb3;
                }

                .second:hover {
                    background-color: #13bfb3;

                }

                .custom_card_header {
                    padding: 0;
                    height: 44px;
                }

                .btn-check:focus+.btn,
                .btn:focus {
                    box-shadow: 0 0 0 0.25rem rgb(255 255 255 / 0%) !important;
                }

                .btn {
                    display: block !important;
                }

                /* Media query for screens with a maximum width of 768px (typical for mobile devices) */
                @media (max-width: 768px) {
                    .custom_card_header {
                        height: 0%;
                        padding: 0;
                    }

                    #sec_opinion {
                        display: none;
                    }
                }

                #sec_opinion {
                    border: 1px solid rgb(19 191 179) !important;
                    border-radius: 0px 0px 75px 75px;
                }

                .li-name a {
                    color: black !important;
                }

                .li-name a:hover {
                    color: #13bfb3 !important;
                }

                .active-row {
                    background-color: #13bfb3;
                    /* Change this to the desired active color */
                }
            </style>



            <!-- ======Top Header====== -->
            <div class="row" id="accordionRow">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <div class="accordion " id="accordionExample">
                        <div class="card" id="sec_opinion">
                            <div class="card-header custom_card_header" id="heading" style="background-color:#13bfb3;">
                                <div class="mb-0">
                                    <button class="btn  btn-block text-center second" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="color:#072F66;">
                                        Get free second opinion from our specialists.<i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 text-center">
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var accordionRow = document.getElementById('accordionRow');

                    accordionRow.addEventListener('click', function() {
                        // Toggle the 'active-row' class when the row is clicked
                        this.classList.toggle('active-row');
                    });
                });


                document.addEventListener('DOMContentLoaded', function() {
                    var accordionButtons = document.querySelectorAll('.second');
                    accordionButtons.forEach(function(button) {
                        button.addEventListener('click', function() {
                            var icon = this.querySelector('i');

                            // Toggle the icon class based on the accordion state
                            if (this.getAttribute('aria-expanded') === 'true') {
                                icon.classList.remove('fa-circle-chevron-down');
                                icon.classList.add('fa-circle-chevron-up');
                            } else {
                                icon.classList.remove('fa-circle-chevron-up');
                                icon.classList.add('fa-circle-chevron-down');
                            }
                        });
                    });
                });
            </script>



            <!-- <div class="row mt-3"> -->
            <div class="row ">
                <div class="">
                    <div class="col-sm-12">
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body" style="background-color: #13bfb3;width: 103%;left:-15px; border-top: #13bfb3;">
                                <form action="" class="secondOpinionForm py-lg-4 py-3 col-lg-11 mx-auto px-10 px-lg-20 mb-0 row g-3" method="post" enctype="multipart/form-data" id="opinionform">

                                    <div class="col-sm-4">
                                        <input type="text" name="name" class="form-control" placeholder="Enter Name" />
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" name="number" class=" form-control  " placeholder="Enter mobile number" />
                                    </div>

                                    <div class="col-sm-4">
                                        <select name="preffered_time" class=" form-control">
                                            <option value="" disabled selected>Preferred Time To Call</option>
                                            <option value="Morning">Morning</option>
                                            <option value="Afternoon"> After Noon</option>
                                            <option value="Evening">Evening</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-1">
                                    </div>

                                    <div class="col-sm-7">
                                        <input type="file" name="file" class=" form-control  " placeholder="Upload Document" />
                                    </div>

                                    <div class="col-sm-4">
                                        <button type="button" class="btn" onclick="submitOpinionForm()" id="submit" name="header_submit" style="background-color:#072F66; color:white;">Submit</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <script>
                function submitOpinionForm() {
                    // Prevent form submission
                    event.preventDefault();

                    // Get form input values
                    const name = document.getElementsByName('name')[0].value;
                    const number = document.getElementsByName('number')[0].value;
                    const file = document.getElementsByName('file')[0].files[0];
                    const preferredTime = document.getElementsByName('preffered_time')[0].value;

                    // Check if any field is blank
                    if (name.trim() === '') {
                        alert("Please enter your name");
                        return;
                    } else if (number.trim() === '') {
                        alert("Please enter your mobile number");
                        return;
                    } else if (preferredTime === '') {
                        alert("Please select a preferred time to call");
                        return;
                    } else if (file === undefined) {
                        alert("Please upload a file");
                        return;
                    }

                    // Check if the number is valid
                    const phonePattern = /^\d+$/; // Regular expression for numbers only
                    if (!phonePattern.test(number)) {
                        alert("Please enter a valid phone number");
                        return;
                    }

                    // If all validations pass, proceed with form submission
                    const formData = new FormData(document.getElementById('opinionform'));

                    // Make an AJAX request to submit the form data
                    jQuery.ajax({
                        url: "/opinion_ajax.php",
                        data: formData,
                        type: "POST",
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            alert("Submitted successfully !");
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            alert('Error');
                        }
                    });
                }
            </script>



            <!-- Header top -->
            <div class="header-top">
                <div class="auto-container">
                    <div class="inner-container">
                        <?php
                        $data = get_website_info();
                        if ($data) {
                            // print_r($data);
                            foreach ($data as $details) {
                                $address = $details['address'];
                                $emergency_number = $details['emergency_number'];
                            }
                        }
                        ?>

                        <div class="top-left" style="margin-left: 215px;">
                            <ul class="contact-list clearfix">
                                <li><i class="flaticon-hospital-1"></i><?= $address ?> </li>
                                <li><i class="flaticon-back-in-time"></i>Emergency Number: <a href="tel:<?= $emergency_number ?>"> <?= $emergency_number ?></a></li>
                            </ul>
                        </div>


                        <div class="top-right">
                            <div class="social-icon-one">
                                <div><img src="/image_website/accreditation_new.webp" alt="Aaccreditation" width="147" height="54" style="max-width: 100%; height: auto;" srcset="" loading="lazy"></div>


                            </div>
                        </div>

                        <div class="star_rating" style="margin-left: -70px;">

                            <div class="elfsight-app-f69ce0e3-9083-484d-b9c2-3646df7047b6" data-elfsight-app-lazy></div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Header Top -->

            <!-- Header Lower -->

            <style>
                .img_dimen {
                    width: 395px;
                    height: 29px;
                }

                @media only screen and (max-width: 1536px) {
                    .img_dimen {
                        width: 320px;
                        height: 34px;
                    }
                }



                @media screen and (max-width: 600px) {
                    #hide_header {
                        visibility: hidden;
                        display: none;
                    }

                    #navbar {
                        padding-left: 0rem !important;
                    }
                }

                /* .submenu-item ul {
                    display: none;
                } */
                @media screen and (min-width: 601px) {
                    #navbar {
                        padding-left: 0.1rem !important;
                    }
                }

                .li-name {
                    display: flex;
                    align-items: center;
                }

                .li-name img {
                    height: 25px;
                    /* Adjust the height as needed */
                    padding-right: 5px;
                }

                .li-name a {
                    text-decoration: none;
                    color: #000;
                    /* Set the desired text color */
                    font-weight: 400;
                    text-wrap: nowrap;
                }
            </style>

            <div class="header-lower d-flex flex-row">
                <div class="logo-box" id="hide_header">

                    <!-- <div class="logo" style="padding-left: 20px;">
                        <a href="/">
                        <img src="/image_website/main_header.webp" class="img_dimen" alt="Orchid medical centre" title="" style=" margin-top: -88px;width:340px;height:auto;margin-bottom:-65px; max-height:150px;"></a>
                    </div> -->


                    <div class="logo" style="padding-left: 20px;">
                        <a href="/">
                            <img src="/image_website/main_header.webp" class="img_dimen" alt="Orchid medical centre" style="margin-top: -88px; width: 340px; height: auto; margin-bottom: -65px; max-width: 100%;" loading="lazy">
                        </a>
                    </div>


                </div>
                <!-- <div class="auto-container " style=" max-width: 1200px;"> -->
                <div class="auto-container">
                    <!-- Main box -->
                    <div class="main-box" style="right:1px;">
                        <!--Nav Box-->
                        <div class="nav-outer">
                            <nav class="nav main-menu">
                                <ul class="navigation" id="navbar">
                                    <li><a href="/">Home</a></li>

                                    <li class="dropdown">
                                        <span>About Us</span>
                                        <ul>
                                            <li><a href="/about_us/">About Us</a></li>
                                            <li><a href="/alliance/">Alliances</a></li>
                                            <li><a href="/patient_testimonial/">Patient Testimonial</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="/doctors/">Doctors</a></li>

                                    <!-- cnter of excellence desktop -->


                                    <!-- center of excellence desktop -->

                                    <li class="menu-item menu-dropdown desktop-content " id="desktop mega-menu-parent">
                                        <span class="menu-link">Centre Of Excellence <i class="fa fa-sort-desc" aria-hidden="true" style="vertical-align: 2px;"></i></span>
                                        <div class="submenu megamenu megamenu-column-4">
                                            <?php
                                            $data = get_all_coe_info();
                                            if ($data) {
                                                // print_r($data);
                                                foreach ($data as $type) {
                                                    $dept_name = $type['name'];
                                                    $coe_cat_id = $type["id"];
                                                    $coe_slug = $type["coe_slug"];
                                                    $logo_img = '/admin/department/coe/image/' . $type['logo_image'];
                                                    $img = '/admin/department/coe/image/' . $type['image'];
                                            ?>
                                                    <div class="submenu-inner">
                                                        <!-- <h4 class="submenu-title">Men</h4> -->
                                                        <ul class="submenu-list ">
                                                            <li class="submenu-item " id="<?= $coe_cat_id ?>"><a class="submenu-link" href="/department/coe_dept/<?= $coe_slug ?>"><img src="<?= $logo_img ?>" style="height: 50px;padding-right: 8px;" alt="<?= $dept_name ?>" loading="lazy"><?= $dept_name ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </li>


                                    <li class="dropdown mobile-content">
                                        <span>Centre Of Excellence</span>
                                        <ul>
                                            <?php
                                            $data = get_all_coe_info();
                                            if ($data) {
                                                foreach ($data as $type) {
                                                    $dept_name = $type['name'];

                                                    $coe_cat_id = $type["id"];
                                                    $logo_img = '/admin/department/coe/image/' . $type['logo_image'];
                                            ?>
                                                    <li class="submenu-item-mobile" id="<?= $coe_cat_id ?>">
                                                        <a class="submenu-link " href="/department/coe_dept/<?= $coe_slug ?>">
                                                            <img src="<?= $logo_img ?>" style="height: 50px;padding-right: 8px;" alt="<?= $dept_name ?>" loading="lazy"> <?= $dept_name ?>
                                                        </a>
                                                        <ul class="submenu-content">
                                                            <?php
                                                            $data = get_departmentdetails_info_by_coe_cat_id($coe_cat_id);
                                                            if ($data) {
                                                                // print_r($data);
                                                                foreach ($data as $type) {
                                                                    $coe_dept_name = $type['name'];
                                                                    $slug = $type['slug'];
                                                                    $img_logo_coe = '/admin/department/coe/details/logo/' . $type['dept_logo'];
                                                            ?>
                                                                    <li class="abc">
                                                                        <img src="<?= $img_logo_coe ?>" style="height: 40px;padding-right: 8px;" alt="<?= $coe_dept_name ?>" loading="lazy">
                                                                        <a href="/department/<?= $slug ?>"><?= $coe_dept_name ?></a>
                                                                    </li>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </li>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                        <script>
                                            $(document).ready(function() {
                                                // Show submenu on hover
                                                $(".submenu-item").hover(
                                                    function() {
                                                        $(this).find("ul").show();
                                                    },
                                                    function() {
                                                        $(this).find("ul").hide();
                                                    }
                                                );
                                                // Handle click event on submenu-link
                                                $(".submenu-link").click(function(event) {
                                                    event.stopPropagation(); // Prevent event bubbling
                                                    window.location.href = $(this).attr("href"); // Navigate to the link's href
                                                });
                                            });
                                        </script>
                                    </li>



                                    <!--specialities desktop collection -->

                                    <li class="menu-item menu-dropdown desktop-content" id="desktop">
                                        <span class="menu-link">Specialities <i class="fa fa-sort-desc" aria-hidden="true" style="vertical-align: 2px;"></i></span>
                                        <div class="submenu megamenu megamenu-column-4">
                                            <?php
                                            $data1 = get_department_info_specialities2();
                                            if ($data1) {
                                                // print_r($data);
                                                foreach ($data1 as $type1) {
                                                    $dept_name1 = $type1['name'];
                                                    $slug1 = $type1['slug'];
                                                    $dept_type = $type1['dept_type'];
                                                    if ($dept_type == 1) {
                                                        $img_logo_spcl = '/admin/department/coe/details/logo/' . $type1['dept_logo'];
                                                    } else {
                                                        $img_logo_spcl = '/admin/department/logo/' . $type1['dept_logo'];
                                                    }
                                            ?>
                                                    <div class="submenu-inner">
                                                        <ul class="submenu-list">
                                                            <li class="submenu-item"><a href="/department/<?= $slug1 ?>" class="submenu-link"><img src="<?= $img_logo_spcl ?>" style="height: 25px;padding-right: 8px;" alt="<?= $dept_name1 ?>" loading="lazy"><?= $dept_name1 ?></a></li>
                                                        </ul>
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </li>


                                    <!-- specialities in mobile -->

                                    <li class="dropdown mobile-content" id="mobile">
                                        <span>Specialities</span>
                                        <ul>
                                            <?php
                                            $data = get_department_info_specialities2();
                                            if ($data) {
                                                // print_r($data);
                                                foreach ($data as $type) {
                                                    $dept_name = $type['name'];
                                                    $slug = $type['slug'];
                                                    $dept_type = $type['dept_type'];
                                                    $img_logo = '/admin/department/logo/' . $type['dept_logo'];

                                                    if ($dept_type == 1) {
                                                        $img_logo = '/admin/department/coe/details/logo/' . $type['dept_logo'];
                                                    } else {
                                                        $img_logo = '/admin/department/logo/' . $type['dept_logo'];
                                                    }
                                            ?>
                                                    <li><img src="<?= $img_logo ?>" style="height: 34px;padding-left: 12px;margin-top: 6px;margin-right: -16px;" alt="<?= $dept_name ?>" loading="lazy"><a href="/department/<?= $slug ?>"><?= $dept_name ?></a></li>

                                            <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </li>

                                    <li><a href="/health_package/">Health Package</a></li>

                                    <!-- <li class="dropdown">
                                        <span>News</span>
                                        <ul>
                                            <li><a href="/contact_us/contact/">Blog</a></li>
                                            <li><a href="/contact_us/career/">Orchid in news</a></li>
                                        </ul>
                                    </li> -->

                                    <li class="dropdown">
                                        <span>Blogs</span>
                                        <ul>
									       <li><a href="/blogs/">Blogs </a></li>									
                                           <li><a href="/news/">Orchid in news</a></li>
										   </ul>
                                    </li>
   
                                    <li class="dropdown">
                                        <span>Contact Us</span>
                                        <ul>
                                            <li><a href="/contact_us/contact/">Contact Us</a></li>
                                            <li><a href="/contact_us/career/">Careers</a></li>
                                        </ul>
                                    </li>

                                    <li class="hide-on-scroll">
                                        <a href="<?= $report ?>" target="_blank" class="btn report-btn" id="report-btn">Reports<i class="fa-solid fa-download" style="font-size: 15px; margin-left:3px;"></i></a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- Main Menu End-->
                        </div>
                    </div>
                </div>
            </div>


            <!-- Sticky Header  -->
            <div class="sticky-header">
                <div class="auto-container">
                    <div class="main-box">
                        <div class="logo-box">
                            <div class="logo"><a href="/"><img src="/image_website/main_header.webp" alt="Orchid Medical Centre" style="width: 132px;" loading="lazy"></a></div>
                        </div>
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </div>
                </div>
            </div>
            <!-- End Sticky Menu -->

            <!-- Mobile Header -->
            <div class="mobile-header fixed-top" style="background-color: white;">
                <div class="logo"><a href="/"><img src="/image_website/footer_logo.webp" style="width: 275px;" alt="Orchid medical centre" loading="lazy"></a>
                </div>
                <!--Nav Box-->
                <div class="nav-outer clearfix">
                    <div class="outer-box">
                        <!-- Search Btn -->
                        <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span class="fa fa-bars"></span></a>
                    </div>
                </div>
            </div>

            <!-- Mobile Nav -->
            <div id="nav-mobile"></div>
            <!-- Header Search -->

            <div class="search-popup">
                <span class="search-back-drop"></span>
                <button class="close-search"><span class="fa fa-times"></span></button>

                <div class="search-inner">
                    <form method="post" action="">
                        <div class="form-group">
                            <input type="search" name="search-field" value="" placeholder="Search..." required="">
                            <button type="submit"><i class="flaticon-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Header Search -->
        </header>

        <!--End Main Header -->









        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


        <script>
/* ---------- jQuery safe blocks ---------- */
$(document).ready(function () {
    $(".submenu-item-mobile").on("click", function (e) {
        e.preventDefault();
        $(this).find(".submenu-content").toggle();
    });

    $(window).on("scroll", function () {
        var reportsLink = $('.hide-on-scroll');
        var secondHeader = $('.sticky-header');

        if (secondHeader.length && secondHeader.offset().top >= 1) {
            reportsLink.hide();
        } else {
            reportsLink.show();
        }
    });
});

/* ---------- Vanilla JS (NULL-SAFE) ---------- */
document.addEventListener("DOMContentLoaded", function () {

    const menu = document.querySelector(".menu");
    const burger = document.querySelector(".burger");
    const overlay = document.querySelector(".overlay");

    // If menu does not exist on this page, stop safely
    if (!menu || !burger || !overlay) return;

    const menuInner = menu.querySelector(".menu-inner");
    const menuArrow = menu.querySelector(".menu-arrow");

    if (!menuInner || !menuArrow) return;

    let subMenu = null;

    function toggleMenu() {
        menu.classList.toggle("is-active");
        overlay.classList.toggle("is-active");
    }

    function showSubMenu(children) {
        subMenu = children.querySelector(".submenu");
        if (!subMenu) return;

        subMenu.classList.add("is-active");
        subMenu.style.animation = "slideLeft 0.35s ease forwards";

        const icon = children.querySelector("i");
        if (icon && icon.parentNode) {
            const menuTitle = icon.parentNode.childNodes[0].textContent;
            menu.querySelector(".menu-title").textContent = menuTitle;
        }

        menu.querySelector(".menu-header").classList.add("is-active");
    }

    function hideSubMenu() {
        if (!subMenu) return;

        subMenu.style.animation = "slideRight 0.35s ease forwards";
        setTimeout(() => {
            subMenu.classList.remove("is-active");
        }, 300);

        menu.querySelector(".menu-title").textContent = "";
        menu.querySelector(".menu-header").classList.remove("is-active");
    }

    function toggleSubMenu(e) {
        if (!menu.classList.contains("is-active")) return;

        const dropdown = e.target.closest(".menu-dropdown");
        if (dropdown) showSubMenu(dropdown);
    }

    window.addEventListener("resize", function () {
        if (window.innerWidth >= 992 && menu.classList.contains("is-active")) {
            toggleMenu();
        }
    });

    burger.addEventListener("click", toggleMenu);
    overlay.addEventListener("click", toggleMenu);
    menuArrow.addEventListener("click", hideSubMenu);
    menuInner.addEventListener("click", toggleSubMenu);
});
</script>
