<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Dokumen;
use App\Models\Staf;

class DokumenController extends Controller
{
    public function dokumenManager()
    {
        $documents = Dokumen::paginate(10);

        return view('staf.dokumen.dokumenManager', [
            'title' => 'Manajer Dokumen',
            'documents' => $documents,
        ]);
    }

    public function dokumenNew()
    {
        return view('staf.dokumen.dokumenNew', [
            'title' => 'Dokumen Baru',
            'staf' => Staf::all(),
        ]);
    }

    public function dokumenNewSubmit(Request $request)
    {   
        //dd($request->all()); // Dump the request data
        // Check if the form is reaching the controller
        if (!$request->has('form_reached_controller')) {
            return redirect()->back()->with('error', 'Form data not received by the controller');
        }

        $MAX_FILE_SIZE = 20480;

        $validatedData = $request->validate([
            'judul' => 'required|unique:dokumen',
            'keterangan' => 'required',
            'id_staf' => 'nullable',
            // 'filename' => 'required|mimes:pdf,doc,docx|max:'.$MAX_FILE_SIZE,
        ], [
            // 'filename.mimes' => 'Dokumen harus berupa PDF, DOC, atau DOCX!',
            // 'filename.max' => 'Ukuran dokumen tidak boleh lebih besar dari '.($MAX_FILE_SIZE / 1024).'MB'
        ]);

        // $documentFile = $request->file('filename');
        $documentName = $request->input('judul');

        // $modifiedDocumentName = Str::slug($documentName, '_') . '.' . $documentFile->getClientOriginalExtension();
        // $documentFile->storeAs('public/documents', $modifiedDocumentName);

        $validatedData['staf'] = auth()->user()->staf;
        // $validatedData['filename'] = $modifiedDocumentName;
        $validatedData['is_active'] = $request->input('is_active', false);

        Dokumen::create($validatedData);

        return redirect('/staf/manajemen-web/dokumen')->with('success', 'Dokumen berhasil ditambahkan!');
    }

    public function dokumenEdit($id)
    {
        return view('staf.dokumen.dokumenEdit', [
            'title' => 'Edit Dokumen',
            'dokumen' => Dokumen::find($id),
            'staf' => Staf::all(),
        ]);
    }

    public function dokumenEditSubmit(Request $request, $id)
    {
        $MAX_FILE_SIZE = 20480;

        $validatedData = $request->validate([
            'judul' => 'required',
            'keterangan' => 'required',
            'filename' => 'nullable|mimes:pdf,doc,docx|max:'.$MAX_FILE_SIZE,
            'id_staf' => 'nullable',
        ], [
            'filename.mimes' => 'Dokumen harus berupa PDF, DOC, atau DOCX!',
            'filename.max' => 'Ukuran dokumen tidak boleh lebih besar dari '.($MAX_FILE_SIZE / 1024).'MB'
        ]);

        $document = Dokumen::find($id);
        $currentJudul = $document->judul;
        $newJudul = $request->input('judul');

        // Check if judul is different and update the path accordingly
        if ($currentJudul !== $newJudul) {
            // Judul is different, update the path based on the new judul
            if ($request->hasFile('filename')) {
                $documentFile = $request->file('filename');
                $modifiedDocumentName = Str::slug($newJudul, '_') . '.' . $documentFile->getClientOriginalExtension();
                $documentFile->storeAs('public/documents', $modifiedDocumentName);
                $validatedData['filename'] = $modifiedDocumentName;
            } else {
                // No new file uploaded, but judul is different, update path accordingly
                $pathInfo = pathinfo($document->filename);
                $newFilename = Str::slug($newJudul, '_') . '.' . $pathInfo['extension'];
                $validatedData['filename'] = $newFilename;

                // Rename the file in storage
                Storage::move('public/documents/' . $document->filename, 'public/documents/' . $newFilename);
            }
        } elseif ($request->hasFile('filename')) {
            // Judul is the same, but a new file is uploaded, update the path with the new file
            $documentFile = $request->file('filename');
            $modifiedDocumentName = Str::slug($currentJudul, '_') . '.' . $documentFile->getClientOriginalExtension();
            $documentFile->storeAs('public/documents', $modifiedDocumentName);
            $validatedData['filename'] = $modifiedDocumentName;
        }

        $validatedData['id_staf'] = auth()->user()->id_staf;
        $validatedData['is_active'] = $request->input('is_active', false);

        $document->update($validatedData);

        return redirect('/staf/manajemen-web/dokumen')->with('success', 'Dokumen berhasil diubah!');
    }

    public function dokumenDelete($id)
    {
        $document = Dokumen::find($id);

        if ($document) {
            $documentPath = storage_path('app/public/documents/' . $document->filename);
            if (file_exists($documentPath)) {
                unlink($documentPath);
            }
            $document->delete();

            return redirect('/staf/manajemen-web/dokumen')->with('success', 'Dokumen berhasil dihapus!');
        } else {
            $document->delete();

            return redirect('/staf/manajemen-web/dokumen')->with('warning', 'Dokumen berhasil dihapus dari database! (file tidak dapat ditemukan)');
        }
    }

    public function dokumenDownload($filename)
    {
        $file = storage_path('app/public/documents/' . $filename);

        if (!file_exists($file)) {
            abort(404);
        }

        return response()->download($file);
    }
}
