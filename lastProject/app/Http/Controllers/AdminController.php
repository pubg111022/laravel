<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileAdminRequest;
use App\Models\Comment;
use App\Models\Order;
use App\Models\RepComment;
use App\Models\User;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\SizeProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Size;

class AdminController extends Controller
{
    function index(Category $cate, OrderDetail $order_detail, Request $req)
    {
        $req->session()->forget('time1');
        $req->session()->forget('time2');
        $time = getdate();
        $day =  $time["mday"];
        $month = $time["mon"];
        $year = $time["year"];
        $start = $year . '-' . $month-1 . '-' . '31';
        $end = $year . '-' . $month . '-' . $day+1;
        $start_year = $year . '-' . '1-1';
        $end_year = $year . '-' . '12-31';
        $orderInMonth = Order::whereBetween('created_at', [$start, $end])->where('shipping_status', 3);
        $orderInYear = Order::whereBetween('created_at', [$start_year, $end_year])->where('shipping_status', 3);
        $count = $orderInMonth->count();
        $order = $orderInMonth->get();
        $count2 = $orderInYear->count();
        $order2 = $orderInYear->get();
        $no_process_count = Order::where('shipping_status', 0)->count();
        $delivering_count = Order::where('shipping_status', 2)->count();
        $total = 0;
        $totalInYear = 0;
        $category = Category::get();
        $product = Product::get();
        $size = SizeProduct::get();
        $order_de = DB::table('order_details')->select(
            'order_details.name as name',
            DB::raw('COUNT(order_details.name) as quantity , SUM(order_details.price) as total')
        )
            ->rightJoin('orders', 'order_details.order_id', '=', 'orders.id')
            ->groupBy('order_details.name')
            ->whereBetween('orders.created_at', [$start, $end])->where('orders.shipping_status', 3)
            ->orderBy('quantity','desc')
            ->take(4)
            ->get();
        foreach ($order as $key => $value) {
            $total += $value->total;
        };
        foreach ($order2 as $key => $value) {
            $totalInYear += $value->total;
        };
        return view('admin.index.index', compact('count', 'order_de', 'year', 'total', 'totalInYear','end' ,'count2', 'no_process_count', 'delivering_count', 'category', 'cate', 'order_detail', 'product', 'size'));
    }
    function getData(Request $req, Category $cate, OrderDetail $order_detail)
    {
        $req->session()->put('time1', $req->time1);
        $req->session()->put('time2', $req->time2);
        if ($req->time1 > $req->time2) {
            $start = $req->time2;
            $end = $req->time1;
        } else {
            $start = $req->time1;
            $end = $req->time2;
        }
        $time = getdate();
        $month = $time["mon"];
        $year = $time["year"];
        $start_year = $year . '-' . '1-1';
        $end_year = $year . '-' . '12-31';
        $orderInMonth = Order::whereBetween('created_at', [$start, $end])->where('shipping_status', 3);
        $orderInYear = Order::whereBetween('created_at', [$start_year, $end_year])->where('shipping_status', 3);
        $count = $orderInMonth->count();
        $order = $orderInMonth->get();
        $count2 = $orderInYear->count();
        $order2 = $orderInYear->get();
        $no_process_count = Order::where('shipping_status', 0)->whereBetween('created_at', [$start, $end])->count();
        $delivering_count = Order::where('shipping_status', 2)->whereBetween('created_at', [$start, $end])->count();
        $total = 0;
        $totalInYear = 0;
        $category = Category::get();
        $product = Product::get();
        $size = SizeProduct::get();
        $order_de = DB::table('order_details')->select(
            'order_details.name as name',
            DB::raw('COUNT(order_details.name) as quantity , SUM(order_details.price) as total')
        )
            ->rightJoin('orders', 'order_details.order_id', '=', 'orders.id')
            ->groupBy('order_details.name')
            ->whereBetween('orders.created_at', [$start, $end])->where('orders.shipping_status', 3)
            ->orderBy('quantity','desc')
            ->take(4)
            ->get();
        foreach ($order as $key => $value) {
            $total += $value->total;
        };
        foreach ($order2 as $key => $value) {
            $totalInYear += $value->total;
        };
        return view('admin.index.index', compact('count', 'year', 'order_de', 'total', 'totalInYear', 'count2', 'no_process_count', 'delivering_count', 'category', 'cate', 'order_detail', 'product', 'size'));
    }
    function login()
    {
        return view('admin.account.signin');
    }
    function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
    function order(Request $req, ShippingMethod $method)
    {
        $filter = $req->value;
        $req->session()->put('order', $filter);
        if ($filter == 'new') {
            $order = Order::orderBy('id', 'desc')->get();
        } else if ($filter == 'paid') {
            $order = Order::where('order_status', 1)->orderBy('id', 'desc')->get();
        } else if ($filter == 'unpaid') {
            $order = Order::where('order_status', 0)->orderBy('id', 'desc')->get();
        } else if ($filter == 'noprocess') {
            $order = Order::where('shipping_status', 0)->orderBy('id', 'desc')->get();
        } else if ($filter == 'processed') {
            $order = Order::where('shipping_status', 1)->orderBy('id', 'desc')->get();
        } else if ($filter == 'delivering') {
            $order = Order::where('shipping_status', 2)->orderBy('id', 'desc')->get();
        } else if ($filter == 'delivered') {
            $order = Order::where('shipping_status', 3)->orderBy('id', 'desc')->get();
        } else if ($filter == 'cancelled') {
            $order = Order::where('shipping_status', 4)->orderBy('id', 'desc')->get();
        }
        return view('admin.order.index', compact('order', 'method'));
    }
    function post_login(Request $req)
    {
        $req->session()->put('password', $req->password);
        $req->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => "email Not Null",
                'password.required' => "password Not Null",
            ]
        );
        if (Auth::attempt($req->only('email', 'password'))) {
            if (Auth::user()->role == 1) {
                return redirect()->route("index_admin");
            } else {
                $alert = "Email or password is incorrect";
                return redirect()->back()->with('alert', $alert);
            }
        } else {
            $alert = "Email or password is incorrect";
            return redirect()->back()->with('alert', $alert);
        }
    }
    function comment()
    {
        $comment = Comment::get();
        return view('admin.comment.index', compact('comment'));
    }
    function removecomment($id)
    {
        RepComment::where('comment_id', $id)->delete();
        Comment::find($id)->delete();
        return redirect()->back();
    }
    function accept($id)
    {
        Comment::find($id)->update([
            'status' => 1
        ]);
        return redirect()->back();
    }
    function order_filter(Request $req, ShippingMethod $method)
    {
        $filter = $req->input('filter');
        if ($filter == 'new') {
            $order = Order::orderBy('id', 'desc')->get();
        } else if ($filter == 'paid') {
            $order = Order::where('order_status', 1)->orderBy('id', 'desc')->get();
        } else if ($filter == 'unpaid') {
            $order = Order::where('order_status', 0)->orderBy('id', 'desc')->get();
        } else if ($filter == 'noprocess') {
            $order = Order::where('shipping_status', 0)->orderBy('id', 'desc')->get();
        } else if ($filter == 'processed') {
            $order = Order::where('shipping_status', 1)->orderBy('id', 'desc')->get();
        } else if ($filter == 'delivering') {
            $order = Order::where('shipping_status', 2)->orderBy('id', 'desc')->get();
        } else if ($filter == 'delivered') {
            $order = Order::where('shipping_status', 3)->orderBy('id', 'desc')->get();
        } else if ($filter == 'cancelled') {
            $order = Order::where('shipping_status', 4)->orderBy('id', 'desc')->get();
        }
        return view('admin.order.filterOrder', compact('order', 'method'));
    }
    function update_order(Request $req)
    {
        $id = $req->input('id');
        $shipping_status = $req->input('shipping_status');
        $order_status = $req->input('order_status');
        Order::find($id)->update([
            'shipping_status' => $shipping_status,
            'order_status' => $order_status
        ]);
    }
    function profile(Request $req)
    {
        return view('admin.profile.index');
    }
    function update_admin(UpdateProfileAdminRequest $req)
    {
        User::find(Auth::user()->id)->update([
            'name' => $req->name,
            'email' => Auth::user()->email,
            'password' => Hash::make($req->password),
            'phone' => $req->phone,
            'address' => $req->address,
            'birthday' => $req->birthday
        ]);
        return redirect()->back();
    }
}
