<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\customer;
use App\Models\invoice;
use App\Models\invoice_detail;

class InvoiceController extends Controller
{
    public function index(){
        $data = customer::join('invoices','invoices.id_invoice','=','customers.id')->get(['customers.nama_customer','invoices.*']);
        $data = customer::select("customers.nama_customer","invoices.*")->join("invoices","invoices.id_customer","=","customers.id")->get();
        return view('invoice',['data'=>$data]);
    }

    public function add(){
        $data = customer::all();
        $akhir = invoice::all()->last();
        if ($akhir == null) {
            return view('add_invoice',["data"=>$data,"no_invoice"=> 1]);
        } 
        return view('add_invoice',["data"=>$data,"no_invoice"=>$akhir->id_invoice + 1]);
    }

    public function kalkulasi_diskon($diskon,$harga){
        $result = ($diskon * $harga ) / 100;
        return $result;
    }

    public function kalkulasi_subtotal($diskon,$harga){
        $hasil = ($diskon * $harga) / 100;
        $result = $harga - $hasil;
        return $result;
    }

    public function kalkulasi_subtotal_array($harga,$diskon){
        $array_hasil = [];
        for ($i=0; $i < count($harga); $i++) {
            if ($diskon[$i] > 0){
                $hasil = ($diskon[$i] * $harga[$i]) / 100;
                $result = $harga[$i] - $hasil;
                array_push($array_hasil,$result);
            } else {
                array_push($array_hasil,$harga[$i]);
            }
        }
        return $array_hasil;
    }

    public function total_array($subtotal){
        $array_total = [];
        $temp_total = 0;
        foreach ($subtotal as $total) {
            $temp_total = $temp_total + $total;
            array_push($array_total,$temp_total);
        }
        return $array_total;
    }

    public function delete($id){
        echo $id;
        $data_id_invoice = invoice::where('id_invoice',$id)->delete();
        $data_id_invoice = invoice_detail::where('id_invoice',$id)->delete();
        return redirect('invoice');
    }

    public function detail($id){
        $data = customer::all();
        $detail = invoice_detail::where('id_invoice_detail',$id)->get()->first();
        $invoice = invoice::where('id_invoice',$id)->get()->first();
        $nama_customer = customer::where('id',$invoice->id_customer)->get('nama_customer')->first()['nama_customer'];
        $harga = json_decode($detail['harga_item']);
        $item = json_decode($detail['nama_item']);
        $diskon = json_decode($detail['diskon']);
        $catatan = $invoice['catatan'];
        $tgl_invoice = $invoice['tgl_invoice'];
        $array_diskon = $this->kalkulasi_subtotal_array($harga,$diskon);
        return view('detail_invoice',[
            'nama_customer' => $nama_customer,
            'data'=>$data,
            'status' => $invoice->status,
            'no_invoice'=>$id,
            'tgl_invoice' => $tgl_invoice,
            'catatan' => $catatan,
            'subtotal' => $array_diskon,
            'item' => $item,
            'harga' => $harga,
            'diskon' => $diskon,
            'total' => $this->total_array($array_diskon)
        ]); 
    }

    public function edite($id){
        $detail = invoice_detail::where('id_invoice',$id)->get();
        dd($detail);
    }

    public function inject(Request $request){
        $total = 0;
        $id_invoice = $request->no_invoice;
        $tgl_invoice = $request->tgl_invoice;
        $customer = $request->customer;
        $id_customer = customer::where('nama_customer',$customer)->get('id')->first()['id'];
        $status = $request->status;
        $catatan = $request->catatan;
        for ($i=0; $i < count($request->harga); $i++) { 
            if ($request->diskon[$i] <= 0){
                $total = $total + $request->harga[$i];
                continue;
            } elseif ($request->diskon[$i] > 0) {
                $hasil = $this->kalkulasi_diskon($request->diskon[$i],$request->harga[$i]);
                $total = $total + $hasil;
            } else {
                $total = $total + $hasil;
            }
        }
        $nama_item = json_encode($request->nama_item);
        $harga = json_encode($request->harga);
        $diskon = json_encode($request->diskon);
        $invoice = New invoice;
        $invoice->tgl_invoice = $tgl_invoice;
        $invoice->id_customer = $id_customer;
        $invoice->catatan = $catatan;
        $invoice->total = $total;
        $invoice->status = $status;
        $invoice->save();
        $invoice_detail = New invoice_detail;
        $invoice_detail->id_invoice = $id_invoice;
        $invoice_detail->nama_item = $nama_item;
        $invoice_detail->harga_item = $harga;
        $invoice_detail->diskon = $diskon;
        $invoice_detail->save();
        return redirect('invoice');
    }

    public function updating_data(Request $request){
        $total = 0;
        $id_invoice = $request->no_invoice;
        $tgl_invoice = $request->tgl_invoice;
        $customer = $request->customer;
        $id_customer = customer::where('nama_customer',$customer)->get('id')->first()['id'];
        $status = $request->status;
        $catatan = $request->catatan;
        for ($i=0; $i < count($request->harga); $i++) { 
            if ($request->diskon[$i] <= 0){
                $total = $total + $request->harga[$i];
                continue;
            } elseif ($request->diskon[$i] > 0) {
                $hasil = $this->kalkulasi_diskon($request->diskon[$i],$request->harga[$i]);
                $total = $total + $hasil;
            } else {
                $total = $total + $hasil;
            }
        }
        $nama_item = json_encode($request->nama_item);
        $harga = json_encode($request->harga);
        $diskon = json_encode($request->diskon);

        // invoice update data
        $invoice_update = invoice::where('id_invoice',$id_invoice)->update([
            'tgl_invoice' => $tgl_invoice,
            'id_customer' => $id_customer,
            'catatan' => $catatan,
            'total' => $total,
            'status' => $status
        ]);

        // invoice detail update data
        $invoice_detail = invoice_detail::where('id_invoice_detail',$request->no_invoice)->update([
            'id_invoice' => $id_invoice,
            'nama_item' => $nama_item,
            'harga_item' => $harga,
            'diskon' => $diskon
        ]);
        return redirect('invoice');
    }

    public function get_edit_data($id){
        $data = customer::all();
        $detail = invoice_detail::where('id_invoice_detail',$id)->get()->first();
        $invoice = invoice::where('id_invoice',$id)->get()->first();
        $nama_customer = customer::where('id',$invoice->id_customer)->get('nama_customer')->first()['nama_customer'];
        $harga = json_decode($detail['harga_item']);
        $item = json_decode($detail['nama_item']);
        $diskon = json_decode($detail['diskon']);
        $catatan = $invoice['catatan'];
        $tgl_invoice = $invoice['tgl_invoice'];
        $array_diskon = $this->kalkulasi_subtotal_array($harga,$diskon);
        return view('edit_invoice',[
            'nama_customer' => $nama_customer,
            'data'=>$data,
            'status' => $invoice->status,
            'no_invoice'=>$id,
            'tgl_invoice' => $tgl_invoice,
            'catatan' => $catatan,
            'subtotal' => $array_diskon,
            'item' => $item,
            'harga' => $harga,
            'diskon' => $diskon,
            'total' => $this->total_array($array_diskon)
        ]); 
    }
}
