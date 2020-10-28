<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Helpers\CommonFunctions;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\ProductDetailRepository;
use App\Repositories\Contracts\OrderDetailRepository;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $productDetailRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        ProductDetailRepository $productDetailRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productDetailRepository = $productDetailRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->all(['name', 'id']);
        return view('admin.product.index', compact('categories'));
    }

    public function getDataProduct(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'sku_code',
            3 => 'image',
            4 => 'category_id',
            5 => 'status',
            6 => 'created_at',
            7 => 'options'
        ];
        $searchWord = $request->input('search.value');
        $start = $request->input('start');
        $limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $products = $this->productRepository->findAllProduct($searchWord, $start, $limit, $order, $dir);
        $data = array();
        if(!empty($products['data'])) {
            foreach ($products['data'] as $index => $item) {
                $id = $item->id;
                $urlEdit = '/admin/getProductById/' . $id;
                $urlDelete = '/admin/deleteProduct'; 
                $editMethod = 'GET';
                $deleteMethod = 'POST';
                $urlStatus = "/admin/updateStatusProduct";
                $tableName = "#table_model";
                $deleteTitle = isset($item->name) ? $item->name : '';
                $nestedData['index']            = ++$index + $start;
                $nestedData['name']             = !empty($item->name)  ? $item->name : '---';
                $nestedData['sku_code']         = !empty($item->sku_code)  ? $item->sku_code : '---';
                $nestedData['image']            = !empty($item->image)  ? '<img src="'.$item->image.'" style="max-width: 100px; max-height: 100px">' : '---';
                $nestedData['category_id']      = !empty($item->category_id)  ? $this->categoryRepository->find($item->category_id)->name : '---';
                $nestedData['status']           = $item->status == 1 ? '<span class="badge badge-success btnChangeStatus" data-status="'.$item->status.'" data-id="'.$item->id.'" data-url="'.$urlStatus.'" data-template="'.$tableName.'">Active</span>' : '<span class="badge badge-dark btnChangeStatus" data-status="'.$item->status.'" data-id="'.$item->id.'" data-url="'.$urlStatus.'" data-template="'.$tableName.'">Disabled</span>';
                $nestedData['created_at']       = !empty($item->created_at) ? Carbon::parse($item->created_at)->diffForHumans() : '---';
                $nestedData['options'] = CommonFunctions::getHtmlEditAndDelete($id, $urlEdit, $urlDelete, $editMethod, $deleteMethod, $deleteTitle, $tableName);   
                $data[] = $nestedData;
            }
        }
        $result = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($products['recordsTotal']),
            "recordsFiltered" => intval($products['recordsTotal']),
            "data"            => $data
        );
        return response()->json($result);
    }

    public function store(Request $request)
    {
        $jsonFormat = array();
        $jsonFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'sku_code' => 'required|unique:products,sku_code',
            'image' => 'required',
        ], [
            'required' => 'Các trường có dấu (*) bắt buộc nhập',
            'sku_code.unique' => 'Mã sản phẩm đã tồn tại'
        ]);
        if ($validator->fails()) {
            $jsonFormat['message'] = $validator->errors()->first();
            return response()->json($jsonFormat);
        }
        $index = 0;
        foreach($request->product_details as $key => $product_detail) {
            $color = $product_detail['color'];
            $image = $product_detail['image'];
            $salePrice = (int)str_replace('.', '', $product_detail['sale_price']);
            $importPrice = (int)str_replace('.', '', $product_detail['import_price']);
            $promotionPrice = (int)str_replace('.', '', $product_detail['promotion_price']);
            $quantity = (int)str_replace('.', '', $product_detail['quantity']);

            if($color == '' || $image == '' || $quantity == '' || $salePrice == '' || $importPrice == '') {
                $jsonFormat['message'] = 'Các trường có dấu (*) bắt buộc nhập trong chi tiết sản phẩm ' . ++$index;
                return response()->json($jsonFormat);
            }
            if($quantity <= 0) {
                $jsonFormat['message'] = 'Số lượng phải lớn hơn 1 trong chi tiết sản phẩm ' . ++$index;
                return response()->json($jsonFormat);
            }
            if($promotionPrice != '' && $promotionPrice >= $salePrice) {
                $jsonFormat['message'] = 'Giá khuyến mãi phải nhỏ hơn giá bán trong chi tiết sản phẩm ' . ++$index;
                return response()->json($jsonFormat);
            }
        }
        try {
            DB::beginTransaction();
            $product = $this->productRepository->create([
                'name'          => $request->name,
                'category_id'   => $request->category_id,
                'sku_code'      => $request->sku_code,
                'image'         => $request->image,
                'details'       => $request->details,
                'introduction'  => $request->introduction,
                'status'        => $request->status ? 1 : 0
            ]);
            foreach($request->product_details as $product_detail) {
                $start_date = null;
                $end_date = null;
                if(isset($product_detail['promotion_date']) && $product_detail['promotion_date'] != null) {
                    list($start_date, $end_date) = explode(' - ', $product_detail['promotion_date']);
                    $start_date = str_replace('/', '-', $start_date);
                    $start_date = date('Y-m-d', strtotime($start_date));
                    $end_date = str_replace('/', '-', $end_date);
                    $end_date = date('Y-m-d', strtotime($end_date));
                }
                $this->productDetailRepository->create([
                    'product_id' => $product->id,
                    'color' => $product_detail['color'],
                    'image' => $product_detail['image'],
                    'import_quantity' => str_replace('.', '', $product_detail['quantity']),
                    'quantity' => str_replace('.', '', $product_detail['quantity']),
                    'import_price' => str_replace('.', '', $product_detail['import_price']),
                    'sale_price' => str_replace('.', '', $product_detail['sale_price']),
                    'promotion_price' => str_replace('.', '', $product_detail['promotion_price']) != '' ? str_replace('.', '', $product_detail['promotion_price']) : null,
                    'promotion_start_date' => $start_date,
                    'promotion_end_date' => $end_date
                ]);
            }  
            DB::commit();
            $jsonFormat['status']  = Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['message'] = 'Thêm thành công';
        } catch (\Exception $e) {
            DB::rollBack();
            $jsonFormat['message'] = $e->getMessage();
        }
        return response()->json($jsonFormat);
    }

    public function edit($id) {
        $jsonFormat = [];
        $jsonFormat['status'] = \Config::get('constants.STATUS.INACTIVE');
        if ($this->productRepository->count(['id' => $id]) > 0) {
            $jsonFormat['status'] = \Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['data']  = $this->productRepository->findProductById($id);
        } else {
            $jsonFormat['message'] = 'Không tồn tại bản ghi';
        }
        return response()->json($jsonFormat);
    }

    public function update(Request $request, $id) {
        $data = array();
        $jsonFormat = array();
        $jsonFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'sku_code' => 'required|unique:products,sku_code,' . $id,
            'image' => 'required',
        ], [
            'required' => 'Các trường có dấu (*) bắt buộc nhập',
            'sku_code.unique' => 'Mã sản phẩm đã tồn tại'
        ]);

        if ($validator->fails()) {
            $jsonFormat['message'] = $validator->errors()->first();
            return response()->json($jsonFormat);
        }
        $index = 0;
        foreach($request->product_details as $product_detail) {
            $color = $product_detail['color'];
            $image = $product_detail['image'];
            $salePrice = (int)str_replace('.', '', $product_detail['sale_price']);
            $importPrice = (int)str_replace('.', '', $product_detail['import_price']);
            $promotionPrice = (int)str_replace('.', '', $product_detail['promotion_price']);
            $quantity = (int)str_replace('.', '', $product_detail['quantity']);

            if($color == '' || $image == '' || $quantity == '' || $salePrice == '' || $importPrice == '') {
                $jsonFormat['message'] = 'Các trường có dấu (*) bắt buộc nhập trong chi tiết sản phẩm ' . ++$index;
                return response()->json($jsonFormat);
            }
            if($quantity <= 0) {
                $jsonFormat['message'] = 'Số lượng phải lớn hơn 1 trong chi tiết sản phẩm ' . ++$index;
                return response()->json($jsonFormat);
            }
            if($promotionPrice != '' && $promotionPrice >= $salePrice) {
                $jsonFormat['message'] = 'Giá khuyến mãi phải nhỏ hơn giá bán trong chi tiết sản phẩm ' . ++$index;
                return response()->json($jsonFormat);
            }
        }
       
        try {
            $data['name'] = $request->name;
            $data['sku_code'] = $request->sku_code;
            $data['category_id'] = $request->category_id;
            $data['image'] = $request->image;
            $data['introduction'] = $request->introduction;
            $data['details'] = $request->details;
            $data['status'] = $request->status ? 1 : 0;
            DB::beginTransaction();
            $this->productRepository->update($data, $id);
            foreach($request->product_details as $index => $product_detail) {
                $start_date = null;
                $end_date = null;
                if(isset($product_detail['promotion_date']) && $product_detail['promotion_date'] != null) {
                    list($start_date, $end_date) = explode(' - ', $product_detail['promotion_date']);
                    $start_date = str_replace('/', '-', $start_date);
                    $start_date = date('Y-m-d', strtotime($start_date));
                    $end_date = str_replace('/', '-', $end_date);
                    $end_date = date('Y-m-d', strtotime($end_date));
                }
                $this->productDetailRepository->update([
                    'color' => $product_detail['color'],
                    'image' => $product_detail['image'],
                    'import_quantity' => str_replace('.', '', $product_detail['quantity']),
                    'quantity' => str_replace('.', '', $product_detail['quantity']),
                    'import_price' => str_replace('.', '', $product_detail['import_price']),
                    'sale_price' => str_replace('.', '', $product_detail['sale_price']),
                    'promotion_price' => str_replace('.', '', $product_detail['promotion_price']) != '' ? str_replace('.', '', $product_detail['promotion_price']) : null,
                    'promotion_start_date' => $start_date,
                    'promotion_end_date' => $end_date
                ], $product_detail['id']);
            }  
            DB::commit();
            $jsonFormat['status']  = Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['message'] = 'Cập nhật thành công';
        } catch (\Exception $e) {
            DB::rollBack();
            $jsonFormat['message'] = $e->getMessage();
        }
        return response()->json($jsonFormat);
    }

    public function delete($id) {
        $jsonFormat = array();
        $jsonFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        if ($this->productRepository->count(['id' => $id]) == 0) {
            $jsonFormat['message'] = 'Không tồn tại bản ghi';
            return response()->json($jsonFormat);
        }
        try {
            DB::beginTransaction();
            $this->productRepository->delete($id);
            DB::commit();
            $jsonFormat['status'] = Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['message'] = 'Xóa thành công';
        } catch (\Exception $e) {
            DB::rollBack();
            $jsonFormat['message'] = $e->getMessage();
        }
        return response()->json($jsonFormat);
    }

    public function updateStatus(Request $request) {
        $jsonFormat = array();
        $jsonFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        $id = $request->id;
        try {
            DB::beginTransaction();
            $result = $this->productRepository->update([
                "status" => $request->status == 1 ? 0 : 1
            ], $id);
            DB::commit();
            $jsonFormat['status'] = Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['message'] = 'Cập nhật thành công';
        } catch (\Exception $e) {
            DB::rollBack();
            $jsonFormat['message'] = 'Có lỗi xảy ra';
        }
        return response()->json($jsonFormat);
    }
}
