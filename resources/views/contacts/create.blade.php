@extends('layouts.fontend')

@section('title', 'Create Contact')

@section('content')
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
                            var successModal = new bootstrap.Modal(document.getElementById(
                                'successModal'));
                            successModal.show();

                            // Hide the modal after 3 seconds
                            setTimeout(function() {
                                successModal.hide();
                            }, 3000);

                            // Clear the form
                            $('#contactForm')[0].reset(); // ล้างค่าของฟอร์ม
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
                            var errorDiv = '<div class="alert alert-danger"><ul>' + errorList +
                                '</ul></div>';
                            $('#contactForm').prepend(errorDiv);
                        } else {
                            alert('An error occurred while saving the data: ' + xhr
                                .responseText);
                        }
                    }
                });
            });
        });
    </script>

    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb py-5">
        <div class="container text-center py-5">
            <h3 class="text-white display-3 mb-4">Contact Us</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="/Dashboards">Home</a></li>
                    <li class="breadcrumb-item active text-white">Contact</li>
                </ol>
        </div>
    </div>
    <!-- Header End -->


    <!-- Contact Start -->
    <div class="container-fluid contact py-5" style="background: var(--bs-primary);">
        <div class="container pt-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="text-center">
                        <h1 class="display-3 text-white mb-4">Contact Us</h1>
                        <p class="text-white fs-4">The contact form is currently inactive. Get a functional and working
                            contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code
                            and you're done. <a class="text-secondary" href="https://htmlcodex.com/contact-form">Download
                                Now</a>.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form rounded p-5">
                        <form id="contactForm" action="{{ route('contacts.store') }}" method="POST">
                            @csrf
                            <h1 class="display-6 mb-4 text-center">คุณมีคำถามใดๆ หรือไม่?</h1>
                            <div class="row gx-4 gy-3">
                                <div class="col-xl-6">
                                    <input class="form-control bg-white border-0 py-3 px-4" id="name" type="text"
                                        placeholder="Your First Name" name="name" value="{{ old('name') }}" required />
                                    <div class="invalid-feedback">A name is required.</div>
                                </div>
                                <div class="col-xl-6">
                                    <input class="form-control bg-white border-0 py-3 px-4" id="email" type="email"
                                        placeholder="Your Email" name="email" value="{{ old('email') }}" required />
                                    <div class="invalid-feedback">An email is required.</div>
                                    <div class="invalid-feedback">Email is not valid.</div>
                                </div>

                                <div class="col-6">
                                    <textarea class="form-control bg-white border-0 py-3 px-4" id="message" name="message" rows="4" cols="10"
                                        placeholder="Your Message" required>{{ old('message') }}</textarea>
                                    <div class="invalid-feedback">A message is required.</div>
                                </div>
                                <div class="col-xl-6">
                                    <input class="form-control bg-white border-0 py-3 px-4" id="phone" type="tel"
                                        placeholder="Your Phone" name="phone" value="{{ old('phone') }}" required />
                                    <div class="invalid-feedback">A phone number is required.</div>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-primary-outline-0 w-100 py-3 px-5">บันทึก</button>
                                    
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
