<?php

namespace App\Http\Controllers\Admin\Accountant;

use App\Models\FridayItem;
use Illuminate\Http\Request;
use App\Models\FridayCategory;
use App\Models\FridayCollection;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $categories = FridayCollection::with('categories.items')
            ->latest() // Orders by 'created_at' or 'id' descending
            ->first();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $collection = FridayCollection::firstOrCreate(
            ['collection_date' => \DateTime::createFromFormat('d/m/Y', $request->collection_date)->format('Y-m-d')],
            ['collection_day' => date('l', strtotime($request->collection_date))]
        );

        $category = new FridayCategory();
        $category->collection_id = $collection->id;
        $category->category_name = $request->category_name;
        $category->save();

        return response()->json(['success' => true, 'category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $category = FridayCategory::find($id);
        $category->category_name = $request->category_name;
        $category->save();

        return response()->json(['success' => true, 'category' => $id]);
    }

    public function destroy($id)
    {
        $category = FridayCategory::find($id);
        $category->delete();

        return response()->json(['success' => true]);
    }

    // Item Management Starts Here
    public function storeItem(Request $request)
    {
        $item = new FridayItem();
        $item->category_id = $request->category_id;
        $item->item_name = $request->item_name;
        $item->item_amount = $request->amount;
        $item->save();

        return response()->json(['success' => true, 'item' => $item]);
    }
    public function updateItem(Request $request, $id)
    {
        $item = FridayItem::find($id);
        $item->item_name = $request->item_name;
        $item->item_amount = $request->amount;
        $item->save();

        return response()->json(['success' => true, 'item' => $id]);
    }
    public function destroyItem($id)
    {
        $item = FridayItem::find($id);
        $item->delete();

        return response()->json(['success' => true]);
    }
    // Item Management Ends Here

}
