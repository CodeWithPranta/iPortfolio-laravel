<div>
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
          <div class="container">

            <div class="d-flex justify-content-between align-items-center">
              <h2>Articles & Tutorials</h2>
              <ol>
                <li><a href="/">Home</a></li>
                <li>Articles</li>
              </ol>
            </div>

          </div>
        </section><!-- End Breadcrumbs -->

        <main class="container">

            <div class="row height d-flex justify-content-center align-items-center">

                <div class="col-md-6">

                  <div class="form">
                    <i class="bi bi-search"></i>
                    <input type="text" class="form-control form-input" placeholder="Search anything..." wire:model.live="search">
                  </div>

                </div>
            </div>

            <div class="row mb-2">
              @foreach ($articles as $article)
              <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                  <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-primary">{{$article->category->name}}</strong>
                    <h3 class="mb-0">{{Str::limit($article->title, 35)}}</h3>
                    <div class="mb-1 text-muted">{{\Carbon\Carbon::parse($article->created_at)->format('j F, Y') }}</div>
                    <div class="card-text mb-auto">{!! Str::limit($article->content, 120) !!}</div>
                    <a href="{{ route('single.article', ['slug' => $article->slug]) }}" wire:navigate.hover class="stretched-link">Continue reading</a>
                  </div>
                </div>
              </div>
              @endforeach

            </div>



          </main>
      </main><!-- End #main -->

</div>
