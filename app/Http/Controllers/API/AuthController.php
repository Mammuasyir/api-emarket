<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isEmpty;

class AuthController extends Controller
{
    public function regis(Request $request)
    {
        $psn = [
            'name.required'      => 'Nama wajib diisi.',

            'password.required'  => 'Password wajib diisi.',
            'password.confirmed' => 'Password konfirmasi tidak sesuai.',
            'password.min'       => 'Password minimal diisi dengan 5 karakter.',

            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Email tidak valid.',
            'email.unique'       => 'Email sudah terdaftar.',

            'telp.required'      => 'Telepon wajib diisi.',
            'telp.numeric'       => 'Telepon harus berupa angka.',
            'telp.unique'        => 'Nomor telepon tertaut pada akun lain.',
        ];

        $validasi = Validator::make($request->all(), [
            'name'               => ['required', 'string', 'max:255'],
            'email'              => ['required', 'string', 'email', 'unique:users'],
            'telp'               => ['required', 'numeric', 'unique:users'],
            'password'           => ['required', 'min:5', 'string']
        ], $psn);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->pesanError($val[0]);
        }

        $user = User::create([
            'name'                  => $request->name,
            'email'                 => $request->email,
            'telp'                  => $request->telp,
            'password'              => encrypt($request->password)
            // 'password'              => bcrypt($request->password)
        ]);

        return response()->json([
            'status'                => 1,
            'message'               => 'Registred',
	    'data'                  => $user
        ], Response::HTTP_OK);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (password_verify($request->password, $user->password)) {
                return response()->json([
                    'message'               => "Welcome, $user->name"
                ], Response::HTTP_OK);
            }
            return $this->pesanError("Kesalahan Input");
        } elseif ($request->email == null) {
            return $this->pesanError("Email ga boleh kosong");
        } elseif (isEmpty($user)) {
            return $this->pesanError("Email ga terdaftar");
        }
    }
    public function pesanError($pesan)
    {
        return response()->json([
'status'                => 0,
            'message'   => $pesan
        ]);
    }
}
