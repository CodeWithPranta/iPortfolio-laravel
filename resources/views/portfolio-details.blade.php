@extends('layouts.main')
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Portfolio Details</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Portfolio Details</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                @php
                    $sliders = $portfolio->slider_photos;
                    //dd($sliders)
                    $n = count($sliders);
                @endphp

                @for ($i = 0; $i < $n; $i++)
                <div class="swiper-slide">
                    <img src="{{asset('storage/'. $sliders[$i])}}" alt="">
                </div>
                @endfor
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Project information</h3>
              <ul>
                <li><strong>Category</strong>: {{$portfolio->category}}</li>
                <li><strong>Client</strong>: {{$portfolio->client}}</li>
                <li><strong>Project date</strong>: {{$portfolio->project_date}}</li>
                <li><strong>Project URL</strong>: <a href="{{$portfolio->project_link}}" target="_blank">{{$portfolio->project_link}}</a></li>
              </ul>
            </div>
          </div>
          <div class="portfolio-description">
            <h2>Project Overview</h2>
            <div>
              {!! $portfolio->project_details !!}
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

@endsection
