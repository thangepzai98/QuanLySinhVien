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
                        <li class="breadcrumb-item"><a href="#"><i class=""></i> Quản lý người dùng</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas"></i> Danh sách người dùng</li>
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
                                        <th>Tên tài khoản</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Loại tài khoản</th>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm người dùng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="add_error"></div>
                <form action="" method="post" id="form_add" action="javascript:void(0)" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <div class="control-label">Trạng thái</div>
                        <label class="custom-switch mt-2">
                          <input type="checkbox" name="status" class="custom-switch-input" checked>
                          <span class="custom-switch-indicator"></span>
                        </label>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="btn_add_data">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- user detail -->
<div class="modal fade bd-example-modal-lg" id="viewRecordDetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
          aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Lịch sử mua hàng</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="activities">
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
    function formatMoney(amount, decimalCount = 2, decimal = ",", thousands = ".") {
        try {
            decimalCount = Math.abs(decimalCount);
            decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

            const negativeSign = amount < 0 ? "-" : "";

            let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
            let j = (i.length > 3) ? i.length % 3 : 0;

            return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
        } catch (e) {
            console.log(e)
        }
    };
    //load data
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
            "url": "{{ url('admin/getDataUser') }}",
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
                "targets": 4,
                "orderable": false,
            },
            {
                "targets": 8,
                "orderable": false,
            },
        ],
        "columns": [
            { "data": "index" },
            { "data": "name" },
            { "data": "email" },
            { "data": "phone" },
            { "data": "address" },
            { "data": "type" },
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        btnSubmit.attr("disabled", true);
        btnSubmit.html('Đang xử lý...');
        
        $.ajax({
            url: '/admin/saveUser' ,
            type: "POST",
            data: form.serialize(),
            success: function(response) {
                if (response.status !== 1) {
                    btnSubmit.html('Save');
                    $('#add_error').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + response.message + '</div>');
                    $("#addModel").animate({ scrollTop: 0 }, "slow");
                    btnSubmit.attr("disabled", false);
                } else {
                    form.trigger("reset");
                    form.find('input').val('');
                    btnSubmit.html('Save');
                    $('#add_error').html('');
                    $('#add_modal').modal('hide');
                    iziToast.success({
                        message: 'Thêm thành công!',
                        position: 'topRight'
                    });
                    if(typeof table !== 'undefined' && table !== null) {
                        table.draw();
                    }
                    btnSubmit.attr("disabled", false);
                }
            }
        });
    });

    // get order history 
    $("body").on("click", ".viewRecordDetail", function () {
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: '/admin/getOrdersOfUser/' + id,
            success: function (data) {
                console.log(data.data);
                var html = '';
                $.each(data.data, function (index, order) { 
                    html +=  '   <div class="activity">  '  + 
 '                                   <div class="activity-icon bg-primary text-white">  '  + 
 '                                      <i class="fas fa-arrows-alt"></i>  '  + 
 '                                   </div>  '  + 
 '                                   <div class="activity-detail">  '  + 
 '                                      <div class="mb-2">  '  + 
 '                                         <span class="text-job">'+ order.created_at+ '</span>  '  + 
 '                                         <span class="bullet"></span>  '  + 
 '                                         <div class="float-right dropdown">  '  + 
 '                                         </div>  '  + 
 '                                      </div>  '  + 
 '                                      <div class="table-responsive">  '  + 
 '                                         <table class="table table-striped" style="margin-bottom: 0; background-color: #fff;">  '  + 
 '                                            <thead>  '  + 
 '                                               <tr>  '  + 
 '                                                  <th class="text-center" style="vertical-align: middle;">STT</th>  '  + 
 '                                                  <th class="text-center" style="vertical-align: middle;">Mã<br>Sản Phẩm</th>  '  + 
 '                                                  <th class="text-center" style="vertical-align: middle;">Tên<br>Sản Phẩm</th>  '  + 
 '                                                  <th class="text-center" style="vertical-align: middle;">Mầu Sắc</th>  '  + 
 '                                                  <th class="text-center" style="vertical-align: middle;">Số Lượng</th>  '  + 
 '                                                  <th class="text-center" style="vertical-align: middle;">Đơn Giá</th>  '  + 
 '                                               </tr>  '  + 
 '                                            </thead>  '  + 
 '                                           <tbody>  ' ; 
                        $.each(order.order_details, function (index, order_detail) { 
                            html +=   '   <tr>  '  + 
                            ' <td class="text-center" style="vertical-align: middle;">'+ (++index) +'</td>  '  + 
                            ' <td class="text-center" style="vertical-align: middle;"><a title="">'+ order_detail.product_detail.product.sku_code +'</a></td>  '  + 
                            ' <td class="text-center" style="vertical-align: middle;">'+ order_detail.product_detail.product.name +'</td>  '  + 
                            ' <td class="text-center" style="vertical-align: middle;">'+ order_detail.product_detail.color +'</td>  '  + 
                            ' <td class="text-center" style="vertical-align: middle;">'+ order_detail.quantity +'</td>  '  + 
                            ' <td class="text-center" style="color: #f30; vertical-align: middle;">'+formatMoney(order_detail.price, 0, ',', '.')  +' VNĐ</td>  '  + 
                            ' </tr>  ' ; 
                        });
                    html +=  '   </tbody>  '  + 
                            ' </table>  '  + 
                            '   </div>  '  + 
                            '   </div>  '  + 
                            '  </div>  '  + 
                            ' </div>  ' ; 
                });
                $('.activities').html(html);
            }
        });
    });
</script>
@endsection