<?php

namespace App\Services;

use App\Models\Products;
use Exception;

class ProductService
{
    public function all()
    {
        return Products::orderBy('id', 'DESC')
            ->paginate(8);
    }

    /**
     * @throws Exception
     */
    public function create(array $product_data): Products
    {
        $this->imgHandler($product_data);

        $product = Products::create($product_data);

        if (!$product)
            throw new Exception('Error in save product');

        return $product;
    }

    /**
     * @throws Exception
     */
    public function update($id, array $product_data)
    {
        $this->imgHandler($product_data);

        $product = Products::find($id);

        if (!$product->update($product_data))
            throw new Exception('Error in updating product');

        return $product;
    }

    private function imgHandler(&$product_data)
    {
        if (!empty($product_data['img_path']))
            $product_data['img_path'] = ImageUploadService::upload($product_data['img_path']);
    }
}
