@extends('layout.main')

@push('style')
    <link rel="stylesheet" href="{{asset('sneat/vendor/libs/apex-charts/apex-charts.css')}}" />
@endpush

@push('script')
    <script src="{{asset('sneat/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script>
        const options = {
            chart: {
                type: 'bar'
            },
            series: [{
                name: '{{ __('dashboard.letter_transaction') }}',

            }],
            stroke: {
                curve: 'smooth',
            },
            xaxis: {
                categories: [
                    '{{ __('dashboard.incoming_letter') }}',
                    '{{ __('dashboard.outgoing_letter') }}',
                    '{{ __('dashboard.disposition_letter') }}',
                ],
            }
        }

        const chart = new ApexCharts(document.querySelector("#today-graphic"), options);

        chart.render();
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-13 mb-4 order-0">
            <div class="card mb-4">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h4 class="card-title text-primary">{{ $greeting }}</h4>
                            <p class="mb-4">
                                {{ $currentDate }}
                            </p>

                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{asset('sneat/img/undraw_Engineering_team_a7n2.png')}}" height="180"
                                 alt="View Badge User" data-app-dark-img="illustrations/undraw_Engineering_team_a7n2.png"
                                 data-app-light-img="illustrations/undraw_Engineering_team_a7n2.png">
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3"
                             style="position: relative;">
                            <div class="">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2">{{ __('dashboard.today_graphic') }}</h5>
                                    <span class="badge bg-label-warning rounded-pill">{{ __('dashboard.today') }}</span>
                                </div>
                                <div class="mt-sm-auto">
                                    @if($percentageLetterTransaction > 0)
                                    <small class="text-success text-nowrap fw-semibold">
                                        <i class="bx bx-chevron-up"></i> {{ $percentageLetterTransaction }}%
                                    </small>
                                    @elseif($percentageLetterTransaction < 0)
                                        <small class="text-danger text-nowrap fw-semibold">
                                            <i class="bx bx-chevron-down"></i> {{ $percentageLetterTransaction }}%
                                        </small>
                                    @endif
                                    <h3 class="mb-0 display-4"></h3>
                                </div>
                            </div>
                            <div id="profileReportChart" style="min-height: 80px; width: 80%">
                                <div id="today-graphic"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
        </div>
        <div class="col-mb-4 ">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('SOP Sertifikasi Dan TI')"
                        :value="$Sertifikasi_TI"
                        :daily="false"
                        color="success"
                        icon="bx-book-bookmark"
                        :percentage="0"
                    />
                </div>
                <div class="col-lg-4 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('SOP Administrasi Dan Keuangan')"
                        :value="$Administrasi_Keuangan"
                        :daily="false"
                        color="danger"
                        icon="bx-book-bookmark"
                        :percentage="0"
                    />
                </div>
                <div class="col-lg-4 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('SOP Manajemen Mutu')"
                        :value="$Manajemen_Mutu"
                        :daily="false"
                        color="primary"
                        icon="bx-book-bookmark"
                        :percentage="0"
                    />
                </div>
                <div class="col-lg-4 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('SOP Marketing')"
                        :value="$Marketing"
                        :daily="false"
                        color="warning"
                        icon="bx-book-bookmark"
                        :percentage="0"
                    />
                </div>
                <div class="col-lg-4 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('Pengguna')"
                        :value="$activeUser"
                        :daily="false"
                        color="info"
                        icon="bx-user-check"
                        :percentage="0"
                    />
                </div>
            </div>
        </div>
    </div>
@endsection
