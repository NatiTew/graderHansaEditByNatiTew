<?php

class Title extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'title';
	}

	public function rules()
	{
		return array(
			array('gender_id', 'required'),
			array('gender_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('id, name, gender_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'gender' => array(self::BELONGS_TO, 'Gender', 'gender_id'),
			'users' => array(self::HAS_MANY, 'Users', 'title_id'),
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
			'gender_id' => Yii::t('app', 'Gender'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('gender_id',$this->gender_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
