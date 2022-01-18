@extends('layouts.layout')

@section('transaksiStatus')
active
@endsection

@section('content')
<!-- Modal Tambah Transaksi -->
<div class="modal modal-danger fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="Tambah Transaksi" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Tambah Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('transaksi.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 col-md-3">
                        <div class="form-group">
                            <label><b>Tipe Transaksi</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" name="tipe" required >
                                <option value="">--Pilih--</option>
                                <option value="LS">LS</option>
                                <option value="TU">TU</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label><b>Tanggal</b></label>
                            <input type="date" id="tanggalref" name="tanggalref" class="form-control" placeholder="Tanggal" required>
                        </div>  
                    </div>
                </div>                
                <div class="form-group">
                    <label><b>Subkegiatan</b></label>
                    <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idgrup" required >
                        <option value="">--Pilih--</option>
                        @foreach($subkegiatan as $sk)
                        <option value="{{$sk->idgrup}}">{{$sk->kode.', '.$sk->nama.', '.$sk->tahun}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rekening</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idrekening" required >
                                <option value="">--Pilih--</option>
                                @foreach($rekening as $r)
                                <option value="{{$r->id}}">{{$r->kode.', '.$r->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rekanan</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" data-live-search="true" name="idrekanan" required >
                                <option value="">--Pilih--</option>
                                @foreach($rekanan as $r)
                                <option value="{{$r->id}}">{{$r->nama}}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>
                </div>        
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Jenis Transaksi</b></label>
                            <select class="selectpicker" data-style-base="form-control" data-style="" name="jenis" required >
                                <option value="">--Pilih--</option>
                                <option value="1">Debit</option>
                                <option value="0">Kredit</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Jumlah</b></label>
                            <input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" pattern="^(?=.+)(?:[1-9]\d*|0)(?:\.\d{0,2})?$" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label><b>Keterangan</b></label>
                    <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" maxlength="250" rows="3" style="resize: none;" required></textarea>
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

<!-- Form -->
<form hidden action="{{route('transaksi.delete')}}" method="POST" id="delete">
    @csrf
    @method('delete')
    <input type="hidden" name="id">
</form>

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
                            <th class="mw-6rem"></th>
                            <th>Tanggal</th>
                            <th>Subkegiatan</th>
                            <th>Ket.</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th class="mw-6rem"></th>
                            <th>Tanggal</th>
                            <th>Subkegiatan</th>
                            <th>Ket.</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
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
    
function hapus(self){
    var tr = $(self).closest('tr');
    var data=oTable.fnGetData(tr); 
    $('#delete').find('input[name=id]').val(data['id']);
    Swal.fire({
        customClass: {
            confirmButton: 'btn btn-primary mr-2',
            cancelButton: 'btn btn-dark'
        },
        buttonsStyling: false,
        icon: 'warning',
        iconColor: '#f4b619',
        title: 'Yakin ingin menghapus?',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#delete').submit();
        }
    })
}

function show(self){
    var tr = $(self).closest('tr');
    var row = oTable.api().row( tr );
    var data=oTable.fnGetData(tr);

    if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        // btn.removeClass('btn-danger');
        // btn.addClass('btn-success');
        // btn.html('<i class="material-icons">add</i>')
    }
    else {
        row.child( format(data)).show();
        // tr.addClass('shown'); 
        // btn.addClass('btn-danger');
        // btn.removeClass('btn-success');
        // btn.html('<i class="material-icons">remove</i>')
    }
}

function format(data){
    var str=`<tr><td colspan="8" style="bacground-color:#f9f9f9;">
        <div class="row">
        <div class="col-md-4" id="riwayat">
            <h6><b>Riwayat</b></h6>
            <ul class="list-unstyled">
            </ul>
        </div>
        </div>
    </td></tr>`;
    var $view=$(str);
    
    let max=data.riwayat.length;
    let riwayatstr='<li>Request&nbsp'+data.tipe+
        '<p>'+data.tanggalref+'</p>'+
        (max===0?'':'<hr>')+
        '</li>';
    data.riwayat.forEach(function(e,i){
        let msg='';
        switch (i) {
            case 0:
                msg='PPD disetujui';
                break;
            case 1:
                msg='SOPD disetujui';
                break;
            case 2:
                msg='SPD disetujui';
                break;
        }
        riwayatstr+='<li>'+msg+
            '<button class="btn btn-sm btn-primary float-right">Print</button>'+
            '<p>'+e[0]+'</p>'+
            (max-1===i?'':'<hr>')+
            '</li>';
    });
    $view.find('#riwayat ul').append(riwayatstr);
    return $view;
    return $view.prop("outerHTML");
}

$(document).ready(function(){
    oTable = $("#transaksitable").dataTable({
        processing: true,
        serverSide: true,
        ajax: {url: '{{route("transaksi.data")}}'},
        columns: [
            { data:'DT_RowIndex', orderable: false, searchable: false, width: '46px' },
            { data:'tipe', orderable: false,  width: '4rem'},
            { data:'tanggalref'},
            { data:'subkegiatan.nama'},
            { data:'keterangan', orderable: false},
            { data:'jenis'},
            { data:'jumlah'},
            { data:'action', orderable: false, searchable: false, className: "text-right", width: '4rem'},
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
        // {
        //     column_number: 2,
        //     filter_default_label: 'Status',
        //     filter_type: "select",
        //     style_class:'c-filter-1',
        //     reset_button_style_class:'c-filter-btn-1 btn btn-sm btn-warning',
        //     data:[
        //         {value:'0',label:'Belum'},
        //         {value:'1',label:'PPD acc'},
        //         {value:'2',label:'SOPD acc'},
        //         {value:'3',label:'SPD acc'},
        //     ]
        // },
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