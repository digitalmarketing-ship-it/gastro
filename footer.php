<?php

require_once("db_connect.php");
require_once("check_cookie.php");
require_once("functions.php");
?>



<style>
    .float {
        position: fixed;
        width: 50px;
        height: 50px;
        bottom: 51px;
        left: 20px;
        background-color: #25d366;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 2px 2px 3px #999;
        z-index: 100;
    }

    .my-float {
        margin-top: 11px;
    }



    .sticky-icon {
        /* z-index: 100; */
        position: fixed;
        top: 40%;
        right: 0%;
        width: 200px;
        display: flex;
        flex-direction: column;
    }

    .sticky-icon a {
        transform: translate(160px, 0px);
        /* border-radius: 50px 0px 0px 50px; */
        border-radius: 15px 0px 0px 15px;
        text-align: left;
        margin: 2px;
        text-decoration: none;
        /* text-transform:uppercase; */
        padding: 10px;
        font-size: 20px;
        /* font-family: 'Oswald', sans-serif; */
        transition: all 0.8s;
    }

    .sticky-icon a:hover {
        color: #FFF;
        transform: translate(0px, 0px);
    }

    .sticky-icon a:hover i {
        transform: rotate(360deg);
    }

    /*.search_icon a:hover i  {
  transform:rotate(360deg);}*/
    .Facebook {
        background-color: #2C80D3;
        color: #FFF;
    }

    .Youtube {
        background-color: #fa0910;
        color: #FFF;
    }

    .Twitter {
        background-color: #13bfb3;
        color: #FFF;
    }

    .Instagram {
        background-color: #FD1D1D;
        color: #FFF;
    }

    .Google {
        background-color: #00307e;
        color: #FFF;
    }

    .sticky-icon a i {
        /* background-color:#FFF; */
        height: 40px;
        /* width: 40px; */
        color: #fefefe;
        text-align: center;
        line-height: 40px;
        border-radius: 50%;
        margin-right: 20px;
        transition: all 0.5s;
    }

    .sticky-icon a i.fa-facebook-f {
        background-color: #FFF;
        color: #2C80D3;
    }

    .sticky-icon a i.fa-google-plus-g {
        background-color: #FFF;
        color: #d34836;
    }

    .sticky-icon a i.fa-instagram {
        background-color: #FFF;
        color: #FD1D1D;
    }

    .sticky-icon a i.fa-youtube {
        background-color: #FFF;
        color: #fa0910;
    }

    .sticky-icon a i.fa-twitter {
        background-color: #FFF;
        color: #53c5ff;
    }

    .fas fa-shopping-cart {
        background-color: #FFF;
    }

    #myBtn {
        height: 50px;
        display: none;
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        text-align: center;
        padding: 10px;
        text-align: center;
        line-height: 40px;
        border: none;
        outline: none;
        background-color: #1e88e5;
        color: white;
        cursor: pointer;
        border-radius: 50%;
    }

    .fa-arrow-circle-up {
        font-size: 30px;
    }

    #myBtn:hover {
        background-color: #555;
    }


    @media only screen and (max-width: 600px) {

        .Google {
            display: none;
        }

        .Twitter {
            display: none;
        }

        .float {
            display: none;
        }
    }
</style>



<?php
$data = get_website_info();
if ($data) {
    // print_r($data);
    foreach ($data as $details) {
        $desc = $details['short_desc'];
        $facebook = $details['facebook'];
        $instagram = $details['instagram'];
        $linkedin = $details['linkedin'];
        $youtube = $details['youtube'];
        $address = $details['address'];
        $mobile_number = $details['mobile_number'];
        $email = $details['email'];
        $get_direction = $details['get_direction'];
        $appointment = $details['appointment'];
        $emergency_number = $details['emergency_number'];
        $report = $details['report'];
        $whatsapp = $details['whatsapp'];
    }
}

?>






<!--Start Sticky Icon-->
<div class="sticky-icon">
    <a href="tel:<?= $emergency_number ?>" class="Youtube" style="font-size: 12px;
    font-weight: 600;"><i class="fa-solid fa-truck-medical"></i>Emergency service 24x7</a>
    <a href="<?= $appointment ?>" class="Google"><i class="fa-regular fa-calendar-check" id="appoint"> </i> Appointment </a>

    <a href="<?= $report ?>" class="Twitter report-btn" target='_blank'><i class="fa-solid fa-download " id="reports"> </i> Reports</a>


</div>
<!--End Sticky Icon-->



<!-- Main Footer -->
<footer class="main-footer">
    <!--Widgets Section-->
    <div class="widgets-section" style="background-image: url(/images/background/7.webp);">
        <div class="auto-container">
            <div class="row">
                <!--Big Column-->
                <div class="big-column col-xl-6 col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <!--Footer Column-->
                        <div class="footer-column col-xl-7 col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget about-widget">
                                <div class="logo">
                                    <a href="/">
                                        <img src="/image_website/main_footer_logo.webp" alt="Orchid medical centre" style="margin-left: -13px;" width="333" height="48" /></a>
                                </div>



                                <div class="text">

                                    <p><?= $desc ?></p>

                                </div>

                                <ul class="social-icon-three" style="margin-left:-30px">
                                    <li><a href="<?= $facebook ?>" target="_blank" class="fab fa-facebook-f"></a></li>
                                    <li><a href="<?= $instagram ?>" target="_blank" class="fab fa-instagram"></a></li>
                                    <li><a href="<?= $linkedin ?>" target="_blank" class="fab fa-linkedin-in"></a></li>
                                    <li><a href="<?= $youtube ?>" target="_blank" class="fab fa-youtube"></a></li>
                                    <li><a href="/admin/" target="_blank" class="fa-solid fa-user-tie"></a></li>
                                </ul>




                            </div>
                        </div>

                        <!--Footer Column-->
                        <div class="footer-column col-xl-5 col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget">
                                <div class="widget-title">Quick Links</div>
                                <ul class="user-links" style="margin-left:-30px">
                                    <li><a href="/">Home</a></li>


                                    <li><a href="/#coe">Centre Of Excellence</a></li>
                                    <li><a href="/#spcl">Specialities</a></li>

                                    <li><a href="/academics/">Academics</a></li>
                                    <li><a href="/technologies/">Technologies</a></li>
                                    <li><a href="/patient_testimonial/">Patient Testimonial</a></li>
                                    <li><a href="/contact_us/contact/">Contact Us</a></li>
                                    <li><a href="/bmw_reports/">Biomedical Waste Report</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Big Column-->
                <div class="big-column col-xl-6 col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <!--Footer Column-->
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <!--Footer Column-->
                            <div class="footer-widget recent-posts">
                                <div class="widget-title">Latest News</div>
                                <!--Footer Column-->
                                <div class="widget-content">


                                    <?php
                                    $data1 = get_blogs_info_limit_desc_footer();
                                    if ($data1) {
                                        // print_r($data1);
                                        foreach ($data1 as $news) {



                                            $slug = $news['slug'];
                                            $title_h = $news['title'];
                                            $img_tech = '/admin/news/image/' . $news['image'];


                                            // print_r($title);


                                    ?>




                                            <div class="post">
                                                <div class="thumb"><a href="/news/details/<?= $slug ?>"><img src="<?= $img_tech ?>" alt="<?= $title_h ?>"></a></div>
                                                <div><a href="/news/details/<?= $slug ?>" style="color: #ffffff;"><?= $title_h ?></a></div>
                                                <!-- <span class="date">July 11, 2020</span> -->
                                            </div>

                                    <?php

                                        }
                                    }


                                    ?>

                                </div>
                            </div>
                        </div>

                        <!--Footer Column-->
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <!--Footer Column-->
                            <div class="footer-widget contact-widget">
                                <div class="widget-title">Contact Us</div>
                                <!--Footer Column-->
                                <div class="widget-content">
                                    <ul class="contact-list" style="margin-left:-30px">
                                        <li class="mt-5">
                                            <span class="icon flaticon-placeholder"></span>
                                            <div class="text"><?= $address ?></div>
                                            <!-- <a href="tel:<?= $mobile_number ?>"><strong><?= $mobile_number ?></strong></a> -->

                                        </li>

                                        <li class="mt-5">
                                            <span class="icon flaticon-call-1"></span>
                                            <div class="text"><a href="tel:<?= $mobile_number ?>"><strong><?= $mobile_number ?></strong></a></div>
                                        </li>

                                        <li class="mt-5">
                                            <span class="icon flaticon-email"></span>
                                            <div class="text"> <a href="mailto:<?= $email ?>"><strong><?= $email ?></strong></a>

                                            </div>
                                        </li>

                                        <!-- <li>
                                                <span class="icon flaticon-back-in-time"></span>
                                                <div class="text">Mon - Sat 8.00 - 18.00<br>
                                                <strong>Sunday CLOSED</strong></div>
                                            </li> -->


                                        <li class="mt-5">
                                            <span class=""><i class=" icon fa-solid fa-location-arrow"></i></span>
                                            <div class="text mb-3"> <a href="<?= $get_direction ?>" target="_blank ">
                                                    <strong>Get Direction</strong></a>
                                            </div>

                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3662.4669388419575!2d85.33090547408696!3d23.371319403226217!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f4e10d47207009%3A0x8a579a6aab7ecd78!2sOrchid%20Medical%20Centre!5e0!3m2!1sen!2sin!4v1756706260302!5m2!1sen!2sin" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

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





    <!--Footer Bottom-->
    <div class="footer-bottom">
        <!-- Scroll To Top -->


        <div class="container">

            <p style="color:black; text-align: center; padding-top: 15px;"> <span style="color:yellow;">*Disclaimer:</span> The information throughout this hospital (www.orchidmedcentre.com) is not intended to be taken as medical advice, diagnosis, or treatment. There is no guarantee of specific results and the results for any treatment mentioned on the website may vary, as every individual and their medical conditions are different.</p>

        </div>

        <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>




        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="footer-nav">
                    <ul class="clearfix">
                        <li><a href="/sitemap/">Sitemap</a></li>
                        <li><a href="/privacy_policy/">Privacy Policy</a></li>
                        <li><a href="/contact_us/contact/">Contact</a></li>
                        <li><a href="/legal_compliance/">Legal & Compliance</a></li>
                    </ul>
                </div>



                <div class="copyright-text mb-3">
                    <!-- <p>Copyright © 2020 <a href="#">Bold Touch</a>All Rights Reserved.</p> -->
                    <p>
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script>
                        All rights reserved <a href="/ " target="_blank">Orchid Medical</a> | Powered By <a href="https://cndigital.in/ " target="_blank">CN Digital</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</footer>
<!--End Main Footer -->

</div><!-- End Page Wrapper -->






<style>
    @media only screen and (min-width: 600px) {
        #mob_footer {

            display: none;

        }
    }

    .footer_icon {
        color: black !important;
        margin: 0px;
        padding: 0px;
    }

    .footer_link {
        text-decoration: none !important;
        color: white;
        /* color:#25304c ; */
    }

    .footer_link:hover {
        color: #25304c !important;
        /* color:white !important; */
    }

    .footer_text {

        font-size: 10px;
        margin: 0px;
        padding: 0px;
    }

    .mob_footer {
        background-color: #12beb2;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        /* box-shadow: rgba(17, 17, 26, 0.1) 0px 4px 16px, rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px; */
        position: fixed;
        bottom: 0px;
        left: 0px;
        width: 100%;
        /* background-color:white; */
        z-index: 58888;
    }
</style>





<div id='mob_footer' class="mob_footer pt-2 pb-2">


    <table style='width:100%;text-align:center;'>

        <tr>

            <td style='width:20%;'>

                <a href="/doctors/" class='footer_link' target='_blank'>

                    <span class="material-symbols-outlined">stethoscope</span>

                    <div class='footer_text' style="line-height:0.5;"> Doctor </div>


                </a>


            </td>





            <td style='width:20%;'>

                <a href="<?= $appointment ?>" class='footer_link' target='_blank'>

                    <span class="material-symbols-outlined">calendar_month</span>

                    <div class='footer_text' style="line-height:0.5;"> Book Appt. </div>


                </a>


            </td>


            <td style='width:20%;'>

                <a href="<?= $report ?>" class='footer_link report-btn' target='_blank'>

                    <span class="material-symbols-outlined">summarize</span>

                    <div class='footer_text' style="line-height:0.5;"> Report </div>


                </a>


            </td>







            <td style='width:20%;'>
                <a href="https://wa.me/<?php echo $whatsapp ?>" class='footer_link' target='_blank'>


                    <i class="fa-brands fa-whatsapp" style="font-size: 24px; vertical-align: 5px;"></i>

                    <div class='footer_text' style="line-height:0.5;"> Whatsapp </div>

                </a>

            </td>

            <td style='width:20%;'>
                <a href="https://www.google.com/maps/dir//H.B.+Road+Near+Lalpur+Thana,+New+Barhi+Toli,+Ranchi,+Jharkhand+834001/@23.3711664,85.2509274,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x39f4e10d47207009:0x8a579a6aab7ecd78!2m2!1d85.333329!2d23.371188?entry=ttu" class='footer_link' target='_blank'>
                    <i class="fas fa-location" style="font-size: 24px; vertical-align: 5px;"></i>
                    <div class='footer_text' style="line-height:0.5;"> Get Direction </div>
                </a>

            </td>

        </tr>


    </table>



</div>


<!-- zecpaa tag -->



<script type="application/javascript">
    (function(w, d, s, o, f, js, fjs) {
        w['zcWidget'] = o;
        w[o] = w[o] || function() {
            (w[o].q = w[o].q || []).push(arguments)
        };
        js = d.createElement(s), fjs = d.getElementsByTagName(s)[0];
        js.id = o;
        js.src = f;
        js.async = 1;
        fjs.parentNode.insertBefore(js, fjs);

    }(window, document, 'script', 'zc', 'https://widget.zceppa.com//zc-widget.min.js'));
    zc('init', {
        domain: 'prod'
    });
</script>


<!-- zecpaa tag -->



<!-- Third-party CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"
        defer></script>

<script src="https://static.elfsight.com/platform/platform.js"
        data-use-service-core
        defer></script>

<!-- Core Libraries -->
<script src="/js/jquery.js" defer></script>
<script src="/js/popper.min.js" defer></script>

<!-- jQuery Plugins -->
<script src="/js/jquery.fancybox.js" defer></script>
<script src="/js/jquery.modal.min.js" defer></script>
<script src="/js/mmenu.polyfills.js" defer></script>
<script src="/js/mmenu.js" defer></script>
<script src="/js/owl.js" defer></script>
<script src="/js/wow.js" defer></script>
<script src="/js/appear.js" defer></script>

<!-- Bootstrap (local if still needed) -->
<script src="/js/bootstrap.min.js" defer></script>

<!-- Custom Script (MUST BE LAST) -->
<script src="/js/script.js" defer></script>


<!-- Color Setting -->

<!-- <script src="/js/color-settings.js"></script> -->



<!-- script for active  menu color -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentPageUrl = window.location.pathname;
        var menuLinks = document.querySelectorAll('.navigation a');

        menuLinks.forEach(function(link) {
            if (link.getAttribute('href') === currentPageUrl) {
                link.classList.add('active');
                // If the menu item is inside a dropdown, also mark its parent as active
                var dropdownParent = link.closest('.dropdown');
                if (dropdownParent) {
                    dropdownParent.querySelector('span').classList.add('active');
                }
                // Change text color of active menu item
                link.style.color = '#004083'; // Example color
            }
        });
    });
</script>
<!-- script for active  menu color -->


<script>
    $(document).ready(function() {
        $('.report-btn').on('click', function(e) {
            $.ajax({
                url: 'track_click.php',
                method: 'POST',
                success: function(response) {
                    console.log('Click tracked successfully.');
                },
                error: function() {
                    console.log('Error tracking click.');
                }
            });
        });
    });
</script>

</body>

</html>