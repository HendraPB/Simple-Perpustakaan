@extends('adminlte::page')

@section('content_header')
@yield('custom_content_header')
@stop

@section('content')
@yield('custom_content')
@stop

@section('footer')
@yield('custom_footer')
@stop

@section('css')
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.0/dist/vue.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0/dist/vue.min.js"></script> -->

<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
@yield('custom_css')
@stop

@section('js')
<script>
    const ajax = axios.create({
        baseURL: "{{ URL::to('adminAPI') }}"
    });

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });

    Vue.component('v-select', VueSelect.VueSelect)
    Vue.component('date-picker', VueBootstrapDatetimePicker);
    $.extend(true, $.fn.datetimepicker.defaults, {
        icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'fas fa-calendar-check',
            clear: 'far fa-trash-alt',
            close: 'far fa-times-circle'
        }
    });

    Vue.mixin({
        data: function () {
            return {
                idn: vdp_translation_id.js,
                dataTable: null,
                tableUrl: null,
                getData: false,
                order: [
                    [0, "desc"]
                ],
                tableData: [],
                columns: [],
                columnDefs: [{
                    "targets": [0],
                    "searchable": false,
                    // "orderable": false,
                    "visible": true
                }],
                editorOption: {
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                            // ['blockquote', 'code-block'],
                            ['blockquote'],

                            [{
                                'header': 1
                            }, {
                                'header': 2
                            }], // custom button values
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            [{
                                'script': 'sub'
                            }, {
                                'script': 'super'
                            }], // superscript/subscript
                            [{
                                'indent': '-1'
                            }, {
                                'indent': '+1'
                            }], // outdent/indent
                            [{
                                'direction': 'rtl'
                            }], // text direction

                            [{
                                'size': ['small', false, 'large', 'huge']
                            }], // custom dropdown
                            [{
                                'header': [1, 2, 3, 4, 5, 6, false]
                            }],

                            [{
                                'color': []
                            }, {
                                'background': []
                            }], // dropdown with defaults from theme
                            [{
                                'font': []
                            }],
                            [{
                                'align': []
                            }],

                            ['clean'],

                            ['link', 'image', 'video']
                        ]
                    }
                },
                content: null,
                DateTimePickeroptions: {
                    format: 'YYYY/MM/DD HH:mm:ss',
                    useCurrent: false,
                    showClear: true,
                    showClose: true,
                },
                DatePickeroptions: {
                    format: 'YYYY-MM-DD',
                    useCurrent: false,
                    showClear: true,
                    showClose: true,
                },
                TimePickeroptions: {
                    format: 'HH:mm',
                    useCurrent: false,
                    showClear: true,
                    showClose: true,
                }
            }
        },
        components: {
            vuejsDatepicker,
            LocalQuillEditor: VueQuillEditor.quillEditor,
        },
        mounted: function () {
            $('.vdp-datepicker input').removeAttr('readonly').addClass('readonly')

            $('.readonly').on('keydown paste', function (e) {
                e.preventDefault()
            });
        },
        methods: {
            getContent: function (url) {
                ajax({
                    method: 'GET',
                    url: url
                }).then(function (response) {
                    app.content = response.data.data
                }).catch(function (error) {
                    console.log(error)
                })
            },
            getDataTable: function () {
                this.dataTable = $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: this.tableUrl,
                    columns: this.columns,
                    columnDefs: this.columnDefs,
                    scrollX: true,
                    order: this.order,
                    initComplete: function (settings, json) {
                        if (app.getData)
                            app.tableData = json.data
                    },
                    fnRowCallback: function (nRow, aData, iDisplayIndex) {
                        $("td:nth-child(1)", nRow).html(app.dataTable.page.info().start +
                            iDisplayIndex + 1);
                        return nRow;
                    },
                })
            },
            reDrawTable: function (params) {
                this.dataTable.ajax.reload()
            },
            preventSubmit() {
                this.$refs.form.addEventListener('submit', event => {
                    event.preventDefault()
                })
            },
            formatDate: function (event) {
                return moment(event).format('YYYY-MM-DD')
            },
            displayDate: function (event) {
                return moment(event).format('D/MMM/YYYY')
            },
            displayTime: function (event) {
                return moment(event, "HH:mm:ss").format('HH:mm')
            },
            displayUpdateAt: function (event) {
                return moment(event).format('YYYY/MM/DD HH:mm:ss')
            }
        }
    })

</script>
@yield('custom_js')
@stop
