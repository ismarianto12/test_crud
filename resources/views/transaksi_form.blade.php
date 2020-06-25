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
                    <input type="text" name="konsumen" class="form-control" id="inputPassword3"
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
                <label for="inputPassword3" class="col-sm-2 col-form-label">Nomor Polisi</label>
                <div class="col-sm-10">
                    <input type="text" name="n_polisi" class="form-control" id="inputPassword3"
                        value="{{ $n_polisi }}" placeholder="Nama Divisi">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Tlg Lahir</label>
                <div class="col-sm-10">
                    <input type="text" name="tgl_lahir" class="form-control" id="inputPassword3"
                        value="{{ $tgl_lahir }}" placeholder="Nama Divisi">
                </div>
            </div>
        </div>
         <div class="card-body">
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">jenis Kelamin</label>
                <div class="col-sm-10">
                   <select name="jk" class="form-control">
                    <option value="L">laki-laki</option>
                    <option value="L">Perempuan</option>
                </select>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Nomor Hp</label>
                <div class="col-sm-10">
                    <input type="text" name="no_hp" class="form-control" id="inputPassword3"
                        value="{{ $no_hp }}" placeholder="Nama Divisi">
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
            })
        })
</script>
