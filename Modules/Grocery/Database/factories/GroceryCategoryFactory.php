<?php
namespace Modules\Grocery\Database\factories;

use App\Enum\ContentType;
use App\Models\Category;
use App\Traits\FileStore;
use App\Traits\Slug;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroceryCategoryFactory extends Factory
{
    use Slug, FileStore;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

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
            'slug' => $this->createSlug($word),
            'type' => ContentType::GROCERY
//            'image_original' => $result['original'],
//            'image_thumbnail' => $result['thumbnail'],
//            'image_large' => $result['large'],
//            'image_medium' => $result['medium'],
        ];
    }
}

