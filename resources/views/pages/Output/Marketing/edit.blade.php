@extends('layout.main')

@section('content')
    <div class="breadcrumb">
        {{ __('Sertifikasi Dan TI') }} / {{ __('Output') }}
    </div>

    <div class="card mb-4">
        <form action="{{ route('Output.Marketing.update', ['Marketing' => $data->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row">
                <div class="col-sm-12 col-12 col-md-6 col-lg-6 mb-3">
                    <label for="kode">{{ __('Kode') }}</label>
                    <input type="text" class="form-control" id="kode" name="kode" value="{{ old('kode') ?? $data->kode}}" required>
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-6 mb-3">
                    <label for="judul">{{ __('Judul') }}</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') ?? $data->judul}}" required>
                </div>
                <div class="col-sm-12 col-12 col-md-6 col-lg-6 mb-3">
                    <label for="klasifikasi">{{ __('Klasifikasi') }}</label>
                    <select class="form-select" id="klasifikasi" name="klasifikasi" required>
                        <option >Pilih Klasifikasi</option>
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

            </div>
            <div class="card-footer pt-0">
                <button class="btn btn-primary" type="submit">{{ __('menu.general.save') }}</button>
            </div>
        </form>
    </div>
@endsection
