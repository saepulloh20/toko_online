@extends('layouts.dashboard')

@section('title')
    Dashboard Transaction Detail
@endsection

@section('content')
    <!-- Secction Content -->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">{{ $transaction->product->name }}</h2>
                <p class="dashboard-subtitle">Transactions Details</p>
            </div>
            <div class="dashboard-content" id="transactionDetails">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <img src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                                            class="w-100 mb-3" alt="" />
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Customer Name</div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->transaction->user->name ?? '' }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Race Name</div>
                                                <div class="product-subtitle">{{ $transaction->product->name }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Date of Transaction</div>
                                                <div class="product-subtitle">{{ $transaction->created_at }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Payment Status</div>
                                                <div class="product-subtitle text-danger">
                                                    {{ $transaction->transaction->transaction_status }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Total Amount</div>
                                                <div class="product-subtitle">Rp.
                                                    {{ number_format($transaction->transaction->total_price) }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Mobile</div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->transaction->user->phone_number }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Nomor BIB</div>
                                                <div class="product-subtitle">{{ $transaction->code }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Jenis</div>
                                                <div class="product-subtitle">{{ $transaction->product->lokasi }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Active Start</div>
                                                <div class="product-subtitle">{{ $transaction->product->active_start }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Active End</div>
                                                <div class="product-subtitle">{{ $transaction->product->active_end }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('dashboard/transactions-update', $transaction->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 mt-4">
                                            <h5>Account Profile Information</h5>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Address I</div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->transaction->user->address_one }}</div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Address II</div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->transaction->user->address_two }}</div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Province</div>
                                                    <div class="product-subtitle">
                                                        {{ App\Models\Province::find($transaction->transaction->user->provinces_id)->name }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">City</div>
                                                    <div class="product-subtitle">
                                                        {{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Postal Code</div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->transaction->user->zip_code }}</div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Country</div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->transaction->user->country }}</div>
                                                </div>
                                                {{-- <div class="col-12 col-md-6">
                                                    <div class="product-title">Shipping Status</div>
                                                    <div class="product-subtitle">{{ $transaction->shipping_status }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">No Resi</div>
                                                    <div class="product-subtitle">{{ $transaction->resi }}</div>
                                                </div> --}}
                                            </div>
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
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var transactionDetails = new Vue({
            el: '#transactionDetails',
            data: {
                status: '{{ $transaction->shipping_status }}',
                resi: '{{ $transaction->resi }}',
            },
        });
    </script>
@endpush
