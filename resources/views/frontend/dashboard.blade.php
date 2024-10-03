<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>มูลนิธิแม่กอเหนี่ยวยะลา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link href="{{ asset('fontend/css/styles.css') }}" rel="stylesheet" />
</head>

<style>
    .logo-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    header.masthead {
        background-image: url('{{ asset('images/aaa.png') }}');
        background-size: cover;
        background-position: center;
        height: 100vh;
        color: #fff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    }

    .section-heading {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .section-subheading {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        color: #6c757d;
    }

    .portfolio-item img {
        transition: transform 0.2s ease;
    }

    .portfolio-item img:hover {
        transform: scale(1.05);
    }

    .fixed-size {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    footer.footer {
        background-color: #f8f9fa;
        padding: 2rem 0;
        text-align: center;
    }
</style>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo-icon rounded-circle">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#news">ข่าวสาร</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">บริการข่าวสาร</a></li>
                    <li class="nav-item"><a class="nav-link" href="#learning-resources">สาระเรียนรู้</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">Welcome</div>
            <div class="masthead-heading text-uppercase">มูลนิธิแม่กอเหนี่ยวยะลา</div>
            <a class="btn btn-primary btn-xl text-uppercase" href="{{ route('login.user') }}">บริแจ้งอุบัติเหตุ 24 ชั่วโมง</a>
        </div>
    </header>

    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="news">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">บริการข่าวสาร</h2>
                <h3 class="section-subheading text-muted">การเกิดอุบัติเหตุในพื้นจังหวัดยะลา</h3>
            </div>
            <div class="row">
                @forelse($news as $item)
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal{{ $item->id }}">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"></i></div>
                                </div>
                                @if ($item->image)
                                    @php
                                        $images = json_decode($item->image);
                                    @endphp

                                    @if (!empty($images))
                                        <img class="img-fluid fixed-size" src="{{ asset($images[0]) }}" alt="Image">
                                    @else
                                        <img class="img-fluid fixed-size" src="{{ asset('path/to/default-image.jpg') }}" alt="Default Image">
                                    @endif
                                @else
                                    <img class="img-fluid fixed-size" src="{{ asset('path/to/default-image.jpg') }}" alt="Default Image">
                                @endif
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">{{ $item->title }}</div>
                                <div class="portfolio-caption-subheading text-muted">{{ $item->time }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">ไม่มีข่าวที่จะแสดง</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="page-section" id="services">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">บริการข่าวสาร</h2>
                <h3 class="section-subheading text-muted">การเกิดอุบัติเหตุในพื้นจังหวัดยะลา</h3>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <a href="{{ route('news.index') }}" class="text-decoration-none text-dark">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-ambulance fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">อุบัติเหตุ</h4>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('news.index') }}" class="text-decoration-none text-dark">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-procedures fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">เจ็บป่วย</h4>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('news.index') }}" class="text-decoration-none text-dark">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-ellipsis-h fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">อื่นๆ</h4>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Learning Resources Section -->
    <section class="page-section bg-light" id="learning-resources">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">สาระเรียนรู้</h2>
                <h3 class="section-subheading text-muted">Some resources to enhance your learning.</h3>
            </div>
       
            
        </div>
    </section>

    <!-- Contact Section -->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">ติดต่อ</h2>
                <h3 class="section-subheading text-muted">สามาถรติดต่อได้ 24 ชม.</h3>
            </div>
            <form id="contactForm" action="{{ route('contacts.store') }}" method="POST">
                @csrf
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" id="name" type="text" placeholder="Your Name *" name="name" value="{{ old('name') }}" required />
                            <div class="invalid-feedback">A name is required.</div>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="email" type="email" placeholder="Your Email *" name="email" value="{{ old('email') }}" required />
                            <div class="invalid-feedback">An email is required.</div>
                            <div class="invalid-feedback">Email is not valid.</div>
                        </div>
                        <div class="form-group mb-md-0">
                            <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" name="phone" value="{{ old('phone') }}" required />
                            <div class="invalid-feedback">A phone number is required.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-textarea mb-md-0">
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message" required>{{ old('message') }}</textarea>
                            <div class="invalid-feedback">A message is required.</div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary btn-xl">Submit</button>
                    </div>
                </div>
            </form>

            <!-- Success Modal -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="successModalLabel">สำเร็จ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ข้อมูลของคุณถูกบันทึกสำเร็จแล้ว
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#contactForm').on('submit', function(event) {
                        event.preventDefault();
                        var formData = new FormData(this);

                        // Clear previous error messages
                        $('#contactForm').find('.alert-danger').remove();

                        $.ajax({
                            url: "{{ route('contacts.store') }}",
                            method: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                if (response.success) {
                                    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                                    successModal.show();

                                    // Hide the modal after 3 seconds
                                    setTimeout(function() {
                                        successModal.hide();
                                    }, 3000);
                                } else {
                                    alert(response.message);
                                }
                            },
                            error: function(xhr) {
                                var errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                                if (errors) {
                                    var errorList = '';
                                    $.each(errors, function(key, value) {
                                        errorList += '<li>' + value + '</li>';
                                    });
                                    var errorDiv = '<div class="alert alert-danger"><ul>' + errorList + '</ul></div>';
                                    $('#contactForm').prepend(errorDiv);
                                } else {
                                    alert('An error occurred while saving the data: ' + xhr.responseText);
                                }
                            }
                        });
                    });
                });
            </script>
        </div>
    </section>

    <!-- Footer-->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2023</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" href="https://www.facebook.com/profile.php?id=100064623012060&sk=photos" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark text-decoration-none me-3" href="#!">ขอคุณที่ใช้บริการ</a>
                    <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals-->
    @foreach ($news as $item)
    <div class="portfolio-modal modal fade" id="portfolioModal{{ $item->id }}" tabindex="-1" aria-labelledby="portfolioModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal">
                    <img src="{{ asset('images/icon.png') }}" alt="Close modal" />
                </div>
                <div class="modal-body">
                    <h2 class="text-uppercase">{{ $item->title }}</h2>
                    <p class="item-intro text-muted">{{ $item->time }}</p>
                    <p class="text-muted">{{ $item->location }}</p>
                    
                    <!-- แสดงรูปภาพในรูปแบบสไลด์ -->
                    @if ($item->image)
                        @php
                            $images = json_decode($item->image);
                        @endphp

                        @if (!empty($images))
                            <div id="carousel{{ $item->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($images as $index => $image)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img class="img-fluid d-block mx-auto" src="{{ asset($image) }}" alt="{{ $item->title }}" style=" max-height: 400px;">
                                        </div>
                                    @endforeach
                                </div>
                         
                                <a class="carousel-control-prev" href="#carousel{{ $item->id }}" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel{{ $item->id }}" role="button" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </a>
                            </div>
                        @endif
                    @endif

                    <p>{{ $item->content }}</p>
                    <p>{{ $item->username }}</p>
                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                        <i class="fas fa-times me-1"></i>
                        ปิด
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('fontend/js/scripts.js') }}"></script>
</body>

</html>
