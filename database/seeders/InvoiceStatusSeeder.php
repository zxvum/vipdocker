<?php

namespace Database\Seeders;

use App\Models\InvoiceStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'В процессе выставления', 'color' => 'secondary'],
            ['name' => 'Выставлен', 'color' => 'primary'],
            ['name' => 'Ожидание оплаты', 'color' => 'warning'],
            ['name' => 'Оплачен', 'color' => 'success'],
        ];

        foreach ($statuses as $status) {
            InvoiceStatus::create([
                'name' => $status['name'],
                'color' => $status['color']
            ]);
        }
    }
}
