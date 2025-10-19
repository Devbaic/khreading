
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<title>{{ $title ?? 'KH READING' }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
	<meta name="description" content="This is meta description">
	<meta name="author" content="Themefisher">
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
	<link rel="icon" href="images/favicon.png" type="image/x-icon">

	<!-- # Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/3d-flip-book/dist/css/flipbook.style.css">
	<!-- # CSS Plugins -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="{{asset('https://fonts.googleapis.com')}}">
    <link rel="preconnect" href="{{asset('https://fonts.gstatic.com')}}" crossorigin>
    <link href="{{asset('https://fonts.googleapis.com/css2?family=Moul&display=swap')}}" rel="stylesheet">

    <!-- 3D FlipBook CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/3d-flip-book/dist/css/flipbook.style.css">
    <script src="//static.anyflip.com/plugin/LightBox/js/anyflp-light-box-api-min.js"></script>
    <!-- Font Awesome for placeholder icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link rel="stylesheet" href="{{asset('/front/plugins/slick/slick.css')}}">
	<link rel="stylesheet" href="{{asset('/front/plugins/font-awesome/fontawesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('/front/plugins/font-awesome/brands.css')}}">
	<link rel="stylesheet" href="{{asset('/front/plugins/font-awesome/solid.css')}}">
<link rel="icon" href="/images/khreading (1).png" type="image/x-icon">
	<!-- # Main Style Sheet -->
	<link rel="stylesheet" href="{{asset('/front/css/style.css')}}">
    @livewireStyles
</head>

<body>

<!-- navigation -->
<header class="navigation bg-tertiary">
	<nav class="py-3 text-center navbar navbar-expand-xl navbar-light">
		<div class="container">
			<a class="navbar-brand" href="{{route('home')}}">
				<img loading="prelaod" decoding="async" class="img-fluid" width="150" src="images/khreading__1_-removebg-preview.png" alt="">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="m-auto mb-2 navbar-nav mb-lg-0">
					<li class="nav-item"> <a class="nav-link" href="{{route('home')}}">Home</a></li>
					<li class="nav-item "> <a class="nav-link" href="{{route('about')}}">About Us</a></li>
					<li class="nav-item "> <a class="nav-link" href="{{route('books')}}">Books</a></li>
                    <li class="nav-item "> <a class="nav-link" href="{{route('team')}}">Our Team</a></li>
					<li class="nav-item "><a class="nav-link " href="{{route('blog')}}">Blog</a></li>
					<li class="nav-item "><a class="nav-link " href="{{route('faq')}}">FAQ</a></li>
				</ul>
				<a href="{{route('contact')}}" class="btn btn-outline-primary">Contact Us</a>
			</div>
		</div>
	</nav>
</header>
<!-- /navigation -->

 {{ $slot }}






<footer class="section-sm bg-tertiary">
	<div class="container">
		<div class="row justify-content-between">
			<div class="mb-4 col-lg-2 col-md-4 col-6">
				<div class="footer-widget">
					<h5 class="mb-4 text-primary font-secondary">Service</h5>
					<ul class="list-unstyled">
						<li class="mb-2"><a href="service-details.html">Web Design</a>
						</li>
						<li class="mb-2"><a href="service-details.html">Graphic Design</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="mb-4 col-lg-2 col-md-4 col-6">
				<div class="footer-widget">
					<h5 class="mb-4 text-primary font-secondary">Quick Links</h5>
					<ul class="list-unstyled">
						<li class="mb-2"><a href="{{route('about')}}">About Us</a>
						</li>
						<li class="mb-2"><a href="{{route('contact')}}">Contact Us</a>
						</li>
						<li class="mb-2"><a href="{{route('blog')}}">Blog</a>
						</li>
						<li class="mb-2"><a href="{{route('team')}}">Team</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="mb-4 col-lg-2 col-md-4 col-6">
				<div class="footer-widget">
					<h5 class="mb-4 text-primary font-secondary">Other Links</h5>
					<ul class="list-unstyled">
						<li class="list-inline-item me-4"><a class="text-black" href="privacy-policy.html">Privacy Policy</a>
                        </li>
						<li class="list-inline-item me-4"><a class="text-black" href="terms.html">Terms &amp; Conditions</a>
                        </li>
					</ul>
				</div>
			</div>
		</div>

	</div>
</footer>

<!-- # JS Plugins -->
<script src="{{asset('/front/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/front/plugins/bootstrap/bootstrap.min.js')}}"></script>

<!-- Main Script -->
<script src="{{asset('/front/js/script.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/3d-flip-book/dist/js/flipbook.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/3d-flip-book/dist/js/flipbook.min.js"></script>
</body>
<script>
$(document).ready(function() {
    let flipbookInstance = null;

    function openBookModal(fileUrl) {
        if (!fileUrl || fileUrl.includes('anyflip.com')) {
            if(fileUrl) window.open(fileUrl, '_blank');
            return;
        }

        $('#flipbookModal').modal('show');
        $('#flipbookContainer').html('<div class="mt-5 text-center"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');

        if (flipbookInstance) {
            flipbookInstance.destroy();
            flipbookInstance = null;
        }

        setTimeout(() => {
            flipbookInstance = $("#flipbookContainer").FlipBook({
                pdf: fileUrl,
                template: {
                    html: "https://cdn.jsdelivr.net/npm/3d-flip-book/dist/templates/default-book-view.html"
                },
                propertiesCallback: function(props) {
                    props.page.depth = 3;
                    props.cover.color = 0x333333;
                    return props;
                },
                controlsProps: {
                    downloadURL: fileUrl,
                    actions: {
                        cmdDownloadPDF: { enabled: true },
                        cmdPrint: { enabled: true }
                    }
                }
            });
        }, 300);
    }

    $(document).on('click', '.book-image, .open-book', function(e) {
        e.preventDefault();
        const fileUrl = $(this).data('href');
        openBookModal(fileUrl);
    });

    $('#flipbookModal').on('hidden.bs.modal', function () {
        if (flipbookInstance) {
            flipbookInstance.destroy();
            flipbookInstance = null;
            $('#flipbookContainer').html('');
        }
    });
});
</script>
 @livewireScripts
</html>
