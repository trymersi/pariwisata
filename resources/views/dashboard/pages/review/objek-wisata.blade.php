@extends('dashboard.layouts.app')

@section('content')
<div class="layout-px-spacing">

    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            
            <div class="widget-content widget-content-area br-6">
                <div class="widget-header">                                
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Tabel Data Review {{ $page_name }}</h4>
                            
                        </div>
                    </div>
                </div>
                <div class="table-responsive mb-4 mt-4">
                    <table id="tabel" class="tabel table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Objek Wisata</th>
                                <th>Nama Pengulas</th>
                                <th>Email Pengulas</th>
                                <th>Rating</th>
                                <th>Ulasan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th class="no-content"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal fade stick-up" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data ?</h5>
            </div>
            <div class="modal-body">
              <p class="no-margin">Apakah Anda Yakin Akan Menghapus Data Ulasan Data <mark class="text-danger NamaUserHapus">highlight</mark> ?</p>
            </div>
            <div class="modal-footer AksiHapus">
              
            </div>
          </div>
    </div>
</div>

@endsection


@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/dt-global_style.css')}}">
@endpush

@push('js')
<script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
<script>
    $(document).ready(function(){
        
           var tabel = $('.tabel').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 ,
           processing: true,
           serverSide: true,
           ajax: {
           url: "{{ url('dashboard/review/objek-wisata/table') }}",
           },
           columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
            {
                data: 'nama_objek',
                name: 'nama_objek'
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'rating',
                name: 'rating'
            },
            {
                data: 'ulasan',
                name: 'ulasan'
            },
            {
                data: 'tanggal',
                name: 'tanggal'
            },
            {
                data: 'status',
                name: 'status'
            },
            
           {
               data: 'option',
               name: 'option'
            }
           ],
           "initComplete": function(settings, json) {
                deleteData();
                status();
           },
           "drawCallback": function( settings ) {
            deleteData();
            status();
                }
           });

           function deleteData()
           {
                $('#ModalHapus').on('show.bs.modal', function(e) {
                    var id = $(e.relatedTarget).attr('data-id');
                    var nama = $(e.relatedTarget).attr('data-nama');
                    console.log(id);
                    $('.NamaUserHapus').html('');
                    $('.AksiHapus').html('');
                    $('.NamaUserHapus').html(nama);
                    $('.AksiHapus').html('<button type="button" class="btn btn-default btn-cons no-margin pull-left inline" data-dismiss="modal">Batal</button><button type="button" class="btn btn-danger btn-cons  pull-left inline TombolHapus" data-id="'+id+'" data-token="{{ csrf_token() }}" >Hapus</button>');
                    $('.TombolHapus').on('click',function(e)
                    {
                        var idDelete = $(this).attr('data-id');
                        var token = $(this).attr('data-token');
                        $.ajax({
                            url:"{{url('dashboard/review/objek-wisata/delete')}}/" + idDelete,
                            type: 'POST',
                            data: {_method: 'delete', _token :token},
                            success:function(get){
                            toastr.options = {
                                "positionClass": "toast-bottom-right",
                                }
                            if(get.status == '1')
                            {
                                toastr["success"]("Data  Berhasil Dihapus", "Sukses !!")
                            }
                            else
                            {
                                toastr["error"]("Terjadi Kesalahan Saat Menghapus Data", "Gagal !!")
                            }
                            $('#ModalHapus').modal('hide');
                            tabel.ajax.reload();
                            }

                        });
                    });
                });
           }

           function status()
            {
                $('.status-aktivkan').on('click',function()
                {
                    var id = $(this).data("id");
                    $.ajax({
                        url:"{{url('dashboard/review/objek-wisata/setaktiv')}}",
                        type: 'POST',
                        data: {_method: 'post', _token :'{{ csrf_token() }}', id :id},
                        success:function(get){
                            toastr.options = {
                                "positionClass": "toast-bottom-right",
                                }
                            toastr["success"]("Status Berhasil Diubah", "Sukses !!")
                            tabel.ajax.reload();
                        }
                    });
                })

                $('.status-nonaktivkan').on('click',function()
                {
                    var id = $(this).data("id");
                    $.ajax({
                        url:"{{url('dashboard/review/objek-wisata/setnonaktiv')}}",
                        type: 'POST',
                        data: {_method: 'post', _token :'{{ csrf_token() }}', id :id},
                        success:function(get){
                            toastr.options = {
                                "positionClass": "toast-bottom-right",
                                }
                            toastr["success"]("Status Berhasil Diubah", "Sukses !!")
                            tabel.ajax.reload();
                        }
                    });
                })
            }

            
           
       });

       
    </script>
@endpush
