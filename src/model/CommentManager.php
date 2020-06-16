<?php

namespace App\Model;

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

    public function add(Comment $comment){

        $request = $this->_dataBase->prepare('INSERT INTO comment 
            (`userId`, `chapterId`, `creationDate`, `message`, `isModified`, `isReported`) 
            VALUES (:userId, :chapterId, :creationDate, :message, :isModified, :isReported)');

        $request->bindValue(':userId', $comment->userId(), \PDO::PARAM_INT);
        $request->bindValue(':chapterId', $comment->chapterId());
        $request->bindValue(':creationDate', $comment->creationDate());
        $request->bindValue(':message', $comment->message());        
        $request->bindValue(':isModified', $comment->isModified());
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

    public function delete(Comment $comment)
    {
        $request = $this->_dataBase->prepare('DELETE comment WHERE id = :id');
        $request->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
        $request->execute();
    }

    public function getComment($info)
    {
        if (is_int($info))
        {
            $request = $this->_dataBase->query('SELECT * FROM comment WHERE id = '.$info );
            $data = $request->fetch(\PDO::FETCH_ASSOC);
            
            return new Comment($data);
        }
    }

    public function getCommentsOrdered($chapterId)
    {
        $orderedComments = [];
        $request = $this->_dataBase->prepare('SELECT * FROM comment WHERE chapterId = '.$chapterId.' AND isReported = 0 ORDER BY creationDate');
        $request->execute();
        while ($data = $request->fetch(\PDO::FETCH_ASSOC))
        {
            $orderedComments[] = new Comment($data);
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
            $comments[] = new Comment($data);
        }
        
        return $comments;
    }

    public function report(Comment $comment)
    {
        $request = $this->_dataBase->prepare('UPDATE comment SET isReported = true WHERE id = :id');
        $request->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
        
        $request->execute();
    }

        
    public function getReportedList()
    {
        $comments = [];
        
        $request = $this->_dataBase->prepare('SELECT * FROM comment ORDER BY chapterId, creationDate WHERE isReported = true');
        $request->execute();
        
        while ($data = $request->fetch(\PDO::FETCH_ASSOC))
        {
            $comments[] = new Comment($data);
        }
        
        return $comments;
    }
    
    public function update(Comment $comment)
    {
        $request = $this->_dataBase->prepare('UPDATE comment SET message = :message, 
                                            isModified = true, isReported = false WHERE id = :id');
        
        $request->bindValue(':message', $comment->message());
        $request->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
        
        $request->execute();
    }

}