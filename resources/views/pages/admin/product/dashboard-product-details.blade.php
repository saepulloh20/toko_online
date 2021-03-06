@extends('layouts.admin')

@section('title')
    Race Details
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">{{ $product->name }}</h2>
                <p class="dashboard-subtitle">Race Details</p>
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
                        <form action="{{ route('admin/products-update', $product->id) }} " method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Event Start</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $product->event_start }}" name="event_start" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Event End</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $product->event_end }}" name="event_end" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Active Start</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $product->active_start }}" name="active_start" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Active End</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $product->active_end }}" name="active_end" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Race Name</label>
                                                <input type="text" class="form-control" value="{{ $product->name }}"
                                                    name="name" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="Number" class="form-control" value="{{ $product->price }}"
                                                    name="price" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Race Category</label>
                                                <input type="text" class="form-control" value="{{ $product->jenis }}"
                                                    name="jenis" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Race Vanue</label>
                                                <input type="text" class="form-control" value="{{ $product->lokasi }}"
                                                    name="lokasi" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="categories_id" class="form-control">
                                                    <option value="{{ $product->categories_id }}">Tidak diganti
                                                        ({{ $product->category->name }})</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" id="editor">{!! $product->description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5 btn-block">Update
                                                Product</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($product->galleries as $gallery)
                                        <div class="col-md-4">
                                            <div class="gallery-container">
                                                <img src="{{ Storage::url($gallery->photos ?? '') }}" alt=""
                                                    class="w-100" />
                                                <a href="{{ route('products-gallery-delete', $gallery->id) }}"
                                                    class="delete-gallery">
                                                    <img src="/images/remove.svg" alt="" />
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-12">
                                        <form action="{{ route('products-gallery-upload') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="products_id" value="{{ $product->id }}">
                                            <input type="file" name="photos" id="file" style="display: none"
                                                onchange="form.submit()">
                                            <button type="button" class="btn btn-secondary btn-block mt-3"
                                                onclick="thisFileUpload()">Add Photo</button>
                                        </form>
                                        <form action="{{ route('admin/products-destroy', $product->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-block mt-3">Delete
                                                Product</button>
                                        </form>
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

@push('addon-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        function thisFileUpload() {
            document.getElementById('file').click();
        }
    </script>
    <script>
        ClassicEditor.create(document.querySelector('#editor'))
            .then((editor) => {
                console.log(editor);
            })
            .catch((error) => {
                console.error(error);
            });
    </script>
@endpush
