@extends('layouts.admin')

@section('title')
    Create Size Chart
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
                                <form action="{{ route('admin-stock/store') }}" method="POST" id="stockproducts"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Pajar</label>
                                                <select name="products_id" class="form-control" v-if="products"
                                                    @change="category()" v-model="selectedProduct">
                                                    <option v-for="product in products" :value="product">
                                                        @{{ product.name }}
                                                    </option>
                                                </select>
                                                <select v-else class="form-control">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Size Product</label>
                                                <select name="sizecharts_id" class="form-control" v-if="sizecharts"
                                                    v-model="sizecharts_id">
                                                    <option v-for="size in sizecharts" :value="size.id">
                                                        @{{ size.size }}
                                                    </option>
                                                </select>
                                                <select v-else class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Stock</label>
                                                <input type="text" name="stock" class="form-control" required>
                                            </div>
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

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        var locations = new Vue({
            el: '#stockproducts',
            mounted() {
                AOS.init();
                this.getProductsData();
            },
            data: {
                products: null,
                sizecharts: null,
                selectedProduct: null,
                sizecharts_id: null,
                categories_id: null,
                products_id: null,
            },
            methods: {
                getProductsData() {
                    var self = this;
                    axios.get('{{ route('api-product') }}')
                        .then(function(response) {
                            self.products = response.data;
                        })
                },

                category(categories_id) {
                    var self = this;
                    self.categories_id = self.selectedProduct.categories_id;

                },
                getSizeData() {
                    var self = this;
                    axios.get('{{ url('api/size') }}/' + self.categories_id)
                        .then(function(response) {
                            self.sizecharts = response.data;
                        })
                }
            },
            watch: {
                selectedProduct: function(val, oldVal) {
                    this.sizecharts_id = null;
                    this.getSizeData();
                }
            }
        });
    </script>
@endpush
