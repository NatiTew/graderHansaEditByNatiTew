<?php

class UserInfo extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'user_info';
	}

	public function rules()
	{
		return array(
			array('scid', 'required'),
			array('scid', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>20),
			array('name', 'length', 'max'=>100),
			array('passwd', 'length', 'max'=>10),
			array('grp', 'length', 'max'=>40),
			array('type', 'length', 'max'=>1),
			array('user_id, name, passwd, grp, type, scid', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
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
			'user_id' => Yii::t('app', 'User'),
			'name' => Yii::t('app', 'Name'),
			'passwd' => Yii::t('app', 'Passwd'),
			'grp' => Yii::t('app', 'Grp'),
			'type' => Yii::t('app', 'Type'),
			'scid' => Yii::t('app', 'Scid'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id,true);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('passwd',$this->passwd,true);

		$criteria->compare('grp',$this->grp,true);

		$criteria->compare('type',$this->type,true);

		$criteria->compare('scid',$this->scid);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
