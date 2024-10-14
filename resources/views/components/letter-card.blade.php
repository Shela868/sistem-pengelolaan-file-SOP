<div class="card mb-4">
    <div class="card-header pb-0">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="card-title">
                <h5 class="text-nowrap mb-0 fw-bold">{{ $sop->reference_number }}</h5>
                <small class="text-black">
                    {{ $sop->type == 'incoming' ? $sop->from : $sop->to }}
                    {{-- <span
                        class="text-secondary">{{ __('model.sop.agenda_number') }}:</span> {{ $sop->agenda_number }} --}}
                    |
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
                                <i class="bx bxs-file-jpg display-6 cursor-pointer text-primary"></i>
                            @elseif($attachment->extension == 'png')
                                <i class="bx bxs-file-png display-6 cursor-pointer text-primary"></i>
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
                    @if($sop->type == 'incoming')
                        <div class="dropdown-menu dropdown-menu-end"
                             aria-labelledby="dropdown-{{ $sop->type }}-{{ $sop->id }}">
                            @if(!\Illuminate\Support\Facades\Route::is('*.show'))
                                <a class="dropdown-item"
                                   href="{{ route('SOP.Sertifikasi_TI.show', $sop) }}">{{ __('menu.general.view') }}</a>
                            @endif
                            <a class="dropdown-item"
                               href="{{ route('SOP.Sertifikasi_TI.edit', $sop) }}">{{ __('menu.general.edit') }}</a>
                            <form action="{{ route('SOP.Sertifikasi_TI.destroy', $sop) }}" class="d-inline"
                                  method="post">
                                @csrf
                                @method ('DELETE')
                                <span
                                    class="dropdown-item cursor-pointer btn-delete">{{ __('menu.general.delete') }}</span>
                            </form>
                        </div>
                    @else
                        <div class="dropdown-menu dropdown-menu-end"
                             aria-labelledby="dropdown-{{ $sop->type }}-{{ $sop->id }}">
                            @if(!\Illuminate\Support\Facades\Route::is('*.show'))
                                <a class="dropdown-item"
                                   href="{{ route('SOP.Administrasi_Keuangan.show', $sop) }}">{{ __('menu.general.view') }}</a>
                            @endif
                            <a class="dropdown-item"
                               href="{{ route('SOP.Administrasi_Keuangan.edit', $sop) }}">{{ __('menu.general.edit') }}</a>
                            <form action="{{ route('SOP.Administrasi_Keuangan.destroy', $sop) }}" class="d-inline"
                                  method="post">
                                @csrf
                                @method('DELETE')
                                <span
                                    class="dropdown-item cursor-pointer btn-delete">{{ __('menu.general.delete') }}</span>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <hr>
        <form method="post" action="{{ route('simpan.checkbox') }}">
            @csrf

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="checkboxDokumentasi" name="dokumentasi" value="dokumentasi">
                <label class="form-check-label" for="checkboxDokumentasi">Dokumentasi</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="checkboxSosialisasi" name="checkbox[]" value="sosialisasi">
                <label class="form-check-label" for="checkboxSosialisasi">Sosialisasi</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="checkboxEvaluasi" name="checkbox[]" value="evaluasi">
                <label class="form-check-label" for="checkboxEvaluasi">Evaluasi</label>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        {{ $slot }}
    </div>
</div>


