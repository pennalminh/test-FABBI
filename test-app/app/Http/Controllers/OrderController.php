<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function getData()
    {
        $jsonFilePath = storage_path('dishes.json');

        $jsonData = file_get_contents($jsonFilePath);

        return $jsonData;
    }

    public function filterStep1(Request $request)
    {
        $meal = $request->query('meal');

        $jsonFilePath = storage_path('dishes.json');

        $jsonData = file_get_contents($jsonFilePath);

        $data = json_decode($jsonData, true);

        $arrItem = array_filter($data['dishes'], function ($item) use ($meal) {
            return in_array($meal, $item['availableMeals']);
        });

        $uniqueByName = [];

        foreach ($arrItem as $item) {
            $uniqueByName[$item['restaurant']] = $item;
        }

        $uniqueByName = array_values($uniqueByName);

        return $uniqueByName;
    }

    public function filterStep2(Request $request)
    {
        $meal = $request->query('meal');

        $restaurant = $request->query('restaurant');

        $jsonFilePath = storage_path('dishes.json');

        $jsonData = file_get_contents($jsonFilePath);

        $data = json_decode($jsonData, true);

        $arrItem1 = array_filter($data['dishes'], function ($item) use ($meal) {
            return in_array($meal, $item['availableMeals']);
        });
        $arrItem2 = array_filter($arrItem1, function ($item1) use ($restaurant) {
            return $item1["restaurant"] == $restaurant;
        });

        return $arrItem2;
    }
}
