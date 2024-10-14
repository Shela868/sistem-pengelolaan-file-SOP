<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="d-flex align-items-center">
                <a href="{{ asset('storage/attachments/' . $filename) }}" target="_blank">
                    @if (strtolower($extension) == 'pdf')
                        <i class="bx bxs-file-pdf display-5 mr-2"></i>
                    @elseif(strtolower($extension) == 'png')
                        <i class="bx bxs-file-png display-5 mr-2"></i>
                    @elseif(in_array(strtolower($extension), ['jpeg', 'jpg']))
                        <i class="bx bxs-file-jpg display-5 mr-2"></i>
                    @else
                        <i class="bx bxs-file display-5 mr-2"></i>
                    @endif
                </a>
                <small class="ml-2">
                    {{ $sop->title }} <!-- Misalnya, menampilkan judul SOP -->
                </small>
            </div>
            <div class="dropdown d-inline-block">
                <button class="btn p-0" type="button" id="dropdown-{{ $sop->type_SOP }}-{{ $sop->id }}"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                @if($sop->type_SOP == 'Sertifikasi_TI')
                <div class="dropdown-menu dropdown-menu-end"
                     aria-labelledby="dropdown-{{ $sop->type_SOP }}-{{ $sop->id }}">
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
                     aria-labelledby="dropdown-{{ $sop->type_SOP }}-{{ $sop->id }}">
                    <a class="dropdown-item"
                       href="{{ route('SOP.Admin_keu.edit', $sop) }}">{{ __('menu.general.edit') }}</a>
                    <form action="{{ route('SOP.admin_keu.destroy', $sop) }}" class="d-inline"
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
        <div class="accordion mt-3" id="accordion-{{ str_replace('.', '-', $filename) }}">
            <div class="accordion-item card">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                    data-bs-target="#accordion-id-{{ str_replace('.', '-', $filename) }}" aria-expanded="false"
                    aria-controls="accordion-id-{{ str_replace('.', '-', $filename) }}">
                    {{ $filename }}
                </button>
                <div id="accordion-id-{{ str_replace('.', '-', $filename) }}"
                    class="accordion-collapse collapse text-center"
                    data-bs-parent="#accordion-{{ str_replace('.', '-', $filename) }}" style="">
                    @if (strtolower($extension) == 'pdf')
                        <a class="btn my-3 btn-primary" download
                            href="{{ asset('storage/attachments/' . $filename) }}">{{ __('menu.general.download') }}</a>
                    @elseif(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/attachments/' . $filename) }}" width="100%" alt="Picture">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
