<?php
define("SALT_LENGTH", 10);
class Users extends CActiveRecord {
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'users';
    }

    public function rules() {
        return array(
            array('gender_id, title_id', 'required'),
            array('gender_id, title_id', 'numerical', 'integerOnly' => true),
            array('username', 'length', 'max' => 128),
            array('password, email', 'length', 'max' => 128),
            array('name, surname', 'length', 'max' => 100),
            array('id, username, password, name, surname, email, gender_id, title_id', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'gender' => array(self::BELONGS_TO, 'Gender', 'gender_id'),
            'title' => array(self::BELONGS_TO, 'Title', 'title_id'),
        );
    }

    public function behaviors() {
        return array('CAdvancedArBehavior',
            array('class' => 'ext.CAdvancedArBehavior')
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'เลขที่'),
            'username' => Yii::t('app', 'รหัสผู้ใช้'),
            'password' => Yii::t('app', 'รหัสผ่าน'),
            'name' => Yii::t('app', 'ชื่อ'),
            'surname' => Yii::t('app', 'นามสกุล'),
            'email' => Yii::t('app', 'อีเมลล์'),
            'gender_id' => Yii::t('app', 'เพศ'),
            'title_id' => Yii::t('app', 'คำนำหน้าชื่อ'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);

        $criteria->compare('username', $this->username, true);

        $criteria->compare('password', $this->password, true);

        $criteria->compare('name', $this->name, true);

        $criteria->compare('surname', $this->surname, true);

        $criteria->compare('email', $this->email, true);

        $criteria->compare('gender_id', $this->gender_id);

        $criteria->compare('title_id', $this->title_id);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @return boolean validate user
     */
    public function validatePassword($password) {
        return $this->hashPassword($password, $this->email) === $this->password;
    }

    /**
     * @return hashed value
     */
    public function hashPassword($phrase, $salt = null) {
        $key = 'Gf;B&yXL|beJUf-K*PPiU{wf|@9K9j5?d+YW}?VAZOS%e2c -:11ii<}ZM?PO!96';
        if ($salt == '')
            $salt = substr(hash('sha512', $key), 0, SALT_LENGTH);
        else
            $salt = substr($salt, 0, SALT_LENGTH);
        return hash('sha512', $salt . $key . $phrase);
    }

}
