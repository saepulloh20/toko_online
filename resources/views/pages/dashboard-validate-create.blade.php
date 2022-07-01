@extends('layouts.dashboard')

@section('title')
    Race Event
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Create Submission Form</h2>
                <p class="dashboard-subtitle">Membuat Submission Form</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="allert allert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('dashboard/validate-store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Race Event</label>
                                                <select name="products_id" class="form-control">
                                                    @foreach ($buyTransactions as $transaction)
                                                        <option value="{{ $transaction->product->id }}">
                                                            {{ $transaction->product->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Race Type</label>
                                                <select name="race_type" class="form-control" readonly='readonly'>
                                                    @foreach ($buyTransactions as $transaction)
                                                        <option value="{{ $transaction->product->category->id }}">
                                                            {{ $transaction->product->category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group ">
                                                <label>Distance</label>
                                                <div class="row">
                                                    <div class="col-md-10 input-group">
                                                        <input type="text" name="distance" class="form-control"><span
                                                            class="input-group-text" id="basic-addon2">KM</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Average Pace</label>
                                                <input type="text" class="form-control" name="average_pace" />
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Time</label>
                                                <input type="text" class="form-control" name="time" />
                                                <p class="text-muted">Format (00:00:00)</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Photos</label>
                                                <input type="file" name="photos" class="form-control" />
                                                <p class="text-muted">Kamu dapat memilih lebih dari 1 file</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">Save Now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
