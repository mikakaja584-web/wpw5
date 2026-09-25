<?php

namespace App\Http\Controllers;

use App\Rules\Uppercase;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function submitForm(Request $request)
    {
        $messages = [
            'name.required' => 'Nama harus diisi!',
            'email.required' => 'Email tidak boleh kosong!',
            'password.confirmed' => 'Password tidak cocok!',
            'password.required' => 'Password harus diisi!'
        ];

        $request->validate([
            'name' => ['required', new Uppercase],
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ], $messages);

        return "Data berhasil divalidasi!";
    }
}