@extends('layouts.konsumen')
@section('css')

@endsection

@section('content')
      <section class="content-header">
        <br/>
        <br/>
        <ol class="breadcrumb">
          <li><a href="{{ route('home_konsumen') }}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Form Pemesanan Barang</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        @if(\Session::has('msg_tambah_pesanan'))
           <h5> <div class="alert alert-success">
              {{ \Session::get('msg_tambah_pesanan')}}
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
                    <h3 class="box-title">Keranjang Pemesanan</h3>
                    <div class="box-tools pull-right">
                            <a href="{{ route('home_konsumen') }}"><button type="submit" class="btn btn-warning btn-xs" onclick="return confirm('Apakah anda yakin ingin membatalkan Pemesanan ?')"><i class="fa fa-close"></i> Kembali</button></a>
                    </div>
                </div>
              <div class="box-body table-responsive">
                <table class="table table-striped" id="data-detail">
                  <thead>
                    <tr>
                      <th style="display: none;">ID Detail</th>
                      <th style="display: none;">ID Produk</th>
                      <th>Nama Produk</th>
                      <th>Jumlah</th>
                      <th style="display: none;" >ID Konsumen</th>
                      <th>Sub Total</th>
                      <th width="100">Aksi</th>
                    </tr>
                  </thead>
                    <tbody>
                        @foreach($keranjang as $key => $value)
                          <tr>
                            <td style="display: none;">{{ $value->keranjang_id }}</td>
                            <td style="display: none;">{{ $value->barang_id }}</td>
                            <td>{{ $value->nama_barang }}</td>
                            <td>{{ $value->jumlah_beli }}</td>
                            <td style="display: none;">{{ $value->id }}</td>
                            <td>{{ $value->harga }}</td>
                            <td width="100">
                              <a href="{{ route('hapus_pesanan',$value->keranjang_id) }}"><button class="btn btn-xs btn-danger" onclick="return confirm('apakah anda ingin menghapus data ini ?')"> &nbsp; &nbsp;<i class="fa fa-trash"> &nbsp; &nbsp;</i> Hapus</button></a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
              
          </div>
        </div>
        <div class="row">
          <div class="col-xs-7">
              <div class="box box-danger">
                  <div class="box-header">
                    <h3 class="box-title">Tambah Produk</h3>
                  
                  </div>
              <div class="box-body">
                <table class="table table-bordered table-striped" id="data-produk">
                <thead>
                  <tr>
                    <th style="display: none;">ID Barang</th>
                    <th width="100">Foto</th>
                    <th>Produk</th>
                    <th>Harga </th>
                    <th>Stok</th>
                    <th>Kondisi</th>
                    <th width="65">Aksi</th>
                  </tr>
                </thead>
                  <tbody>
                  @foreach($barang as $key => $value)
                        <tr>
                          <td style="display: none;">{{ $value->barang_id }}</td>
                          <td><img width="100px" src="{{ asset('uploads/'.$value->foto_barang) }}"></td>
                          <td>{{ $value->nama_barang }}</td>
                          <td>{{ $value->harga_barang }}</td>
                          <td>{{ $value->stok_barang }}</td>
                          <td>{{ $value->kondisi_barang }}</td>
                          <td>
                            <button class="btn btn-success btn-tambah-produk"> &nbsp; <i class="fa fa-plus"> &nbsp;</i></button>
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
                
                    <div style="display: none">{{ $sub_ttl = 0 }}</div>
                    @foreach($keranjang as $key => $value)
                   <div style="display: none">{{ $sub_ttl += $value->harga }}</div>
                    @endforeach
                    
                 <h4>Total Pembayaran : 
                    <div class="pull-right">
                        <b>Rp.{{ number_format($sub_ttl,0,',','.') }}</b>
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
                <form action="{{ route('buat_pesanan') }}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group has-feedback">
                      <input type="hidden" name="total_bayar" value="{{ $sub_ttl }}" class="form-control" readonly>
                      <input type="hidden" name="id_user" value="{{ $id }}" class="form-control" readonly>
                      @foreach($keranjang as $key => $value)
                      <input type="hidden" name="keranjang_id[]" value="{{ $value->keranjang_id }}" class="form-control" readonly> 
                      @endforeach
                    </div>
                    <div class="form-group has-feedback">
                      <label>Tanggal Pengerjaan :</label>
                      <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                    </div>
                    <div class="form-group has-feedback">
                      <label>Full Booking :</label>
                      <b style="color:red;" id="full"> </b> &nbsp;
                    </div>
                    <div class="form-group has-feedback">
                      <label>Jam :</label>
                      <select name="jam" class="form-control" id="jam" required>
                        <option value="">Pilih Jam</option>
                        <option value="07:00">07:00</option>
                        <option value="08:00">08:00</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                        <option value="17:00">17:00</option>
                      </select>
                    </div>
                    <div class="form-group has-feedback">
                      <label>Catatan :</label>
                      <textarea name="catatan" class="form-control" cols="5" rows="3" placeholder="Tidak Wajib" required></textarea>
                    </div>
                    <div class="form-group has-feedback">
                    <label>Bukti Bayar</label>
                      <input type="file" name="bukti_bayar" id="bukti" class="form-control" required>
                    </div>
                     <div class="row">
                      <div class="col-xs-4 col-xs-offset-8">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Pesan</button>
                      </div>
                      </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    <div class="modal fade" id="modal-tambah-detail" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Pemesanan</h4>
          </div>
          <div class="modal-body">
            <form action="{{ route('tambah_produk') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="hidden" name="barang_id" class="form-control" readonly>
                <input type="hidden" name="harga_barang" class="form-control" readonly>
                <input type="hidden" name="id_user" value="{{ $id }}" class="form-control" readonly> 
            </div>
            <div class="form-group has-feedback">
              <label>Nama Produk</label>
              <input type="text" name="nama_barang" class="form-control" readonly>
            </div>
            <div class="form-group has-feedback">
              <label>Stok</label>
              <input type="text" name="stok" class="form-control" readonly>
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
<script>
  $(function(){
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
      $('#tanggal').on('change', function(){
          $.ajax({
            url: '{{ route('cek_jam') }}',
            method: 'POST',
            data: {tanggal: $(this).val()},
            success: function (response) {
            $('#full').empty()
            
                $.each(response, function (jam_transaksi, jam_transaksi) {
                    $('#full').append(jam_transaksi + ", ")
                })
            }
        })
      });
  });
</script>
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

  $('#data-produk').on('click','.btn-tambah-produk',function(){
    row = produk.row( $(this).closest('tr') ).data();
    console.log(row);
    $('input[name=barang_id]').val(row[0]);
    $('input[name=nama_barang]').val(row[2]);
    $('input[name=harga_barang]').val(row[3]);
    $('input[name=jumlah]').val('');
    $('input[name=stok]').val(row[4]);
    $('#modal-tambah-detail').modal('show');
  });
</script>
@endsection
