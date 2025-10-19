<main>
  <section class="section py-5 bg-light">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-lg-7 text-center">
          <p class="text-primary text-uppercase fw-bold mb-2">Frequent Questions</p>
          <h1 class="fw-bold mb-3">Frequently Asked Questions</h1>
          <p class="text-muted">Find answers to the most common questions below.</p>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-9">
          <div class="accordion accordion-border-bottom shadow-sm rounded-3" id="accordionFAQ">
            @if($faqs->isNotEmpty())
              @foreach ($faqs as $faq)
                @php
                  $id = 'faq-' . $loop->index;
                @endphp

                <div class="accordion-item mb-3 border-0">
                  <h2 class="accordion-header" id="heading-{{ $id }}">
                    <button class="accordion-button collapsed fw-semibold text-dark"
                      type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapse-{{ $id }}" aria-expanded="false"
                      aria-controls="collapse-{{ $id }}">
                      {{ $faq->question }}
                    </button>
                  </h2>
                  <div id="collapse-{{ $id }}" class="accordion-collapse collapse"
                    aria-labelledby="heading-{{ $id }}" data-bs-parent="#accordionFAQ">
                    <div class="accordion-body text-muted">
                      {!! $faq->answer !!}
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p class="text-center text-muted">No FAQs available at the moment.</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
