@extends('admin.layout.base')
@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row ">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-primary text-white-all">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="#"><i class=""></i> Quản lý sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas"></i> Danh sách sản phẩm</li>
                    </ol>
                </nav>
                <div class="card">
                    <div class="card-header">
                        <div class="group_action float-right">
                            <a href="#add_modal" class="btn btn-info" data-toggle="modal"  target=""><i class="fa fa-plus"></i>&#32;Tạo mới</a>
                        </div>
                    </div>
                    <div class="card-body">             
                        <div class="table-responsive">
                            <table class="table table-striped" id="table_model">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Tên</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Chuyên mục</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Tùy chọn</th>
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
    </section>
</div>
<!-- add form -->
<div class="modal fade in" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="add_error"></div>
                <form action="" method="post" id="form_add" action="javascript:void(0)" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thông tin sản phẩm</h4>
                            <div class="card-header-action">
                                <a data-collapse="#collapse_product_infor" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="collapse_product_infor">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Ảnh hiển thị</label> (<span class="text-danger">*</span>)
                                    <div class="input-group mb-1">
                                        <img id="image_add" style="max-width: 100px; max-height: 100px">
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="lfm_add" data-input="image_path" data-preview="image_add">
                                        <label class="custom-file-label" for="customFile"></label>
                                    </div>
                                    <input id="image_path" class="form-control" name="image" value="" type="hidden">
                                </div>
                                <div class="form-group">
                                    <label>Tên sản phẩm</label> (<span class="text-danger">*</span>)
                                    <input type="text" class="form-control" name="name" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Mã sản phẩm</label> (<span class="text-danger">*</span>)
                                    <input type="text" class="form-control" name="sku_code" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Chuyên mục</label> (<span class="text-danger">*</span>)
                                    <select class="form-control" name="category_id">
                                        <option value="">-- Chọn chuyên mục --</option>
                                        @if (!empty($categories)) @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#add_tab_intro" role="tab" aria-controls="home" aria-selected="false">Giới thiệu</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#add_tab_detail" role="tab" aria-controls="profile" aria-selected="true">Chi tiết</a>
                                        </li>
                                      </ul>
                                      <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade active show" id="add_tab_intro" role="tabpanel" aria-labelledby="home-tab">
                                              <textarea class="form-control" name="introduction" id="add_intro"></textarea>
                                        </div>
                                        <div class="tab-pane fade" id="add_tab_detail" role="tabpanel" aria-labelledby="profile-tab">
                                              <textarea class="form-control" id="add_detail" name="details"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-label">Trạng thái</div>
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="status" class="custom-switch-input" checked>
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Chi tiết sản phẩm</h4>
                            <div class="card-header-action">
                                <a data-collapse="#collapse_product_details" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="collapse_product_details">
                            <div class="card-body">
                                <div id="add_product_details"></div>
                                <button class="btn btn-success mb-2 float-right add">Thêm chi tiết sản phẩm</button>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="btn_add_data">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit form -->
<div class="modal fade in" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="edit_error"></div>
                <form action="" method="post" id="form_edit" action="javascript:void(0)" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thông tin sản phẩm</h4>
                            <div class="card-header-action">
                                <a data-collapse="#edit_collapse_product_infor" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="edit_collapse_product_infor">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Ảnh hiển thị</label> (<span class="text-danger">*</span>)
                                    <div class="input-group mb-1">
                                        <img id="edit_image_holder" style="max-width: 100px; max-height: 100px">
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="lfm_edit" data-input="edit_image_path" data-preview="edit_image_holder">
                                        <label class="custom-file-label" for="customFile"></label>
                                    </div>
                                    <input id="edit_image_path" class="form-control" name="image" value="" type="hidden">
                                </div>
                                <div class="form-group">
                                    <label>Tên sản phẩm</label> (<span class="text-danger">*</span>)
                                    <input type="text" class="form-control" name="name" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Mã sản phẩm</label> (<span class="text-danger">*</span>)
                                    <input type="text" class="form-control" name="sku_code" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Chuyên mục</label> (<span class="text-danger">*</span>)
                                    <select class="form-control" name="category_id">
                                        <option value="">-- Chọn chuyên mục --</option>
                                        @if (!empty($categories)) @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#edit_tab_intro" role="tab" aria-controls="home" aria-selected="false">Giới thiệu</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#edit_tab_detail" role="tab" aria-controls="profile" aria-selected="true">Chi tiết</a>
                                        </li>
                                      </ul>
                                      <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade active show" id="edit_tab_intro" role="tabpanel" aria-labelledby="home-tab">
                                              <textarea class="form-control" name="introduction" id="edit_intro"></textarea>
                                        </div>
                                        <div class="tab-pane fade" id="edit_tab_detail" role="tabpanel" aria-labelledby="profile-tab">
                                              <textarea class="form-control" id="edit_detail" name="details"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-label">Trạng thái</div>
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="status" class="custom-switch-input" checked>
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Chi tiết sản phẩm</h4>
                            <div class="card-header-action">
                                <a data-collapse="#edit_collapse_product_details" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="edit_collapse_product_details">
                            <div class="card-body">
                                <div id="edit_product_details"></div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="btn-group">
                        <input type="hidden" class="form-control" name="id" id="id_edit">
                        <button type="button" class="btn btn-primary" id="btn_edit_data">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit form -->
@endsection

@section('scripts')

<script>
    var domain = "/admin/FileManager";
    function setRepeatField() {
        $("#add_product_details").repeatable({
            max: 5,
            min: 1,
            template: "#product-detail",
            afterAdd: function(addedItem) {
                addedItem.find('.lfm_pro_detail').filemanager('image', { prefix: domain });
                //date picker
                $('.daterange-cus').daterangepicker({
                    autoApply: true,
                    autoUpdateInput: false,
                    minDate: moment(),
                    drops: 'down',
                    opens: 'right',
                    "locale": {
                        "format": "DD/MM/YYYY",
                        "daysOfWeek": [
                            "CN",
                            "T2",
                            "T3",
                            "T4",
                            "T5",
                            "T6",
                            "T7"
                        ],
                        "monthNames": [
                            "Tháng 1,", "Tháng 2,", "Tháng 3,", "Tháng 4,", "Tháng 5,", "Tháng 6,", "Tháng 7,", "Tháng 8,", "Tháng 9,", "Tháng 10,", "Tháng 11,", "Tháng 12,"
                        ],
                    }
                });
                $('.daterange-cus').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
                });
                $('.daterange-cus').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
                //reload collapse
                $("[data-collapse]").each(function() {
                    var me = $(this),
                    target = me.data("collapse");
                    me.click(function() {
                        $(target).collapse("toggle");
                        $(target).on("shown.bs.collapse", function() {
                            me.html('<i class="fas fa-minus"></i>');
                        });
                        $(target).on("hidden.bs.collapse", function() {
                            me.html('<i class="fas fa-plus"></i>');
                        });
                        return false;
                    });
                });
                $('#add_product_details .field-group:not(:last-child) .collapse').collapse("hide");
                $('#add_product_details .field-group:not(:last-child) ._toggle').html('<i class="fas fa-plus"></i>');
                // enable date
                addedItem.find('.promotion_price').on("keyup", function() { 
                    if(addedItem.find('.promotion_price').val() === '') {
                        addedItem.find('.daterange-cus').attr("disabled", true);
                    } else {
                        addedItem.find('.daterange-cus').attr("disabled", false);
                    }
                });
                // format money
                $(function () {
                    $('input.currency').autoNumeric('init', {
                    aSep: '.',
                    aDec: ',',
                    aPad: false,
                    lZero: 'deny',
                    vMin: '0'
                    });
                });
                // set preview box color - size
                addedItem.find('input.color').on('keyup', function() {
                    var color = $(this).val().trim();
                    var size = addedItem.find('input.size').val().trim();
                    var val = '';
                    if(color !== '') val = color + ' - ';
                    if(size !== '') val = val + size;
                    addedItem.find('.card-header h4').text(val);
                });
                addedItem.find('input.size').on('keyup', function() {
                    var size = $(this).val().trim();
                    var color = addedItem.find('input.color').val().trim();
                    var val = '';
                    if(color !== '') val = color + ' - ';
                    if(size !== '') val = val + size;
                    addedItem.find('.card-header h4').text(val);
                });
            }
        });
        // set lfm
        $('#lfm_pro_detail_new0').filemanager('image', { prefix: domain });
        // set daterangepicker
        $(function () {
            //date picker
            $('.daterange-cus').daterangepicker({
                autoApply: true,
                autoUpdateInput: false,
                minDate: moment(),
                drops: 'down',
                opens: 'right',
                "locale": {
                    "format": "DD/MM/YYYY",
                    "daysOfWeek": [
                        "CN",
                        "T2",
                        "T3",
                        "T4",
                        "T5",
                        "T6",
                        "T7"
                    ],
                    "monthNames": [
                        "Tháng 1,", "Tháng 2,", "Tháng 3,", "Tháng 4,", "Tháng 5,", "Tháng 6,", "Tháng 7,", "Tháng 8,", "Tháng 9,", "Tháng 10,", "Tháng 11,", "Tháng 12,"
                    ],
                }
            });
            $('.daterange-cus').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            });
            $('.daterange-cus').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
        // format money
        $(function () {
            $('input.currency').autoNumeric('init', {
            aSep: '.',
            aDec: ',',
            aPad: false,
            lZero: 'deny',
            vMin: '0'
            });
        });
        // enable date
        $(function () {
            $('.promotion_price').on("keyup", function() { 
                if($('#collapse_product_detail_new0 .promotion_price').val() === '') {
                    $('#daterange_cus_new0').attr("disabled", true);
                } else {
                    $('#daterange_cus_new0').attr("disabled", false);
                }
            });
        });
        // set preview box color - size
        $(function () {
            $('input.color').on('keyup', function() {
                var color = $(this).val().trim();
                var val = '';
                if(color !== '') val = color;
                $(this).closest('.card').find('.card-header h4').text(val);
            });
        });
    }

    function formatDateString(s1, s2) {
        var res1 = s1.split(/\D/);
        var res2 = s2.split(/\D/);
        return res1.reverse().join('/') + ' - ' + res2.reverse().join('/');
    }
</script>

<script>
    // set repeat field
    $(function () {
        setRepeatField();
    });
    // set file manager
    $(function () {
        $('#lfm_add').filemanager('image', { prefix: domain });
        $('#lfm_edit').filemanager('image', { prefix: domain });
    });
    // set ckeditor
    CKEDITOR.replace('add_detail', {
        filebrowserImageBrowseUrl: domain+'?type=Images',
        filebrowserBrowseUrl: domain+'?type=Files'
    });
    CKEDITOR.replace('add_intro', {
        filebrowserImageBrowseUrl: domain+'?type=Images',
        filebrowserBrowseUrl: domain+'?type=Files'
    });
    CKEDITOR.replace('edit_detail', {
        filebrowserImageBrowseUrl: domain+'?type=Images',
        filebrowserBrowseUrl: domain+'?type=Files'
    });
    CKEDITOR.replace('edit_intro', {
        filebrowserImageBrowseUrl: domain+'?type=Images',
        filebrowserBrowseUrl: domain+'?type=Files'
    });
    //load datatable
    var tElement = $('#table_model');
    var table = tElement.dataTable({
        "processing": true,
        "language": {
            "processing": "Đang xử lý",
            "search": "Tìm kiếm ",
            "emptyTable": "Không tìm thấy bản ghi",
            "sLengthMenu":    "Hiển thị _MENU_ bản ghi trên 1 trang",
        },
        "serverSide": true,
        "ajax":{
            "url": "{{ url('admin/getDataProduct') }}",
            "dataType": "json",
            "type": "post",
            "data":{ _token: "{{csrf_token()}}" }
        },
        "order": [[ 0, "desc" ]],
        "columnDefs": [
            {
                "targets": 0,
                "orderable": false,
            },
            {
                "targets": 2,
                "orderable": false,
            },
            {
                "targets": 3,
                "orderable": false,
            },
            {
                "targets": 7,
                "orderable": false,
            },
        ],
        "columns": [
            { "data": "index" },
            { "data": "name" },
            { "data": "sku_code" },
            { "data": "image" },
            { "data": "category_id" },
            { "data": "status" },
            { "data": "created_at"},
            { "data": "options"},
        ],
        "autoWidth": false
    });
</script>
<script>
    //add
    $('#btn_add_data').on('click', function (e) {
        e.preventDefault();
        var table = $('#table_model').DataTable();
        var form = $(this).closest('form');
        var btnSubmit = $(this);
        var content = CKEDITOR.instances['add_detail'].getData();
        $('#add_detail').val(content);
        var content2 = CKEDITOR.instances['add_intro'].getData();
        $('#add_intro').val(content2);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        btnSubmit.attr("disabled", true);
        btnSubmit.html('Đang xử lý...');
        
        $.ajax({
            url: '/admin/saveProduct' ,
            type: "POST",
            data: form.serialize(),
            success: function(response) {
                if (response.status !== 1) {
                    btnSubmit.html('Save');
                    $('#add_error').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + response.message + '</div>');
                    $("#addModel").animate({ scrollTop: 0 }, "slow");
                    btnSubmit.attr("disabled", false);
                    iziToast.error({
                        message: response.message,
                        position: 'topRight'
                    });
                } else {
                    form.trigger("reset");
                    form.find('input').val('');
                    btnSubmit.html('Save');
                    $('#add_error').html('');
                    $('#add_modal').modal('hide');
                    $('#image_add').attr('src', '');
                    CKEDITOR.instances['add_detail'].setData('');
                    CKEDITOR.instances['add_intro'].setData('');
                    iziToast.success({
                        message: 'Thêm thành công!',
                        position: 'topRight'
                    });
                    if(typeof table !== 'undefined' && table !== null) {
                        table.draw();
                    }
                    btnSubmit.attr("disabled", false);
                    $("#add_product_details").empty();
                    var oldDiv = $('#add_product_details');
                    var parent = oldDiv.parent();
                    oldDiv.remove();
                    parent.prepend($('<div></div>').attr('id', 'add_product_details'));
                    setRepeatField();
                }
            }
        });
    });

    //edit
    $("body").on("click", ".editRecord", function () {
        $('#edit_product_details').html('');
        var id_edit = $(this).data('id');
        var url_edit = $(this).data('url');
        var method_edit = $(this).data('method');
        var editForm = $('#form_edit');
    
        $.ajax({
            type: method_edit,
            url: url_edit,
            data: { id: id_edit },
            success: function (response) {
                editForm.find("input[name='id']").val(response.data.id);
                editForm.find("input[name='name']").val(response.data.name);
                editForm.find("input[name='sku_code']").val(response.data.sku_code);
                editForm.find('[name="category_id"] option[value="' + response.data.category_id + '"]').prop('selected', true);
                CKEDITOR.instances['edit_intro'].setData(response.data.introduction);
                CKEDITOR.instances['edit_detail'].setData(response.data.details);
                editForm.find('#edit_image_holder').attr('src', response.data.image);
                editForm.find('#edit_image_path').val(response.data.image);
                response.data.status ? editForm.find('[name="status"]').prop("checked", true) : editForm.find('[name="status"]').prop("checked", false);
                $.each(response.data.product_details, function (indexInArray, valueOfElement) { 
                    let html =  '   <div class="card">  '  + 
 '               <div class="card-header">  '  + 
 '                   <h4>' + valueOfElement.color +
 '                   <div class="card-header-action">  '  + 
 '                       <a data-collapse="#edit_collapse_product_detail_'+ indexInArray + '" class="btn btn-icon btn-info _toggle" href="#"><i class="fas fa-plus"></i></a>  '  + 
 '                       <a class="btn btn-icon btn-danger delete" href="#"><i class="fa fa-times icon-only"></i></i></a>  '  + 
 '                   </div>  '  + 
 '               </div>  '  + 
 '               <div class="collapse" id="edit_collapse_product_detail_'+ indexInArray + '" style="">  '  + 
 '                   <div class="card-body">  '  + 
 '                       <div class="form-group">  '  + 
 '                           <div class="row">  '  + 
 '                               <div class="col-md-6">  '  + 
 '                                   <label>Màu sắc</label> (<span class="text-danger">*</span>)  '  + 
 '                                   <input type="text" class="form-control color" name="product_details['+ indexInArray +'][color]" required autocomplete="off" value="'+ valueOfElement.color +'">  '  + 
 '                               </div>  '  + 
 '                               <div class="col-md-6">  '  + 
 '                                   <label>Số lượng</label> (<span class="text-danger">*</span>)  '  + 
 '                                   <input type="text" class="form-control currency" name="product_details['+ indexInArray +'][quantity]" required autocomplete="off" value="'+ valueOfElement.quantity +'">  '  + 
 '                               </div>  '  + 
 '                           </div>  '  + 
 '                       </div>  '  +
 '                       <div class="form-group">  '  + 
 '                           <div class="row">  '  + 
 '                               <div class="col-md-6">  '  + 
 '                                   <label>Giá nhập</label> (<span class="text-danger">*</span>)  '  + 
 '                                   <input type="text" class="form-control currency" name="product_details['+ indexInArray +'][import_price]" required autocomplete="off" value="'+ valueOfElement.import_price +'">  '  + 
 '                               </div>  '  + 
 '                               <div class="col-md-6">  '  + 
 '                                   <label>Giá bán</label> (<span class="text-danger">*</span>)  '  + 
 '                                   <input type="text" class="form-control currency" name="product_details['+ indexInArray +'][sale_price]" required autocomplete="off" value="'+ valueOfElement.sale_price +'">  '  + 
 '                               </div>  '  + 
 '                           </div>  '  + 
 '                       </div>  '  + 
 '                       <div class="form-group">  '  + 
 '                           <div class="row">  '   +
 '                               <div class="col-md-6">  '  + 
 '                                   <label>Giá khuyến mãi</label>  '  + 
 '                                   <input type="text" class="form-control currency promotion_price" id="promotion_price_new0" name="product_details['+ indexInArray +'][promotion_price]" required autocomplete="off" value="'+ (valueOfElement.promotion_price ? valueOfElement.promotion_price : '') +'">  '  + 
 '                               </div>  '  +
 '                               <div class="col-md-6">  ' + 
 '                                  <label>Thời gian khuyến mãi</label>  '  + 
 '                                  <div class="input-group">  '  + 
 '                                      <div class="input-group-prepend">  '  + 
 '                                          <div class="input-group-text">  '  + 
 '                                              <i class="fas fa-calendar"></i>  '  + 
 '                                          </div>  '  + 
 '                                      </div>  '  + 
 '                                      <input type="text" class="form-control daterange-cus" name="product_details['+ indexInArray +'][promotion_date]" value="'+  (valueOfElement.promotion_start_date != null ? formatDateString(valueOfElement.promotion_start_date, valueOfElement.promotion_end_date) : '') + '">  '  + 
 '                                  </div>  '  + 
 '                               </div>  '  +
 '                           </div>  '  + 
 '                       </div>  '  + 
 '                       <div class="form-group">  '  + 
 '                           <label>Ảnh hiển thị</label> (<span class="text-danger">*</span>)  '  + 
 '                           <div class="input-group mb-1">  '  + 
 '                               <img id="edit_pro_detail_image_'+ indexInArray +'" style="max-width: 100px; max-height: 100px" src="'+ valueOfElement.image +'">  '  + 
 '                           </div>  '  + 
 '                           <div class="custom-file">  '  + 
 '                               <input type="file" class="custom-file-input edit_lfm_pro_detail" id="edit_lfm_pro_detail_'+ indexInArray +'" data-input="edit_pro_detail_image_path_'+ indexInArray +'" data-preview="edit_pro_detail_image_'+ indexInArray +'">  '  + 
 '                               <label class="custom-file-label" for="customFile"></label>  '  + 
 '                           </div>  '  + 
 '                           <input id="edit_pro_detail_image_path_'+ indexInArray +'" class="form-control" name="product_details['+ indexInArray +'][image]" value="'+ valueOfElement.image +'" type="hidden">  '  + 
 '                       </div>  '  + '<input type="hidden" class="form-control" name="product_details['+ indexInArray +'][id]" value="'+ valueOfElement.id +'">' +
 '                   </div>  '  + 
 '               </div>  '  + 
 '          </div>  ' ; 
                    $('#edit_product_details').append(html);
                    $('#edit_lfm_pro_detail_' + indexInArray).filemanager('image', { prefix: domain });
                });
                //reload collapse
                $("[data-collapse]").each(function() {
                    var me = $(this),
                    target = me.data("collapse");
                    me.click(function() {
                        $(target).collapse("toggle");
                        $(target).on("shown.bs.collapse", function() {
                            me.html('<i class="fas fa-minus"></i>');
                        });
                        $(target).on("hidden.bs.collapse", function() {
                            me.html('<i class="fas fa-plus"></i>');
                        });
                        return false;
                    });
                });
                //date picker
                $('.daterange-cus').daterangepicker({
                    autoApply: true,
                    autoUpdateInput: false,
                    minDate: moment(),
                    drops: 'down',
                    opens: 'right',
                    "locale": {
                        "format": "DD/MM/YYYY",
                        "daysOfWeek": [
                            "CN",
                            "T2",
                            "T3",
                            "T4",
                            "T5",
                            "T6",
                            "T7"
                        ],
                        "monthNames": [
                            "Tháng 1,", "Tháng 2,", "Tháng 3,", "Tháng 4,", "Tháng 5,", "Tháng 6,", "Tháng 7,", "Tháng 8,", "Tháng 9,", "Tháng 10,", "Tháng 11,", "Tháng 12,"
                        ],
                    }
                });
                $('.daterange-cus').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
                });
                $('.daterange-cus').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
                // format money
                $('input.currency').autoNumeric('init', {
                aSep: '.',
                aDec: ',',
                aPad: false,
                lZero: 'deny',
                vMin: '0'
                });
                // set preview box color - size
                $('input.color').on('keyup', function() {
                    var color = $(this).val().trim();
                    var val = '';
                    if(color !== '') val = color;
                    $(this).closest('.card').find('.card-header h4').text(val);
                });
            }
        });
    });
    //update
    $('#btn_edit_data').on('click', function () {
        var table = $('#table_model').DataTable();
        var form = $(this).closest('form');
        var btnSubmit = $(this);
        var content = CKEDITOR.instances['edit_detail'].getData();
        $('#edit_detail').val(content);
        var content2 = CKEDITOR.instances['edit_intro'].getData();
        $('#edit_intro').val(content2);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        btnSubmit.html('Đang xử lý..');
        var id = $('#id_edit').val();
        $.ajax({
            url: '/admin/updateProduct/' + id,
            type: "POST",
            data: form.serialize(),
            success: function (data) {
                if (data.status !== 1) {
                    btnSubmit.html('Save');
                    $('#edit_error').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + data.message + '</div>');
                    iziToast.error({
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                    btnSubmit.attr("disabled", false);
                    btnSubmit.html('Save');
                    $('#edit_modal').modal('hide');
                    $('#edit_error').html('');
                    form.trigger("reset");
                    table.draw();
                    iziToast.success({
                        message: 'Cập nhật thành công!',
                        position: 'topRight'
                    });
                }
            }
        });
    });
</script>
<script type="text/template" id="product-detail">
    <div class="field-group">
        <div class="card">
            <div class="card-header">
                <h4></h4>
                <div class="card-header-action">
                    <a data-collapse="#collapse_product_detail_{?}" class="btn btn-icon btn-info _toggle" href="#"><i class="fas fa-minus"></i></a>
                    <a class="btn btn-icon btn-danger delete" href="#"><i class="fa fa-times icon-only"></i></i></a>
                </div>
            </div>
            <div class="collapse show" id="collapse_product_detail_{?}" style="">
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Màu sắc</label> (<span class="text-danger">*</span>)
                                <input type="text" class="form-control color" name="product_details[{?}][color]" required autocomplete="off">
                            </div>
                            <div class="col-md-6">
                                <label>Số lượng</label> (<span class="text-danger">*</span>)
                                <input type="text" class="form-control currency" name="product_details[{?}][quantity]" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Giá nhập</label> (<span class="text-danger">*</span>)
                                <input type="text" class="form-control currency" name="product_details[{?}][import_price]" required autocomplete="off">
                            </div>
                            <div class="col-md-6">
                                <label>Giá bán</label> (<span class="text-danger">*</span>)
                                <input type="text" class="form-control currency" name="product_details[{?}][sale_price]" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Giá khuyến mãi</label>
                                <input type="text" class="form-control currency promotion_price" id="promotion_price_new0" name="product_details[{?}][promotion_price]" required autocomplete="off" >
                            </div>
                            <div class="col-md-6">
                                <label>Thời gian khuyến mãi</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input type="text" disabled class="form-control daterange-cus" name="product_details[{?}][promotion_date]" id="daterange_cus_new0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ảnh hiển thị</label> (<span class="text-danger">*</span>)
                        <div class="input-group mb-1">
                            <img id="pro_detail_image_add_{?}" style="max-width: 100px; max-height: 100px">
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input lfm_pro_detail" id="lfm_pro_detail_{?}" data-input="pro_detail_image_path_{?}" data-preview="pro_detail_image_add_{?}">
                            <label class="custom-file-label" for="customFile"></label>
                        </div>
                        <input id="pro_detail_image_path_{?}" class="form-control" name="product_details[{?}][image]" value="" type="hidden">
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
@endsection





