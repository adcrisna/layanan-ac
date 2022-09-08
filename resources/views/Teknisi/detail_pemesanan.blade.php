@extends('layouts.teknisi')
@section('css')

@endsection

@section('content')
      <section class="content-header">
        <br/>
        <br/>
        <ol class="breadcrumb">
          <li><a href="{{ route('home_teknisi') }}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Form Detail</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        @if(\Session::has('msg_success'))
           <h5> <div class="alert alert-success">
              {{ \Session::get('msg_success')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_edit_detail'))
           <h5> <div class="alert alert-warning">
              {{ \Session::get('msg_edit_detail')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_tambah_gagal'))
           <h5> <div class="alert alert-danger">
              {{ \Session::get('msg_tambah_gagal')}}
            </div></h5>
            @endif
             @if(\Session::has('msg_hapus_pemesanan'))
           <h5> <div class="alert alert-danger">
              {{ \Session::get('msg_hapus_pemesanan')}}
            </div></h5>
            @endif
             @if(\Session::has('msg_gagal_pesan'))
           <h5> <div class="alert alert-danger">
              {{ \Session::get('msg_gagal_pesan')}}
            </div></h5>
            @endif
             @if(\Session::has('msg_stok_kurang'))
              <h5> <div class="alert alert-warning">
              {{ \Session::get('msg_stok_kurang')}}
              </div></h5>
            @endif
              <div class="box box-danger">
                  <div class="box-header">
                    <h3 class="box-title">Detail Pemesanan</h3>
                    <div class="box-tools pull-right">
                            <a href="{{ route('data_pekerjaan') }}"><button type="submit" class="btn btn-warning btn-xs" ><i class="fa fa-close"></i> Kembali</button></a>
                    </div>
                </div>
              <div class="box-body table-responsive">
                <table class="table table-striped" id="data-detail">
                  <thead>
                    <tr>
                      <th style="display: none;">ID Detail</th>
                      <th style="display: none;">ID Jasa</th>
                      <th>Nama Jasa</th>
                      <th>Jumlah</th>
                      <th>No Pesanan</th>
                      <th>Sub Total</th>
                      <th width="100">Aksi</th>
                    </tr>
                  </thead>
                    <tbody>
                        @foreach($detail as $key => $value)
                          <tr>
                            <td style="display: none;">{{ $value->detail_transaksi_id }}</td>
                            <td style="display: none;">{{ $value->jasa_id }}</td>
                            <td>{{ $value->nama_jasa }}</td>
                            <td>{{ $value->jumlah }}</td>
                            <td >{{ $value->no_pesanan }}</td>
                            <td>{{ $value->sub_total }}</td>
                            <td width="100">
                              <a href="{{ route('hapus_layanan',$value->detail_transaksi_id) }}"><button class="btn btn-xs btn-danger" onclick="return confirm('apakah anda ingin menghapus data ini ?')"> &nbsp; &nbsp;<i class="fa fa-trash"> &nbsp; &nbsp;</i> Hapus</button></a>
                            </td>
                          </tr>
                        @endforeach
                        @foreach($detail_barang as $key => $value)
                          <tr>
                            <td style="display: none;">{{ $value->detail_transaksi_id }}</td>
                            <td style="display: none;">{{ $value->barang_id }}</td>
                            <td>{{ $value->nama_barang }}</td>
                            <td>{{ $value->jumlah }}</td>
                            <td >{{ $value->no_pesanan }}</td>
                            <td>{{ $value->sub_total }}</td>
                            <td width="100">
                            
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
              
          </div>
        </div>
        <div class="row">
          @if (empty($transaksi->total_bayar))
          <div class="col-xs-7">
              <div class="box box-danger">
                  <div class="box-header">
                    <h3 class="box-title">Tambah Jasa</h3>
                  
                  </div>
              <div class="box-body">
                <table class="table table-bordered table-striped" id="data-produk">
                <thead>
                  <tr>
                    <th style="display: none;">ID Jasa</th>
                    <th>Jasa</th>
                    <th>Harga </th>
                    <th>Kategori</th>
                    <th>Detail</th>
                    <th width="65">Aksi</th>
                  </tr>
                </thead>
                  <tbody>
                  @foreach($layanan as $key => $value)
                        <tr>
                          <td style="display: none;">{{ $value->jasa_id }}</td>
                          <td>{{ $value->nama_jasa }}</td>
                          <td>{{ $value->harga_jasa }}</td>
                          <td>{{ $value->nama_kategori }}</td>
                          <td>{{ $value->detail_jasa }}</td>
                          <td>
                            <button class="btn btn-success btn-tambah-jasa"> &nbsp; <i class="fa fa-plus"> &nbsp;</i></button>
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
              </table>
              </div>
            </div>
          </div>
         <div class="col-xs-5">
              <div class="box box-danger">
                  <div class="box-header">
                    <h3 class="box-title">Total Pembayaran</h3>
                  </div>
              <div class="box-body">
                
                    <div style="display: none">{{ $total = 0 }}</div>
                    @foreach($detail as $key => $value)
                   <div style="display: none">{{ $total += $value->sub_total }}</div>
                    @endforeach
                    
                 <h4>Total Pembayaran : 
                    <div class="pull-right">
                        <b>Rp.{{ number_format($total,0,',','.') }}</b>
                    </div>
                </h4>
                <h4>No. Rekening BRI (Alex) : 
                    <div class="pull-right">
                        <b>4124512494294</b>
                    </div>
                </h4>
                <div class="pull-right">
                 <b></b>
               </div></h4><br/>
                <form action="{{ route('simpan_pemesanan') }}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group has-feedback">
                      <input type="hidden" name="total_bayar" value="{{ $total }}" class="form-control" readonly>
                      <input type="hidden" name="transaksi_id" value="{{ $transaksi->transaksi_id }}" class="form-control" readonly>
                      <input type="hidden" name="no_pesanan" value="{{ $transaksi->no_pesanan }}" class="form-control" readonly>
                    </div>
                    <div class="form-group has-feedback">
                      <label>Tanggal Pengerjaan :</label>
                      <input type="text" class="form-control" name="tanggal" value="{{ $transaksi->tanggal_transaksi}}" readonly>
                    </div>
                    <div class="form-group has-feedback">
                      <label>Jam :</label>
                      <input type="text" class="form-control" name="jam" value="{{ $transaksi->jam_transaksi}}" readonly>
                    </div>
                    <div class="form-group has-feedback">
                      <label>Keluhan :</label>
                      <textarea name="catatan" class="form-control" cols="5" rows="3" readonly>{{ $transaksi->catatan}}</textarea>
                    </div>
                    <div class="form-group has-feedback">
                    <label>Bukti Bayar</label>
                      <input type="file" name="bukti_bayar" id="bukti" class="form-control" required>
                    </div>
                     <div class="row">
                      <div class="col-xs-4 col-xs-offset-8">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
                      </div>
                      </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        @else
        <div class="col-xs-7"></div>
        <div class="col-xs-5">
              <div class="box box-danger">
                  <div class="box-header">
                    <h3 class="box-title">Total Pembayaran</h3>
                  </div>
              <div class="box-body">
                    
                 <h4>Total Pembayaran : 
                    <div class="pull-right">
                        <b>Rp.{{ number_format($transaksi->total_bayar,0,',','.') }}</b>
                    </div>
                </h4>
                <div class="pull-right">
                 <b></b>
               </div></h4><br/>
                <form action="{{ route('simpan_pemesanan') }}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group has-feedback">
                      <input type="hidden" name="total_bayar" value="{{ $transaksi->total_bayar }}" class="form-control" readonly>
                      <input type="hidden" name="transaksi_id" value="{{ $transaksi->transaksi_id }}" class="form-control" readonly>
                      <input type="hidden" name="no_pesanan" value="{{ $transaksi->no_pesanan }}" class="form-control" readonly>
                    </div>
                    <div class="form-group has-feedback">
                      <label>Tanggal Pengerjaan :</label>
                      <input type="text" class="form-control" name="tanggal" value="{{ $transaksi->tanggal_transaksi}}" readonly>
                    </div>
                    <div class="form-group has-feedback">
                      <label>Jam :</label>
                      <input type="text" class="form-control" name="jam" value="{{ $transaksi->jam_transaksi}}" readonly>
                    </div>
                    <div class="form-group has-feedback">
                      <label>Keluhan :</label>
                      <textarea name="catatan" class="form-control" cols="5" rows="3" readonly>{{ $transaksi->catatan}}</textarea>
                    </div>
                    <div class="form-group has-feedback">
                    <label>Bukti Bayar : </label>
                    <img width="200px" height="150px" src="{{ asset('uploads/'.$transaksi->bukti_bayar) }}">
                    <input type="hidden" name="bukti_bayar" id="bukti" class="form-control">
                  </div>
                     <div class="row">
                      <div class="col-xs-4 col-xs-offset-8">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Selesai</button>
                      </div>
                      </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        @endif
      </section>
    <div class="modal fade" id="modal-tambah-detail" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Pemesanan</h4>
          </div>
          <div class="modal-body">
            <form action="{{ route('tambah_layanan') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="hidden" name="jasa_id" class="form-control" readonly>
                <input type="hidden" name="harga_jasa" class="form-control" readonly>
                <input type="hidden" name="no_pesanan" class="form-control" value="{{ $transaksi->no_pesanan}}" readonly>
            </div>
            <div class="form-group has-feedback">
              <label>Nama Produk</label>
              <input type="text" name="nama_jasa" class="form-control" readonly>
            </div>
            <div class="form-group has-feedback">
              <label>Jumlah</label>
              <input type="number" name="jumlah" class="form-control" required>
            </div>
            <div class="row">
              <div class="col-xs-4 col-xs-offset-8">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Tambah</button>
              </div>
            </div>
          </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
      <!-- /.content -->
 @endsection

@section('javascript')
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript">
   var detail = $('#data-detail').DataTable();

  $('#data-detail').on('click','.btn-ubah-detail',function(){
    row = detail.row( $(this).closest('tr') ).data();
    console.log(row);
    $('input[name=detail_transaksi_id]').val(row[0]);
    $('input[name=barang_id]').val(row[1]);
    $('input[name=id_user]').val(row[4]);
    $('input[name=jumlah]').val(row[3]);
    $('input[name=old_jumlah]').val(row[3]);
    $('input[name=sub_total]').val(row[5]);
    $('#modal-ubah-detail').modal('show');
  });

  var produk = $('#data-produk').DataTable();

  $('#data-produk').on('click','.btn-tambah-jasa',function(){
    row = produk.row( $(this).closest('tr') ).data();
    console.log(row);
    $('input[name=jasa_id]').val(row[0]);
    $('input[name=nama_jasa]').val(row[1]);
    $('input[name=harga_jasa]').val(row[2]);
    $('input[name=jumlah]').val('');
    $('#modal-tambah-detail').modal('show');
  });
</script>
@endsection
