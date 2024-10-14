@extends('layout.main')

@section('content')

<x-breadcrumb :values="[__('Marketing'), __('SOP')]">
    <a href="{{ route('SOP.Marketing.create') }}" class="btn btn-primary">{{ __('menu.general.create') }}</a>
</x-breadcrumb>


    @foreach($data as $sop)
    <div class="card mb-4">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between flex-column flex-sm-row">
                <div class="card-title">
                    <h5 class="mb-0 fw-bold" style="white-space: normal;">{{ $sop->id }} | {{ $sop->perihal_SOP }}</h5>
                    <small class="text-black">
                        {{ $sop->classification?->type }}
                    </small>
                </div>
                <div class="card-title d-flex flex-row">
                    @if(count($sop->attachments))
                        <div>
                            @foreach($sop->attachments as $attachment)
                                <a href="{{ $attachment->path_url }}" target="_blank">
                                    @if($attachment->extension == 'pdf')
                                        <i class="bx bxs-file-pdf display-1 cursor-pointer text-primary"></i>
                                    @elseif(in_array($attachment->extension, ['jpg', 'jpeg']))
                                        <i class="bx bxs-file-jpg display-1 cursor-pointer text-primary"></i>
                                    @elseif($attachment->extension == 'png')
                                        <i class="bx bxs-file-png display-1 cursor-pointer text-primary"></i>
                                    @elseif($attachment->extension == 'docx')
                                        <i class="bx bxs-file-doc display-1 cursor-pointer text-primary"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                    <div class="dropdown d-inline-block">
                        <button class="btn p-0" type="button" id="dropdown-{{ $sop->type }}-{{ $sop->id }}"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>

                            <div class="dropdown-menu dropdown-menu-end"
                                 aria-labelledby="dropdown-{{ $sop->perihal_SOP }}-{{ $sop->id }}">
                                <a class="dropdown-item"
                                   href="{{ route('SOP.Marketing.edit', $sop->id) }}">{{ __('menu.general.edit') }}</a>
                                <form action="{{ route('SOP.Marketing.destroy', $sop) }}" class="d-inline"
                                      method="post">
                                    @csrf
                                    @method ('DELETE')
                                    <span
                                        class="dropdown-item cursor-pointer btn-delete">{{ __('menu.general.delete') }}</span>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($sop->created_at != $sop->updated_at)
            <p>terakhir diupdate pada: {{ $sop->updated_at }}</p>
        @elseif($sop->created_at == $sop->updated_at)
            <p>dibuat pada: {{ $sop->created_at }}</p>
        @endif
            <hr>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="checkboxPenyusunan" name="Penyusunan" value="Penyusunan" {{ $sop->status->status == 'Penyusunan' ? 'checked' : 'disabled' }}>
                <label class="form-check-label" for="checkboxPenyusunan">Penyusunan</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="checkboxEvaluasi" name="Evaluasi" value="Evaluasi" {{ $sop->status->status == 'Evaluasi' ? 'checked' : 'disabled' }}>
                <label class="form-check-label" for="checkboxEvaluasi">Evaluasi</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="checkboxValidasi" name="Validasi" value="Validasi" {{ $sop->status->status == 'Validasi' ? 'checked' : 'disabled' }}>
                <label class="form-check-label" for="checkboxValidasi">Validasi</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="checkboxSosialisasi" name="Sosialisasi" value="Sosialisasi" {{ $sop->status->status == 'Sosialisasi' ? 'checked' : 'disabled' }}>
                <label class="form-check-label" for="checkboxEvaluasi">Sosialisasi</label>
            </div>
        </div>
    </div>

    @endforeach
</div>

{!! $data->appends(['search' => $search])->links() !!}
@endsection
