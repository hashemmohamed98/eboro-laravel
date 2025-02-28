<?php
namespace App\Http\Controllers;
use App\Repository\ProviderRepository;
use App\Services\ApiResponseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class DelievryController
{
    protected $providerRepo;
    protected $apiResponse;

    public function __construct(ProviderRepository $providerRepo, ApiResponseService $apiResponse)
    {
        $this->providerRepo = $providerRepo;
        $this->apiResponse = $apiResponse;
    }

    public function calculateDeliveryFee($providerId, $latitude, $longitude)
    {
        try {
            // Retrieve the provider with its branches
            $provider = $this->providerRepo->with('branch')->find($providerId);

            if (!$provider) {
                return response()->json(['message' => 'Provider not found.'], 404);
            }

            // Get the branches of the provider
            $branches = $provider->branch;

            if ($branches->isEmpty()) {
                return response()->json(['message' => 'No branches found for this provider.', 'delivery_fee' => null], 404);
            }

            // Initialize variables to track the nearest branch
            $nearestBranch = null;
            $minDistance = PHP_INT_MAX; // Start with a very large number for comparison

            // Loop through each branch and calculate the distance
            foreach ($branches as $branch) {
                if ($branch->open_time && $branch->close_time && $branch->open_days) {
                    // Decode the comma-separated values into arrays
                    $openTimes = explode(',', $branch->open_time); // e.g., ["00:00", "20:00", "21:00", ...]
                    $closeTimes = explode(',', $branch->close_time); // e.g., ["11:30", "23:59", "23:59", ...]
                    $openDays = explode(',', $branch->open_days); // e.g., ["Tuesday", "Monday", ...]

                    // Get the current day and time
                    $currentDay = date('l');
                    $currentTime = date('H:i');

                    // Check if the branch is open at this time
                    if ($this->isBranchOpen($openDays, $openTimes, $closeTimes, $currentDay, $currentTime)) {
                        // Calculate the distance from the customer's coordinates to the branch's coordinates
                        $distance = $this->calculateDistance($latitude, $longitude, $branch->lat, $branch->long);

                        // If the current branch is the nearest one, update the nearestBranch and minDistance
                        if ($distance < $minDistance) {
                            $minDistance = $distance;
                            $nearestBranch = $branch;
                        }
                    }
                }
            }

            if (!$nearestBranch) {
                return response()->json([
                    'delivery_fee' => null,
                    'message' => 'No nearby branches found.'
                ], 404);
            }

            // Retrieve the delivery areas for the provider
            $deliveryArea = DB::table('delivery_area')
                ->where('provider_id', $providerId)
                ->whereNull('is_deleted')
                ->get();

            // For each delivery area, calculate the delivery fee based on the nearest branch
            foreach ($deliveryArea as $area) {
                // Calculate the distance from the nearest branch to the customer's coordinates
                $distanceToBranch = $this->calculateDistance(
                    $latitude,
                    $longitude,
                    $nearestBranch->lat,
                    $nearestBranch->long
                );

                // Check if the distance falls within the defined delivery area range
                if ($distanceToBranch >= ($area->distance_from ?? 0) && $distanceToBranch <= $area->distance_to) {
                    return response()->json([
                        'delivery_fee' => $area->delivery_fee,
                    ], 200);
                }
            }

            return response()->json([
                'message' => 'No applicable delivery area found for the given location.',
                'delivery_fee' => null,
            ], 404);

        } catch (\Exception $e) {
            // Log the error if any
            Log::error('Error calculating delivery fee: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while calculating the delivery fee. ERROR : ' . $e->getMessage()], 500);
        }
    }

    // Function to calculate the distance between two geo-coordinates (in kilometers)
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;  // Radius of the Earth in km

        // Convert degrees to radians
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        // Haversine formula
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;

        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Calculate the distance
        $distance = $earthRadius * $c;

        return $distance;
    }

    // Function to check if the branch is open based on its opening hours and current time
    private function isBranchOpen($openDays, $openTimes, $closeTimes, $currentDay, $currentTime)
    {
        // Loop through the openDays to check if the branch is open today
        foreach ($openDays as $index => $day) {
            if ($day == $currentDay) {
                // Check the open and close times for today
                $openTime = $openTimes[$index];
                $closeTime = $closeTimes[$index];

                // If the branch is closed, continue to the next day
                if ($openTime === "Closed" || $closeTime === "Closed") {
                    return false;
                }

                // Compare times (ensure $openTime and $closeTime are in 'H:i' format)
                if ($currentTime >= $openTime && $currentTime <= $closeTime) {
                    return true;  // Branch is open
                }
            }
        }

        return false;  // Branch is closed
    }
}
