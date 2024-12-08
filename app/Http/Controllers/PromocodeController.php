<?php

namespace App\Http\Controllers;

use App\Models\Promocode;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    public function activate(Request $request)
    {
        $code = $request->input('code');

        if ($code) {
            $promocode = Promocode::where('code', $code)->first();

            if ($promocode && $promocode->is_active) {
                // Промокод найден и активен
                session()->put('discount', $promocode->discount_amount); // Сохраняем скидку в сессии
                return response()->json(['message' => 'Промокод успешно применён!'], 200);
            } else {
                return response()->json(['error' => 'Неверный промокод или он уже использован.'], 400);
            }
        } else {
            return response()->json(['error' => 'Не указан промокод.'], 400);
        }
    }
    public function index(Request $request)
    {
        $promoCodes = Promocode::all();
        // dd($promoCodes);
        return view('promoCodes.index', compact('promoCodes'));
    }
}
