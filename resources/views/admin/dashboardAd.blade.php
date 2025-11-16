@extends('layouts.admin')

@section('content')
<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Illustrations -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="show-chatbot">
                <div class="chatbot">
                    <header>
                        <p><span style="font-size: 30px; font-weight: bold;">T</span>o learn piano on your own, follow these 8 main steps:</p>
                    </header>
                    <ul class="chatbox" id="chatbox">
                    <li>1.Understand the keyboard: Understand the names of the notes </li>
                    <br>
                    <li>2.Learn to read sheet music: Know how to read musical notation and rhythm.</li>
                    <br>
                    <li>3.Hand technique: Practice your fingers, sitting posture, and correct hand </li>
                    <br>
                    <li>4.Chords: Understand basic chords and how to change chords.</li>
                    <br>
                    <li>5.Rhythm: Maintain a steady rhythm when playing.</li>
                    <br>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Approach -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <br>
                <p style="font-size: 30px; font-weight: bold; text-align:center;">Try Your Best</p>
                <br>
            </div>
            <div class="card-body">
                <div style="display: flex; align-items: center; margin:10px">
                    <p>
                        <span style="font-size: 30px; font-weight: bold;">A</span> you considering learning piano on your own but don't know how to start and where to start? Learning to play the piano is a rewarding experience, regardless of age.
                        If you're worried about how expensive piano lessons are, or don't have the time to arrange, you can study at home. So how to learn the piano on your own?
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection