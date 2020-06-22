<?php

namespace App\Manager;

class CommentManager extends Manager
{
    private $_dataBase;

    public function __construct() {
        $dataBase = $this->getConnect();
        $this->setDb($dataBase);
    }

    public function setDb(\PDO $dataBase)
    {
        $this->_dataBase = $dataBase;
    }

    public function add(\App\Model\Comment $comment){

        $request = $this->_dataBase->prepare('INSERT INTO comment 
            (`userId`, `author`, `chapterId`, `creationDate`, `content`, `isModerated`, `isReported`) 
            VALUES (:userId,:author, :chapterId, :creationDate, :content, :isModerated, :isReported)');

        $request->bindValue(':userId', $comment->userId(), \PDO::PARAM_INT);
        $request->bindValue(':author', $comment->author());
        $request->bindValue(':chapterId', $comment->chapterId());
        $request->bindValue(':creationDate', $comment->creationDate());
        $request->bindValue(':content', $comment->content());        
        $request->bindValue(':isModerated', $comment->isModerated());
        $request->bindValue(':isReported', $comment->isReported());
        $request->execute();

        $comment->hydrate([
            'id' => $this->_dataBase->lastInsertId(),

        ]);

    }

    public function exists($info)
    {
     
        $request = $this->_dataBase->prepare('SELECT COUNT(*) FROM comment WHERE id = :id ');
        $request->execute([':id' => $info]);
        
        return (bool) $request->fetchColumn();
    }

    public function count()
    {
        return $this->_dataBase->query('SELECT COUNT(*) FROM comment')->fetchColumn();
    }

    public function delete(\App\Model\Comment $comment)
    {
        $request = $this->_dataBase->prepare('DELETE FROM comment WHERE id = :id');
        $request->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
        $request->execute();
    }

    public function getComment($info)
    {
        if (is_int($info))
        {
            $request = $this->_dataBase->query('SELECT * FROM comment WHERE id = '.$info );
            $data = $request->fetch(\PDO::FETCH_ASSOC);
            
            return new \App\Model\Comment($data);
        }
    }

    public function getCommentsOrdered($chapterId)
    {
        $orderedComments = [];
        $request = $this->_dataBase->prepare('SELECT * FROM comment WHERE chapterId = '.$chapterId.' AND isReported = 0 ORDER BY creationDate');
        $request->execute();
        while ($data = $request->fetch(\PDO::FETCH_ASSOC))
        {
            $orderedComments[] = new \App\Model\Comment($data);
        }
        
        return $orderedComments;
    }
    
    
    public function getList()
    {
        $comments = [];
        
        $request = $this->_dataBase->prepare('SELECT * FROM comment ORDER BY chapterId, creationDate');
        $request->execute();
        
        while ($data = $request->fetch(\PDO::FETCH_ASSOC))
        {
            $comments[] = new \App\Model\Comment($data);
        }
        
        return $comments;
    }

    public function report(\App\Model\Comment $comment)
    {
        $request = $this->_dataBase->prepare('UPDATE comment SET isReported = true WHERE id = :id');
        $request->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
        
        $request->execute();
    }

        
    public function getReportedList()
    {
        $comments = [];
        
        $request = $this->_dataBase->prepare('SELECT * FROM comment WHERE isReported = true ORDER BY chapterId, creationDate');
        $request->execute();
        
        while ($data = $request->fetch(\PDO::FETCH_ASSOC))
        {
            $comments[] = new \App\Model\Comment($data);
        }
        
        return $comments;
    }
    
    public function update(\App\Model\Comment $comment)
    {
        $request = $this->_dataBase->prepare('UPDATE comment SET content = :content, 
                                            isModerated = true, isReported = false WHERE id = :id');
        
        $request->bindValue(':content', $comment->content());
        $request->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
        
        $request->execute();
    }

}