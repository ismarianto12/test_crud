@section('title','Table Master Harga')
@extends('template')
@section('content')
<script src="{{ asset('template') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('template') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <!-- /.card-header -->
            <script>
                $(function(){
                    $('.alert').fadeOut(300);
                    $('#example2').on('click', '.edit', function() {
                        var access = $(this).attr('to');
                        $('.show_form').load(access).slideDown();
                    });

                    $('#example2').on('click', '.delete', function() {
                        var id = $(this).attr('id');
                        $('#judul').html('Menghapus data menyebab kan data tidak kembali lagi selamanya seperti mantan ? apakah anda yakin ?');
                        $('#cetak_data').html('<button id='+id+' class="delete btn btn-danger btn-sm"><i class="fa fa-print"></i> Hapus Data konsumen ? </button>');
                        $('#confirm').modal('show');
                    })
                    $('#confirm').on('click','.delete', function() {
                        var id = $(this).attr('id');
                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            url: '{{ Url('konsumen/destroy') }}',
                            success:function(data){
                                alert('data berhasil di hapus');
                                $('#example2').DataTable().ajax.reload();
                                $('#confirm').modal('hide');
                            },error(error,xhr,status){
                                alert('warning');
                            }
                        });
                    });
                });
            </script>
            <div class="card-body">
                <button id="load_form" class="btn btn-info" load="<?= route('konsumen.create') ?>"><i
                        class="icon fa fa-add"></i>Tambah </button>
                <br />
                <div class="show_form"></div>
                <hr />

                <div id="form_result"></div>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Harga</th>
                            <th>Waktu / Jam</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
                        url: "{{ Url('harga/api/data') }}",
                    },
                    columns: [
                    {
                        data: 'DT_RowIndex',
                    },
                    {
                        data : 'harganm',
                    },
                    {
                        data : 'waktu',
                    },
                    {
                        data : 'login.nama',
                    },
                    {
                        data : 'action',
                        orderable :false,
                    }
                    ],
                    'responsive' : true,

                });

                // $('.print_action').click(function(){
                    //     var id = $(this).attr('id');
                    //     $.ajax({
                        //         url : '{{ Url('notulen/print') }}',
                        //         data: 'id='+id+'&_csrf='+'{{ csrf_token() }}',
                        //         type: 'post',
                        //         success:function(data){
                            //             //      alert('success');
                            //         },error(error,xhr,status){
                                //             alert('warning');
                                //         }
                                //     });
                                // });

                                $('#load_form').on('click',function(){
                                    $('.show_form').load($(this).attr('load')).slideDown();
                                });

                            })
    </script>
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                    <div id="judul"></div>
                    <hr />
                    <div id="cetak_data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endsection
