<div class="modal modal-danger fade" tabindex="-1" role="dialog" aria-labelledby="Laporan Fungsional" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Laporan Fungsional</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('fungsional.excel')}}" method="GET">
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Otorisator</b></label>
                    <select class="form-control" name="idotorisator" required >
                        @foreach($otorisator as $orang)
                        <option value="{{$orang->id}}">{{$orang->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label><b>Bendahara</b></label>
                    <select class="form-control" name="idbendahara" required >
                        @foreach($bendahara as $orang)
                        <option value="{{$orang->id}}">{{$orang->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label><b>Bulan</b></label>
                            <select class="form-control" name="bulan" required >
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label><b>Tahun</b></label>
                            <select class="form-control" name="tahun" required >
                                @php $year=intval(date("Y")); @endphp
                                @for($i=$year; $i>=2022; $i--)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Unduh</button>
            </div>
            </form>
        </div>
    </div>
</div>