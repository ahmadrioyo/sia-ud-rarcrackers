<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function user(Request $request)
    {
        $data = new User;

        if($request->get('search')){
            $data = $data->where('name','LIKE', '%'.$request->get('search').'%')
            ->orWhere('user','LIKE','%'.$request->get('search').'%');
        }

        $data = $data->get();
        return view('admin.user', compact('data', 'request'));
    }

    public function create(){
        return view('admin.create'); 
    }
 
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nama' => 'required|unique:users,user',
            'status' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator)->with('failed', 'Salah mengisi data pengguna!');

        $data['user'] = $request->nama;
        $data['name'] = $request->status;
        $data['password'] = Hash::make($request->password);
        
        $user = User::create($data);

        $user->assignRole($request->status);


        return redirect()->route('admin.user')->with('success', 'Berhasil menambah data pengguna!');

    }
    
    public function delete(Request $request, $id){
        $data = User::find($id);

        if($data){
            $data->delete();
        }
        return redirect()->route('admin.user')->with('success', 'Berhasil menghapus data pengguna!');
    }

    public function edit(Request $request, $id){
        $data = User::find($id);
        dd($data);
        return view('admin.edit', compact('data'));
    }

    public function update(Request $request, $id){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'status' => 'required',
            'password' => 'nullable'
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator)->with('failed', 'Salah mengisi data pengguna!');

        $data['user'] = $request->nama;
        $data['name'] = $request->status;

        if($request->password){
            $data['password'] = Hash::make($request->password);
        }

        $user = User::find($id);
        $user->update($data);

        $user->syncRoles($request->status);
        
        return redirect()->route('admin.user')->with('success', 'Berhasil mengubah data pengguna!');
    }
}
