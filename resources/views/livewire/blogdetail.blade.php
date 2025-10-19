<main>
    <div class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="mb-5">
          <h2 class="mb-4" style="line-height:1.5">{{$article->title}}</h2>
          <span>{{ $article->created_at->format('M d, Y') }} <span class="mx-2">/</span> </span>
          <p class="list-inline-item">Category : <a href="#!" class="ml-1">{{ $article->category?->name }}
</a>
          </p>
          <p class="list-inline-item">Author : <a href="#!" class="ml-1">{{$article->author}}</a>
          </p>
        </div>
        <div class="mb-5 text-center">
          <div class="overflow-hidden rounded post-slider">
            <img loading="lazy" decoding="async" src="{{ asset('storage/' . $article->image) }}" alt="Post Thumbnail">

          </div>
        </div>
        <div class="content">
            {{$article->content}}
        </div>
      </div>
    </div>
  </div>
</div>
</main>
