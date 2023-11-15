@extends('layouts.main')
@section('content')

    <!-- ======= Hero Section ======= -->
  <section id="hero"  style="background: url('{{$generalInfo ? asset('storage/' . $generalInfo->background_image) : asset('assets/img/hero-bg.jpg')}}') top center;" class="d-flex flex-column justify-content-center align-items-center">
     <!-- Session message -->
     @if (session()->has('status'))
     <div class="alert m-2 alert-success alert-dismissible fade show" role="alert">
         <strong>{{session()->get('status')}}</strong>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
     @endif

    <div class="hero-container" data-aos="fade-in">
      <h1>{{$aboutInfo ? $aboutInfo->full_name : 'Pranta Mazumder'}}</h1>
      @php
         if ($aboutInfo) {
            $dynamicTexts = json_decode($aboutInfo->dynamic_texts);
         }
      @endphp
      <p>I'm <span class="typed" data-typed-items="
        @if ($aboutInfo)
         @foreach ($dynamicTexts as $dynamicText)
           {{$dynamicText->profession . ','}}
         @endforeach
         @else
         'Designer, Developer, Photographer, Engineer'
        @endif
        "></span></p>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title">
          <h2>About</h2>
          <p>{{$aboutInfo ? $aboutInfo->about_short_description : 'About short description...'}}</p>
        </div>

        <div class="row">
          <div class="col-lg-4" data-aos="fade-right">
            <img src="{{$generalInfo ? asset('storage/'. $generalInfo->avatar) : asset('assets/img/profile-img.jpg')}}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
            <h3>{{$aboutInfo ? $aboutInfo->professional_title : 'UI/UX Designer &amp; Web Developer.'}}</h3>
            <p class="fst-italic">
                {{$aboutInfo ? $aboutInfo->profession_description : 'Two lines description...'}}
            </p>
            <div class="row">
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <span>{{$aboutInfo ? $aboutInfo->birthday : '1 April 1996'}}</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong> <span>{{$aboutInfo ? $aboutInfo->website : 'www.codewithpranta.com'}}</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Phone:</strong> <span>{{$aboutInfo ? $aboutInfo->phone : '+8801518480999'}}</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>City:</strong> <span>{{$aboutInfo ? $aboutInfo->address : 'Khulna, Bangladesh'}}</span></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span>{{$aboutInfo ? $aboutInfo->age : '27'}}</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Degree:</strong> <span>{{$aboutInfo ? $aboutInfo->degree : 'MS in Computer Science'}}</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span>{{$aboutInfo ? $aboutInfo->email : 'codewithpranta@gmail.com'}}</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Freelance:</strong>
                    <span>
                        @if ($aboutInfo)
                            @if ($aboutInfo->freelance === 1)
                                Available
                            @else
                                Not interested
                            @endif
                        @else
                            Available
                        @endif
                    </span>
                </li>
                </ul>
              </div>
            </div>
            <p>
                {{$aboutInfo ? $aboutInfo->about_yourself : 'About yourself....'}}
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Facts Section ======= -->
    <section id="facts" class="facts">
      <div class="container">

        <div class="section-title">
          <h2>Facts</h2>
          <p>{{$fact->fact_short_description}}</p>
        </div>

        <div class="row no-gutters">

            @php
                if ($fact)
                {
                    $infos = json_decode($fact->infos);
                }
            @endphp

            @foreach ($infos as $info)
             <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up">
                <div class="count-box">
                  {!! $info->icon !!}
                  <span data-purecounter-start="0" data-purecounter-end="{{$info->number}}" data-purecounter-duration="1" class="purecounter"></span>
                  <p><strong>{{$info->title}}</strong> <br> {{$info->subtitle}}</p>
                </div>
              </div>
            @endforeach

        </div>

      </div>
    </section><!-- End Facts Section -->

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Skills</h2>
          <p>{{$skillInfo->skill_short_description}}</p>
        </div>

        <div class="row skills-content">
            @php
                if ($skillInfo) {
                    $topics = json_decode($skillInfo->topics);
                }
            @endphp

          @foreach ($topics as $topic)
          <div class="col-lg-6" data-aos="fade-up">

            <div class="progress">
              <span class="skill">{{$topic->name}} <i class="val">{{$topic->efficiency_in_percentage}}%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="{{$topic->efficiency_in_percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </section><!-- End Skills Section -->

    <!-- ======= Resume Section ======= -->
    <section id="resume" class="resume">
      <div class="container">

        <div class="section-title">
          <h2>Resume</h2>
          <p>{{$resumeInfo->resume_short_description}}</p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-up">
            <h3 class="resume-title">Sumary</h3>
            <div class="resume-item pb-0">
              <h4>{{$aboutInfo->full_name}}</h4>
              <p><em>{{$resumeInfo->text_after_name}}</em></p>
              <ul>
                @php
                    if ($resumeInfo) {
                        $lists = json_decode($resumeInfo->resume_contact_lists);
                    }
                @endphp
                @foreach ($lists as $list)
                    <li>{{$list->value}}</li>
                @endforeach
              </ul>
            </div>

            <h3 class="resume-title">Education</h3>
            @php
                if ($resumeInfo) {
                    $educations = json_decode($resumeInfo->educations);
                }
            @endphp
            @foreach ($educations as $edu)
             <div class="resume-item">
                <h4>{{$edu->title}}</h4>
                <h5>{{$edu->start_date}} to {{$edu->end_date === null ? 'Present' : $edu->end_date}}</h5>
                <p><em>{{$edu->institute_name}}</em></p>
                <div>{!! $edu->content!!}</div>
             </div>
            @endforeach
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="resume-title">Professional Experience</h3>
            @php
                if ($resumeInfo) {
                    $experiences = json_decode($resumeInfo->experiences);
                }
            @endphp
            @foreach ($experiences as $exp)
              <div class="resume-item">
                <h4>{{$exp->title}}</h4>
                <h5>{{$exp->start_date}} to {{$edu->end_date === null ? 'Present' : $edu->end_date}}</h5>
                <p><em>{{$exp->industry_name}} </em></p>
                <div>
                  {!! $exp->content !!}
                </div>
              </div>
            @endforeach
          </div>
        </div>

      </div>
    </section><!-- End Resume Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Portfolio</h2>
          <p>{{$contactInfo->portfolio_short_description}}</p>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              @if (!empty($pCategories))
              @foreach ($pCategories as $pCategory)
              <li data-filter=".{{$pCategory->name}}">{{$pCategory->name}}</li>
              @endforeach
              @endif
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">

            @if (!empty($portfolios))
                @foreach ($portfolios as $portfolio)
                <div class="col-lg-4 col-md-6 portfolio-item {{$portfolio->category}}">
                    <div class="portfolio-wrap">
                      <img src="{{asset('storage/'. $portfolio->featured_image)}}" class="img-fluid" alt="Image">
                      <div class="portfolio-links">
                        <a href="{{asset('storage/'. $portfolio->featured_image)}}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Project"><i class="bx bx-plus"></i></a>
                        <a href="{{route('portfolio.details', $portfolio->id)}}" title="More Details"><i class="bx bx-link"></i></a>
                      </div>
                    </div>
                </div>
                @endforeach
            @endif

        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Services</h2>
          <p>{{$contactInfo->service_short_description}}</p>
        </div>

        <div class="row">
          @if (!empty($services))
              @foreach ($services as $service)
              <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
                <div class="icon">{!! $service->icon !!}</div>
                <h4 class="title">{{$service->title}}</h4>
                <p class="description">{{$service->description}}</p>
                <a class="title" href="{{$contactInfo->whatsapp}}"><i class="bi bi-whatsapp"></i> TALK</a>
              </div>
              @endforeach
          @endif

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Testimonials</h2>
          <p>{{$contactInfo->testimonial_short_description}}</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            @if (!empty($testimonials))
                @foreach ($testimonials as $testimonial)
                <div class="swiper-slide">
                    <div class="testimonial-item" data-aos="fade-up">
                      <p>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        {{$testimonial->feedback}}
                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                      </p>
                      <img src="{{asset('storage/'.$testimonial->image)}}" class="testimonial-img" alt="">
                      <h3>{{$testimonial->name}}</h3>
                      <h4>{{$testimonial->designation}}</h4>
                    </div>
                  </div><!-- End testimonial item -->
                @endforeach
            @endif
          </div>
          <div class="swiper-pagination"></div>
          <div class="text-center">
            <a href="mailto:codewithpranta@gmail.com">Send Feedback</a>
          </div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact</h2>
          <p>{{$contactInfo->contact_short_description}}</p>
        </div>

        <div class="row" data-aos="fade-in">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>{{$contactInfo->address}}</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>{{$contactInfo->email}}</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>{{$contactInfo->phone}}</p>
              </div>

              <iframe src="{{$contactInfo->google_map_link}}" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="{{ route('send.message') }}" method="post" role="form" class="php-email-form">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Your Name</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Your Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" id="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" name="message" rows="10" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit">Send Message</button>
                </div>
            </form>
        </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
@endsection
