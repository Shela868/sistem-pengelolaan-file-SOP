@extends('layout.main')

@section('content')
    <div class="breadcrumb">
        {{ __('SOP') }} / {{ __('Manajemen Mutu') }}
    </div>

    <div class="card mb-4">
        <form action="{{ route('SOP.Manajemen_Mutu.update', ['Manajemen_Mutu' => $data->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row">
                <div class="col-sm-12 col-12 col-md-6 col-lg-6 mb-3">
                    <label for="perihal_SOP">{{ __('Perihal SOP') }}</label>
                    <input type="text" class="form-control" id="perihal_SOP" name="perihal_SOP" value="{{ old('perihal_SOP') ?? $data->perihal_SOP}}" required>
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-6 mb-3">
                    <label for="klasifikasi">{{ __('Klasifikasi') }}</label>
                    <select class="form-select" id="klasifikasi" name="klasifikasi" required>
                        <option value="">Pilih Klasifikasi</option>
                        @foreach($classifications as $classification)
                            <option value="{{ $classification->code }}" {{ old('klasifikasi', $data->klasifikasi) == $classification->code ? 'selected' : '' }}>
                                {{ $classification->type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-6 mb-3">
                    <label for="lampiran">{{ __('Lampiran') }}</label>
                    <input type="file" class="form-control @error('attachments') is-invalid @enderror" id="attachments" name="attachments">
                    <span class="error invalid-feedback">{{ $errors->first('attachments') }}</span>
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-6 mb-3">
                    <label for="status_SOP">{{ __('Status SOP') }}</label>
                    <select class="form-select" id="status_SOP" name="status_SOP" required>
                        <option value="">SOP Status</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ old('status_SOP', $data->status_SOP) == $status->id ? 'selected' : '' }}>
                                {{ $status->status }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer pt-0">
                <button class="btn btn-primary" type="submit">{{ __('menu.general.save') }}</button>
            </div>
        </form>
    </div>
@endsection
