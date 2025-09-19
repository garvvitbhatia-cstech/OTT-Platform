<?php
declare(strict_types=1);

namespace Admins\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmailTemplate Entity
 *
 * @property int $id
 * @property string|null $email_template_title
 * @property string|null $email_template_sender_name
 * @property string|null $email_template_sender_email_address
 * @property string|null $email_template_email_address
 * @property string|null $email_template_email_heading
 * @property string|null $email_template_email_from
 * @property string|null $email_template_subject
 * @property string|null $email_template_description
 * @property string|null $email_template_support_message
 * @property string|null $email_template_disclaimer
 * @property int $email_template_status
 * @property string|null $created
 * @property string|null $modified
 */
class EmailTemplate extends Entity
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
        'email_template_title' => true,
        'email_template_sender_name' => true,
        'email_template_sender_email_address' => true,
        'email_template_email_address' => true,
        'email_template_email_heading' => true,
        'email_template_email_from' => true,
        'email_template_subject' => true,
        'email_template_description' => true,
        'email_template_support_message' => true,
        'email_template_disclaimer' => true,
        'email_template_status' => true,
        'created' => true,
        'modified' => true,
    ];
}
