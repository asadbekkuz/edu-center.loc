<?php

namespace frontend\models\query;

use frontend\models\Payment;

/**
 * This is the ActiveQuery class for [[Payment]].
 *
 * @see Payment
 */
class PaymentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Payment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Payment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     *
     *  Get debtors information
     * @return PaymentQuery
     */
    public function debtor()
    {
        return $this->andWhere(['status' => Payment::PAYMENT_DEBTOR]);
    }

    /**
     *
     *  Get paids information
     */

    public function paid()
    {
        return $this->andWhere(['status' => Payment::PAYMENT_PAID]);
    }
}

