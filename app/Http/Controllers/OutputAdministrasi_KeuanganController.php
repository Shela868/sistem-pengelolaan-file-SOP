<?php

namespace App\Http\Controllers;

use App\Enums\LetterType;
use App\Http\Requests\StoreLetterRequest;
use App\Http\Requests\UpdateSOPRequest;
use App\Models\Outputattachment;
use App\Models\Classification;
use App\Models\Config;
use App\Models\output_sop;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OutputAdministrasi_KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $outputQuery = output_sop::where('klasifikasi', 'ADM');

        if ($request->has('search')) {
            $outputQuery->where('judul', 'like', '%' . $request->search . '%');
        }

        $output = $outputQuery->paginate(10)->appends(['search' => $request->search]);

        return view('pages.Output.Administrasi_Keuangan.index', [
            'output' => $output,
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
        return view('pages.Output.Administrasi_Keuangan.create', [
            'sop' => output_sop::all(),
            'classifications' => Classification::all(),

        ]);
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();

            // Validasi request
            $request->validate([
                'kode' => 'required|string',
                'judul' => 'required|string',
                'klasifikasi' => 'required|exists:classifications,code',
                'attachments' => 'required|file|mimes:pdf,jpg,jpeg,png,docx',
            ]);

            // Menyimpan data SOP
            $output = output_sop::create([
                'kode' => $request->kode,
                'judul' => $request->judul,
                'klasifikasi' => $request->klasifikasi,
            ]);

            // Menyimpan relasi Classification
            $classification = Classification::where('code', $request->klasifikasi)->first();
            $output->classification()->associate($classification);
            $output->save();


            // Menyimpan file attachment
            $attachment = $request->file('attachments');
            $extension = $attachment->getClientOriginalExtension();
            $filename = time() . '-' . $attachment->getClientOriginalName();
            $attachment->storeAs('public/attachments', $filename);

            // Menyimpan attachment ke database
            $output->attachments()->create([
                'filename' => $filename,
                'extension' => $extension,
                'user_id' => $user->id,
                'letter_id' => $output->id,
            ]);

            return redirect()
                ->route('Output.Administrasi_Keuangan.index')
                ->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param output_sop $output
     * @return View
     */
    public function edit($id): View
    {
        return view('pages.Output.Administrasi_Keuangan.edit', [
            'data' => output_sop::find($id),
            'classifications' => Classification::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSOPRequest $request
     * @param output_sop $output
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $output = output_sop::findOrFail($id);
        try {
            $output->update([
                'kode' => $request->kode,
                'judul' => $request->judul,
                'klasifikasi' => $request->klasifikasi,
            ]);
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $attachment) {
                    $extension = $attachment->getClientOriginalExtension();
                    if (!in_array($extension, ['png', 'jpg', 'jpeg', 'pdf','docx']))
                        continue;
                    $filename = time() . '-' . $attachment->getClientOriginalName();
                    $filename = str_replace(' ', '-', $filename);
                    $attachment->storeAs('public/attachments', $filename);
                    Attachment::create([
                        'filename' => $filename,
                        'extension' => $extension,
                        'user_id' => auth()->user()->id,
                        'letter_id' => $output->id,
                    ]);
                }
            }
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param output_sop $output
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $output = output_sop::findOrFail($id);
        try {
            $output->delete();
            return redirect()
                ->route('Output.Administrasi_Keuangan.index')
                ->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }


}
