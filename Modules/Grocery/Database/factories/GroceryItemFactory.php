<?php
namespace Modules\Grocery\Database\factories;

use App\Traits\FileStore;
use App\Traits\Slug;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroceryItemFactory extends Factory
{
    use Slug, FileStore;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Grocery\Entities\Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $word = ucfirst($this->faker->word()) . ' ' . ucfirst($this->faker->word());
        return [
            'name' => $word,
            'sku' => $this->createSlug($word),
            'category_id' => rand(1,50),
            'brand_id' => rand(1,50),
            'has_variant' => 0,
            'parent_id' => null,
        ];
    }
}

