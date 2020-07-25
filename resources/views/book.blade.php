@extends('layout')

@section('custom_content_header')
<h1>Kelola Buku</h1>
@stop

@section('custom_content')
<div id="app">
    <button type="button" class="btn btn-primary expand" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus" aria-hidden="true"></i>Tambah Buku
    </button>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" @click="preventSubmit">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">@{{ modalTitle }}</h4>
                </div>
                <form ref="form" @submit="submit">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" class="form-control" required v-model="code">
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" required v-model="title">
                        </div>
                        <div class="form-group">
                            <label>Tahun Terbit</label>
                            <input type="text" class="form-control" required v-model="publication">
                        </div>
                        <div class="form-group">
                            <label>Penulis</label>
                            <input type="text" class="form-control" required v-model="author">
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="text" class="form-control" required v-model="stock">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#myModal" rel="modal:close">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
                    data: 'updated_at',
                    title: 'Terakhir Update',
                    width: '20%',
                    render: function (data) {
                        return app.displayUpdateAt(data)
                    }
                },
                {
                    title: 'Action',
                    className: 'action dt-body-center',
                    width: '20%',
                    defaultContent: '<div class="manage-button"><button id="edit" class="btn btn-primary">Rubah</button><button id="delete" class="btn btn-danger">Hapus</button></div>'
                }
            ],
            modalTitle: 'Tambah',
            editId: null,
            code: '',
            title: '',
            publication: '',
            author: '',
            stock: '',
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
                    if (this.id == 'delete')
                        app.delete(data)
                    else
                        app.edit(data)
                })
            },
            initModal: function () {
                $(document).on('hide.bs.modal', '#myModal', function () {
                    app.modalTitle = 'Tambah'
                    app.editId = app.code = app.title = app.publication = app.author = app.stock = ''
                })
            },
            submit: function () {
                ajax({
                    method: !this.editId ? 'POST' : 'PATCH',
                    url: !this.editId ? 'book' : 'book/' + this.editId,
                    data: {
                        code: this.code,
                        title: this.title,
                        publication: this.publication,
                        author: this.author,
                        stock: this.stock
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
            },
            delete: function (data) {
                Swal.fire({
                    title: 'Yakin akan dihapus?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.value) {
                        ajax({
                            method: 'DELETE',
                            url: 'book/' + data.id
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
            },
            edit: function (data) {
                this.modalTitle = 'Rubah'
                this.editId = data.id
                this.code = data.code
                this.title = data.title
                this.publication = data.publication
                this.author = data.author
                this.stock = data.stock
                $('.expand').trigger('click')
            }
        }
    })

</script>
@stop
