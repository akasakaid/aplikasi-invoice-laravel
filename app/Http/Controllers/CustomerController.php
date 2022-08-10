<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\customer;

class CustomerController extends Controller
{
    public function index(){
        $customer = DB::table('customers')->get();
        return view('customer',['customer' => $customer]);
    }

    public function add(){
        return view('add_customer');
    }

    public function stored(Request $request){
        $nama = $request->nama;
        $telp = $request->telp;
        $alamat = $request->alamat;
        $customer = New customer;
        $customer->nama_customer = $nama;
        $customer->telp = $telp;
        $customer->alamat = $alamat;
        $customer->save();
        return redirect("customer");
    }

    public function drop($id){
        $id_customer = customer::where('id',$id)->delete();
        return redirect("customer");
    }

    public function update(Request $request){
        $id = $request->id;
        $nama = $request->nama;
        $telp = $request->telp;
        $alamat = $request->alamat;
        $customer = customer::where('id',$id)->update(["nama_customer"=>$nama,"telp"=>$telp,"alamat"=>$alamat]);
        return redirect("customer");
    }

    public function source($id){
        $customer = customer::where('id',$id)->get()[0];
        return view("edit_customer",["customer"=>$customer]);
    }
}
