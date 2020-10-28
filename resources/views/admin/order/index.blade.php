@extends('admin.layout.base')
@section('styles')
    
@endsection
@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row ">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-primary text-white-all">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="#"><i class=""></i> Quản lý đơn đặt hàng</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas"></i> Danh sách đơn đặt hàng</li>
                    </ol>
                </nav>
                <div class="card">
                    <div class="card-header">
                        <div class="group_action float-right">
                            
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
                                        <th>Mã đơn hàng</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Phương thức thanh toán</th>
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

<!-- Large modal -->
<div class="modal fade bd-example-modal-lg viewRecord" id="viewRecordModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="myLargeModalLabel">Thông tin đơn hàng</h5>
            <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="invoice-infor">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        From: <br />
                        <br />
                        <address>
                            <b class="mb-0">Thang Mobile</b>
                            <p class="mb-0">Phone: 0967 999 999</p>
                            <p class="mb-0">Email: thangmobile@gmail.com</p>
                            <p class="mb-0">Address: Đồ Sơn - Hải Phòng</p>
                        </address>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        To: <br />
                        <br />
                        <address>
                            <b class="mb-0 name"></b>
                            <p class="mb-0">Phone: <span class="phone"></span></p>
                            <p class="mb-0"> Email: <span class="email"></span></p>
                            <p class="mb-0">Address: <span class="address"></span></p>
                        </address>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        Thông Tin Đơn Hàng<br />
                        <br />
                        <address>
                            <p class="mb-0">Đơn Hàng: <span class="order_code">#PSO37835</span></p>
                            <p class="mb-0">Ngày Tạo: <span  class="created_at"></span></p>
                            <p class="mb-0">Thanh Toán: <span class="payment_method"></span></p>
                        </address>
                    </div>
                </div>
            </div>
            <div class="list-product">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center;">STT</th>
                                <th>Mã Sản Phẩm</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Mầu Sắc</th>
                                <th style="text-align: center;">Số Lượng</th>
                                <th>Đơn Giá</th>
                                <th>Tổng Tiền</th>
                            </tr>
                        </thead>
                        <tbody id="products">
                            
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-success pull-right" id="btn-print"><i class="fa fa-print"></i> In Hóa Đơn</button>
            </div>
        </div>
      </div>
   </div>
</div>

@endsection

@section('scripts')
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>


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
            "url": "{{ url('admin/getDataOrder') }}",
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
                "targets": 7,
                "orderable": false,
            },
        ],
        "columns": [
            { "data": "index" },
            { "data": "order_code" },
            { "data": "name" },
            { "data": "email" },
            { "data": "phone" },
            { "data": "payment_method" },
            { "data": "is_processed" },
            { "data": "created_at"},
            { "data": "options"},
        ],
        "autoWidth": false
    });

    // get order detail
    $("body").on("click", ".viewRecordDetail", function () {
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: '/admin/getOrderDetail/' + id,
            success: function (data) {
                $('.name').html(data.data.name);
                $('.phone').html(data.data.phone);
                $('.email').html(data.data.email);
                $('.address').html(data.data.address);
                $('.order_code').html(data.data.order_code);
                $('.created_at').html(data.data.created_at);
                $('.payment_method').html(data.data.payment_method === 1 ? 'Thanh toán khi nhận hàng' : 'Thanh toán trực tuyến');
                var html = '';
                var totalPrice = 0;
                $.each(data.data.order_details, function (index, value) { 
                     totalPrice += value.quantity * value.price;
                     html +=  '<tr>'  + 
 '                                   <td style="text-align: center;">'+ (++index) +'</td>  '  + 
 '                                   <td>#'+ value.product_detail.product.sku_code + '</td>  '  + 
 '                                   <td>'+ value.product_detail.product.name +'</td>  '  + 
 '                                   <td>'+ value.product_detail.color +'</td>  '  + 
 '                                   <td style="text-align: center;">'+ value.quantity +'</td>  '  + 
 '                                   <td><span style="color: #f30;">'+ formatMoney(value.price,0,',','.') +' VNĐ</span></td>  '  + 
 '                                   <td><span style="color: #f30;">'+ formatMoney(value.quantity * value.price) +' VNĐ</span></td>  '  + 
 '                              </tr>  ' ; 
                });
                html +=  '<tr>'  + 
 '                          <td colspan="7" style="text-align: right;"><b>Tổng = <span style="color: #f30;">'+ formatMoney(totalPrice) +' VNĐ</span></b></td>'  + 
 '                       </tr>' ; 
                $('#products').html(html);
                console.log(data.data);
            }
        });
    });

    //print
    $(document).ready(function() {
        $('#btn-print').click(function(){
            printJS({
                printable: 'viewRecordModal',
                type: 'html',
                css: [
                '{{ asset('assets/css/bootstrap.min.css') }}',
                ],
                ignoreElements: [
                    'btn-print',
                    'close'
                ],
                style: 'img { filter: grayscale(100%); -webkit-filter: grayscale(100%); }'
            });
        });
    });
</script>
@endsection