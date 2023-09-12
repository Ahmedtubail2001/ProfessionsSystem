@extends('cms.parent')

@section('title')

@endsection

@section('title', 'Title')
@section('page-title', 'Title')
@section('small-title', 'Title')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="nav-icon fas fa-hammer"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Professions</span>
                        <span class="info-box-number">
                            {{ $professions}}

                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-briefcase"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Workers</span>
                        <span class="info-box-number">{{$workers}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">All Users</span>
                        <span class="info-box-number"> {{$users}}</span>

                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-city"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Cities</span>
                        <span class="info-box-number">{{$cities}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
    </div>

    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            Digital Strategist
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>Luay Matar</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> backEnd Developer / laravel framwork /
                                        jquery
                                    </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-building"></i></span>
                                            Address: Gaza , Dr-albalah , Brka</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                            Phone #: + 972 - 56 72 75 232</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="https://media.licdn.com/dms/image/D4D03AQFOzEBVIeUHxg/profile-displayphoto-shrink_800_800/0/1677965639362?e=1694044800&v=beta&t=nysDRrw50GjbvF73xcCsnk0K-sfG0C4vzAWGRlIj4AM"
                                        alt="user-avatar" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">

                                <a href="https://www.linkedin.com/in/luay-matar-639320224/"
                                    class="btn btn-sm btn-primary" target="_blank">
                                    <i class="fas fa-user"></i> View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            Digital Strategist
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>Ahmed Tubail</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> Web developer / Back End/
                                        Coffee Lover </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-building"></i></span>
                                            Address:Palestine , Gaza , al-Naser</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                            Phone #: +972 59 51 48 174</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="https://media.licdn.com/dms/image/D4D35AQGkXD5l5Cwx1A/profile-framedphoto-shrink_800_800/0/1679561957745?e=1689073200&v=beta&t=4C5nYvsCEojHiHdLMX-dUVGmhCL_2UBPHhLN50cqhUg"
                                        alt="user-avatar" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">

                                <a href="https://www.linkedin.com/in/ahmed-tubail-3b236326a/" target="_blank"
                                    class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            Digital Strategist
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>Mohamed Alserhi</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> Web Designer / Front End Developer /
                                        Flutter /
                                        Coffee
                                        Lover </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-building"></i></span>
                                            Address: Palestine , Gaza, Al-Zaytoun Street 10</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                            Phone #: + 972 59 24 76 869</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="https://media.licdn.com/dms/image/D4D03AQHs15DwqOKenA/profile-displayphoto-shrink_800_800/0/1687593412718?e=1694044800&v=beta&t=rWoach-KwIwiKJIE0pRsdr8Ho49vIUMFUH4W-jGlLog"
                                        alt="user-avatar" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">

                                <a href="https://www.linkedin.com/in/mohamed-alserhi-2a93101a6/" target="_blank"
                                    class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            Digital Strategist
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>Taj aldeen huseen</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> Web Designer / react / node js /
                                        Coffee
                                        Lover </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-building"></i></span>
                                            Address: Palestine , Gaza , Al-brije</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                            Phone #: +972 59 23 68 009</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="https://media.licdn.com/dms/image/D4D03AQHhFB2t3ePqJA/profile-displayphoto-shrink_800_800/0/1688480170441?e=1694044800&v=beta&t=5kosGz9MAFbAjvKqi5nbdf3qagjagEUqV1alxgRJeX0"
                                        alt="user-avatar" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">

                                <a href="https://www.linkedin.com/in/taj-aldeen/" target="_blank"
                                    class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
</section>
<!-- /.row -->
@endsection

@section('script')

@endsection