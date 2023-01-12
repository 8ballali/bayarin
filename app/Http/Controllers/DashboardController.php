<?php

namespace App\Http\Controllers;


use App\Models\Universities;
use Illuminate\Http\Request;
use App\Imports\UniversityImport;
use App\Models\Merchants;
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
        $merchant = Merchants::all();
        $user = Auth::user();
        $role = $user->roles->name;
        return view('dashboardmerchant', compact('merchant','user','role'));
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
