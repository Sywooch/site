<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Cart]].
 *
 * @method Cart|null one($db = null)
 * @method Cart[] all($db = null)
 *
 * @see Cart
 */
class CartQuery extends \app\base\ActiveQuery
{
    /**
     * @param string $userId
     * @return $this
     */
    public function onlyUserId(string $userId)
    {
        $a = Cart::tableName();

        return $this->andWhere(["$a.user_id" => $userId]);
    }
}
