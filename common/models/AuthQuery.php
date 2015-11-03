<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Auth]].
 *
 * @see Auth
 */
class AuthQuery extends \yii\db\ActiveQuery
{
    /* public function active()
      {
      $this->andWhere('[[status]]=1');
      return $this;
      } */

    /**
     * @inheritdoc
     * @return Auth[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Auth|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
