@extends('layouts.layout')

@section('transaksiStatus')
active
@endsection

@section('content')
<!-- Modal Tambah Transaksi -->
<div class="modal modal-danger fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="Tambah Transaksi" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Ubah Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('transaksi.update')}}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="idgrup">
            <input type="hidden" name="idunitkerja">
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Tanggal</b></label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" placeholder="Tanggal" required>
                </div>
                <div class="form-group">
                    <label><b>Transaksi</b></label>
                    <input type="text" id="transaksi" name="transaksi" class="form-control" placeholder="Transaksi" pattern="[^0][\d]*$" required>
                </div>
                <div class="form-group">
                    <label><b>Keterangan</b></label>
                    <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" maxlength="99" rows="3" style="resize: none;"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Transaksi</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
                </div>
                <div class="col text-right">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah" data-placement="top" title="Lihat Detail Siswa">Tambah</button>        
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="transaksitable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th></th>
                            <th></th>
                            <th>Tanggal</th>
                            <th>Unit Kerja</th>
                            <th>Subkegiatan</th>
                            <th>Rekening</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                            <th hidden >ID</th>
                            <th hidden >tanggalcreate</th>
                            <th hidden >idgrup</th>
                            <th hidden >idunitkerja</th>
                            <th hidden >idrekening</th>
                            <th hidden >saldo</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th></th>
                            <th></th>
                            <th>Tanggal</th>
                            <th>Unit Kerja</th>
                            <th>Subkegiatan</th>
                            <th>Rekening</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                            <th hidden >ID</th>
                            <th hidden >tanggalcreate</th>
                            <th hidden >idgrup</th>
                            <th hidden >idunitkerja</th>
                            <th hidden >idrekening</th>
                            <th hidden >saldo</th>
                        </tr>
                    </tfoot>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@section('script')
@include('layouts.alert')
<script type="text/javascript">
$(document).ready(function(){
    oTable = $("#transaksitable").dataTable({
        processing: true,
        serverSide: true,
        ajax: {url: '{{route("transaksi.data")}}'},
        columns: [
            { data:'DT_RowIndex', orderable: false, searchable: false, width: 1 },
            { data:'tipe', orderable: false },
            { data:'status', orderable: false},
            { data:'tanggalref'},
            { data:'unitkerja.nama', orderable: false},
            { data:'subkegiatan.nama'},
            { data:'rekening.nama'},
            { data:'jenis'},
            { data:'jumlah'},
            { data:'action', orderable: false, searchable: false, width: 1 },
            { data:'id', visible: false},
            { data:'tanggal', visible: false},
            { data:'idgrup', visible: false},
            { data:'idunitkerja', visible: false},
            { data:'idrekening', visible: false},
            { data:'saldo', visible: false},
        ],
    }).yadcf([
        {
            column_number: 1,
            filter_default_label: 'Tipe',
            filter_type: "select",
            style_class:'c-filter-1',
            reset_button_style_class:'c-filter-btn-1 btn btn-sm btn-warning',
            data:[
                {value:'LS',label:'LS'},
                {value:'TU',label:'TU'},
            ]
        },
        {
            column_number: 2,
            filter_default_label: 'Status',
            filter_type: "select",
            style_class:'c-filter-1',
            reset_button_style_class:'c-filter-btn-1 btn btn-sm btn-warning',
            data:[
                {value:'0',label:'Belum'},
                {value:'1',label:'PPD acc'},
                {value:'2',label:'SOPD acc'},
                {value:'3',label:'SPD acc'},
            ]
        },
        // {
        //     column_number: 4,
        //     filter_default_label: 'Unit Kerja',
        //     filter_type: "select",
        //     style_class:'c-filter-1',
        //     reset_button_style_class:'c-filter-btn-1 btn btn-sm btn-warning',
        //     data:[
        //         {value:"37", label:"LAB KESDA"},
        //         {value:"38", label:"PKM Tanjungsari"},
        //         {value:"39", label:"PKM Simomulyo"},
        //         {value:"40", label:"PKM Manukan Kulon"},
        //         {value:"41", label:"PKM Balongsari"},
        //         {value:"42", label:"PKM Asemrowo"},
        //         {value:"43", label:"PKM Sememi"},
        //         {value:"44", label:"PKM Benowo"},
        //         {value:"45", label:"PKM Jeruk"},
        //         {value:"46", label:"PKM Lidah Kulon"},
        //         {value:"47", label:"PKM Lontar"},
        //         {value:"48", label:"PKM Peneleh"},
        //         {value:"49", label:"PKM Ketabang"},
        //         {value:"50", label:"PKM Kedungdoro"},
        //         {value:"51", label:"PKM Dr. Soetomo"},
        //         {value:"52", label:"PKM Tembok Dukuh"},
        //         {value:"53", label:"PKM Gundih"},
        //         {value:"54", label:"PKM Tambakrejo"},
        //         {value:"55", label:"PKM Simolawang"},
        //         {value:"56", label:"PKM Perak Timur"},
        //         {value:"57", label:"PKM Pegirian"},
        //         {value:"58", label:"PKM Sidotopo"},
        //         {value:"59", label:"PKM Wonokusumo"},
        //         {value:"60", label:"PKM Krembangan Selatan"},
        //         {value:"61", label:"PKM Dupak"},
        //         {value:"62", label:"PKM Kenjeran"},
        //         {value:"63", label:"PKM Tanah Kali Kedinding"},
        //         {value:"64", label:"PKM Sidotopo Wetan"},
        //         {value:"65", label:"PKM Rangkah"},
        //         {value:"66", label:"PKM Pacar Keling"},
        //         {value:"67", label:"PKM Gading"},
        //         {value:"68", label:"PKM Pucangsewu"},
        //         {value:"69", label:"PKM Mojo"},
        //         {value:"70", label:"PKM Kalirungkut"},
        //         {value:"71", label:"PKM Medokan Ayu"},
        //         {value:"72", label:"PKM Tenggilis"},
        //         {value:"73", label:"PKM Gunung Anyar"},
        //         {value:"74", label:"PKM Menur"},
        //         {value:"75", label:"PKM Klampis Ngasem"},
        //         {value:"76", label:"PKM Mulyorejo"},
        //         {value:"77", label:"PKM Sawahan"},
        //         {value:"78", label:"PKM Putat Jaya"},
        //         {value:"79", label:"PKM Banyu Urip"},
        //         {value:"80", label:"PKM Pakis"},
        //         {value:"81", label:"PKM Jagir"},
        //         {value:"82", label:"PKM Wonokromo"},
        //         {value:"83", label:"PKM Ngagel Rejo"},
        //         {value:"84", label:"PKM Kedurus"},
        //         {value:"85", label:"PKM Dukuh Kupang"},
        //         {value:"86", label:"PKM Wiyung"},
        //         {value:"87", label:"PKM Gayungan"},
        //         {value:"88", label:"PKM Jemursari"},
        //         {value:"89", label:"PKM Sidosermo"},
        //         {value:"90", label:"PKM Kebonsari"},
        //         {value:"103", label:"PKM Bangkingan"},
        //         {value:"104", label:"PKM Made"},
        //         {value:"117", label:"PKM Moro Krembangan ,"},
        //         {value:"121", label:"PKM Tambak Wedi"},
        //         {value:"122", label:"PKM Bulak Banteng"},
        //         {value:"135", label:"PKM Keputih"},
        //         {value:"138", label:"PKM Kalijudan"},
        //         {value:"148", label:"PKM Balas Klumprik"},
        //         {value:"151", label:"PKM Siwalankerto"},
        //         {value:"984", label:"PKM Sawah Pulo"},
        //     ]
        // },
    ]);
});
</script>
@endsection