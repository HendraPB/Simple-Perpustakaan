@extends('layout')

@section('custom_content_header')
<h1>Peminjaman Buku</h1>
@stop

@section('custom_content')
<div id="app">
    <table id="dataTable" class="table-striped table-bordered" width="100%"></table>
</div>
@stop

@section('custom_footer')
@stop

@section('custom_css')
@stop

@section('custom_js')
<script>
    var app = new Vue({
        el: '#app',
        data: {
            tableUrl: "{{ URL::to('adminAPI/rent') }}",
            columns: [{
                    data: 'id',
                    title: 'No',
                    width: 1,
                    className: 'id'
                },
                {
                    data: 'book.code',
                    title: 'Kode'
                },
                {
                    data: 'book.title',
                    title: 'Judul'
                },
                {
                    data: 'book.stock',
                    title: 'Stok Buku'
                },
                {
                    data: 'user.name',
                    title: 'Peminjam'
                },
                {
                    data: 'start',
                    title: 'Tanggal Pinjam',
                    render: function (data) {
                        return app.displayDate(data)
                    }
                },
                {
                    data: 'end',
                    title: 'Tanggal Kembali',
                    render: function (data) {
                        return app.displayDate(data)
                    }
                },
                {
                    data: 'status.name',
                    title: 'Status'
                },
                {
                    data: 'status_id',
                    title: 'Action',
                    className: 'action dt-body-center',
                    width: '20%',
                    render: function (data) {
                        return '<div class="manage-button">' + (data == 1 ?
                                '<button id="2" class="btn btn-success">Setuju</button><button id="3" class="btn btn-danger">Tolak</button>' :
                                (data == 2 ?
                                    '<button id="4" class="btn btn-primary">Kembali</button>' : '')) +
                            '</div>'
                    }
                }
            ]
        },
        mounted: function () {
            this.getDataTable()
            this.initButton()
        },
        methods: {
            initButton: function () {
                $('#dataTable tbody').on('click', 'button', function () {
                    var data = app.dataTable.row($(this).parents('tr')).data()
                    app.action(data, this.id)
                })
            },
            action: function (data, status) {
                Swal.fire({
                    title: (status == 4 ? 'Yakin akan merubah status menjadi kembali?' :
                        'Yakin akan ' + (status == 2 ? 'menyetujui' : 'menolak') +
                        ' pengajuan peminjaman buku ini?'),
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.value) {
                        ajax({
                            method: 'PATCH',
                            url: 'rent/' + data.id,
                            data: {
                                book_id: data.book_id,
                                status_id: status,
                            }
                        }).then(function (response) {
                            app.reDrawTable()
                            Toast.fire({
                                type: response.data.type,
                                title: response.data.title
                            })
                        }).catch(function (error) {
                            console.log(error)
                        })
                    }
                })
            }
        }
    })

</script>
@stop
