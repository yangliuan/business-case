<?php

namespace Database\Factories;

use App\Models\ExcelDemo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExcelDemoFactory extends Factory
{
    protected $model = ExcelDemo::class;

    public function definition()
    {
        return [
            'str_column' => $this->faker->realText(),
            'int_column' => $this->faker->numberBetween(1, 9999999999),
            'float_column' => $this->faker->randomFloat(2, 1, 9999999999),
            'pic_column' => '/public/conky.png',
            'text_column' => $this->faker->randomHtml(1, 3)
        ];
    }
}
