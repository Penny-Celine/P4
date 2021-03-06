<?php

namespace App\Model;

class Post extends Hydratation
{
    private $_id;
    private $_userId;
    private $_title;
    private $_content;
    private $_creationDate;
    private $_modifiedDate;
    private $_enableComments;
    private $_isDeleted;

    public function __construct(array $data) {
        $this->hydrate($data);
    }

    //getters

    public function id() {
        return $this->_id;
    }

    public function userId() {
        return $this->_userId;
    }

    public function title() {
        return $this->_title;
    }

    public function content() {
        return $this->_content;
    }

    public function creationDate() {
        return $this->_creationDate;
    }

    public function modifiedDate() {
        return $this->_modifiedDate;
    }

    public function enableComments() {
        return $this->_enableComments;
    }

    public function isDeleted() {
        return $this->_isDeleted;
    }

    //setters

    public function setId($id){
        $this->_id = (int) $id;
    }

    public function setUserId($userId) {
        $this->_userId = (int) $userId;
    }

    public function setTitle($title) {
        if (is_string($title))
        {
            $this->_title = $title;
        }
    }

    public function setContent($content) {
        if (is_string($content))
        {
            $this->_content = $content;
        }
    }

    public function setCreationDate($creationDate) {
        if (preg_match('#^\d{4}\-((0\d)|(1[0-2]))\-[0-3]\d$#', $creationDate))
        {
            $this->_creationDate = $creationDate;
        }
    }

    public function setModifiedDate($modifiedDate) {
        if (preg_match('#^\d{4}\-((0\d)|(1[0-2]))\-[0-3]\d ([0-1]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$#', $modifiedDate) || $modifiedDate == '')
        {
            $this->_modifiedDate = $modifiedDate;
        }
    }

    public function setEnableComments($enableComments) {

        if ($enableComments === 'Oui')
        {
            $this->_enableComments = 'Oui';
        } else
        {
            $this->_enableComments = 'Non';
        }
    }

    public function setIsDeleted($isDeleted) {

        if ($isDeleted === 'Oui')
        {
            $this->_isDeleted = 'Oui';
        } else
        {
            $this->_isDeleted = 'Non';
        }
    }

}