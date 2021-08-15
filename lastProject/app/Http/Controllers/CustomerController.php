<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\UpdateProfileCustomerRequest;
use App\Mail\ChangePassword;
use App\Mail\EmailContact;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\city;
use App\Models\Comment;
use App\Models\commune;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\DeliveryPrice;
use App\Models\district;
use App\Models\Farmer;
use App\Models\imageProduct;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\RepComment;
use App\Models\Review;
use App\Models\Shipping;
use App\Models\ShippingMethod;
use App\Models\Size;
use App\Models\SizeProduct;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\CssSelector\Parser\Shortcut\HashParser;

class CustomerController extends Controller
{

    function index(Product $pro, Request $req, Wishlist $wish)
    {
        $req->session()->put('page', 'home');
        $banner = Banner::get();
        $count_banner = Banner::count();
        $brand = Brand::get();
        $blog = Blog::take(4)->get();
        $new = 0;
        $top3 = $pro->top3();
        $last3 = $pro->last3();
        $product = Product::get();
        $cateid = 0;
        $category = Category::get();
        foreach ($product as $item) {
            $new = $item->id;
        }
        $new = Product::find($new);
        foreach ($category as $items) {
            $cateid = $items->id;
        }
        $top3new = Product::orderBy('id', 'desc')->where('status', 0)->take(3)->get();
        $productByCate = Product::take(5)->get();
        return view('customer.page.index', compact('top3', 'product', 'category', 'productByCate', 'blog', 'pro', 'new', 'cateid', 'last3', 'top3new', 'wish', 'brand', 'banner', 'count_banner'));
    }
    function about(Request $req)
    {
        $req->session()->put('page', 'about');
        $brand = Brand::get();
        $farmer = Farmer::get();
        return view('customer.page.about', compact('brand', 'farmer'));
    }
    function store(Product $pro, Request $req, wishlist $wish)
    {
        $req->session()->put('page', 'store');
        $top3sale = Product::where('sale_price', '>', 0)->orderBy('sale_price', 'asc')->take(3)->get();
        $new = 0;
        $category = Category::get();
        $min = 0;
        $max = 100;
        $sort = '';
        $keyword = '';
        $productByCate = Product::orderBy('id', 'desc')->paginate(6);
        $top3 = $pro->top3();
        foreach (Product::get() as $item) {
            $new = $item->id;
        }
        $new = Product::find($new);
        if ($req->id != null) {
            $productByCate = $pro->getProByCate($req->id);
            $cate = Category::find($req->id);
            if ($cate != null) {
                $keyword = $cate->name;
            } else {
                $keyword = "all";
            }
        } else if ($req->price != null) {
            $data = explode(',', $req->price);
            $min = $data[0];
            $max = $data[1];
            $productByCate = $pro->getProByPrice($req->price);
            $keyword = $req->price;
        } else if ($req->sort != null) {
            $productByCate = $pro->sort($req->sort);
            $sort = $req->sort;
            $keyword = $req->sort;
        } else if ($req->keyword != null) {
            $productByCate = $pro->search($req->keyword);
            $keyword = $req->keyword;
        }
        return view('customer.page.store', compact('category', 'productByCate', 'top3', 'min', 'max', 'sort', 'pro', 'new', 'top3sale', 'wish', 'keyword'));
    }
    function getByCate(Request $req, Product $pro, wishlist $wish)
    {
        $new = 0;
        foreach (Product::get() as $item) {
            $new = $item->id;
        }
        $new = Product::find($new);
        $data = $pro->getProByCate($req->input('id'));
        return view('customer.master.filterProduct', compact('data', 'new', 'wish'));
    }
    function getCountWishList(Wishlist $wish)
    {
        $countwish = 0;
        if (Auth::check()) {
            $countwish = $wish->getCount(Auth::user()->id);
        }
        return $countwish;
    }
    function totalCart(Cart $cart)
    {
        $list = [];
        $total = 0;
        $total_price = 0;
        $total_sale = 0;
        if (Auth::check()) {
            $list = $cart->getCart(Auth::user()->id);
        }
        foreach ($list as $key => $value) {
            if ($value->sale_price > 0) {
                $total_sale += $value->sale_price * $value->quantity;
            } else {
                $total_price += $value->price * $value->quantity;
            }
        }
        $total = $total_price + $total_sale;
        return "Total: $" . $total;
    }
    function countCart(Cart $cart)
    {
        $list = 0;
        $count = 0;
        if (Auth::check()) {
            $list = $cart->getCart(Auth::user()->id);
        }
        foreach ($list as $key => $value) {
            $count++;
        }
        return $count;
    }
    function getBySort(Request $req, Product $pro, wishlist $wish)
    {
        $new = 0;
        foreach (Product::get() as $item) {
            $new = $item->id;
        }
        $new = Product::find($new);
        $data = $pro->sort($req->input('value'));
        return view('customer.master.filterProduct', compact('data', 'new', 'wish'));
    }
    function getbyPrice(Request $req, Product $pro, wishlist $wish)
    {
        $new = 0;
        foreach (Product::get() as $item) {
            $new = $item->id;
        }
        $new = Product::find($new);
        $data = $pro->getProByPrice($req->input('value'));
        return view('customer.master.filterProduct', compact('data', 'new', 'wish'));
    }
    function productdetail(Product $pro, $id, Wishlist $wish, User $user)
    {
        $reviews = Review::where('product_id', $id)->get();
        $count_reviews = Review::where('product_id', $id)->count();
        $star = 0;
        $favo = 0;
        $count = 0;
        if (Auth::check()) {
            $count = Review::where('product_id', $id)->where('user_id', Auth::user()->id)->count();
            $old_review = Review::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
        }
        if ($count == 0) {
            $old_star = 3;
        } else {
            $old_star = $old_review->rating;
        }
        $favo = Wishlist::where('product_id', $id)->count();
        $check_order = [];
        $check_count_order = 0;
        $check_exist = false;
        if (Auth::check()) {
            $check_order = Order::where('user_id', Auth::user()->id)->get();
            $check_count_order = Order::where('user_id', Auth::user()->id)->count();
        }
        if ($check_count_order > 0) {
            foreach ($check_order as $key => $value) {
                $order_detail  = OrderDetail::where('order_id', $value->id)->get();
                foreach ($order_detail as $key => $value2) {
                    $size = SizeProduct::where('id',$value2->size_product_id)->get();
                    foreach ($size as $key => $value3) {
                        if($value3->product_id == $id){
                            $check_exist = true;
                        }
                    }
                }
            }
        }
        foreach ($reviews as $item) {
            $star += $item->rating;
        }
        if ($count_reviews == 0) {
            $value = 0;
        } else {
            $value = $star / $count_reviews;
        }

        $size = SizeProduct::where('product_id')->get();
        $product = $pro->getbyid($id);
        $image = imageProduct::where('product_id', $id)->get();
        $size = SizeProduct::where('product_id', $id)->get();
        $productRelated = $pro->productRelated($product->category_id);
        return view('customer.page.productdetail', compact('product', 'image', 'user', 'size', 'productRelated', 'value', 'reviews', 'pro', 'count_reviews', 'size', 'favo', 'wish', 'old_star', 'check_exist'));
    }
    function blog(Blog $bl, Category $cate, Request $req)
    {
        $req->session()->put('page', 'blog');
        $blog = Blog::paginate(3);
        $top3blog = Blog::take(3)->get();
        $category = Category::get();
        return view('customer.page.blog', compact('blog', 'bl', 'top3blog', 'cate', 'category'));
    }
    function blog_search(Blog $bl, Category $cate, Request $req)
    {
        $name = $req->name;
        $req->session()->put('page', 'blog');
        $blog = Blog::where('title', 'like', "%" . $name . "%")->paginate(3);
        $top3blog = Blog::take(3)->get();
        $category = Category::get();
        return view('customer.page.blog', compact('blog', 'bl', 'top3blog', 'cate', 'category'));
    }
    function blogdetail($id, Blog $bl, Product $pro)
    {
        $count = 0;
        if (Auth::check()) {
            $comment = Comment::where('blog_id', $id)->where('status', 1)->where('status', 1)->orWhere('blog_id', $id)->get();
            $count =  Comment::where('blog_id', $id)->where('user_id', Auth::user()->id)->where('status', 1)->orWhere('blog_id', $id)->count();
        } else {
            $comment = Comment::where('blog_id', $id)->where('blog_id', $id)->where('status', 1)->get();
            $count = Comment::where('blog_id', $id)->where('blog_id', $id)->where('status', 1)->count();
        }
        $category = Category::get();
        $countRep  = RepComment::count();
        $pro_sale = Product::where('sale_price', '>', 0)->get();
        $blog = Blog::find($id);
        $related = Blog::where('id', '!=', $id)->take(3)->get();
        return view('customer.page.blogdetail', compact('blog', 'related', 'pro_sale', 'comment', 'count', 'bl', 'countRep', 'category', 'pro'));
    }
    function contact(Request $req)
    {
        $req->session()->put('page', 'contact');
        return view('customer.page.contact');
    }
    function login(Request $req)
    {
        $page = '';
        if ($req->page != null) {
            $page = $req->page;
        }
        return view('customer.account.login', compact('page'));
    }
    function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
    function login_post(Request $req)
    {
        $req->session()->put('check_post', 'login');
        $req->session()->put('password', $req->password);
        $req->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'name.required' => "Eamil Can Not Null",
                'password.required' => "Password Can Not Null"
            ]
        );
        $array = [];
        if ($req->page != null) {
            $array = explode("=", $req->page);
        }
        if (Auth::attempt($req->only('email', 'password'))) {
            if ($req->page != null) {
                if (count($array) == 1) {
                    return redirect()->route($array[0]);
                } else {
                    return redirect()->route($array[0], $array[1]);
                }
            } else {
                return redirect()->route('index');
            }
        } else {
            $alert = "Email or password is incorrect";
            return redirect()->back()->with('alert', $alert);
        }
    }
    function register_post(Request $req)
    {
        $req->session()->put('check_post', 'register');
        $req->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|unique:users|max:255|min:5',
                'password' => 'required|max:255|min:6',
                'cf_password' => 'same:password'
            ],
            [
                'name.required' => 'Name  Not Null',
                'email.unique' => 'Email is existed',
                'password.required' => 'password not null',
                'password.min' => 'Password must be greater than 6 character ',
                'cf_password.same' => 'Confirm Password incorrect'
            ]
        );
        $alert = "Successful Create";
        $color = 'Primary';
        $register = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password)
        ]);
        $alert = "Register Success";
        return redirect()->route('login')->with('alert', $alert);
    }
    function comment(Request $req)
    {
        Comment::create([
            'comment' => $req->comment,
            'user_id' => $req->user_id,
            'blog_id' => $req->blog_id
        ]);
        return redirect()->back();
    }
    function rep(Request $req)
    {
        RepComment::create([
            'reply' => $req->reply,
            'user_id' => $req->user_id,
            'comment_id' => $req->comment_id
        ]);
        return redirect()->back();
    }
    function vote(Request $req)
    {
        $count = 0;
        if (Auth::check()) {
            $count = Review::where('product_id', $req->product_id)->where('user_id', Auth::user()->id)->count();
        }
        if (Auth::check()) {
            if ($count == 0) {
                $reviews = Review::create([
                    'reviews' => $req->reviews,
                    'rating' => $req->rating,
                    'product_id' => $req->product_id,
                    'user_id' => Auth::user()->id
                ]);
            } else {
                $update_reviews = Review::where('product_id', $req->product_id)->where('user_id', Auth::user()->id)->update([
                    'reviews' => $req->reviews,
                    'rating' => $req->rating,
                    'product_id' => $req->product_id,
                    'user_id' => Auth::user()->id
                ]);
            }
        }
        return redirect()->back();
    }
    function wishlist(Request $req)
    {
        $req->session()->put('page', 'wishlist');
        $wish = [];
        if (Auth::check()) {
            $wish = Wishlist::where('user_id', Auth::user()->id)->get();
        }
        return view('customer.page.wishlist', compact('wish'));
    }
    function addWishlist(Request $req)
    {
        $id = $req->input('id');
        $exits = Wishlist::where('product_id', $id)->where('user_id', Auth::user()->id)->count();
        if (Auth::check()) {
            if ($exits > 0) {
                Wishlist::where('product_id', $id)->where('user_id', Auth::user()->id)->delete();
            } else {
                Wishlist::create([
                    'product_id' => $id,
                    'user_id' => Auth::user()->id
                ]);
            }
        }
    }
    function removewish(Request $req)
    {
        $id = $req->input('id');
        if (Auth::check()) {
            Wishlist::where('product_id', $id)->where('user_id', Auth::user()->id)->delete();
        }
    }
    function cart(Cart $c, Request $req)
    {
        $req->session()->put('page', 'cart');
        $req->session()->forget('shipping_method');
        $req->session()->forget('name');
        $req->session()->forget('matp');
        $req->session()->forget('maqp');
        $req->session()->forget('xaid');
        $req->session()->forget('shipp');
        $req->session()->forget('coupon');
        $city = city::get();
        $cart = [];
        if (Auth::check()) {
            $cart = $c->getCart(Auth::user()->id);
            $count_Cart = Cart::where('user_id', Auth::user()->id)->count();
        }
        $shipping_method = ShippingMethod::get();
        $total = 0;
        foreach ($cart as $key => $value) {
            if ($value->total2 == 0) {
                $total += $value->total1;
            } else {
                $total += $value->total2;
            }
        }
        return view('customer.page.cart', compact('cart', 'c', 'total', 'city', 'shipping_method', 'count_Cart'));
    }
    function addCart(Request $req)
    {
        $id = $req->input('id');
        $size = 0;
        $sizeProduct = SizeProduct::where('product_id', $id)->get();
        foreach ($sizeProduct as $key => $value) {
            $size = $value->size_id;
        };
        if (Auth::check()) {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $id,
                'size_id' => $size
            ]);
        }
        return view('customer.page.subcart');
    }
    function updateCart(Request $req, Cart $cart)
    {
        if (Auth::check()) {
            $count = $req->count;
            Cart::where('user_id', Auth::user()->id)->delete();
            for ($i = 0; $i < $count; $i++) {
                for ($j = 0; $j < $req->quantity[$i]; $j++) {
                    Cart::create([
                        'product_id' => $req->product_id[$i],
                        'size_id' => $req->size_id[$i],
                        'user_id' => Auth::user()->id
                    ]);
                }
            }
        }
        return redirect()->back();
    }
    function removeCart(Request $req)
    {
        $proId = $req->input('proId');
        $sizeId = $req->input('sizeId');
        if (Auth::check()) {
            Cart::where('user_id', Auth::user()->id)->where('product_id', $proId)->where('size_id', $sizeId)->delete();
        }
    }
    function removeAllCart()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::user()->id)->delete();
        }
    }
    function addProdetail(Request $req)
    {
        $product_id = $req->input('product_id');
        $size_id = $req->input('size_id');
        $quantt = $req->input('quantt');
        if (Auth::check()) {
            for ($i = 0; $i < $quantt; $i++) {
                Cart::create([
                    'product_id' => $product_id,
                    'size_id' => $size_id,
                    'user_id' => Auth::user()->id
                ]);
            }
        }
        return view('customer.page.subcart');
    }
    function profile(Request $req)
    {
        $req->session()->put('page', 'profile');

        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
        }
        return view('customer.page.viewprofile', compact('user'));
    }
    function updateProfile(UpdateProfileCustomerRequest $req)
    {
        $array = explode('-', $req->birthday);
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            $email = $user->email;
            if ($req->name == null) {
                $name = $user->name;
            } else {
                $name = $req->name;
            };
            if ($req->password == null) {
                $password = $user->password;
            } else {
                $password = Hash::make($req->password);
            };
            if ($req->phone == null) {
                $phone = $user->phone;
            } else {
                $phone = $req->phone;
            };
            if ($req->address == null) {
                $address = $user->address;
            } else {
                $address = $req->address;
            };
            if ($req->has('file')) {
                $file =  $req->file;
                $file_name = $file->getClientOriginalName();
                $file->move(public_path('uploads'), $file_name);
            } else {
                $file_name = $user->avatar;
            }
            if (getdate()["year"] - $array[0] > 13) {
                $birthday = $req->birthday;
            } else {
                $birthday = $user->birthday;
            }
        }
        if ($req->password == null) {
            User::find(Auth::user()->id)->update([
                'name' => $name,
                'phone' => $phone,
                'address' => $address,
                'birthday' => $birthday,
                'avatar' => $file_name,
                'email' => $email
            ]);
        } else {
            User::find(Auth::user()->id)->update([
                'name' => $name,
                'password' => $password,
                'phone' => $phone,
                'address' => $address,
                'birthday' => $birthday,
                'avatar' => $file_name,
                'email' => $email
            ]);
        }

        return redirect()->back();
    }
    function post_contact(ContactRequest $req)
    {
        Contact::create([
            'name' => $req->name,
            'phone' => $req->phone,
            'email' => $req->email,
            'comment' => $req->comment
        ]);
        $form_contact = $_SESSION["form_contact"] = $req;
        Mail::to($req->email)->send(new EmailContact());
        unset($_SESSION["form_contact"]);
        return redirect()->back();
    }
    function getCoupon(Request $req, Cart $cart)
    {
        $coupon = $req->input('coupon');
        $total = 0;
        $listcart = [];
        if (Auth::check()) {
            $listCart = $cart->getCart(Auth::user()->id);
        }
        foreach ($listCart as $key => $value) {
            if ($value->total2 == 0) {
                $total += $value->total1;
            } else {
                $total += $value->total2;
            }
        }
        $condition = Coupon::where('code', $coupon)->first()->condition;
        $quantity = Coupon::where('code', $coupon)->first()->quantity;
        if ($quantity > 0) {
            if ($condition == 1) {
                $value = Coupon::where('code', $coupon)->first()->value . '%';
                $req->session()->put('coupon', $coupon);
            } else {
                $value = Coupon::where('code', $coupon)->first()->value;
                if ($value > $total) {
                    return 'false';
                } else {
                    $value = Coupon::where('code', $coupon)->first()->value . '$';
                    $req->session()->put('coupon', $coupon);
                }
            }
        } else {
            $value = 0 . "$";
        }
        return $value;
    }
    function getDistricts(Request $req)
    {
        $matp = $req->input('matp');
        $district = district::where('matp', $matp)->get();
        return view('customer.master.select', compact('district'));
    }
    function getCommunes(Request $req)
    {
        $maqh = $req->input('maqh');
        $commune = commune::where('maqh', $maqh)->get();
        return view('customer.master.select2', compact('commune'));
    }
    function ship(Request $req)
    {
        $matp = $req->input('matp');
        $maqh = $req->input('maqh');
        $xaid = $req->input('xaid');
        $shipp = $req->input('shipp');
        $shipping_method = $req->input('shipping_method');
        $price_ship = DeliveryPrice::where('xaid', $xaid)->first()->price;
        $req->session()->put('matp', $matp);
        $req->session()->put('maqh', $maqh);
        $req->session()->put('xaid', $xaid);
        $req->session()->put('shipp', $shipp);
        $req->session()->put('shipping_method', $shipping_method);
        $shipping_method_price = ShippingMethod::find($shipping_method)->price;
        if ($shipp == '') {
            return $price_ship * $shipping_method_price;
        } else {
            $count = Shipping::where('name', $shipp)->where('status', 0)->count();
            $price = Shipping::where('name', $shipp)->first()->price;
            if ($count == 0) {
                return $price_ship * $shipping_method_price;
            } else {
                return $price_ship * $shipping_method_price - $price;
            }
        }
    }
    function totalamount(Request $req, Cart $cart)
    {
        $total = 0;
        $coupon = session()->get("coupon");
        $shipp = session()->get("shipp");
        $xaid = session()->get("xaid");
        if (session()->has("shipping_method")) {
            $shipping_method_id = session()->get("shipping_method");
        } else {
            $shipping_method_id = 0;
        }
        $check_count =  $shipping_method_price = ShippingMethod::where('id', $shipping_method_id)->count();
        if ($check_count > 0) {
            $shipping_method_price = ShippingMethod::find($shipping_method_id)->price;
        } else {
            $shipping_method_price = 0;
        }
        if (DeliveryPrice::where('xaid', $xaid)->count() > 0) {
            $delivery = DeliveryPrice::where('xaid', $xaid)->first()->price * $shipping_method_price;
        } else {
            $delivery = 0;
        }
        $count_coupon = Coupon::where('code', $coupon)->where('quantity', '>', 0)->count();
        $count_shipp = Shipping::where('name', $shipp)->where('status', 0)->count();
        if (Auth::check()) {
            $listCart = $cart->getCart(Auth::user()->id);
        }
        foreach ($listCart as $key => $value) {
            if ($value->total2 == 0) {
                $total += $value->total1;
            } else {
                $total += $value->total2;
            }
        }
        if ($count_coupon > 0) {
            $condition = Coupon::where('code', $coupon)->first()->condition;
            $check_quantity = Coupon::where('code', $coupon)->first()->quantity;
            if ($check_quantity > 0) {
                if ($condition == 0) {
                    if (Coupon::where('code', $coupon)->first()->value > $total) {
                        $total = $total;
                    } else {
                        $total = $total - Coupon::where('code', $coupon)->first()->value;
                    }
                } else {
                    $total = $total - $total * Coupon::where('code', $coupon)->first()->value / 100;
                }
            }
        }
        if ($count_shipp > 0) {
            $price = Shipping::where('name', $shipp)->first()->price;
        } else {
            $price = 0;
        }
        $total = $total + $delivery - $price;
        return "$" . $total;
    }
    function checkout(Cart $c, Request $req)
    {
        $check_cart = 0;
        if (Auth::check()) {
            $check_cart = Cart::where('user_id', Auth::user()->id)->count();
        }
        if ($check_cart == 0) {
            return redirect()->route('cart');
        }
        $req->session()->put('page', 'checkout');
        $alert = 'Please choose your address';
        $user = [];
        $cart = [];
        if (!session()->has("xaid")) {
            return redirect()->back()->with('alert', $alert);
        }
        $coupon = session()->get("coupon");
        $shipp = session()->get("shipp");
        $xaid = session()->get("xaid");
        $matp = session()->get('matp');
        $maqh = session()->get('maqh');
        $shipping_method_id = session()->get('shipping_method');
        $shipping_method_price = ShippingMethod::find($shipping_method_id)->price;
        $city = city::get();
        $qh = district::get();
        $xa = commune::get();
        $total = 0;
        $shipping_method = ShippingMethod::get();
        $delivery = DeliveryPrice::where('xaid', $xaid)->first()->price * $shipping_method_price;
        $ship_count = Shipping::where('name', $shipp)->where('status', 0)->count();
        $coupon_count = Coupon::where('code', $coupon)->where('quantity', '>', 0)->count();
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->first();
            $cart = $c->getCart(Auth::user()->id);
        }
        foreach ($cart as $key => $value) {
            if ($value->total2 == 0) {
                $total += $value->total1;
            } else {
                $total += $value->total2;
            }
        }
        $last_total = $total;

        if ($ship_count > 0) {
            $price_ship = Shipping::where('name', $shipp)->first()->price;
        } else {
            $price_ship = 0;
        }

        if ($coupon_count > 0) {
            $price_coupon = Coupon::where('code', $coupon)->first()->value;
            $condition = Coupon::where('code', $coupon)->first()->condition;
            if ($condition == 0) {
                $price_coupon = "$" . " " . Coupon::where('code', $coupon)->first()->value;
                $value = Coupon::where('code', $coupon)->first()->value;
                $last_total = $last_total - $value;
            } else {
                $price_coupon = Coupon::where('code', $coupon)->first()->value . "%";
                $value = Coupon::where('code', $coupon)->first()->value;
                $last_total = $last_total - $last_total * $value / 100;
            }
        } else {
            $price_coupon = "$0";
        }
        $last_total = $last_total + $delivery;
        $last_total = $last_total - $price_ship;
        return view('customer.page.checkout', compact('user', 'city', 'qh', 'xa', 'matp', 'maqh', 'xaid', 'qh', 'xa', 'cart', 'total', 'delivery', 'price_coupon', 'price_ship', 'last_total', 'shipping_method', 'shipping_method_id'));
    }
    function post_order(OrderRequest $req, Cart $c)
    {
        $coupon = session()->get("coupon");
        $shipp = session()->get("shipp");
        $xaid = session()->get("xaid");
        $matp = session()->get('matp');
        $maqh = session()->get('maqh');
        $ship_count = Shipping::where('name', $shipp)->where('status', 0)->count();
        $coupon_count = Coupon::where('code', $coupon)->where('quantity', '>', 0)->count();
        if ($ship_count > 0) {
            Shipping::where('name', $shipp)->update([
                'status' => 1
            ]);
        }
        if ($coupon_count > 0) {
            $coupon = Coupon::where('code', $coupon)->first();
            if ($coupon->quantity > 1) {
                $coupon->update([
                    'quantity' => $coupon->quantity - 1
                ]);
            } elseif ($coupon->quantity == 1) {
                $coupon->update([
                    'quantity' => 0,
                    'status' => 1
                ]);
            }
        }
        $shipping_method_id = session()->get('shipping_method');
        $city = city::where('matp', $matp)->first()->name;
        $districts = district::where('maqh', $maqh)->first()->name;
        $commune = commune::where('xaid', $xaid)->first()->name;
        $address = $commune . " - " . $districts . " - " . $city;
        $quantity_cart = Cart::where('user_id', Auth::user()->id)->count();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'name' => $req->name,
            'email' => $req->email,
            'payment_methods' => $req->order_method,
            'phone' => $req->phone,
            'address' => $address,
            'note' => $req->note,
            'shipping_method_id' => $shipping_method_id,
            'shipping_status' => 0,
            'quantity' => $quantity_cart,
            'order_status' => $req->order_method,
            'total' => $req->total
        ]);
        foreach ($cart as $key => $value) {
            $size_product_id = SizeProduct::where('product_id', $value->product_id)->where('size_id', $value->size_id)->first();
            OrderDetail::create([
                'order_id' => $order->id,
                'price' => Product::find($value->product_id)->sale_price > 0 ? Product::find($value->product_id)->sale_price : Product::find($value->product_id)->price,
                'name' => Product::find($value->product_id)->name,
                'size_product_id' => $size_product_id->id,
                'image' => Product::find($value->product_id)->image
            ]);
        }
        Cart::where('user_id', Auth::user()->id)->delete();
        return redirect()->route('store');
    }
    function banking(Request $req)
    {
        $name = $req->input('name');
        $email = $req->input('email');
        $phone = $req->input('phone');
        $total = $req->input('total');
        $note = $req->input('note');
        if (Auth::check()) {
            $info = User::find(Auth::user()->id);
        }
        if ($name == '') {
            $name = $info->name;
        }
        if ($email == '') {
            $email = $info->email;
        }
        if ($phone == '') {
            $phone = $info->phone;
        }
        $order_method = $req->input('order_method');
        $coupon = session()->get("coupon");
        $shipp = session()->get("shipp");
        $xaid = session()->get("xaid");
        $matp = session()->get('matp');
        $maqh = session()->get('maqh');
        $ship_count = Shipping::where('name', $shipp)->where('status', 0)->count();
        $coupon_count = Coupon::where('code', $coupon)->where('quantity', '>', 0)->count();
        if ($ship_count > 0) {
            Shipping::where('name', $shipp)->update([
                'status' => 1
            ]);
        }
        if ($coupon_count > 0) {
            $coupon = Coupon::where('code', $coupon)->first();
            if ($coupon->quantity > 1) {
                $coupon->update([
                    'quantity' => $coupon->quantity - 1
                ]);
            } elseif ($coupon->quantity == 1) {
                $coupon->update([
                    'quantity' => 0,
                    'status' => 1
                ]);
            }
        }
        $shipping_method_id = session()->get('shipping_method');
        $city = city::where('matp', $matp)->first()->name;
        $districts = district::where('maqh', $maqh)->first()->name;
        $commune = commune::where('xaid', $xaid)->first()->name;
        $address = $commune . " - " . $districts . " - " . $city;
        $quantity_cart = Cart::where('user_id', Auth::user()->id)->count();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'name' => $name,
            'email' => $email,
            'payment_methods' => $order_method,
            'phone' => $phone,
            'address' => $address,
            'note' => $note,
            'shipping_method_id' => $shipping_method_id,
            'shipping_status' => 0,
            'quantity' => $quantity_cart,
            'order_status' => $order_method,
            'total' => $total
        ]);
        foreach ($cart as $key => $value) {
            $size_product_id = SizeProduct::where('product_id', $value->product_id)->where('size_id', $value->size_id)->first();
            OrderDetail::create([
                'order_id' => $order->id,
                'price' => Product::find($value->product_id)->sale_price > 0 ? Product::find($value->product_id)->sale_price : Product::find($value->product_id)->price,
                'name' => Product::find($value->product_id)->name,
                'size_product_id' => $size_product_id->id,
                'image' => Product::find($value->product_id)->image
            ]);
        }
        Cart::where('user_id', Auth::user()->id)->delete();
    }
    function order_tracking(Request $req, ShippingMethod $shipping_method)
    {
        $order = [];
        if (Auth::check()) {
            $order = Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        }
        return view('customer.page.ordered', compact('order', 'shipping_method'));
    }
    function order_tracking_detail($id)
    {
        $order_detail = DB::table('order_details')->select(
            'name',
            'image',
            DB::raw('sum(price) as price , count(size_product_id) as quantity')
        )
            ->groupBy('size_product_id', 'name', 'image')
            ->where('order_id', $id)
            ->get();
        return view('customer.page.orderDetail', compact('order_detail'));
    }
    function forgot_password(Request $req)
    {
        return view('customer.page.forgotpassword');
    }
    function forgot_post(Request $req)
    {
        $check = User::where('email', $req->email)->count();
        if ($check == 0) {
            return redirect()->back()->with('alert', 'Email does Not Exist');
        } else {
            $code = mt_rand(100000, 999999);
            $req->session()->put('code', $code);
            $id = User::where('email', $req->email)->first()->id;
            $req->session()->put('id_email', $id);
            Mail::to($req->email)->send(new ChangePassword());
            $req->session()->put('step1', 'ok');
            return redirect()->route('typecode');
        }
    }
    function typecode(Request $req)
    {
        if ($req->session()->has('step1')) {
        } else {
            return redirect()->route('login');
        }
        return view('customer.page.typecode');
    }
    function postcode(Request $req)
    {
        if ($req->code == session()->get('code')) {
            $req->session()->put('step2', 'ok');
            return redirect()->route('changepassword');
        } else {
            return redirect()->back()->with('alert', 'The code is not correct');
        }
    }
    function changepassword(Request $req)
    {
        if ($req->session()->has('step2')) {
        } else {
            return redirect()->route('login');
        }

        return view('customer.page.changepassword');
    }
    function post_password(Request $req)
    {
        $req->validate(
            [
                'password' => 'required|max:255|min:6',
                'cf_password' => 'same:password'
            ],
            [
                'password.required' => 'password not null',
                'password.min' => 'Password must be greater than 6 character ',
                'cf_password.same' => 'Confirm Password incorrect'
            ]
        );
        $email_id = session('id_email');
        User::find($email_id)->update([
            'password' => Hash::make($req->password)
        ]);
        $req->session()->put('step3', 'ok');
        return redirect()->route('success');
    }
    function success(Request $req){
        if ($req->session()->has('step3')) {
        } else {
            return redirect()->route('login');
        }
        $req->session()->flush();
        return view('customer.page.success');
    }
}
