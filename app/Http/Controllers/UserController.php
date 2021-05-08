<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Biodata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use Alert;
use Exception;
use Crypt;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['users'] = User::query()->with(['biodata'])->orderBy('name')->get();
        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $menu = 'user';
        $edit = false;

        $data = [
            'menu' => $menu,
            'edit' => $edit
        ];

        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->except('_token');

        Validator::make($data, User::RULES, User::ERROR_MESSAGES)->validate();

        //dd($data);
        try {
            // $data['userid_created'] = Auth::user()->id;
            // $data['userid_updated'] = Auth::user()->id;
            $data['password'] = bcrypt('12345678');
            $data['login_type'] = 'app';

            $user = User::create($data);
            $user->assignRole('user');

            $data['user_id'] = $user->id;
            $biodata = Biodata::create($data);

        } catch (Exception $ex) {
            return redirect()->back()->withInput();
        }

        $data = [
            'user' => $user->id,
        ];

        return redirect()->route('user.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $edit = true;

        try {
            $menu = 'User';
            $user = User::query()->with(['biodata'])->find(decrypt($id));

            $data = [
                    'menu' => $menu,
                    'edit' => $edit,
                    'user' => $user,
                ];

            return view('user.create', $data);
        } catch (Exception $ex) {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->except('_token');
        Validator::make($data, [
            'email' => ['required', Rule::unique('users')->ignore(decrypt($id))],
        ]);

        try {

            $user = User::query()->find(decrypt($id));
            //dd($user->id);
            $biodata = Biodata::where('user_id',$user->id)->first();

            //dd($biodata);
            $user->update($data);
            $biodata->update($data);

            alert()->success('Berhasil', 'User Berhasil di Update');
            Alert::success('Data berhasil dihapus');

            return redirect()->route('user.index');

        } catch (Exception $ex) {

            alert()->error('Gagal', 'User gagal di Update');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::query()->find(decrypt($id));
        $biodata = Biodata::where('user_id', $user->id)->first();

        $user->syncRoles(['']);

        $user->delete();
        $biodata->delete();

        alert()->success('Berhasil', 'User Berhasil di Update')->persistent('Ok');
        Alert::success('Data berhasil dihapus')->persistent('Ok');

        return redirect()->route('user.index');
    }
}
