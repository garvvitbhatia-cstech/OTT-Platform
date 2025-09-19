<?php
declare(strict_types=1);

namespace Admins\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property string|null $invoice_id
 * @property int $user_id
 * @property int $item_id
 * @property int $quantity
 * @property string|null $price
 * @property string|null $total
 * @property string|null $payment_through
 * @property int $status
 * @property int $order_day
 * @property int $order_month
 * @property int $order_year
 * @property string|null $customer_name
 * @property string|null $customer_email
 * @property string|null $customer_contact
 * @property string|null $customer_address
 * @property string|null $customer_locality
 * @property string|null $customer_pincode
 * @property string|null $customer_state
 * @property string|null $customer_city
 * @property int|null $created
 * @property int|null $modified
 *
 * @property \Admins\Model\Entity\Invoice $invoice
 * @property \Admins\Model\Entity\User $user
 * @property \Admins\Model\Entity\Item $item
 */
class Order extends Entity
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
        'invoice_id' => true,
        'user_id' => true,
        'item_id' => true,
        'quantity' => true,
        'price' => true,
        'total' => true,
        'payment_through' => true,
        'status' => true,
        'order_day' => true,
        'order_month' => true,
        'order_year' => true,
        'customer_name' => true,
        'customer_email' => true,
        'customer_contact' => true,
        'customer_address' => true,
        'customer_locality' => true,
        'customer_pincode' => true,
        'customer_state' => true,
        'customer_city' => true,
        'created' => true,
        'modified' => true,
        'invoice' => true,
        'user' => true,
        'item' => true,
    ];
}
