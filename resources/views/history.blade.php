@extends('layout')

@section('custom_content_header')
<h1>Riwayat Peminjaman Buku</h1>
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
            tableUrl: "{{ URL::to('adminAPI/history') }}",
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
                }
            ]
        },
        mounted: function () {
            this.getDataTable()
        }
    })

</script>
@stop
