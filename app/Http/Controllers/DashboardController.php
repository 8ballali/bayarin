<?php

namespace App\Http\Controllers;


use App\Models\Universities;
use Illuminate\Http\Request;
use App\Imports\UniversityImport;
use App\Models\Merchants;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        $role = $user->roles->name;
        return view('dashboard.dashboard', compact('user','role'));
    }
    public function university()
    {

        $university = Universities::all();
        $user = Auth::user();
        $role = $user->roles->name;
        return view('dashboard.university', compact('university','user','role'));
    }
    public function merchant()
    {
        $merchant = Merchants::get();
        $user = Auth::user();

        $role = $user->roles->name;
        return view('dashboard.merchant', compact('merchant','user','role'));
    }
    public function merchant_add()
    {
        $merchant = Merchants::all();
        $user = Auth::user();
        $role = $user->roles->name;
        return view('dashboard.add-merchant', compact('merchant','user','role'));
    }
    public function edit_merchant($id)
    {
        $merchant = Merchants::find($id);
        $user = Auth::user();
        $role = $user->roles->name;
        return view('dashboard.edit-merchant', compact('merchant','user','role'));
    }
    public function add_merchant(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'type' => 'required',
        ]);

        $file = $request->file('logo');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'storage';
        $file->move($tujuan_upload, $nama_file);

        Merchants::create([
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
            'type' => $request->type,
            'logo' => $nama_file,

        ]);
        return redirect('/merchant');
    }


    public function update_merchant($id, Request $request)
    {
        $merchant = Merchants::find($id);
        $this->validate($request, [
            'name' => 'required',
        ]);
        if ($request->file) {
            $file = $request->file('logo');

            $nama_file = time() . "_" . $file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'storage';
            $file->move($tujuan_upload, $nama_file);
            @unlink(public_path('/') . '/storage/' . $merchant->file);
        }else{
            $nama_file=$merchant->file;
        }

        $merchant->name = $request->name;
        $merchant->description = $request->description;
        $merchant->type = $request->type;
        $merchant->save();
        return redirect('/merchant');
    }

    public function delete_merchant($id)
    {
        $merchant = Merchants::find($id);
        $merchant->delete();
        return redirect('/merchant');
    }

    public function roles()
    {
        $user = Auth::user();
        $role = $user->roles->name;

        $roles = Roles::all();
        return view('dashboard.roles', compact('user','role','roles'));
    }
    public function import_excel(Request $request)
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		// menangkap file excel
		$file = $request->file('file');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();

		// upload ke folder file_siswa di dalam folder public
		$file->move('file_univ',$nama_file);

		// import data
		Excel::import(new UniversityImport, public_path('/file_univ/'.$nama_file));

		// alihkan halaman kembali
		return redirect('/university');
	}
}
