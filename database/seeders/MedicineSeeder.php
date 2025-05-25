<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medicines = [
            ['medicine_name' => 'Paracetamol', 'type' => 'Tablet', 'stock' => 100, 'price' => 5000, 'description' => 'Pain reliever and fever reducer', 'expired_date' => '2025-12-31'],
            ['medicine_name' => 'Ibuprofen', 'type' => 'Tablet', 'stock' => 75, 'price' => 7000, 'description' => 'Anti-inflammatory drug', 'expired_date' => '2025-11-30'],
            ['medicine_name' => 'Cetirizine', 'type' => 'Tablet', 'stock' => 120, 'price' => 4000, 'description' => 'Antihistamine for allergy relief', 'expired_date' => '2026-01-15'],
            ['medicine_name' => 'Omeprazole', 'type' => 'Capsule', 'stock' => 80, 'price' => 8000, 'description' => 'Proton pump inhibitor for acid reflux', 'expired_date' => '2025-10-20'],
            ['medicine_name' => 'Metformin', 'type' => 'Tablet', 'stock' => 60, 'price' => 12000, 'description' => 'Medication for type 2 diabetes', 'expired_date' => '2026-02-28'],
            ['medicine_name' => 'Lisinopril', 'type' => 'Tablet', 'stock' => 90, 'price' => 10000, 'description' => 'ACE inhibitor for hypertension', 'expired_date' => '2025-09-15'],
            ['medicine_name' => 'Amlodipine', 'type' => 'Tablet', 'stock' => 110, 'price' => 9500, 'description' => 'Calcium channel blocker for high blood pressure', 'expired_date' => '2025-08-01'],
            ['medicine_name' => 'Simvastatin', 'type' => 'Tablet', 'stock' => 130, 'price' => 11000, 'description' => 'Cholesterol-lowering medication', 'expired_date' => '2026-03-10'],
            ['medicine_name' => 'Levothyroxine', 'type' => 'Tablet', 'stock' => 70, 'price' => 13000, 'description' => 'Thyroid hormone replacement therapy', 'expired_date' => '2025-07-25'],
        ];

        foreach ($medicines as $obat) {
            Medicine::create($obat);
        }
    }
}
