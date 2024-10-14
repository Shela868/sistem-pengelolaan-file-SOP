@extends('layout.main')

@section('content')

<x-breadcrumb :values="[__('Sertifikasi Dan TI'), __('Output')]">
    <a href="{{ route('Output.Sertifikasi_TI.create') }}" class="btn btn-primary">{{ __('menu.general.create') }}</a>
</x-breadcrumb>


    @foreach($output as $out)
    <div class="card mb-4">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between flex-column flex-sm-row">
                <div class="card-title">
                    <h5 class="text-nowrap mb-0 fw-bold"> {{ $out->kode }} | {{ $out->judul }}</h5>
                    <small class="text-black">
                      {{ $out->classification?->type }}
                    </small>
                </div>
                <div class="card-title d-flex flex-row">
                    @if(count($out->attachments))
                        <div>
                            @foreach($out->attachments as $attachment)
                                <a href="{{ $attachment->path_url }}" target="_blank">
                                    @if($attachment->extension == 'pdf')
                                        <i class="bx bxs-file-pdf display-1 cursor-pointer text-primary"></i>
                                    @elseif(in_array($attachment->extension, ['jpg', 'jpeg']))
                                        <i class="bx bxs-file-jpg display-1 cursor-pointer text-primary"></i>
                                    @elseif($attachment->extension == 'docx')
                                        <i class="bx bxs-file-doc display-1 cursor-pointer text-primary"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                    <div class="dropdown d-inline-block">
                        <button class="btn p-0" type="button" id="dropdown-{{ $out->type }}-{{ $out->id }}"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>

                            <div class="dropdown-menu dropdown-menu-end"
                                 aria-labelledby="dropdown-{{ $out->kode }}-{{ $out->id }}">
                                <a class="dropdown-item"
                                   href="{{  route('Output.Sertifikasi_TI.edit', ['Sertifikasi_TI' => $out->id]) }}">{{ __('menu.general.edit') }}</a>
                                <form action="{{ route('Output.Sertifikasi_TI.destroy', $out->id) }}" class="d-inline"
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
            @if($out->created_at != $out->updated_at)
            <p>terakhir diupdate pada: {{ $out->updated_at }}</p>
        @elseif($out->created_at == $out->updated_at)
            <p>dibuat pada: {{ $out->created_at }}</p>
        @endif
            <hr>
        </div>
    </div>

    @endforeach
</div>

{!! $output->appends(['search' => $search])->links() !!}
@endsection

