@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container text-center mt-5">
        <h1>Learn Music Theory for Free</h1>
        <p>Musicca helps you improve your reading, writing, and playing music through effective exercises and engaging content. It's free forever.</p>
        <a href="{{route('study')}}" class="btn btn-start mt-3">Start</a>
    </div>
    <div class="container mt-5">
        <div class="row text-center">
            <!-- Cột 1: Vui thú và hiệu quả -->
            <div class="col-md-6 left-column">
                <h2>Fun and effective</h2>
                <p>Web Piano helps you practice your piano skills in a fun and effective way through interactive practice exercises and innovative gameplay. You can learn and play piano online with in-depth lessons designed for all levels. Create a free account to access all content, participate in music challenges, and discover the joy of learning piano at home. Don't worry about ads, you can enjoy a seamless learning experience.</p>
                <a href="{{route('account.login')}}" class="btn btn-create">Create account</a>
            </div>
            <!-- Cột 2: Dành cho các trường học -->
            <div class="col-md-6">
                <h2>For schools</h2>
                <p>Web Piano is a great tool to support the teaching of piano theory and practice in the school environment. The platform provides online lessons, rich practice exercises and interactive music games to help students master music knowledge in a fun and effective way.
Teachers can easily use Web Piano to guide students in their piano lessons at school, or to help with homework. With a friendly interface and completely free, students can learn music at their own pace, whether at school or at home.</p>
            </div>
        </div>
        <!-- Hàng icon mô tả -->
        <div class="row text-center mt-5">
            <div class="col-md-4 d-flex justify-content-center">
                <div class="card p-3 hover-card bordered-card reduced-width">
                    <div class="image-container">
                        <img src="{{ asset('image/anh1.jpg') }}" alt="Ảnh 1" class="img-fluid full-image">
                        <div class="hover-content">Getting Started</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                <div class="card p-3 hover-card bordered-card reduced-width">
                    <div class="image-container">
                        <img src="{{ asset('image/anh2.jpg') }}" alt="Ảnh 1" class="img-fluid full-image">
                        <div class="hover-content">Basic Practice</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                <div class="card p-3 hover-card bordered-card reduced-width">
                    <div class="image-container">
                        <img src="{{ asset('image/anh3.jpg') }}" alt="Ảnh 1" class="img-fluid full-image">
                        <div class="hover-content">Playing the Game the Right Way</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row text-center justify-content-center">
            <!-- Cột 1: Vui thú và hiệu quả -->
                <div class="col-md-6 mx-auto">
                    <h2>Explore your musical talent</h2>
                    <p>Web Piano is not only a learning tool, but also a space for you to explore and develop your musical talent. With a diverse system of exercises, from basic to advanced, you will gradually master how to play the piano easily.
The creative test and challenge system on Web Piano helps you self-assess your skills, participate in music competitions and track your progress. This is the ideal place for you to turn your passion for music into reality.</p>
                </div>
            </div>
        </div>
        <div class="contact1">
            <div class="container-contact1">
                <div class="contact1-pic js-tilt" data-tilt>
                    <img src="image/img-01.png" alt="IMG">
                </div>
                <form action="{{ route('contact.form') }}" method="POST" class="contact1-form validate-form">
                    @csrf
                    <span class="contact1-form-title">
                        CONTACT FORM
                    </span>
                    
                    @if(session('result'))
                        <h6 class="text-center text-success">{{ session('result') }}</h6>
                    @elseif(session('error'))
                        <h6 class="text-center text-danger">{{ session('error') }}</h6>
                    @endif

                    <div class="wrap-input1 validate-input" data-validate="Name is required">
                        <input class="input1" type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                        <span class="shadow-input1"></span>
                    </div>

                    <div class="wrap-input1 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input1" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                        <span class="shadow-input1"></span>
                    </div>

                    <div class="wrap-input1 validate-input" data-validate="Subject is required">
                        <input class="input1" type="text" name="subject" placeholder="Subject" value="{{ old('subject') }}" required>
                        <span class="shadow-input1"></span>
                    </div>

                    <div class="wrap-input1 validate-input" data-validate="Message is required">
                        <textarea class="input1" name="message" placeholder="Message" required>{{ old('message') }}</textarea>
                        <span class="shadow-input1"></span>
                    </div>

                    <div class="container-contact1-form-btn">
                        <button type="submit" class="contact1-form-btn">
                            <span>
                                Send Email
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="{{ asset('js/practice.js') }}"></script>
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/tilt/tilt.jquery.min.js"></script>
<script>
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<script src="js/main.js"></script>
@endsection
