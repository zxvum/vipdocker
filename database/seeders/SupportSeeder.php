<?php

namespace Database\Seeders;

use App\Models\SupportStatus;
use App\Models\SupportTheme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SupportTheme::create(['name' => 'Общий вопрос']);
        SupportTheme::create(['name' => 'Пополнение баланса']);
        SupportTheme::create(['name' => 'Работоспособность сайта']);
        SupportTheme::create(['name' => 'Заказы/Товары']);
        SupportTheme::create(['name' => 'Другое']);

        SupportStatus::create(['name' => 'Создан', 'color_name' => 'warning']);
        SupportStatus::create(['name' => 'Изменен', 'color_name' => 'warning']);
        SupportStatus::create(['name' => 'В процессе', 'color_name' => 'primary']);
        SupportStatus::create(['name' => 'Решён', 'color_name' => 'success']);
        SupportStatus::create(['name' => 'Закрыт', 'color_name' => 'danger']);
    }
}
