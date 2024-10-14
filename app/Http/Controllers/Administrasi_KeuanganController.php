<?php

namespace App\Http\Controllers;

use App\Enums\LetterType;
use App\Http\Requests\StoreLetterRequest;
use App\Http\Requests\UpdateSOPRequest;
use App\Models\Attachment;
use App\Models\Classification;
use App\Models\Config;
use App\Models\Letter;
use App\Models\LetterStatus;
use App\Models\SOP;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Administrasi_KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $data = SOP::where('klasifikasi', 'ADM');
        if ($request->has('search')) {
            $data = $data->where('perihal_SOP', 'like', '%' . $request->search . '%');
        }
        $data = $data->paginate(10)->appends(['search' => $request->search]);
        return view('pages.SOP.Administrasi_Keuangan.index', [
            'data' => $data,
            'search' => $request->search,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('pages.SOP.Administrasi_Keuangan.create', [
            'sop' => SOP::all(),
            'classifications' => Classification::all(),
            'statuses' => LetterStatus::all(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();

            // Validasi request
            $request->validate([
                'perihal_SOP' => 'required|string',
                'klasifikasi' => 'required|exists:classifications,code',
                'attachments' => 'required|file|mimes:pdf,jpg,jpeg,png',
                'status_SOP' => 'required|exists:letter_statuses,id',
            ]);

            // Menyimpan data SOP
            $sop = SOP::create([
                'perihal_SOP' => $request->perihal_SOP,
                'klasifikasi' => $request->klasifikasi,
                'status_SOP' => $request->status_SOP,
            ]);

            // Menyimpan relasi Classification
            $classification = Classification::where('code', $request->klasifikasi)->first();
            $sop->classification()->associate($classification);
            $sop->save();

            // Menyimpan relasi LetterStatus
            $status = LetterStatus::find($request->status_SOP);
            $sop->status()->associate($status);
            $sop->save();

            // Menyimpan file attachment
            $attachment = $request->file('attachments');
            $extension = $attachment->getClientOriginalExtension();
            $filename = time() . '-' . $attachment->getClientOriginalName();
            $attachment->storeAs('public/attachments', $filename);

            // Menyimpan attachment ke database
            $sop->attachments()->create([
                'filename' => $filename,
                'extension' => $extension,
                'user_id' => $user->id,
                'letter_id' => $sop->id,
            ]);

            return redirect()
                ->route('SOP.Administrasi_Keuangan.index')
                ->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param SOP $data
     * @return View
     */
    public function edit($id): View
    {session(['edited_form' => true]);
        return view('pages.SOP.Administrasi_Keuangan.edit', [
            'data' => SOP::find($id),
            'classifications' => Classification::all(),
            'statuses' => LetterStatus::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSOPRequest $request
     * @param SOP $data
     * @return RedirectResponse
     */
     public function update(Request $request, $id)
    { $data = SOP::findOrFail($id);
        $request->validate([
            'perihal_SOP' => 'required|string',
            'klasifikasi' => 'required|exists:classifications,code',
            'attachments' => 'file|mimes:pdf,jpg,jpeg,png,docx',
            'status_SOP' => 'required|exists:letter_statuses,id',
        ]);

        try {
            $data->update([
                'perihal_SOP' => $request->perihal_SOP,
                'klasifikasi' => $request->klasifikasi,
                'status_SOP' => $request->status_SOP,
            ]);
            if ($request->hasFile('attachments')) {
                $attachment = $request->file('attachments');
                    $extension = $attachment->getClientOriginalExtension();
                    $filename = time() . '-' . $attachment->getClientOriginalName();
                    $filename = str_replace(' ', '-', $filename);
                    $attachment->storeAs('public/attachments', $filename);
                    $data->attachments()->update([
                        'filename' => $filename,
                        'extension' => $extension,
                        'user_id' => auth()->user()->id,
                        'letter_id' => $data->id,
                    ]);
                }

            $data->save();
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param SOP $sop
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $sop = SOP::findOrFail($id);
        try {
            $sop->delete();
            return redirect()
                ->route('SOP.Administrasi_Keuangan.index')
                ->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
