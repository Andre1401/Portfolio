<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Pembelian;

class PembelianDetailController extends Controller
{
    public function index()
    {
        $id_pembelian = session('id');
        $produk = Produk::orderBy('kode_produk')->get();
        $supplier = Supplier::find(session('id_supplier'));
        $diskon = Pembelian::find($id_pembelian)->diskon ?? 0;

        if (! $supplier) {
            abort(404);
        }

        return view('pembelian_detail.index', compact('id_pembelian','produk','supplier','diskon'));
    }

    public function data($id)
    {
        $detail = PembelianDetail::with('produk')
            ->where('id_pembelian', $id)
            ->get();
        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($detail as $item) {
            $row = array();
            $row['kode_produk'] = '<span class="badge badge-success">'. $item->produk['kode_produk'] .'</span>';
            $row['nama_produk'] = $item->produk['nama_produk'];
            $row['harga_beli'] = 'Rp. '.format_uang($item->harga_beli);
            $row['jumlah'] = '<input type="number" class="form-control quantity" data-id="'. $item->id .'" value="'. $item->jumlah .'">';
            $row['subtotal'] = 'Rp. '.format_uang($item->subtotal);
            $row['aksi'] = '<div>
                                <button onclick="deleteData(`'. route('pembelian_detail.destroy', $item->id) .'`)" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button> 
                            </div>';
                
            $data[] = $row;

            $total += $item->harga_beli * $item->jumlah;
            $total_item +=  $item->jumlah;
        }
        $data[] = [
            'kode_produk' => '
                <div class="total" hidden>'. $total .'</div> 
                <div class="total_item" hidden>'. $total_item .'</div>',
            'nama_produk' => '',
            'harga_beli' => '',
            'jumlah' => '',
            'subtotal' => '',
            'aksi' => '',
        ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['aksi','kode_produk','jumlah'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $produk = Produk::where('id', $request->id_produk)->first();
        if (! $produk) {
            return response()->json('Data gagal disimpan', 400);
        }

        $detail = new PembelianDetail();
        $detail->id_pembelian = $request->id_pembelian;
        $detail->id_produk = $produk->id;
        $detail->harga_beli = $produk->harga_beli;
        $detail->jumlah = 1;
        $detail->subtotal = $produk->harga_beli;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $detail = PembelianDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga_beli * $request->jumlah;
        $detail->update();
    }

    public function destroy($id)
    {
        $detail = PembelianDetail::find($id);
        $detail->delete();

        return response(null, 204);
    }

    public function loadForm($diskon, $total)
    {
        $bayar = $total - ($diskon / 100 * $total);
        $data = [
            'totalrp' => format_uang($total),
            'bayar' => $bayar,
            'bayarrp' => format_uang($bayar),
            'terbilang' => ucwords(terbilang($bayar). ' Rupiah'),
        ];

        return response()->json($data);
    }
}
