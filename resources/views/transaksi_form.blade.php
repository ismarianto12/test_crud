<br /><br /><br />
<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">{{ ucfirst($params) }}</h3>
    </div>
    <form class="form-horizontal" method="post" id="simpan" action="{{ $action }}">
        @csrf
        {{ $method }}
        <div class="card-body">
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Konsumen</label>
                <div class="col-sm-10">
                    <input type="text" name="konsumen" class="konsumen form-control" id="inputPassword3"
                        value="{{ $konsumen_id }}" placeholder="Nama Divisi">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Nomor Polisi</label>
                <div class="col-sm-10">
                    <input type="text" name="jkendaraan" class="form-control" id="inputPassword3"
                        value="{{ $nomor_polisi }}" placeholder="Nomor Polisi">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Jam masuk kendaraan</label>
                <div class="col-sm-10">
                    <input type="text" name="masuk" class="form-control" id="inputPassword3" value="{{ $masuk }}"
                        placeholder="Nama Divisi">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Jam Keluar Kendaraan</label>
                <div class="col-sm-10">
                    <input type="text" name="keluar" class="form-control" id="inputPassword3" value="{{ $keluar }}"
                        placeholder="jam keluar kendaraan">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Jumlah Biaya</label>
                <div class="col-sm-10">
                    <input type="text" name="biaya" class="form-control" id="inputPassword3" value="{{ $biaya }}"
                        placeholder="Jumlah Biaya ... ">
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" id="simpan" class="btn btn-info">Simpan</button>
    </form>
    <button type="reset" id="cancel" class="btn btn-default float-right">Cancel</button>
</div>
</div>
<script>
    $(function() {
        $('#cancel').on('click', function() {
            $('.show_form').hide().slideUp().fast();
            $('#dtable').DataTable().ajax.reload();
        });
        $('#simpan').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: formData,
                headers: {
                    '_csrf': '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(data) {
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        } else if (data.success) {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            //$('#sample_form')[0].reset();
                            $('#dtable').DataTable().ajax.reload();
                            $('.show_form').hide().slideUp();
                        }
                        $('#form_result').html(html);
                    },
                    error: function(xhr, error, status) {
                        // swal('warning', 'Batal ', 'error');
                        alert(error)
                    }
                });

            });
        });



//ss
    $(function() {
        $('.konsumen').on('click',function(){
                $('#konsummen_modal').modal('show');
            });
        });
</script>


{{-- modal --}}

<div class="modal fade" id="konsummen_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-check"></i> Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Data Konsumen</h3>
                <hr />
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Polisi </th>
                            <th> Nama konsumen</th>
                            <th>Tgl Transaksi</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Biaya</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



{{-- javascript data --}}
<script>
    $(function(){
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };
        $('#example2').DataTable({
            initComplete: function() {
                var api = this.api();
                $('#datatables input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'

            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ Url('konsumen/api/data') }}",
            },
            columns: [
            {
                data: 'DT_RowIndex',
            },
            {
                data : 'konsumen',
            },
            {
                data : 'jkendaraan',
            },
            {
                data : 'n_polisi',
            },
            {
                data : 'tgl_lahir',
            },
            {
                data: "no_hp",
            },
            {
                data : 'jk',
                orderable :false,
                render: function (data, type, row) {
                    if (data == "L") {
                        return '<span class="btn btn-success btn-sm"><i class="fa fa-check"></i>Laki Laki</span>';
                    }else
                    if (data == "P") {
                        return '<span class="btn btn-warning btn-sm">Perempuan</span>';
                    }
                }
            },
            {
                data : 'action',
                orderable :false,
            }
            ],
            'responsive' : true,

        });


    })
</script>
