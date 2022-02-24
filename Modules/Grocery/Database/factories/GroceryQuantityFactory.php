<?php
namespace Modules\Grocery\Database\factories;

use App\Traits\FileStore;
use App\Traits\Slug;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroceryQuantityFactory extends Factory
{
    use Slug, FileStore;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Grocery\Entities\ItemQuantity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $word = ucfirst($this->faker->word()) . ' ' . ucfirst($this->faker->word());
        $quantity = rand(50,200);
        $price = rand(50,500);
        $selling_price = 10/100 * $price;
        return [
            'item_id' => rand(1,200),
            'quantity' => $quantity,
            'initial_quantity' => $quantity,
            'purchase_price' => $price,
            'selling_price' => $selling_price,
            'purchase_date' => Carbon::today(),
            'vendor_id' => null,
        ];
    }
}

