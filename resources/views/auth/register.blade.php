@extends('layouts.auth')

@section('content')

    <div class="page-content page-auth" id="register">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center justify-content-center row-login">
                    <div class="col-lg-4">
                        <h2>Memulai untuk jual beli dengan cara terbaru</h2>
                        <form method="POST" action="{{ route('register') }}" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label>Full Name</label>
                            <input id="name" 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            name="name" 
                            value="{{ old('name') }}" 
                            v-model="name" required 
                            autocomplete="name" autofocus>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input id="email" 
                            type="email" 
                            @change="checkEmail()"
                            class="form-control @error('email') is-invalid @enderror" 
                            :class="{'is-invalid': this.email_unavaible}"
                            name="email" v-model="email" 
                            value="{{ old('email') }}"  
                            required autocomplete="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input id="password" type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            name="password" required 
                            autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input id="password-confirm" type="password" 
                            class="form-control @error('password_confirmation') is-invalid @enderror" 
                            name="password_confirmation" required 
                            autocomplete="new-password">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <button type="submit" 
                        class="btn btn-success btn-block mt-4"
                        :disabled="this.email_unavaible">
                        Sign Up Now
                        </button>
                        <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-4">Back to Sign In</a>
                        </form>
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
    Vue.use(Toasted);

    var register = new Vue({
        el: '#register',
        mounted() {
        AOS.init();
        
        },
        methods: {
            checkEmail: function() {
                var self = this;
                axios.get('{{ route('api-register-check') }}', {
                    params: {
                        email: this.email
                    }
                })
                .then(function (response) {
                    if(response.data == 'Available') {
                        self.$toasted.show(
                        'Email anda tersedia! Silahkan lanjutkan langkah selanjutnya!', 
                        {
                        position: 'top-center',
                        className: 'rounded',
                        duration: 1000,
                        }
                    );
                    self.email_unavaible = false ;
                    } else {
                        self.$toasted.error(
                        'Maaf, tampaknya email sudah terdaftar pada sistem kami.', 
                        {
                        position: 'top-center',
                        className: 'rounded',
                        duration: 1000,
                        }
                    );
                    self.email_unavaible = true ;
                    }
                    // handle success
                    console.log(response);
                });
            }
        },
        data() {
            return {
                name: '',
                email: '',
                is_store_open: true,
                store_name: '',
                email_unavaible: false
            }
        },
    });
    </script>
@endpush
