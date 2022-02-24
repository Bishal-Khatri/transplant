<?php
namespace Modules\Grocery\Database\factories;

use App\Traits\FileStore;
use App\Traits\Slug;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroceryBrandFactory extends Factory
{
    use Slug, FileStore;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Grocery\Entities\Brand::class;

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
        ];
    }
}

