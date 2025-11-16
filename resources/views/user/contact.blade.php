<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://www.soengsouy.com/favicon.ico" rel="icon" type="image/x-icon"/>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/animate/animate.css">
    <link rel="stylesheet" href="css/util.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
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
</body>
</html>
