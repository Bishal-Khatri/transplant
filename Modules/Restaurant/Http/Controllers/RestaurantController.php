<?php

namespace Modules\Restaurant\Http\Controllers;

use App\Enum\CategoryType;
use App\Models\Category;
use App\Traits\FileStore;
use App\Traits\SetResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Restaurant\Entities\Amenity;
use Modules\Restaurant\Entities\Restaurant;
use Modules\Restaurant\Entities\RestaurantAmenity;
use Modules\Restaurant\Entities\RestaurantMenu;

class RestaurantController extends Controller
{
    use SetResponse, FileStore;

    public function amenityIndex()
    {
        $amenities = Amenity::paginate(20);
        return view('restaurant::amenity.index', compact('amenities'));
    }

    public function amenityCreate()
    {
        return view('restaurant::amenity.create');
    }

    public function amenityEdit($id)
    {
        $amenity = Amenity::findOrFail($id);
        return view('restaurant::amenity.create', compact('amenity'));
    }

    public function amenitySave(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        if ($request->id AND !blank($request->id)){
            $amenity = Amenity::findOrFail($request->id);
        }else{
            $amenity = new Amenity();
        }

        if ($request->hasFile('image')){
            if (isset($request->id) AND !blank($request->id) AND $request->hasFile('image')){
                Storage::delete('public/'.$amenity->image);
            }

            $path = $request->file('image')->store('amenities', 'public');
            $amenity->image = $path;
        }

        if (!blank($request->name)){
            $amenity->name = $request->name;
        }

        if (!blank($request->status)){
            $amenity->status = $request->status;
        }

        $amenity->save();

        session()->flash('success', 'Success <br> Amenity created/updated successfully.');

        return redirect()->route('restaurant.amenity.index');
    }

    public function addAmenity(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|integer',
            'amenity_id' => 'required|integer',
        ]);
        $amenity = new RestaurantAmenity();
        $amenity->restaurant_id = $request->restaurant_id;
        $amenity->amenity_id = $request->amenity_id;
        $amenity->save();

        $returnData = $this->prepareResponse(false, 'Success <br> Amenity added successfully.', [], []);
        return response()->json($returnData, 200);
    }

    public function amenityDelete($id)
    {
        $amenity = Amenity::findOrFail($id);
        if (!blank($amenity->image)){
            Storage::delete('public/'.$amenity->image);
        }
        $amenity->delete();
        session()->flash('success', 'Success <br> Amenity deleted successfully.');

        return redirect()->route('restaurant.amenity.index');
    }

    public function index()
    {
        return view('restaurant::index');
    }

    public function listing()
    {
        return view('restaurant::restaurant-list');
    }

    public function edit($id)
    {
        $restaurant = Restaurant::with('menu', 'menu.category', 'user')->findOrFail($id);
        $categories = Category::where('type', CategoryType::RESTAURANT)->get();
        $amenities = Amenity::where('status', true)->get();

        return view('restaurant::restaurant-edit', compact('restaurant', 'categories', 'amenities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'restaurant_name' => 'required|max:1000',
            'user' => 'required|integer',
            'id' => 'nullable|integer',
            'latitude' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'longitude' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        if ($request->id) {
            $restaurant = Restaurant::findOrFail($request->id);
        } else {
            $restaurant = new Restaurant();
        }

        if ($request->hasFile('logo')){
            $resolution = [
                'large' => [1000,1000],
            ];
            $main_image = $this->saveImage($request->logo, 'restaurant', $resolution);
            $restaurant->logo = $main_image['large'];
        }

        $restaurant->name = $request->restaurant_name;
        $restaurant->address = $request->address;
        if ($request->has('user')){
            $restaurant->user_id = $request->user;
        }
        $restaurant->description = $request->description;
        $restaurant->address = $request->address;
        $restaurant->latitude = $request->latitude;
        $restaurant->longitude = $request->longitude;
        $restaurant->save();

        $returnData = $this->prepareResponse(false, 'Success <br> Restaurant created/updated successfully', compact('restaurant'), []);
        return response()->json($returnData, 200);
    }

    public function apiListing(Request $request)
    {
        $filter = $request->filter ? $request->filter : '';
        $per_page = $request->per_page ? $request->per_page : 20;

        $query = Restaurant::query();
        $query->with('user');
        $query->where('name', 'LIKE', '%'.$filter.'%')
            ->orderBy('id', 'desc');

        $restaurants = $query->paginate($per_page);

        $returnData = $this->prepareResponse(false, 'success', compact('restaurants'), []);
        return response()->json($returnData, 200);
    }

    public function destroy($id)
    {
        try {
            $restaurant = Restaurant::findOrFail($id);

            if (!blank($restaurant->logo)){
                Storage::delete('public/'.$restaurant->logo);
            }

            if (!blank($restaurant->cover_image)) {
                Storage::delete('public/'.$restaurant->cover_image);
            }

            $restaurant->delete();

            $returnData = $this->prepareResponse(false, 'Success <br> Record deleted successfully.', [], []);
            return response()->json($returnData, 200);
        } catch (\Exception $e) {
            $returnData = $this->prepareResponse(true, "Fail <br> Could not delete record.", [], []);
            return response()->json($returnData, 500);
        }
    }

    public function saveMenuItem(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'restaurant_id' => 'required|integer',
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'image' => 'required',
            'category_id' => 'required',
        ], [
            'category_id.required' => 'Category field is required.'
        ]);

        if ($request->id) {
            $menu = RestaurantMenu::findOrFail($request->id);
        } else {
            $menu = new RestaurantMenu();
        }

        if ($request->hasFile('image')){
            $resolution = [
                'medium' => [800,800]
            ];
            $uploaded_image = $this->saveImage($request->image, 'restaurant_menu', $resolution);
            $menu->image = $uploaded_image['medium'];
        }

        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->restaurant_id = $request->restaurant_id;
        $menu->category_id = $request->category_id ? $request->category_id : null;
        $menu->save();

        $returnData = $this->prepareResponse(false, 'Success <br> Item created/updated successfully', compact('menu'), []);
        return response()->json($returnData, 200);
    }

    public function deleteMenuItem($id)
    {
        try {
            $item = RestaurantMenu::findOrFail($id);
            if (!blank($item->image)){
                Storage::delete('public/'.$item->image);
            }
            $item->delete();

            $returnData = $this->prepareResponse(false, 'Success <br> Record deleted successfully.', [], []);
            return response()->json($returnData, 200);
        } catch (\Exception $e) {
            $returnData = $this->prepareResponse(true, $e->getMessage(), [], []);
            return response()->json($returnData, $e->getCode());
        }
    }
}
