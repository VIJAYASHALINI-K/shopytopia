<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $product_name
 * @property string $product_description
 * @property string $product_brand
 * @property float $product_price
 * @property float $product_rating
 *
 * @property \App\Model\Entity\Category[] $categories
 * @property \App\Model\Entity\OrderItem[] $order_items
 * @property \App\Model\Entity\ShoppingCart[] $shopping_carts
 * @property \App\Model\Entity\Shopytopium[] $shopytopia
 */
class Product extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'product_name' => true,
        'product_description' => true,
        'product_brand' => true,
        'product_price' => true,
        'product_rating' => true,
    ];
}
