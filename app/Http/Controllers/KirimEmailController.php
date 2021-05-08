<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\KodingEmail;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\User;
use App\Models\Biodata;
use Exception;
use Alert;

class KirimEmailController extends Controller
{

    public function index()
    {
        //
        $data['email'] = User::query()->with(['biodata'])->where('name', '!=', 'Admin')->count();

        $data['sudah'] = User::query()
        ->with(['biodata'])
        ->where('name', '!=', 'Admin')
        ->whereHas('biodata', function ($q) {
            $q->where('status', '=', 'done');
        })->count();

        $data['belum'] = User::query()
        ->with(['biodata'])
        ->where('name', '!=', 'Admin')
        ->whereHas('biodata', function ($q) {
            $q->where('status', '=', null );
        })->count();

        return view('dashboard', $data);

    }

    public function create()
    {
        //
        Mail::to("epc.tju@gmail.com")->send(new KodingEmail());

        return "Email telah dikirim";
    }

    public function store(Request $request)
    {
        //

    }

    public function show($id)
    {
        //

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //

    }

    public function destroy($id)
    {
        //
    }

    public function verifikasi($id)
    {

        //$biodata = Biodata::query()->where('id', $id)->firstOrFail();
        $upemail = Biodata::query()->findOrFail(decrypt($id));

        if ($upemail->status == 'done'){
            return view('sudah');

        }else{
            $data['status'] = 'done';
            $upemail->update($data);

            return view('terimakasih');
        }

    }

    public function send($id)
    {
        try {
                $biodata = Biodata::query()->with(['user'])->findOrFail(decrypt($id));

                //dd($biodata);
                // $pesan =    'Yang bertanda tangan di bawah ini :' . "\n" .
                // 'Nama :' . "\n" .
                //     'Nomor :' . "\n\n\n" .
                //     'Menyatakan Bahwa :' . "\n";
                // $perhatian = 'Untuk mengunduh dokumen klik link :' . "\n";

                //$penerima = 'mishaprimaresty@gmail.com';
                $penerima = $biodata->user->email;

                //Mail::to($penerima)->send(new KodingEmail($biodata));

                Mail::send('isiemail', array('biodata' => $biodata), function ($pesan) use ($penerima) {
                $pesan->to($penerima , 'Verifikasi')->subject('Pernyataan Kepatuhan');
                $pesan->from(env('MAIL_USERNAME', 'laravelmailto8@gmail.com'), 'Pernyataan Kepatuhan');

                });

                alert()->success('Berhasil', 'Email Berhasil Dikirim');

                return redirect()->route('user.index');

            } catch (Exception $e) {
                return response(['status' => false, 'errors' => $e->getMessage()]);
            }
    }

    // public function send(Request $request)
    // {
    //     try {
    //         Mail::send('isiemail', array('pesan' => $request->pesan), function ($pesan) use ($request) {
    //             $pesan->to($request->penerima, 'Verifikasi')->subject('Verifikasi Email');
    //             $pesan->from(env('MAIL_USERNAME', 'didikprab@gmail.com'), 'Verifikasi Akun email anda');
    //         });
    //     } catch (Exception $e) {
    //         return response(['status' => false, 'errors' => $e->getMessage()]);
    //     }
    // }
}
