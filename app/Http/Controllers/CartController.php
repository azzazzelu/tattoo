<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Получаем ID продукта
        $productId = $request->input('product_id');

        // Проверяем, существует ли такой продукт
        if ($product = Products::find($productId)) {
            // Создаем новый элемент корзины или обновляем существующий
            $cartItem = CartItem::updateOrCreate(
                ['user_id' => Auth::id(), 'product_id' => $product->id],
                ['quantity' => DB::raw('quantity + 1')] // Увеличение количества на 1
            );

            return back()->with('message', 'Товар добавлен в корзину.');
        }

        return back()->withErrors(['error' => 'Продукт не найден']);
    }

    /**
     * Удаление товара из корзины
     *
     * @param int $itemId
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart($itemId)
    {
        $userId = Auth::user()->id;
        if ($cartItem = CartItem::where('user_id', $userId)->find($itemId)) {
            if ($cartItem->quantity == 1) {
                $cartItem->delete();
            } else {
                $cartItem->decrement('quantity');
            }
            return redirect()->route('basket.index')->with('message', 'Количество товара уменьшено.');
        }
        return redirect()->back()->withErrors(['error' => 'Элемент корзины не найден.']);
    }
    public function clearCart($itemId)
    {
        $userId = Auth::user()->id;

        // Получаем все элементы корзины текущего пользователя
        $cartItems = CartItem::where('user_id', $userId)->find($itemId);

        // Удаляем каждый элемент корзины
        $cartItems->delete();

        return redirect()->route('basket.index')->with('message', 'Товар убран из корзины.');
    }
    /**
     * Просмотр содержимого корзины
     */
    public function index()
    {
        $allQuantity = 0;
        $allTotal = 0;
        $Discount = session('discount') ?? 0; // Извлекаем скидку из сессии, если она существует
        $addServices = 0;

        $cartItems = CartItem::where('user_id', Auth::id())->get(); // Только товары текущего пользователя
        foreach ($cartItems as $item) {
            $allQuantity += $item->quantity;
            $allTotal += $item->quantity * $item->product->price;
        }
        if($Discount>0){
            $allTotal -= $allTotal * $Discount/100;
        }
        return view('basket.cart', compact('cartItems', 'allQuantity', 'allTotal', 'allTotal', 'addServices', 'Discount'));
    }
}
