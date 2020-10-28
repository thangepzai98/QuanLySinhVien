<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class CommonFunctions {

    public static function checkExpireTime($time, $hours)
    {
        return Carbon::parse($time)->addHours($hours)->isPast() ? false : true;
    }

    public static function getHtmlEditAndDelete($id, $urlEdit, $urlDelete, $editMethod = 'PUT', $deleteMethod = 'DELETE', $deleteTitle = '', $template = '') 
    {
        $html = '<div class="btn-group btn-group-xs">';
            $html .= '<a href="#" title="Sửa" class="btn btn-primary editRecord" data-toggle="modal" data-target="#edit_modal" data-method="'.$editMethod.'" data-url="'.$urlEdit.'" data-id="'.$id.'"><i class="fa fa-edit icon-only"></i></a>';
            $html .= '<a href="javascript:void(0)" class="btn btn-danger removeRecord" title="Xóa" data-method="'.$deleteMethod.'" data-url="'.$urlDelete.'" data-id="'.$id.'" data-delete-title="'.$deleteTitle.'" data-template="' . $template . '"><i class="fa fa-times icon-only"></i></a>';
        $html .= '</div>';
        return $html;
    }

    public static function getStartVote($rate) {
        $output = '';
        if($rate == 0){
          $output = '<i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i>';
        } elseif ($rate > 0 && $rate < 1) {
          $output = '<i class="font-13 fa fa-star-half-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i>';
        } elseif ($rate == 1) {
          $output = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i>';
        } elseif ($rate > 1 && $rate < 2) {
          $output = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-half-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i>';
        } elseif ($rate == 2) {
          $output = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i>';
        } elseif ($rate > 2 && $rate < 3) {
          $output = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-half-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i>';
        } elseif ($rate == 3) {
          $output = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i>';
        } elseif ($rate > 3 && $rate < 4) {
          $output = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-half-o"></i><i class="font-13 fa fa-star-o"></i>';
        } elseif ($rate == 4) {
          $output = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-o"></i>';
        } elseif ($rate > 4 && $rate < 5) {
          $output = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-half-o"></i>';
        } elseif ($rate == 5) {
          $output = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i>';
        }
        return $output;
    }

    public static function getRealPrice($price, $promotionPrice, $startDate, $endDate)
    {
      $html = '';
      if($promotionPrice != null && $startDate <= date('Y-m-d') && $promotionPrice >= date('Y-m-d')) {
          $html .= '<span class="old-price">'. number_format($price,0,',','.') .'₫</span><span class="price">'. number_format($promotionPrice,0,',','.') .'₫</span>';
      } else {
        $html .= '</span><span class="price">' . number_format($price,0,',','.') . '₫</span>';
      }
      return $html;
    }

    public static function getPromotionPercent($price, $promotionPrice, $startDate, $endDate)
    {
      $html = '';
      if($promotionPrice != null && $startDate <= date('Y-m-d') && $endDate >= date('Y-m-d')) {
        $html .= '<div class="product-labels"><span class="lbl on-sale">' . round(100 * ($price - $promotionPrice) / $price) . '%</span></div>';
      }
      return $html;
    }
   
    public static function rand_string($length) 
    {
        $chars = "0123456789";
        $size = strlen($chars);
        $str = '';
        for($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }

    public static function checkUnique($data) {
      $unique = array_unique($data);
      if(count($data) != count($unique)) {
        return false;
      }
      return true;
    }
  

    public static function verifyPayment($data)
    {
        $status = Config::get('constants.STATUS.INACTIVE');
        $inputData = array();
        $vnp_SecureHash = $data['vnp_SecureHash'];
        foreach ($data as $key => $value) {
            $inputData[$key] = $value;
        }
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }
        $vnp_HashSecret = env('VNP_HASH_SECRET');
        $secureHash = hash('sha256',$vnp_HashSecret . $hashData);
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $status = Config::get('constants.STATUS.ACTIVE');
            }
        }
        return $status;
    }

  public static function getRandomImage($dir)
  {
    $files = \File::files(public_path() . $dir);
    foreach($files as $file) {
        $data[] = '/photos/shares/' . $file->getFileName();
    }
    $randomFile = $data[rand(0, count($data) - 1)];
    return $randomFile;
  }
}
