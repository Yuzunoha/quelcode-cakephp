<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Review Entity
 *
 * @property int $id
 * @property int $bidinfo_id
 * @property string $reviewer_user_id
 * @property string $reviewee_user_id
 * @property int $value
 * @property string $comment
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\Bidinfo $bidinfo
 * @property \App\Model\Entity\ReviewerUser $reviewer_user
 * @property \App\Model\Entity\RevieweeUser $reviewee_user
 */
class Review extends Entity
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
        'bidinfo_id' => true,
        'reviewer_user_id' => true,
        'reviewee_user_id' => true,
        'value' => true,
        'comment' => true,
        'created' => true,
        'bidinfo' => true,
        'reviewer_user' => true,
        'reviewee_user' => true,
    ];
}
