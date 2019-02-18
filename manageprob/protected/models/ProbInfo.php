<?php

class ProbInfo extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'prob_info';
	}

	public function rules()
	{
		return array(
			array('prob_id', 'required'),
			array('prob_order', 'numerical', 'integerOnly'=>true),
			array('prob_id', 'length', 'max'=>20),
			array('name', 'length', 'max'=>100),
			array('avail', 'length', 'max'=>1),
			array('description', 'length', 'max'=>300),
			array('prob_id, name, avail, prob_order, description', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'lessons' => array(self::MANY_MANY, 'Lessons', 'lesson_prob(lesson_id, prob_id)'),
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
			'prob_id' => Yii::t('app', 'Prob'),
			'name' => Yii::t('app', 'Name'),
			'avail' => Yii::t('app', 'Avail'),
			'prob_order' => Yii::t('app', 'Prob Order'),
			'description' => Yii::t('app', 'Description'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('prob_id',$this->prob_id,true);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('avail',$this->avail,true);

		$criteria->compare('prob_order',$this->prob_order);

		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
