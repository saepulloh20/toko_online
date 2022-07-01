@extends('layouts.app')

@section('title')
    Store Home Page
@endsection

@stack('addon-style')
<section class="content text-center">
    <style scoped>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

        * {
            font-family: 'Poppins', sans-serif !important;
        }

        body .content {
            background: #ffffff;
        }

        body .content .content {
            padding-top: 90px;
            padding-bottom: 90px;
        }

        body .content .content .tagline {
            font-family: Poppins;
            font-style: normal;
            font-weight: bold;
            font-size: 18px;
            line-height: 27px;
            /* identical to box height */
            text-align: center;
            color: #0d3adb;
        }

        body .content .content .headline {
            font-family: Poppins;
            font-style: normal;
            font-weight: bold;
            font-size: 45px;
            line-height: 67px;
            text-align: center;
            color: #111f37;
        }

        body .content .content .benefits {
            margin-top: 50px;
        }

        body .content .content .benefits .rectangle {
            max-width: 302px;
            max-height: 334px;
            border: 1px solid #9ba8be;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            border-radius: 26px;
        }

        body .content .content .benefits .rectangle img {
            margin-top: 50px;
        }

        body .content .content .benefits .rectangle .headline-benefit {
            margin-top: 40px;
            font-family: Poppins;
            font-style: normal;
            font-weight: 600;
            font-size: 18px;
            line-height: 27px;
            /* identical to box height */
            text-align: center;
            color: #111f37;
        }

        body .content .content .benefits .rectangle .subheadline-benefit {
            font-family: Poppins;
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            line-height: 28px;
            /* or 175% */
            text-align: center;
            color: #627492;
            margin-bottom: 40px;
        }

        body .content .content .button-header {
            margin-top: 40px;
        }

        body .content .content .button-header .btn-started {
            width: 150px;
            height: 50px;
            background: #0ddb93 !important;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            color: #001d01;
        }

        body .content .content .button-header .btn-story {
            width: 150px;
            height: 50px;
            border: 1px solid #9ba8be;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            border-radius: 8px;
            font-family: Poppins;
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            line-height: 24px;
            /* identical to box height */
            text-align: center;
            color: #627492;
        }

        /* Login Page */
        <style scoped>* {
            font-family: 'Inter', sans-serif !important;
        }

        body .font-red-hat-display {
            font-family: 'Red Hat Display', sans-serif !important;
        }

        body .cl-light-blue {
            color: #34b3ff;
        }

        body .contact-us-light-lick {
            background: #FFFFFF;
            padding-top: 125px;
            padding-bottom: 90px;
        }

        body .contact-us-light-lick .headline {
            font-family: 'Red Hat Display', sans-serif;
            font-weight: 700;
            font-size: 60px;
            line-height: 140%;
            text-align: center;
            color: #16171C;
        }

        @media screen and (max-width: 768px) {
            body .contact-us-light-lick .headline {
                font-size: 40px;
                line-height: 60px !important;
            }
        }

        body .contact-us-light-lick .button {
            margin-top: 72px;
        }

        body .contact-us-light-lick .btn-contact {
            padding: 16px 32px;
            background: #00B67A;
            border-radius: 12px;
            font-weight: 700;
            font-size: 20px;
            line-height: 24px;
            color: #FFFFFF;
        }

        @media screen and (max-width: 768px) {
            body .contact-us-light-lick .btn-contact {
                width: 100%;
            }
        }

        body .contact-us-light-lick .btn-demo {
            padding: 16px 32px;
            border-radius: 12px;
            font-weight: 400;
            font-size: 20px;
            line-height: 24px;
            color: #16171C;
            border: 1px solid #8D8F98;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        @media screen and (max-width: 768px) {
            body .contact-us-light-lick .btn-demo {
                width: 100%;
            }
        }
    </style>


    @section('content')
        <div class="page-content page-home">
            <section class="store-carousel">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12" data-aos="zoom-in">
                            <div id="storeCarousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li class="active" data-target="#storeCarousel" data-slide-to="0"></li>
                                    <li data-target="#storeCarousel" data-slide-to="1"></li>
                                    <li data-target="#storeCarousel" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="/images/banner.jpg" alt="Carousel IMG" class="d-block w-100" />
                                    </div>
                                    <div class="carousel-item">
                                        <img src="/images/banner.jpg" alt="Carousel IMG" class="d-block w-100" />
                                    </div>
                                    <div class="carousel-item">
                                        <img src="/images/banner.jpg" alt="Carousel IMG" class="d-block w-100" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{-- <section class="store-new-products">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>New Produck</h5>
                    </div>
                </div>
                <div class="row">
                    @php $incrementProduct = 0; @endphp
                    @forelse ($products as $product)
                        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up"
                            data-aos-delay="{{ $incrementProduct += 100 }}">
                            <a href="{{ route('detail', $product->slug) }}" class="component-product" class="d-block">
                                <div class="products-thumbnail">
                                    <div class="products-image"
                                        style="
                            @if ($product->galleries->count()) background-image: url('{{ Storage::url($product->galleries->first()->photos) }}');
                            @else
                                background-color: #eee; @endif
                        ">
                                    </div>
                                </div>
                                <div class="products-text">{{ $product->name }}</div>
                                <div class="products-price">Rp.{{ number_format($product->price) }}</div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">Product Not Found</div>
                    @endforelse
                </div>
        </section> --}}
        </div>
        <section>
            <div class="container">
                <div class="row content">
                    <div class="col-12 px-md-0 my-auto">
                        <div class="headline mt-3">
                            Rohiman Virtual <br class="d-none d-md-block">
                            Run Or Ride
                        </div>
                        <div class="row benefits">
                            <div class="col-md-4 mt-md-0">
                                <div class="rectangle mx-auto px-1">
                                    <img src="/images/register.png" alt="benefits-1" class="img-fluid" width="90px">
                                    <div class="headline-benefit">
                                        Mendaftar
                                    </div>
                                    <div class="subheadline-benefit mt-2">
                                        Daftarkan diri Anda untuk mengikuti banyak acara virtual run / ride yang seru di
                                        Website Rohiman Virtual Run
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-5 mt-md-0">
                                <div class="rectangle mx-auto px-1">
                                    <img src="/images/verify2.png" alt="benefits-1" class="img-fluid" width="90px">
                                    <div class="headline-benefit">
                                        Hasil Aktivitas
                                    </div>
                                    <div class="subheadline-benefit mt-2">
                                        Submit hasil aplikasi perekam berbasis GPS atau foto sesi lari & sepeda di treadmill
                                        / spinning bike
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-5 mt-md-0">
                                <div class="rectangle mx-auto px-1">
                                    <img src="/images/reward.png" alt="benefits-1" class="img-fluid" width="90px">
                                    <div class="headline-benefit">
                                        Penghargaan
                                    </div>
                                    <div class="subheadline-benefit mt-2">
                                        Dapatkan berbagai hadiah menarik seperti e-Badge/medali setelah menyelesaikan
                                        kategori pilihan Anda
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- Page Login --}}
        <section class="contact-us-light-lick position-relative">
            <section class="ornament">
                <style scoped>
                    body .ornament .ornament-left {
                        z-index: 0 !important;
                        position: absolute;
                        top: 0;
                        left: 0;
                    }
                </style>
                <img src="https://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content10/Ornament-left.png"
                    alt="ornament" class="ornament-left">
            </section>
            <div class="container">
                <div class="row d-block mx-0">
                    <div class="headline font-red-hat-display">
                        Mulai Beraktivitas <br>
                        <h5>Daftar dan miliki akun Rohiman Virtual Run sekarang, mulai gaya hidup sehatmu hari ini
                            juga!</h2>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center gap-4 mt-5">
                    <a href="{{ route('register') }}"><button class="btn btn-contact">
                            Daftar Sekarang
                        </button></a>
                </div>
            </div>
        </section>
        <!-- Akhir info panel -->

        {{-- Panel Category Home --}}
        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h1>All Categories</h1>
                    </div>
                </div>
                <div class="row">
                    @php $incrementCategory = 0; @endphp
                    @forelse ($categories as $category)
                        <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up"
                            data-aos-delay="{{ $incrementCategory += 100 }}">
                            <a href="{{ route('categories-detail', $category->slug) }}"
                                class="component-categories d-block">
                                <div class="categories-img">
                                    <img src="{{ Storage::url($category->photo) }}" alt="Categories Gadgets"
                                        class="w-100" />
                                </div>
                                <p class="categories-text">{{ $category->name }}</p>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">Categories Not
                            Found
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    @endsection
