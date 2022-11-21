<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function productDetail(Request $request){
        return view('user.detail-product');
    }
    public function bookingProduct(Request $request){
        return view('user.booking-product');
    }
    public function viewListBooking(){
        return view('user.list-booking');
    }
    public function allProduct(){
        return view('user.all-product');
    }
    public function getListBooking(Request $request){
        $req = $request->all();
        $id_user = Auth::user()->id;
        $data = DB::table('orders')->where('user_order',$id_user)
            ->leftJoin('products', 'orders.product_id', '=', 'products.id')
            ->orderBy('orders.created_at', 'DESC')
            ->skip($req['start'])->take($req['limit'])->get();
        $total = DB::table('orders')->where('user_order',$id_user)->count();
        $res = [
            'rc' => 0,
            'rd' => 'Lấy dữ liệu thành công',
            'list_data' => $data,
            'total'=> $total
        ];
        return json_encode($res);
    }
    public function bookingProductById(Request $request){
        $req = $request->all();
        $dataCreat = Orders::create([
            'user_order' => Auth::user()->id,
            'user_name' => $req['userName'],
            'amount' => $req['amount'],
            'phone' => $req['phone'],
            'address' => $req['address'],
            'product_id' => $req['idProduct'],
            'payment' => $req['payment'],
            'note' => $req['note'],
            'status' => 0,
        ]);
        $res = [
            'rc' => 0,
            'rd' => 'Đặt hàng thành công. Vui lòng đợi admin phê duyệt.',
            'data'=>$dataCreat
        ];
        return json_encode($res);
    }
    public function productDetailById(Request $request){
        $req = $request->all();
        $product = Products::where('id', '=', $req['id'])->first();

        $res = [
            'rc' => 0,
            'rd' => 'Lấy thông tin thành công.',
            'data'=>$product
        ];
        return json_encode($res);
    }
}
