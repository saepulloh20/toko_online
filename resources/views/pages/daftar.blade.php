@extends('layouts.app')

@section('title')
    Registration Page
@endsection

@section('content')
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>

                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Registration</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-4">Registration Virtual Rohiman Run 17K</h2>
                    </div>
                </div>
                <form action="{{ route('checkout') }}" id="locations" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_one"> First Name </label>
                                <input type="text" class="form-control" id="address_one" name="address_one" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_two"> Last Name </label>
                                <input type="text" class="form-control" id="address_two" name="address_two" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="zip_code">Email</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="country">Gender</label>
                                <input type="text" class="form-control" id="country" name="country" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Date Of Birth</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Blood Type</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">ID Card</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">ID Card Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Country</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Address Line</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">City</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="phone_number">State</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="phone_number">Zip Code</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="phone_number">Running Group</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
