@extends('layouts.dashboard')

@section('title')
    Dashboard Transaction Detail
@endsection
@push('addon-script')
    <script>
        const myModalEl = document.getElementById('photosModal')
        const modal = new bootstrap.Modal(myModalEl)
    </script>
@endpush
@section('content')
    <!-- Secction Content -->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">{{ $validates->product->name }}</h2>
                <p class="dashboard-subtitle">Transactions Details</p>
            </div>
            <div class="dashboard-content" id="transactionDetails">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-10">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#photosModal">
                                            <img src="{{ Storage::url($validates->photos ?? '') }}" class="w-50 mb-5"
                                                alt="" /></a>
                                        <div class="modal fade" id="photosModal" data-bs-backdrop="static" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ...
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Customer Name</div>
                                                <div class="product-subtitle">
                                                    {{ $validates->user->name ?? '' }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Race Name</div>
                                                <div class="product-subtitle">{{ $validates->product->name }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Race Type</div>
                                                <div class="product-subtitle">{{ $validates->categories->name }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Distance</div>
                                                <div class="product-subtitle">
                                                    {{ number_format($validates->distance) }} KM
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Average Pace</div>
                                                <div class="product-subtitle">
                                                    {{ $validates->average_pace }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Time</div>
                                                <div class="product-subtitle">{{ $validates->time }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Status</div>
                                                <div class="product-subtitle">
                                                    {{ $validates->status == 1 ? 'Verify' : 'In Review' }}</div>
                                            </div>
                                        </div>
                                    </div>
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
