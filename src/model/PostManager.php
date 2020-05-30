<?php

namespace App\Model;

class PostManager extends Manager
{
    private $_dataBase;

    public function __construct() {
        $dataBase = $this->getConnect();
        $this->setDb($dataBase);
    }

    public function add(Post $chapter){

        $request = $this->_dataBase->prepare('INSERT INTO chapter 
            (`userId`, `title`, `content`, `creationDate`, `modifiedDate`, `enableComments`) 
            VALUES (:userId, :title, :content, :creationDate, :modifiedDate, :enableComments)');

        $request->bindValue(':userId', $chapter->userId());
        $request->bindValue(':title', $chapter->title());
        $request->bindValue(':content', $chapter->content());
        $request->bindValue(':creationDate', $chapter->creationDate());
        $request->bindValue(':modifiedDate', $chapter->modifiedDate());
        $request->bindValue(':enableComments', $chapter->enableComments());
        $request->execute();

        $chapter->hydrate([
            'id' => $this->_dataBase->lastInsertId(),

            'isDeleted' => false,
        ]);

    }

    public function exists($info)
    {
     
      $request = $this->_dataBase->prepare('SELECT COUNT(*) FROM chapter WHERE title = :title');
      $request->execute([':title' => $info]);
      
      return (bool) $request->fetchColumn();
    }

    public function setDb(\PDO $dataBase)
    {
      $this->_dataBase = $dataBase;
    }


}