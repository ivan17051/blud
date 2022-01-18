<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UnitKerja;
use App\Kegiatan;
use App\SubKegiatan;
use App\Pejabat;
use App\Rekanan;
use App\Rekening;
use App\User;
use App\Saldo;
use App\Transaksi;
use Datatables;
use Carbon\Carbon;
use PDF;
use Validator;

class TransaksiController extends Controller
{
    public function index(){
        $subkegiatan=SubKegiatan::where('isactive', 1)->select('idgrup','idkegiatan','kode','nama')->get();
        $rekening=Rekening::where('isactive', 1)->select('id','kode','nama')->get();
        $rekanan=Rekanan::where('isactive', 1)->select('id','nama')->get();
        return view('transaksi',['subkegiatan'=>$subkegiatan, 'rekening'=>$rekening, 'rekanan'=>$rekanan]);
    }

    public function data(Request $request){
        $data = Transaksi::where('isactive',1)->with(['unitkerja','rekening','subkegiatan']);
        $datatable = Datatables::of($data);
        $datatable->editColumn('tanggalref', function ($t) { return Carbon::parse($t->tanggal)->translatedFormat('d M Y');})
            ->addIndexColumn()
            ->editColumn('tipe', function ($t) { 
                return $t->tipe==='TU'?
                    "<span class=\"badge bg-success text-white\">TU</span>":
                    "<span class=\"badge bg-primary text-white\">LS</span>";
            })
            ->editColumn('jenis', function ($t) { 
                return $t->jenis===1?"<p class=\"text-info\"><b>debit</b></p>":"<p class=\"text-warning\"><b>kredit</b></p>";
            })
            ->addColumn('action', function ($t) { 
                $html='';
                if ($t->status===0) {
                    $html.='<button onclick="hapus(this)" class="btn btn-sm btn-outline-danger border-0" title="delete"><i class="fas fa-trash fa-sm"></i></button>&nbsp&nbsp';
                }
                $html.='<button onclick="show(this)" class="btn btn-sm btn-outline-info border-0" title="info">&nbsp<i class="fas fa-ellipsis-v fa-sm"></i>&nbsp</button>';
                return $html;
            })
            ->addColumn('status_raw', function ($t) {
                return $t->status;
            })
            ->editColumn('jumlah', function ($t){
                return number_format($t->jumlah,2,',','.');
            })
            ->editColumn('status', function ($t) { 
                switch ($t->status) {
                    case 0:
                        return '<button class="btn btn-sm btn-outline-dark border-0" title="acc"><i class="fas fa-hourglass-half fa-sm"></i>&nbsp belum</button>';
                        break;
                    case 1:
                        return '<button class="btn btn-sm btn-warning border-0" title="acc"><i class="fas fa-check fa-sm"></i>&nbsp ppd</button>';
                        break;
                    case 2:
                        return '<button class="btn btn-sm btn-info border-0" title="acc"><i class="fas fa-check fa-sm"></i>&nbsp sopd</button>';
                        break;
                    case 2:
                        return '<button class="btn btn-sm btn-success border-0" title="acc"><i class="fas fa-check fa-sm"></i>&nbsp spd</button>';
                        break;
                    default:
                        return '';
                }
            })
            ->rawColumns(['tipe','jenis','status','action']);
        return $datatable->make(true);  
    }

    public function storeUpdateTransaksi(Request $request){
        $user = Auth::user();
        $input = array_map('trim', $request->all());
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:transaksi,id',
            'tipe' => 'required|string|in:LS,TU',
            'jenis' => 'required|in:0,1',
            'tanggalref' => 'required|string',
            'idgrup' => 'integer',
            'idrekening' => 'required|exists:mrekening,id',
            'idrekanan' => 'required|exists:mrekanan,id',
            'jumlah' => array('required','regex:/^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$/'), // allow float
            'keterangan' => 'required|string|max:255',
        ]);
        if ($validator->fails()) return back()->with('error','Gagal menyimpan');
        
        $input = $validator->valid();
        $input['idunitkerja']=$user->idunitkerja;

        //jika edit transaksi old
        if(isset($input['id'])){
            $t=Transaksi::find($input['id']);
            $t->fill($input);
            $t->fill([
                'saldo'=>999999,
                'riwayat'=>array(),
                'status'=>1,
                'idm'=>$user->id,
            ]);
        }
        else{
            $t=new Transaksi();
            $t->fill($input);
            $t->fill([
                'saldo'=>999999,
                'riwayat'=>array(),
                'status'=>0,
                'tanggal'=>Carbon::now()->format('Y-m-d'),
                'idc'=>$user->id,
                'idm'=>$user->id,
            ]);
        }

        //cek apakah ada proses edit atau tidak
        if($t->isDirty()){
            $t->save();
            return back()->with('success','Berhasil menyimpan');
        }else{
            return back()->with('error','Tidak ada perubahan');
        }
    }

    public function deleteTransaksi(Request $request){
        $userId = Auth::id();
        try {
            $model=Transaksi::find($request->input('id'));
            $model->idm=$userId;
            $model->isactive=0;
            $model->save();
            return back()->with('success','Berhasil menghapus');
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menghapus');
        }
    }
        
    public function ppd($id){
        $transaksi = Transaksi::with(['unitkerja','subkegiatan','rekening'])->find($id);
        // dd($transaksi);
        // $pdf = PDF::loadView('tu', ['transaksi' => $transaksi])->stream('ppd.pdf');
        // return $pdf;
        return view('tu', ['transaksi' => $transaksi]);
    }
}
