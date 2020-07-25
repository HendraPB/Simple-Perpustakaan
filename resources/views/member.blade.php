@extends('layout')

@section('custom_content_header')
<h1>Kelola Anggota</h1>
@stop

@section('custom_content')
<div id="app">
    <button type="button" class="btn btn-primary expand" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus" aria-hidden="true"></i>Tambah Anggota
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
                            <label>Nama *</label>
                            <input type="text" class="form-control" required v-model="name">
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" class="form-control" required v-model="email">
                        </div>
                    </div>
                    <div class="modal-body" v-if="modalTitle == 'Tambah'">
                        <div class="form-group">
                            <label>Password *</label>
                            <input type="text" class="form-control" required v-model="password">
                        </div>
                    </div>
                    <div class="modal-body" v-else>
                        <div class="form-group">
                            <label>Password (biarkan kosong jika tidak ingin diubah)</label>
                            <input type="text" class="form-control" v-model="password">
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
            tableUrl: "{{ URL::to('adminAPI/member') }}",
            columns: [{
                    data: 'id',
                    title: 'No',
                    width: 1,
                    className: 'id'
                },
                {
                    data: 'name',
                    title: 'Nama'
                },
                {
                    data: 'email',
                    title: 'Email'
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
            name: '',
            email: '',
            password: '',
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
                    app.editId = app.name = app.email = app.password = ''
                })
            },
            submit: function () {
                ajax({
                    method: !this.editId ? 'POST' : 'PATCH',
                    url: !this.editId ? 'user' : 'user/' + this.editId,
                    data: {
                        name: this.name,
                        email: this.email,
                        role_id: 2,
                        password: this.password
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
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if (result.value) {
                        ajax({
                            method: 'DELETE',
                            url: 'user/' + data.id
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
                this.name = data.name
                this.email = data.email
                this.password = data.password
                $('.expand').trigger('click')
            }
        }
    })

</script>
@stop
