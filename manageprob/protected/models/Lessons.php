<?php

class Lessons extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'lessons';
	}

	public function rules()
	{
		return array(
			array('name, date, active, rank', 'required'),
			array('active, rank', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('id, name, date, active, rank', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'probInfos' => array(self::MANY_MANY, 'ProbInfo', 'lesson_prob(lesson_id, prob_id)'),
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
			'date' => Yii::t('app', 'Date'),
			'active' => Yii::t('app', 'Active'),
			'rank' => Yii::t('app', 'Rank'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('date',$this->date,true);

		$criteria->compare('active',$this->active);

		$criteria->compare('rank',$this->rank);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
