<?php

namespace App\Http\Controllers;

use App\Cate;
use App\Orders;
use App\Products;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function getHome(){
        return view('admin.home');
    }
    public function getCate(){
        return view('admin.cate');
    }
    public function getProduct(){
        return view('admin.products');
    }
    public function getOrder(){
        return view('admin.orders');
    }
    public function getUser(){
        return view('admin.users');
    }
    public function addCate(Request $request){
        $req = $request->all();
        $dataCreat = Cate::create([
            'name' => $req['name'],
            'description' => $req['description'],
        ]);
        $res = [
            'rc' => 0,
            'rd' => 'Thêm danh mục thành công.',
            'data' => $dataCreat
        ];
        return json_encode($res);
    }
    public function listUser(Request $request){
        $req = $request->all();
        $total = User::orderBy('created_at', 'DESC')->get()->count();
        $data = User::orderBy('created_at', 'DESC')->skip($req['start'])->take($req['limit'])->get();
        $res = [
            'rc' => 0,
            'rd' => 'Lấy dữ liệu thành công',
            'list_data' => $data,
            'total'=> $total
        ];
        return json_encode($res);
    }
    public function listCate(Request $request){

        $req = $request->all();

        $data = Cate::where('id', '>',0);
        $total = $data->orderBy('created_at', 'DESC')->get()->count();
        $data = $data->orderBy('created_at', 'DESC')->skip($req['start'])->take($req['limit'])->get();
        $res = [
            'rc' => 0,
            'rd' => 'Lấy dữ liệu thành công',
            'list_data' => $data,
            'total'=> $total
        ];
        return json_encode($res);
    }
    public function updateCate(Request $request){

        $data = $request->all();
        $cate = Cate::where('id', '=', $data['id'])->first();
        $cate->name =  $data['name'];
        $cate->description =  $data['description'];
        $cate->save();
        $res = [
            'rc' => 0,
            'rd' => 'Cập nhật thành công.',
        ];
        return json_encode($res);
    }
    public function deleteCate(Request $request){
        $req = $request->all();
        $cate = Cate::where('id', '=', $req['id'])->delete();
        $res = [
            'rc' => 0,
            'rd' => 'Xoá dữ liệu thành công.',
        ];
        return json_encode($res);
    }
    public function addProduct(Request $request){
        $req = $request->all();
        $hinhAnh =  $request->file('hinhAnh');
        $filePathHinhAnh = '/products/' . uniqid() . '.' . $hinhAnh->extension();
        $hinhAnh->move(public_path('products'), $filePathHinhAnh);
        $dataCreat = Products::create([
            'name' => $req['name'],
            'description' => $req['description'],
            'cate' => $req['cate'],
            'price' => $req['price'],
            'images' => $filePathHinhAnh,
        ]);
        $res = [
            'rc' => 0,
            'rd' => 'Thêm sản phẩm thành công.',
            'data'=>$dataCreat
        ];
        return json_encode($res);
    }
    public function duyetDon(Request $request){
        $req = $request->all();
        $order = Orders::where('id', '=', $req['id'])->first();
        $order->status = 1;
        $order->save();
        $res = [
            'rc' => 0,
            'rd' => 'Cập nhật thành công.',
        ];
        return json_encode($res);
    }
    public function listOrder(Request $request){
        $req = $request->all();
        $data = DB::table('orders')
            ->leftJoin('products', 'orders.product_id', '=', 'products.id')
            ->select(['products.*','orders.*'])
            ->orderBy('orders.created_at', 'DESC')
            ->skip($req['start'])->take($req['limit'])->get();
        $total = DB::table('orders')->orderBy('orders.created_at', 'DESC')->count();
        $res = [
            'rc' => 0,
            'rd' => 'Lấy dữ liệu thành công',
            'list_data' => $data,
            'total'=> $total
        ];
        return json_encode($res);
    }
    public function listProducts(Request $request){
        $req = $request->all();
        $data = Products::where('id', '>',0);
        if(isset($req['cate'])){
            $data->where('cate',$req['cate']);
        }
        if(isset($req['key'])){
            $data->where('name','like','%'.$req['key'].'%');
        }
        $total = $data->orderBy('created_at', 'DESC')->get()->count();
        $data = $data->orderBy('created_at', 'DESC')->skip($req['start'])->take($req['limit'])->get();
        $res = [
            'rc' => 0,
            'rd' => 'Lấy dữ liệu thành công',
            'list_data' => $data,
            'total'=> $total
        ];
        return json_encode($res);
    }
    public function updateProduct(Request $request){
        $req = $request->all();
        $product = Products::where('id', '=', $req['id'])->first();
        $product->name =  $req['name'];
        $product->cate =  $req['cate'];
        $product->price =  $req['price'];
        $product->description =  $req['description'];
        if($request->file('hinhAnh')){
            $hinhAnh =  $request->file('hinhAnh');
            $filePathHinhAnh = '/products/' . uniqid() . '.' . $hinhAnh->extension();
            $hinhAnh->move(public_path('products'), $filePathHinhAnh);
            $product->images = $filePathHinhAnh;
        }
        $product->save();
        $res = [
            'rc' => 0,
            'rd' => 'Cập nhật thành công.',
        ];
        return json_encode($res);
    }
    public function deleteProduct(Request $request){
        $req = $request->all();
        $product = Products::where('id', '=', $req['id'])->delete();
        $res = [
            'rc' => 0,
            'rd' => 'Xoá dữ liệu thành công.',
        ];
        return json_encode($res);
    }
}
