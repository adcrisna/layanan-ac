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
        <div class="row">
          <div class="col-xs-3"></div>
         <div class="col-xs-6">
              <div class="box box-danger">
                  <div class="box-header">
                    <h3 class="box-title">Form Pemesanan Layanan</h3>
                  </div>
              <div class="box-body">
                <form action="{{ route('buat_layanan') }}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
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
                      <textarea name="catatan" class="form-control" cols="5" rows="3" placeholder="Tidak Wajib"></textarea>
                    </div>
                    <div class="form-group has-feedback">
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
      </div>
</section>
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
@endsection
