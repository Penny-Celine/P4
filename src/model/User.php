<?php

namespace App\Model;

class User extends Hydratation
{
    private $_id;
    private $_name;
    private $_pseudo;
    private $_password;
    private $_email;
    private $_privilege;
    private $_subscribeDate;
    private $_isDeleted;

    public function __construct(array $data) {
        $this->hydrate($data);
    }

    //getters

    public function id() {
        return $this->_id;
    }

    public function name() {
        return $this->_name;
    }

    public function pseudo() {
        return $this->_pseudo;
    }

    public function password() {
        return $this->_password;
    }

    public function email() {
        return $this->_email;
    }

    public function privilege() {
        return $this->_privilege;
    }

    public function subscribeDate() {
        return $this->_subscribeDate;
    }

    public function isDeleted() {
        return $this->_isDeleted;
    }

    
    //setters


    public function setId($id){
        $this->_id = (int) $id;
    }

    public function setName($name){
        $this->_name = htmlSpecialChars($name);
    }

    public function setPseudo($pseudo){
        $this->_pseudo = htmlSpecialChars($pseudo);
    }

    public function setPassword($password){
        $this->_password = $password;
    }

    public function setEmail($email){
        $this->_email = $email;
    }

    public function setPrivilege($privilege){
        if ($privilege === 'admin')
        {
            $this->_privilege = $privilege;
        } else 
        {
            $this->privilege = 'user';
        }
    }

    public function setSubscribeDate($subscribeDate) {
        if (preg_match('#^\d{4}\-((0\d)|(1[0-2]))\-[0-3]\d$#', $subscribeDate))
        {
            $this->_subscribeDate = $subscribeDate;
        }
    }

    public function setisDeleted($isDeleted) {
        if (is_bool($isDeleted))
        {
            $this->_isDeleted = $isDeleted;
        } else if ($isDeleted === 0)
        {
            $this->_isDeleted = false;
        } else if ($isDeleted === 1)
        {
            $this->isDeleted = true;
        }
    }
}
