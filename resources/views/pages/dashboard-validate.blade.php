@extends('layouts.dashboard')

@section('title')
    Dashboard Validation Race Event
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Validate Race Event</h2>
                <p class="dashboard-subtitle">Big result start from the small one</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-12 mt-2">
                                <!-- Tabs -->
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                            role="tab" aria-controls="pills-home" aria-selected="true">Submission
                                            Form</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <a href="" class="card card-list d-block">
                                            <div class="row">
                                                <div class="col-12">
                                                    <a href="{{ route('dashboard/validate-create') }}"
                                                        class="btn btn-success">Add Submission</a>
                                                </div>
                                            </div>
                                            <div class="container ">
                                                <div class="row">
                                                    <div class="col-12 col-lg-12 bg-light">
                                                        <h1>Total KM : {{ $km }} KM</h1>
                                                        <h1>Time : {{ $time }}</h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                @foreach ($validates as $validate)
                                                    <div class="col-12 col-sm-6 col-lg-3">
                                                        <a href="{{ route('dashboard-validate-details', $validate->id) }}"
                                                            class="card card-dashboard-product d-block">
                                                            <div class="card-body">
                                                                <img src="{{ Storage::url($validate->photos ?? '') }}"
                                                                    alt="" class="w-100 mb-2" />
                                                                <div class="product-title">
                                                                    {{ $validate->product->name }}</div>

                                                                <div class="product-category">
                                                                    {{ $validate->categories->name }}</div>

                                                                <div class="product-category">
                                                                    {{ $validate->status == 1 ? 'Verify' : 'In Review' }}
                                                                </div>

                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
