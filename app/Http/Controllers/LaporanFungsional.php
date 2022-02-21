<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\UnitKerja;
use App\Kegiatan;
use App\SubKegiatan;
use App\Pejabat;
use App\Rekanan;
use App\Rekening;
use App\User;
use App\Saldo;
use App\Transaksi;
use App\Pajak;
use Carbon\Carbon;

class LaporanFungsional extends Controller
{
    public function index(){
        $user = Auth::user();
        $idunitkerja = $user->idunitkerja;
        $bendahara = Pejabat::where('idunitkerja', $idunitkerja)->where('jabatan', 'Bendahara Pengeluaran')->get();
        $otorisator = Pejabat::where('idunitkerja', $idunitkerja)->where('jabatan', 'KPA')->get();
        $returnHTML = view('modal.fungsional',['bendahara'=>$bendahara , 'otorisator'=>$otorisator])->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function excel(Request $request){
        $input = $request->all();
        
        $otorisator = Pejabat::where('id', $input['idotorisator'])->first();
        $bendahara = Pejabat::where('id', $input['idbendahara'])->first();
        if(empty($bendahara) OR empty($otorisator)){
            return back()->with('error','Pejabat Tidak Ditemukan');
        }
        else if($bendahara->idunitkerja <> $otorisator->idunitkerja){
            return back()->with('error','Unitkerja Tidak Sesuai');
        }
        $unitkerja = UnitKerja::find( $bendahara->idunitkerja );
        $input['idunitkerja']=$bendahara->idunitkerja;
        
        $date=Carbon::createFromDate($input['tahun'], $input['bulan'], null);
        $now=Carbon::now();

        //DATA
        $data = $this->init($input, $date);

        $ex = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $ex->getProperties()->setCreator("siannasGG");
        $ac = $ex->getActiveSheet();

        // KOP
        $ac->mergeCells('A2:O2');
        $ac->getCell('A2')->setValue("PEMERINTAH KOTA SURABAYA");
        $ac->mergeCells('A3:O3');
        $ac->getCell('A3')->setValue("LAPORAN PERTANGGUNGJAWABAN BENDAHARA PENGELUARAN");
        $ac->mergeCells('A4:O4');
        $ac->getCell('A4')->setValue("(SPJ BELANJA - FUNGSIONAL)");

        $titleStyle = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'font' => [
                'bold' => true,
                'size' => 15,
            ],
        ];
        $ac->getStyle('B1:J1')->applyFromArray($titleStyle);

        $headStyle = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'font' => [
                'bold' => true,
                'size' => 10,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ]
            ]
        ];

        $contentStyle = [
            'font' => [
                'size' => 10,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ]
            ]
        ];

        // INFORMASI
        $ac->getCell('A6')->setValue("Kode dan Nama SKPD");
        $ac->getCell('A7')->setValue("Pengguna Anggaran");
        $ac->getCell('A8')->setValue("Bendahara Pengeluaran");
        $ac->getCell('A9')->setValue("Tahun Anggaran");
        $ac->getCell('A10')->setValue("Bulan");
        $ac->getCell('B6')->setValue(": {$unitkerja->kode}-{$unitkerja->nama}");
        $ac->getCell('B7')->setValue(": ");
        $ac->getCell('B8')->setValue(": ");
        $ac->getCell('B9')->setValue(": ".$date->isoFormat('YYYY'));
        $bulanStr=$date->isoFormat('MMMM');
        $ac->getCell('B10')->setValue(": ".ucwords($bulanStr));

        // HEAD TABEL
        $ac->getCell('A12')->setValue("NO.");
        $ac->getCell('B12')->setValue("KODE SUB-REKENING");
        $ac->getCell('C12')->setValue("URAIAN");
        $ac->getCell('D12')->setValue("ANGGARAN");
        $ac->getCell('D13')->setValue("(Rp.)");
        $ac->getCell('E12')->setValue("SPJ LS - GAJI");
        $ac->getCell('E13')->setValue("S/D BULAN LALU (Rp.)");
        $ac->getCell('F13')->setValue("BULAN INI (Rp.)");
        $ac->getCell('G13')->setValue("S/D BULAN INI (Rp.)");
        $ac->getCell('H12')->setValue("SPJ - BARANG & JASA");
        $ac->getCell('H13')->setValue("S/D BULAN LALU (Rp.)");
        $ac->getCell('I13')->setValue("BULAN INI (Rp.)");
        $ac->getCell('J13')->setValue("S/D BULAN INI (Rp.)");
        $ac->getCell('K12')->setValue("SPJ UP/GU/TU");
        $ac->getCell('K13')->setValue("S/D BULAN LALU (Rp.)");
        $ac->getCell('L13')->setValue("BULAN INI (Rp.)");
        $ac->getCell('M13')->setValue("S/D BULAN INI (Rp.)");
        $ac->getCell('N12')->setValue("JUMLAH SPJ (LS+UP/GU/TU) S/D BULAN INI (Rp.)");
        $ac->getCell('O12')->setValue("SISA PAGU ANGGARAN (Rp.)");

        $ac->mergeCells('E12:G12');
        $ac->mergeCells('H12:J12');
        $ac->mergeCells('H12:J12');

        $ac->getStyle('A12:O14')->applyFromArray($headStyle);

        // HEAD NOMOR TABLE
        $ac->getCell('A14')->setValue("1");
        $ac->getCell('B14')->setValue("2");
        $ac->getCell('C14')->setValue("3");
        $ac->getCell('D14')->setValue("4");
        $ac->getCell('E14')->setValue("5");
        $ac->getCell('F14')->setValue("6");
        $ac->getCell('G14')->setValue("7=5+6");
        $ac->getCell('H14')->setValue("8");
        $ac->getCell('I14')->setValue("9");
        $ac->getCell('J14')->setValue("10=8+9");
        $ac->getCell('K14')->setValue("11");
        $ac->getCell('L14')->setValue("12");
        $ac->getCell('M14')->setValue("13=11+12");
        $ac->getCell('N14')->setValue("14=7+10+13");
        $ac->getCell('O14')->setValue("15=4-14");

        $ac->getColumnDimension('A')->setWidth(22);
        $ac->getColumnDimension('B')->setWidth(13);
        $ac->getColumnDimension('C')->setWidth(35);
        $ac->getColumnDimension('D')->setWidth(13);
        $ac->getColumnDimension('E')->setWidth(13);
        $ac->getColumnDimension('F')->setWidth(13);
        $ac->getColumnDimension('G')->setWidth(13);
        $ac->getColumnDimension('H')->setWidth(13);
        $ac->getColumnDimension('I')->setWidth(13);
        $ac->getColumnDimension('J')->setWidth(13);
        $ac->getColumnDimension('K')->setWidth(13);
        $ac->getColumnDimension('L')->setWidth(13);
        $ac->getColumnDimension('M')->setWidth(13);
        $ac->getColumnDimension('N')->setWidth(33);
        $ac->getColumnDimension('O')->setWidth(19);

        $rowidx=15;
        foreach ($data as $key=>$d) {
            $ac->getCell('A'.$rowidx)->setValue($key+1);
            $ac->getCell('B'.$rowidx)->setValue($d->kode);
            $ac->getCell('C'.$rowidx)->setValue($d->nama);
            $ac->getCell('D'.$rowidx)->setValue(($d->saldoawal ? $d->saldoawal->saldo : 0));

            $ac->getCell('G'.$rowidx)->setValue("=E{$rowidx}+F{$rowidx}");
            $ac->getCell('J'.$rowidx)->setValue("=H{$rowidx}+I{$rowidx}");
            $ac->getCell('M'.$rowidx)->setValue("=K{$rowidx}+L{$rowidx}");
            $ac->getCell('N'.$rowidx)->setValue("=G{$rowidx}+J{$rowidx}+M{$rowidx}");
            $ac->getCell('O'.$rowidx)->setValue("=D{$rowidx}-N{$rowidx}");
            $rowidx++;
        }

        $ac->getStyle("A12:O{$rowidx}")->applyFromArray($contentStyle);

        $ac->mergeCells("A{$rowidx}:C{$rowidx}");
        $ac->mergeCells("L{$rowidx}:O{$rowidx}");
        $ac->getCell("A{$rowidx}")->setValue("Mengetahui,");
        $ac->getCell("L{$rowidx}")->setValue("Surabaya, {$now->isoFormat('d MMMM Y')}");
        $ac->getStyle("A{$rowidx}")->getAlignment()->setHorizontal('center');
        $ac->getStyle("L{$rowidx}")->getAlignment()->setHorizontal('center');

        $ac->getStyle("A{$rowidx}")->getFont()->setBold(TRUE);
        $ac->getStyle("L{$rowidx}")->getFont()->setBold(TRUE);
        
        $rowidx++;
        $ac->mergeCells("A{$rowidx}:C{$rowidx}");
        $ac->mergeCells("L{$rowidx}:O{$rowidx}");
        $ac->getCell("A{$rowidx}")->setValue("Pengguna Anggaran");
        $ac->getCell("L{$rowidx}")->setValue("Bendahara Pengeluaran");
        $ac->getStyle("A{$rowidx}")->getAlignment()->setHorizontal('center');
        $ac->getStyle("L{$rowidx}")->getAlignment()->setHorizontal('center');

        $ac->getStyle("A{$rowidx}")->getFont()->setBold(TRUE);
        $ac->getStyle("L{$rowidx}")->getFont()->setBold(TRUE);
        
        $rowidx++;
        $rowidx++;
        $ac->mergeCells("A{$rowidx}:C{$rowidx}");
        $ac->mergeCells("L{$rowidx}:O{$rowidx}");
        $ac->getCell("A{$rowidx}")->setValue($otorisator->nama);
        $ac->getCell("L{$rowidx}")->setValue($bendahara->nama);
        $ac->getStyle("A{$rowidx}")->getAlignment()->setHorizontal('center');
        $ac->getStyle("L{$rowidx}")->getAlignment()->setHorizontal('center');

        $ac->getStyle("A{$rowidx}")->getFont()->setBold(TRUE)->setUnderline(TRUE);
        $ac->getStyle("L{$rowidx}")->getFont()->setBold(TRUE)->setUnderline(TRUE);
        
        $rowidx++;
        $ac->mergeCells("A{$rowidx}:C{$rowidx}");
        $ac->mergeCells("L{$rowidx}:O{$rowidx}");
        $ac->getCell("A{$rowidx}")->setValue("NIP.{$otorisator->nip}");
        $ac->getCell("L{$rowidx}")->setValue("NIP.{$bendahara->nip}");
        $ac->getStyle("A{$rowidx}")->getAlignment()->setHorizontal('center');
        $ac->getStyle("L{$rowidx}")->getAlignment()->setHorizontal('center');
        $rowidx++;

        // send file ke user
        $fileName="Fungsional_{$unitkerja->nama}_{$bulanStr}_{$date->isoFormat('Y')}.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        header('Cache-Control: max-age=0');
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($ex, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    private function init($input, Carbon $date){
        $idunitkerja=$input['idunitkerja'];
        $year = $date->year;
        $rekening=Rekening::where('isactive', 1)->with([
            'saldo'=>function($q) use($idunitkerja, $date) {
                $date->subMonth();
                $q->select('id','idunitkerja','idrekening','saldo')->orderBy('tanggal','DESC')
                    ->where('idunitkerja', $idunitkerja)
                    ->whereMonth('tanggal',$date->month)
                    ->whereYear('tanggal',$date->year);
            },
            'saldoawal'=>function($q) use($idunitkerja, $year) {
                $q->select('id','idunitkerja','idrekening','saldo')
                    ->where('idunitkerja', $idunitkerja)
                    ->whereYear('tanggal',$year);
            }
        ])->select('id','kode','nama')->get();
        return $rekening;
    }
}