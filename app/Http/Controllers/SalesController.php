<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Product;

class SalesController extends Controller
{
    public function store(Request $request)
    {
        $sale = Sales::create([
            'sale_date' => now(),
            'total_amount' => $request->input('total_amount'),
        ]);

        foreach ($request->input('items') as $item) {
            $product = Product::find($item['product_id']);
            $sale->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $product->price,
                'total_price' => $item['quantity'] * $product->price,
            ]);
        }

        return response()->json($sale);
    }
}
