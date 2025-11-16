<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học Lý Thuyết Âm Nhạc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand">Web Piano</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav main-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('study') }}">Study</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('practice') }}">Practice</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('competition') }}">Competition</a></li>

                    </ul>

                    <!-- Thanh tìm kiếm trong header -->
                    <li class="nav-item ms-5">
                        <form id="searchForm" class="d-flex align-items-center">
                            <div class="input-group">
                                <input type="text" id="searchInput" class="form-control bg-light border-0 small" placeholder="Search for songs">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        document.getElementById("searchForm").addEventListener("submit", function(event) {
                            event.preventDefault();

                            var query = document.getElementById("searchInput").value.toLowerCase();

                            var tables = document.querySelectorAll('*');

                            var found = false;

                            tables.forEach(function(table) {
                                var rows = table.querySelectorAll('tr');

                                rows.forEach(function(row) {
                                    var cells = row.querySelectorAll('td, th');

                                    cells.forEach(function(cell) {

                                        if (cell.textContent.toLowerCase().includes(query)) {
                                            cell.style.backgroundColor = "yellow";
                                            row.scrollIntoView({
                                                behavior: 'smooth',
                                                block: 'center'
                                            });
                                            found = true;
                                        } else {
                                            cell.style.backgroundColor = "";
                                        }
                                    });
                                });
                            });

                            if (!found) {
                                alert("No results found.");
                            }
                        });
                    </script>

                    </ul>

                    <ul class="navbar-nav button-group">

                        <li class="nav-item">
                            <button id="facebookShareButton" class="btn btn-custom me-2">
                                <i class="fa-solid fa-share" style="font-size: 1.5rem;"></i>
                            </button>
                        </li>
                        <li class="nav-item dropdown">
                            @if (Auth::check())
                            <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('image/undraw_profile.svg') }}" style="width: 45px; height: 45px;">
                            </a>
                            @else
                            <a href="{{ route('account.login') }}" class="btn btn-custom me-2" style="text-decoration: none;">Log in</a>
                            @endif
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userMenu">
                                <form action="{{ route('account.logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>
                                <a class="dropdown-item" href="{{ route('activity') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                            </div>

                    </div>
                 </div>
            </div>
        </nav>
        <script>
            document.getElementById("facebookShareButton").addEventListener("click", function() {
                const currentUrl = window.location.href;
                const shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`;


                window.open(shareUrl, "_blank", "width=600,height=400");
            });
        </script>
    </header>