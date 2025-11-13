<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $fileName = 'data_' . Str::uuid() . '.json';
        Storage::disk('local')->put($fileName, json_encode($validatedData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        return redirect()->route('form.show')->with('success', 'Ваше сообщение успешно отправлено!');
    }

    public function showData()
    {
        $files = Storage::disk('local')->files();
        $allData = [];

        foreach ($files as $file) {
            if (Str::startsWith(basename($file), 'data_')) {
                $content = Storage::disk('local')->get($file);
                $allData[] = json_decode($content, true);
            }
        }
        return view('data', ['allData' => $allData]);
    }
}
