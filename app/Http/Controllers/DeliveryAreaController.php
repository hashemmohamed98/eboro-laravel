<?php
namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\DeliveryArea;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class DeliveryAreaController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'provider_id' => 'required|exists:providers,id',
                'distance_from' => 'required|numeric',
                'distance_to' => 'required|numeric',
                'delivery_fee' => 'required|numeric',
                'minimum_order_amount' => 'required|numeric',
                'fulfillment_time_id' => 'nullable|exists:fulfillment_time_range,id', // Ensure it exists
            ]);

            // Save the new delivery area
            DeliveryArea::create($validated);

            return response()->json(['message' => 'Delivery area added successfully!']);
        } catch (ValidationException $e) {
            // Return the exact validation errors
            return response()->json(['errors' => $e->errors()], 422);
        }
    }


}
