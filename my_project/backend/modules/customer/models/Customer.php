<?php

namespace backend\modules\customer\models;

use Yii;
use dosamigos\taggable\Taggable;
/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone_number
 * @property string $email
 * @property string $website
 * @property string $bank_info
 * @property string $tax
 *
 * @property Quotation[] $quotations
 * @property Receipt[] $receipts
 */
class Customer extends \yii\db\ActiveRecord
{

    public function behaviors() {
      return [
        [
          'class' => Taggable::className(),
        ],
     ];
   }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'phone_number', 'email', 'website', 'bank_info', 'tax'], 'required'],
            [['tax'], 'string'],
            [['name', 'phone_number', 'email', 'website', 'bank_info'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 500],
            [['tagNames'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัสลูกค้า',
            'name' => 'ชื่อลูกค้า',
            'address' => 'ที่อยู่ลูกค้า',
            'phone_number' => 'หมายเลขโทรศัพท์',
            'email' => 'อีเมล',
            'website' => 'เว็บไซต์',
            'bank_info' => 'บัญชีธนาคาร',
            'tax' => 'หมายเลขประจำตัวผู้เสียภาษี',
            'taggable' => 'taggable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotations()
    {
        return $this->hasMany(Quotation::className(), ['id_customer' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceipts()
    {
        return $this->hasMany(Receipt::className(), ['id_customer' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    // public function getTags()
    // {
    //     return $this->hasMany(Quotation::className(), ['id' => 'id_customer'])->viaTable('tour_tag_assn', ['tour_id' => 'id']);
    // } 
}
