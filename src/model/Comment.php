<?php

namespace App\Model;

class Comment extends Hydratation
{
    private $_id;
    private $_userId;
    private $_author;
    private $_chapterId;
    private $_creationDate;
    private $_content;
    private $_isModerated;
    private $_isReported;

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

    public function author() {
        return $this->_author;
    }

    public function chapterId() {
        return $this->_chapterId;
    }

    public function creationDate() {
        return $this->_creationDate;
    }

    public function content() {
        return $this->_content;
    }

    public function isModerated() {
        return $this->_isModerated;
    }

    public function isReported() {
        return $this->_isReported;
    }

    //setters

    public function setId($id){
        $this->_id = (int) $id;
    }

    public function setUserId($userId) {
        $this->_userId = (int) $userId;
    }

    public function setAuthor($author) {
        if (is_string($author))
        {
            $this->_author = $author;
        }
    }

    public function setChapterId($chapterId) {
        $this->_chapterId = (int) $chapterId;
    }

    public function setCreationDate($creationDate) {
        if (preg_match('#^\d{4}\-((0\d)|(1[0-2]))\-[0-3]\d$#', $creationDate))
        {
            $this->_creationDate = $creationDate;
        }
    }

    public function setContent($content) {
        if (is_string($content))
        {
            $this->_content = $content;
        }
    }

    public function setisModerated($isModerated) {
        if (is_bool($isModerated))
        {
            $this->_isModerated = $isModerated;
        } else if ($isModerated === 0)
        {
            $this->_isModerated = false;
        } else if ($isModerated === 1)
        {
            $this->isModerated = true;
        }
    }

    public function setisReported($isReported) {
        if (is_bool($isReported))
        {
            $this->_isReported = $isReported;
        } else if ($isReported === 0)
        {
            $this->_isReported = false;
        } else if ($isReported === 1)
        {
            $this->isReported = true;
        }
    }
}
 