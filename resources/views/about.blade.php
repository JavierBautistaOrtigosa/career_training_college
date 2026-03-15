@extends('layouts.app')

@section('content')
<div class="container py-4">


      <!-- SINGLE CARD WRAPPER -->
      <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                  <!-- LOGO (CENTERED) -->
                  <!-- <div class="text-left mb-4">
                        <img src="/images/ctc_logo_v3.svg" alt="Career Training College Logo"
                              class="img-fluid" style="max-height: 90px;">
                  </div> -->

                  <!-- ABOUT US HEADING -->
                  <div class="text-left mb-4">

                        <h4 class="fw-semibold mb-0">About Career Training College</h4>
                  </div>

                  <!-- ABOUT US IMAGE -->
                  <div class="mb-4">
                        <!-- <img src="/images/about_banner.jpg" -->
                        <img src="/images/about_banner_crop.jpg"
                              alt="Career Training College"
                              class="img-fluid w-100 rounded"
                              style="max-height: 300px; object-fit: cover;">
                  </div>

                  <div class="row g-4 mb-4">

                        <!-- MISSION -->
                        <div class="col-md-4">
                              <h5 class="fw-semibold mb-2">Our Mission</h5>
                              <p class="text-muted mb-0">
                                    At Career Training College, our mission is to empower students with practical, industry‑aligned
                                    skills that prepare them for real‑world success. We focus on delivering high‑quality education,
                                    encouraging personal growth, and supporting lifelong learning so every student can build the
                                    confidence and capability needed to achieve their goals.
                              </p>
                        </div>

                        <!-- HISTORY -->
                        <div class="col-md-4">
                              <h5 class="fw-semibold mb-2">Our History</h5>
                              <p class="text-muted mb-0">
                                    Founded in 2010, Career Training College began as a small initiative dedicated to providing
                                    accessible vocational training. Over time, we expanded our programs, modernized our facilities,
                                    and built strong partnerships with industry leaders. Today, we proudly support students from
                                    diverse backgrounds as they work toward meaningful academic and career achievements.
                              </p>
                        </div>

                        <!-- CONTACT INFORMATION -->
                        <div class="col-md-4">
                              <h5 class="fw-semibold mb-2">Contact Us</h5>

                              <p class="mb-1">
                                    <i class="bi bi-envelope-fill me-2 text-primary"></i>
                                    <strong>Email:</strong> info@careertrainingcollege.edu
                              </p>

                              <p class="mb-1">
                                    <i class="bi bi-telephone-fill me-2 text-primary"></i>
                                    <strong>Phone:</strong> (08) 1234 5678
                              </p>

                              <p class="mb-0">
                                    <i class="bi bi-geo-alt-fill me-2 text-primary"></i>
                                    <strong>Address:</strong> 123 Training Road, Perth WA
                              </p>
                        </div>

                  </div>


                  <!-- GOOGLE MAP -->
                  <div class="rounded overflow-hidden">
                        <iframe
                              width="100%"
                              height="250"
                              style="border:0;"
                              loading="lazy"
                              allowfullscreen
                              src="https://maps.google.com/maps?q=123%20Training%20Road%20Perth%20WA&t=&z=13&ie=UTF8&iwloc=&output=embed">
                        </iframe>
                  </div>

            </div>
      </div>

</div>
@endsection