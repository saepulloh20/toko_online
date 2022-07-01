@extends('layouts.admin')

@section('title')
    Category
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Category</h2>
                <p class="dashboard-subtitle">Create New Category</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="allert allert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('validation.update', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Race</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->product->name }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group ">
                                                <label>Distance</label>
                                                <div class="row">
                                                    <div class="col-md-10 input-group">
                                                        <input type="text" name="distance" class="form-control"
                                                            value="{{ $item->distance }} " required><span
                                                            class="input-group-text" id="basic-addon2">KM</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Pace</label>
                                                <input type="text" name="average_pace" class="form-control"
                                                    value="{{ $item->average_pace }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Time</label>
                                                <input type="text" name="time" class="form-control"
                                                    value="{{ $item->time }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <img src="{{ Storage::url($item->photos ?? '') }}" class="w-50" />
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="product-title">Status</div>
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">Verify</option>
                                                <option value="0">In Review</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">Save Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
