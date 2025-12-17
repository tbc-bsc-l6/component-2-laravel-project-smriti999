@extends('layouts.app')

@section('title', 'About The Rose College')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
@endpush

@section('content')

<div class="about-container">

    <h1>About The Rose College</h1>

    <p>
        Founded with a commitment to academic excellence and global relevance,
        <strong>The Rose College</strong> is dedicated to providing high-quality education
        that empowers aspiring students in Nepal to achieve internationally recognised
        qualifications and professional success.
    </p>

    <p>
        The College focuses on delivering programmes aligned with global academic standards
        and the evolving demands of the modern job market. The Rose College has established
        a strong identity as a forward-thinking institution that blends international
        perspectives with local relevance.
    </p>

    <p>
        Our academic delivery is supported by a diverse team of qualified faculty and
        administrative staff from Nepal and abroad. Through academic partnerships,
        industry engagement, internships, and experiential learning opportunities,
        The Rose College encourages students to become confident, globally minded professionals.
    </p>

    <p>
        We believe education extends beyond the classroom. The Rose College actively promotes
        community engagement, ethical leadership, and research-driven learning, while upholding
        the highest standards of integrity and academic quality.
    </p>

    <h2>1. Vision</h2>
    <p>
        To be a leading world-class college in Nepal, delivering high-quality national and
        international qualifications that develop skilled, innovative, and socially responsible
        graduates who can succeed in the global job market.
    </p>

    <h2>2. Mission</h2>
    <ul>
        <li>To make quality education accessible and affordable for students from all regions of Nepal;</li>
        <li>To offer industry-relevant programmes that enhance employability, entrepreneurship, and lifelong learning skills;</li>
        <li>To expand and strengthen academic partnerships in line with global standards;</li>
        <li>To collaborate closely with industry partners to provide internships and career development opportunities;</li>
        <li>To foster student mobility and global exposure through academic exchanges and study visits;</li>
        <li>To promote research, innovation, and community engagement;</li>
        <li>To provide comprehensive student support services that nurture academic success and personal growth.</li>
    </ul>

</div>

@endsection
