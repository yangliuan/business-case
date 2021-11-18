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
            'str_column' => $this->faker->name,
            'int_column' => \mt_rand(1, 1000),
            'float_column' => \round(\mt_rand(1000, 10000)/3, 2),
            'pic_column' => config('app.url').'/public/conky.png',
            'text_column' => $this->faker->randomHtml(2, 3)
        ];
    }
}
