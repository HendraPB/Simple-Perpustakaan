@extends('layout')

@section('custom_content_header')
<h1>Ganti Password</h1>
@stop

@section('custom_content')
<div id="app">
    <form>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Password Lama</label>
                    <input type="password" class="form-control" v-model="oldPassword">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" class="form-control" v-model="password">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" v-model="confPassword">
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary expand" @click="submit">
            Proses
        </button>
    </form>
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
            oldPassword: '',
            password: '',
            confPassword: ''
        },
        methods: {
            submit: function () {
                if (this.password == this.confPassword) {
                    ajax({
                        method: 'POST',
                        url: 'password',
                        data: {
                            oldPassword: this.oldPassword,
                            password: this.password
                        }
                    }).then(function (response) {
                        Toast.fire({
                            type: response.data.type,
                            title: response.data.title
                        })
                    }).catch(function (error) {
                        console.log(error)
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        title: 'Password baru tidak sama dengan konfirmasi password'
                    })
                }
            }
        }
    })

</script>
@stop
