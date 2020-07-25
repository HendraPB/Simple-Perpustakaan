@extends('layout')

@section('custom_content_header')
<h1>Daftar Buku</h1>
@stop

@section('custom_content')
<div id="app">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" @click="preventSubmit">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Isi data berikut untuk meminjam buku</h4>
                </div>
                <form ref="form" @submit="submit">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal Pinjam *</label>
                            <vuejs-datepicker :language="idn" :value="start" format="d MMMM yyyy" :required="true" @input="start=formatDate($event)"></vuejs-datepicker>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kembali *</label>
                            <vuejs-datepicker :language="idn" :value="end" format="d MMMM yyyy" :required="true" @input="end=formatDate($event)"></vuejs-datepicker>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#myModal" rel="modal:close">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        </a>
                        <button type="submit" class="btn btn-primary">Pinjam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
            tableUrl: "{{ URL::to('adminAPI/book') }}",
            columns: [{
                    data: 'id',
                    title: 'No',
                    width: 1,
                    className: 'id'
                },
                {
                    data: 'code',
                    title: 'Kode'
                },
                {
                    data: 'title',
                    title: 'Judul'
                },
                {
                    data: 'publication',
                    title: 'Tahun Terbit'
                },
                {
                    data: 'author',
                    title: 'Penulis'
                },
                {
                    data: 'stock',
                    title: 'Stok'
                },
                {
                    title: 'Action',
                    className: 'action dt-body-center',
                    width: '20%',
                    defaultContent: '<div class="manage-button"><button class="btn btn-primary">Ajukan Peminjaman</button></div>'
                }
            ],
            book_id: '',
            start: '',
            end: ''
        },
        mounted: function () {
            this.getDataTable()
            this.initButton()
            this.initModal()
        },
        methods: {
            initButton: function () {
                $('#dataTable tbody').on('click', 'button', function () {
                    var data = app.dataTable.row($(this).parents('tr')).data()
                    app.action(data)
                })
            },
            initModal: function () {
                $(document).on('hide.bs.modal', '#myModal', function () {
                    app.book_id = app.start = app.end = ''
                })
            },
            submit: function (data) {
                if(this.start > this.end) {
                    Toast.fire({
                        type: 'error',
                        title: 'Tanggal kembali tidak boleh melebihi tanggal pinjam'
                    })
                } else {
                    ajax({
                        method: 'POST',
                        url: 'rent',
                        data: {
                            user_id: "{{ Auth::user()->id }}",
                            book_id: this.book_id,
                            status_id: 1,
                            start: this.start,
                            end: this.end
                        }
                    }).then(function (response) {
                        $('.modal-footer .btn-default').trigger('click')
                        app.reDrawTable()
                        Toast.fire({
                            type: response.data.type,
                            title: response.data.title
                        })
                    }).catch(function (error) {
                        console.log(error)
                    })
                }
            },
            action: function (data) {
                this.book_id = data.id
                $('#myModal').modal('show');
            }
        }
    })

</script>
@stop
