@extends('layouts.app')

@section('title')
    Store Detail Page
@endsection
@push('addon-script')
    <script>
        $("#incrementValue").click(function(e) {
            e.preventDefault();
            var value = parseInt($('#qtyProduct').val());
            value = isNaN(value) ? 1 : value;
            value++;
            $('#qtyProduct').val(value);
        })
        $("#incrementValueMin").click(function(e) {
            e.preventDefault();
            var value = parseInt($('#qtyProduct').val());
            value = isNaN(value) ? 1 : value;
            if (value > 1) {
                value--;
            }
            $('#qtyProduct').val(value);
        })
    </script>
    <script>
        $(function() {


            /* =========================================
                COUNTDOWN 1
             ========================================= */
            $('#clock').countdown('2021/1/10').on('update.countdown', function(event) {
                var $this = $(this).html(event.strftime('' +
                    '<span class="h1 font-weight-bold">%D</span> Day%!d' +
                    '<span class="h1 font-weight-bold">%H</span> Hr' +
                    '<span class="h1 font-weight-bold">%M</span> Min' +
                    '<span class="h1 font-weight-bold">%S</span> Sec'));
            });

            /* =========================================
                COUNTDOWN 2
             ========================================= */
            $('#clock-a').countdown('2021/1/10').on('update.countdown', function(event) {
                var $this = $(this).html(event.strftime('' +
                    '<span class="h1 font-weight-bold">%w</span> week%!w' +
                    '<span class="h1 font-weight-bold">%D</span> Days'));
            });

            /* =========================================
                COUNTDOWN 3
             ========================================= */
            $('#clock-b').countdown('2021/1/1').on('update.countdown', function(event) {
                var $this = $(this).html(event.strftime('' +
                    '<div class="holder m-2"><span class="h1 font-weight-bold">%D</span> Day%!d</div>' +
                    '<div class="holder m-2"><span class="h1 font-weight-bold">%H</span> Hr</div>' +
                    '<div class="holder m-2"><span class="h1 font-weight-bold">%M</span> Min</div>' +
                    '<div class="holder m-2"><span class="h1 font-weight-bold">%S</span> Sec</div>'
                ));
            });


            /* =========================================
                COUNTDOWN 4
             ========================================= */
            function get15dayFromNow() {
                return new Date(new Date().valueOf() + 15 * 24 * 60 * 60 * 1000);
            }

            $('#clock-c').countdown(get15dayFromNow(), function(event) {
                var $this = $(this).html(event.strftime('' +
                    '<span class="h1 font-weight-bold">%D</span> Day%!d' +
                    '<span class="h1 font-weight-bold">%H</span> Hr' +
                    '<span class="h1 font-weight-bold">%M</span> Min' +
                    '<span class="h1 font-weight-bold">%S</span> Sec'));
            });

            /* =========================================
                CALL TO ACTIONS FOR COUNTDOWN 4
             ========================================= */
            $('#btn-reset').click(function() {
                $('#clock-c').countdown(get15dayFromNow());
            });
            $('#btn-pause').click(function() {
                $('#clock-c').countdown('pause');
            });
            $('#btn-resume').click(function() {
                $('#clock-c').countdown('resume');
            });

        });
    </script>
@endpush

@section('content')
    <div class="page-content page-details">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Product Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-gallery mb-3" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" data-aos="zoom-in">
                        <transition name="slide-fade" mode="out-in">
                            <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image"
                                alt="" />
                        </transition>
                    </div>
                    <div class="col-lg-2">
                        <div class="row">
                            <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo, index) in photos"
                                :key="photo.id" data-aos="zoom-in" data-aos-delay="100">
                                <a href="#" @click="changeActive(index)">
                                    <img :src="photo.url" class="w-100 thumbnail-image"
                                        :class="{ active: index == activePhoto }" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="store-details-container" data-aos="fade-up">
            <section class="store-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2>{{ $product->name }}</h2>

                            <!-- Countdown 4-->
                            <div class="rounded bg-gradient-4 text-white shadow p-5 text-center mb-2>
                                <p class="mb-0
                                font-weight-bold text-uppercase">Count Down</p>
                                <div id="clock-c" class="countdown py-2"></div>

                                <!-- Call to actions -->
                                <ul class="list-inline">
                                    <li class="list-inline-item pt-2">
                                        <button id="btn-reset" type="button" class="btn btn-demo"><i
                                                class="glyphicon glyphicon-repeat"></i>Reset</button>
                                    </li>
                                    <li class="list-inline-item pt-2">
                                        <button id="btn-pause" type="button" class="btn btn-demo"><i
                                                class="glyphicon glyphicon-repeat"></i>Pause</button>
                                    </li>
                                    <li class="list-inline-item pt-2">
                                        <button id="btn-resume" type="button" class="btn btn-demo"><i
                                                class="glyphicon glyphicon-repeat"></i>Resume</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="owner">By {{ $product->user->store_name }}</div>
                            <div class="price">Rp. {{ number_format($product->price) }}</div>
                            @auth
                                <form action="{{ route('detail-add', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="sizechart_id">Size Chart</label>
                                        <select v-model="sizechart_id" name="sizechart_id">
                                            @foreach ($size as $sizes)
                                                <option value="{{ $sizes->id }}">{{ $sizes->size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="col-lg-2" data-aos="zoom-in">

                                <div class="row d-flex flex-row justify-content-center">
                                    <div class="mb-4">
                                        <button class="btn btn-success" id="incrementValueMin">
                                            -
                                        </button>
                                    </div>
                                    <div class="  mb-4">
                                        <input id="qtyProduct" type="text" name="quantity" style="width: 30px"
                                            class="m-1 mt-1 justify-content-center" value="1">
                                    </div>
                                    <div class="mb-4">
                                        <button class="btn btn-success" id="incrementValue">
                                            +
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success px-4 text-white btn-block mb-3">
                                    Add to cart
                                </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-success px-4 text-white btn-block mb-3">
                                    Sign in to Add
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </section>

            <section class="store-description border-white">
                <div class="container ">
                    <div class="row">
                        <div class="col-12 col-lg-8 bg-light">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
            </section>

            <section class="store-review">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8 mt-3 mb-3">
                            <h5>Customer Review (3)</h5>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <ul class="list-unstyled">
                            <li class="media">
                                <img src="/images/testimonial/icon-testimonial-1.png" class="mr-3 rounded-circle"
                                    alt="" />
                                <div class="media-body">
                                    <h5 class="mt-2 mb-1">Hazza Risky</h5>
                                    I thought it was not good for living room. I really happy to decided buy this product
                                    last week now feels like homey.
                                </div>
                            </li>
                            <li class="media">
                                <img src="/images/testimonial/icon-testimonial-2.png" class="mr-3 rounded-circle"
                                    alt="" />
                                <div class="media-body">
                                    <h5 class="mt-2 mb-1">Anna Sukkirata</h5>
                                    Color is great with the minimalist concept. Even I thought it was made by Cactus
                                    industry. I do really satisfied with this.
                                </div>
                            </li>
                            <li class="media">
                                <img src="/images/testimonial/icon-testimonial-3.png" class="mr-3 rounded-circle"
                                    alt="" />
                                <div class="media-body">
                                    <h5 class="mt-2 mb-1">Dakimu Wangi</h5>
                                    When I saw at first, it was really awesome to have with. Just let me know if there is
                                    another upcoming product like this.
                                </div>
                            </li>
                        </ul>
                        <div class="container py-5">

                        </div>
                    </div>
                </div>
        </div>

    </div>
    </div>
    </section>
    </div>
    </div>
@endsection


@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var gallery = new Vue({
            el: '#gallery',
            mounted() {
                AOS.init();
            },
            data: {
                activePhoto: 0,
                photos: [
                    @foreach ($product->galleries as $gallery)
                        {
                            id: {{ $product->id }},
                            url: '{{ Storage::url($gallery->photos) }}',
                        },
                    @endforeach
                ],
            },
            methods: {
                changeActive(id) {
                    this.activePhoto = id;
                },
            },
        });
    </script>
@endpush
