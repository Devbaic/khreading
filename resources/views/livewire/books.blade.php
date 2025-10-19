<main>

    <!-- Page Header -->
    <section class="page-header bg-tertiary">
        <div class="container py-4 text-center">
            <h2 class="mb-3">Our Books</h2>
            <ul class="list-inline breadcrumbs">
                <li class="list-inline-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="list-inline-item">/ <a href="{{ route('books') }}">Books</a></li>
            </ul>
        </div>
    </section>

    <!-- Book Grid -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                @if($books->isNotEmpty())
                    @foreach($books as $book)
                        <div class="mb-4 col-lg-4 col-md-6">
                            <div class="text-center border-0 shadow-sm card h-100 book-card">
                                <div class="p-4 card-body">
                                    <div class="mb-3">
                                        @if($book->image)
                                            <img src="{{ asset('storage/' . $book->image) }}"
                                                 alt="{{ $book->name }}"
                                                 class="mb-3 book-image"
                                                 style="cursor:pointer; border-radius:8px; transition: transform 0.3s;"
                                                 onclick="openFlipbook('{{ $book->flip_url }}')"
                                                 onmouseover="this.style.transform='scale(1.05)'"
                                                 onmouseout="this.style.transform='scale(1)'">
                                        @else
                                            <div class="mb-3 text-center book-placeholder">
                                                <i class="fas fa-book fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <h4 class="mb-2" >{{ $book->name }}</h4>
                                    <p class="mb-1 text-muted">អ្នកនិពន្ធ: {{ $book->author }}</p>
                                    <p class="mb-3">{{ optional($book->typebook)->name ?? 'No Type' }}</p>

                                    <div class="gap-2 d-flex justify-content-center">
                                        @if($book->flip_url)
                                            <button class="btn btn-primary btn-sm" onclick="openFlipbook('{{ $book->flip_url }}')">
                                                Read Book <i class="fas fa-book-open ms-1"></i>
                                            </button>
                                        @endif
                                        @if($book->filebook)
                                            <a href="{{ asset('storage/' . $book->filebook) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                Download PDF <i class="fas fa-download ms-1"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-muted">No books available.</p>
                @endif
            </div>
        </div>
    </section>

    <!-- Book Viewer Modal -->
    <div id="bookViewer" class="book-viewer-container"
         style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.95); justify-content:center; align-items:center; z-index:9999; opacity:0; transition: opacity 0.3s;">
        <div class="book-viewer" style="width:90%; max-width:900px; height:90%; max-height:700px; background:white; border-radius:10px; position:relative;">
            <button class="close-book" onclick="closeBookViewer()"
                    style="position:absolute; top:10px; right:10px; background:#ff4757; color:white; border:none; border-radius:50%; width:40px; height:40px; display:flex; justify-content:center; align-items:center;"
                    aria-label="Close Book Viewer">
                <i class="fas fa-times"></i>
            </button>
            <div class="iframe-wrapper" style="position:relative; width:100%; padding-top:60%;">
                <iframe id="flipIframe" style="position:absolute; top:0; left:0; width:100%; height:100%; border:none;"
                        src="" seamless allowtransparency="true" allowfullscreen="true"></iframe>
            </div>
        </div>
    </div>

    <script>
        const viewer = document.getElementById('bookViewer');
        const iframe = document.getElementById('flipIframe');

        function openFlipbook(url) {
            if(!url) {
                alert('Flipbook URL not available.');
                return;
            }
            iframe.src = url;
            viewer.style.display = 'flex';
            setTimeout(() => viewer.style.opacity = 1, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeBookViewer() {
            viewer.style.opacity = 0;
            setTimeout(() => {
                viewer.style.display = 'none';
                iframe.src = '';
            }, 300);
            document.body.style.overflow = 'auto';
        }

        // Close on click outside
        viewer.addEventListener('click', function(e){
            if(e.target === this) closeBookViewer();
        });

        // Close with ESC key
        document.addEventListener('keydown', function(e){
            if(e.key === 'Escape') closeBookViewer();
        });
    </script>

</main>
