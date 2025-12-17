@extends('layouts.app')

@section('title', 'Programmes | The British College')

@section('content')

<!-- ===== Header ===== -->
<section class="programmes-header text-center py-5">
    <div class="container">
        <h1>Unlocking Opportunities with Our Programmes</h1>
        <p>
            Our diverse range of programs aims to provide individuals with the tools,
            resources, and support to achieve their goals. Join us and embark on a
            transformative journey that unlocks new horizons.
        </p>
    </div>
</section>

<!-- ===== Undergraduate ===== -->
<section class="undergraduate-programmes py-5">
    <div class="container">
        <h2 class="text-center mb-5">Undergraduate programme</h2>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="programme-link">
                    <div class="programme-box border-blue">
                        <div class="programme-title">BBA (Hons) Business and Management</div>
                        <img src="{{ asset('images/programmes/bba-hons-business-and-management.jpg') }}" alt="">
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="programme-link">
                    <div class="programme-box border-purple">
                        <div class="programme-title">HM (Hospitality Management)</div>
                        <img src="{{ asset('images/programmes/hospitality-management.jpg') }}" alt="">
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="programme-link">
                    <div class="programme-box border-darkblue">
                        <div class="programme-title">BSc (Hons) Computing</div>
                        <img src="{{ asset('images/programmes/bsc-hons-computing.jpg') }}" alt="">
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="programme-link">
                    <div class="programme-box border-lightpurple">
                        <div class="programme-title">BSc (Hons) Cyber Security & Digital Forensics</div>
                        <img src="{{ asset('images/programmes/bsc-hons-cyber-security.jpg') }}" alt="">
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="programme-link">
                    <div class="programme-box border-black">
                        <div class="programme-title">BSc (Hons) Computer Science - Artificial Intelligence</div>
                        <img src="{{ asset('images/programmes/bsc-hons-ai.jpg') }}" alt="">
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="programme-link">
                    <div class="programme-box border-blue2">
                        <div class="programme-title">BSc (Hons) Data Science</div>
                        <img src="{{ asset('images/programmes/bsc-hons-data-science.jpg') }}" alt="">
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ===== Postgraduate ===== -->
<section class="postgraduate-programmes py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Postgraduate programme</h2>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="programme-link">
                    <div class="programme-box border-blue">
                        <div class="programme-title">Weekend MBA (Executive)</div>
                        <img src="{{ asset('images/programmes/weekend-mba-executive.jpg') }}" alt="">
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="programme-link">
                    <div class="programme-box border-purple">
                        <div class="programme-title">MBA (Graduate)</div>
                        <img src="{{ asset('images/programmes/mba-graduate.jpg') }}" alt="">
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="programme-link">
                    <div class="programme-box border-darkblue">
                        <div class="programme-title">MSc in Professional Accountancy</div>
                        <img src="{{ asset('images/programmes/msc-professional-accountancy.jpg') }}" alt="">
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="programme-link">
                    <div class="programme-box border-lightpurple">
                        <div class="programme-title">MSc Information and Technology</div>
                        <img src="{{ asset('images/programmes/msc-information-technology.jpg') }}" alt="">
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="programme-link">
                    <div class="programme-box border-black">
                        <div class="programme-title">MSc Advanced Computer Science</div>
                        <img src="{{ asset('images/programmes/msc-advanced-computer-science.jpg') }}" alt="">
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ===== Other ===== -->
<section class="other-programmes py-5">
    <div class="container">
        <h2 class="text-center mb-5">Other programmes</h2>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="programme-link">
                    <div class="programme-box border-blue">
                        <div class="programme-title">GCE A Level</div>
                        <img src="{{ asset('images/programmes/gce-a-level.jpg') }}" alt="">
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <a href="#" class="programme-link">
                    <div class="programme-box border-purple">
                        <div class="programme-title">ACCA Programme</div>
                        <img src="{{ asset('images/programmes/acca-programme.jpg') }}" alt="">
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
