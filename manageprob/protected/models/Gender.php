<?php

class Gender extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'gender';
	}

	public function rules()
	{
		return array(
			array('name', 'length', 'max'=>45),
			array('id, name', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'titles' => array(self::HAS_MANY, 'Title', 'gender_id'),
			'users' => array(self::HAS_MANY, 'Users', 'gender_id'),
		);
	}

	public function behaviors()
	{
		return array('CAdvancedArBehavior',
				array('class' => 'ext.CAdvancedArBehavior')
				);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'name' => Yii::t('app', 'Name'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
