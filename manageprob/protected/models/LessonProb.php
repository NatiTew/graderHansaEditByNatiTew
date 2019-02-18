<?php

class LessonProb extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'lesson_prob';
	}

	public function rules()
	{
		return array(
			array('lesson_id, prob_id, limit', 'required'),
			array('lesson_id, active, rank, limit', 'numerical', 'integerOnly'=>true),
			array('prob_id', 'length', 'max'=>20),
			array('lpid, lesson_id, prob_id, active, rank, limit', 'safe', 'on'=>'search'),
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
			'lpid' => Yii::t('app', 'Lpid'),
			'lesson_id' => Yii::t('app', 'Lesson'),
			'prob_id' => Yii::t('app', 'Prob'),
			'active' => Yii::t('app', 'Active'),
			'rank' => Yii::t('app', 'Rank'),
			'limit' => Yii::t('app', 'Limit'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('lpid',$this->lpid);

		$criteria->compare('lesson_id',$this->lesson_id);

		$criteria->compare('prob_id',$this->prob_id,true);

		$criteria->compare('active',$this->active);

		$criteria->compare('rank',$this->rank);

		$criteria->compare('limit',$this->limit);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
