@extends('site.layouts.app')

@section('content')
    <!-- ======= About Section ======= -->
    @include('site.pages.about')
    <!-- End About Section -->

    <!-- ======= Features Section ======= -->
    @include('site.pages.features')
    <!-- End Features Section -->

    <!-- ======= Services Section ======= -->
    @include('site.pages.services')
    <!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    {{-- @include('site.pages.portfolio') --}}
    <!-- End Portfolio Section -->

    <!-- ======= Cta Section ======= -->
    @include('site.pages.cta')
    <!-- End Cta Section -->

    <!-- ======= Testimonials Section ======= -->
    {{-- @include('site.pages.testemonials') --}}
    <!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->
    {{-- @include('site.pages.team') --}}
    <!-- End Team Section -->

    <!-- ======= Clients Section ======= -->
    {{-- @include('site.pages.clients') --}}
    <!-- End Clients Section -->

    <!-- ======= Pricing Section ======= -->
    @include('site.pages.pricing')
    <!-- End Pricing Section -->

    <!-- ======= F.A.Q Section ======= -->
    {{-- @include('site.pages.faq') --}}
    <!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    @include('site.pages.contact')
    <!-- End Contact Section -->

@endsection
