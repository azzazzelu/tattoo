<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'full_name' => 'required',
        //     'phone' => 'nullable|regex:/^\+?[0-9]{10,15}$/|required',
        //     'email' => 'nullable|email',
        //     'city' => 'nullable|string|required',
        //     'street' => 'nullable|string|required',
        //     'house_number' => 'nullable|string|required',
        //     'apartment_office' => 'nullable|string',
        //     'entrance' => 'nullable|numeric',
        //     'floor' => 'nullable|numeric',
        //     'intercom_code' => 'nullable|string',
        //     'total_quantity' => 'numeric|required',
        //     'total_amount' => 'numeric|required',
        //     'payment_method' => 'in:cash,card,online|required',
        //     'delivery_type' => 'in:Post_russia,courier|required'

        // ]);
        $validatedData = $request->validate([
            'intercom_data' => 'required|max:255',
            'floor_data' => 'required|max:255',
            'entrance_data' => 'required|max:255',
            'apartmentOffice_data' => 'required|max:255',
            'streetHouse_data' => 'required',
            'city_data' => 'required',
            'emailAddress_data' => 'required',
            'phoneNumber_data' => 'required',
            'fullName_data' => 'required',
            'allQuantity' => 'required',
            'allTotal' => 'required',
            'payment_method' => 'required|string',
            'delivery_method' => 'required|string',
        ]);
        // dump($validatedData);
        // dd($validatedData);
        $order = new Order();
        $order->fill($validatedData);
        $order->save();
        $userId = Auth::user()->id;
        $cartItems = CartItem::where('user_id', $userId)->get();

        // Переносим данные в архивную таблицу
        foreach ($cartItems as $item) {
            OrderItem::create([
                'product_id' => $item->product_id,
                'user_id' => $item->user_id,
                'quantity' => $item->quantity,
                // Добавляйте остальные поля, которые нужно перенести
            ]);
        }
        CartItem::where('user_id', $userId)->delete();
        // dd('hahaha');
        // Получаем товары из корзины
        // $cartItems = Session::get('cart', []);

        // foreach ($cartItems as $item) {
        //     $orderItem = new OrderItem();
        //     $orderItem->order_id = $order->id;
        //     $orderItem->product_id = $item['product_id'];
        //     $orderItem->quantity = $item['quantity'];
        //     $orderItem->unit_price = $item['price'];
        //     $orderItem->save();
        // }

        // // Рассчитываем итоговую сумму и количество товаров
        // $totalQuantity = array_sum(array_column($cartItems, 'quantity'));
        // $totalAmount = array_sum(array_map(function ($item) {
        //     return $item['quantity'] * $item['price'];
        // }, $cartItems));

        // $order->update(['total_quantity' => $totalQuantity, 'total_amount' => $totalAmount]);

        // // Очищаем корзину
        // Session::forget('cart');

        return redirect()->route('basket.index')->with('message', 'Заказ успешно оформлен!');
    }
}
