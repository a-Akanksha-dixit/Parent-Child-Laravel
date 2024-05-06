<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create top-level category 'Clothing'
        $clothing = Categories::create(['name' => 'Clothing', 'is_parent' => true, 'is_leaf' => false, 'path' => 'clothing']);

        // Seed subcategories recursively
        $this->seedSubcategories($clothing, [
            'Men\'s Clothing' => [
                'Shirts' => [
                    'T-Shirts' => [
                        'Graphic Tees',
                        'Polo Shirts'
                    ],
                    'Dress Shirts'
                ],
                'Pants' => [
                    'Jeans' => [
                        'Skinny Jeans',
                        'Bootcut Jeans'
                    ],
                    'Chinos',
                    'Dress Pants'
                ],
                'Jackets' => [
                    'Bomber Jackets',
                    'Leather Jackets',
                    'Denim Jackets'
                ]
            ],
            'Women\'s Clothing' => [
                'Dresses' => [
                    'Casual Dresses',
                    'Evening Dresses'
                ],
                'Tops' => [
                    'T-Shirts',
                    'Blouses',
                    'Tank Tops'
                ],
                'Skirts' => [
                    'Mini Skirts',
                    'Midi Skirts',
                    'Maxi Skirts'
                ]
            ],
            'Accessories' => [
                'Hats' => [
                    'Baseball Caps',
                    'Beanies'
                ],
                'Belts' => [
                    'Leather Belts',
                    'Fabric Belts'
                ],
                'Sunglasses' => [
                    'Aviator Sunglasses',
                    'Wayfarer Sunglasses',
                    'Cat-eye Sunglasses'
                ]
            ]
        ]);
    }

    private function seedSubcategories(Categories $parent, array $subcategories)
    {
        foreach ($subcategories as $name => $children) {
            // Create subcategory
            $subcategory = $parent->subcategories()->create([
                'name' => $name,
                'is_parent' => !empty($children),
                'is_leaf' => empty($children),
                'path' => $parent->path . '/' . strtolower(str_replace(' ', '-', $name)) // Generate path
            ]);
            
            // Recursively seed its children
            if (!empty($children) && is_array($children)) {
                $this->seedSubcategories($subcategory, $children);
            }
        }
    }

}
