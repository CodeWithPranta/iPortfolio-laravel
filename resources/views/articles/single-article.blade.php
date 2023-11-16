@extends('layouts.article')
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Article Details</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Article Details</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Article Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

          <div class="row gy-4">

            <div class="col-lg-8">
              <div class="portfolio-details-slider swiper">
                <div class="swiper-wrapper align-items-center">
                  <div class="swiper-slide">
                    <img src="{{asset('storage/'.$article->featured_image)}}" alt="Featured Image">
                  </div>
                </div>

              </div>
            </div>

            <div class="col-lg-4">
              <div class="portfolio-info">
                <h3>Article information</h3>
                <ul>
                  <li><strong>Category</strong>: {{$article->category->name}}</li>
                  <li><strong>Publish date</strong>: {{\Carbon\Carbon::parse($article->created_at)->format('j F, Y')}}</li>
                </ul>
              </div>
            </div>

          </div>

          <div class="row gy-4">
            <div class="col-12">
                <div class="portfolio-description">
                    {!! $article->content !!}
                </div>
            </div>
          </div>

        </div>
      </section><


  </main><!-- End #main -->

@endsection
