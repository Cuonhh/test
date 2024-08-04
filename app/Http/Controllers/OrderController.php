<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['customer', 'products'])->latest()->paginate(10);
        return view('admin.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $customer = Customer::create($request->customer);
                $supplier = Supplier::create($request->supplier);
                $totalAmount = 0;
                $orderDetails = [];

                foreach ($request->products as $key => $product) {
                    $product['supplier_id'] = $supplier->id;
                    if ($request->hasFile("products.$key.image")) {
                        $product['image'] = Storage::put('products', $request->file("products.$key.image"));
                    }
                    $tmpProduct = Product::create($product);
                    $qty = $request->order_details[$key]['qty'];
                    $orderDetails[$tmpProduct->id] = [
                        'qty' => $qty,
                        'price' => $tmpProduct->price
                    ];
                    $totalAmount += $qty * $tmpProduct->price;
                }

                $order = Order::create([
                    'customer_id' => $customer->id,
                    'total_amount' => $totalAmount,
                ]);
                $order->products()->attach($orderDetails);
            });

            return redirect()->route('orders.index')->with('success', 'Thao tác thành công!');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['customer', 'products']);
        return view('admin.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $order->load(['customer', 'products']);
        return view('admin.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        try {
            DB::transaction(function () use ($order, $request) {
                $order->products()->sync($request->order_details);

                $totalAmount = collect($request->order_details)->sum(function ($item) {
                    return $item['price'] * $item['qty'];
                });

                $order->update(['total_amount' => $totalAmount]);
            });

            return back()->with('success', 'Thao tác thành công!');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        try {
            DB::transaction(function () use ($order) {
                $order->products()->detach();
                $order->delete();
            });

            return back()->with('success', 'Thao tác thành công!');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
