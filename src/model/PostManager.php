<?php

namespace App\Model;

class PostManager extends Manager
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

    public function add(Post $chapter){

        $request = $this->_dataBase->prepare('INSERT INTO chapter 
            (`userId`, `title`, `content`, `creationDate`, `modifiedDate`, `enableComments`) 
            VALUES (:userId, :title, :content, :creationDate, :modifiedDate, :enableComments)');

        $request->bindValue(':userId', $chapter->userId(), \PDO::PARAM_INT);
        $request->bindValue(':title', $chapter->title());
        $request->bindValue(':content', $chapter->content());
        $request->bindValue(':creationDate', $chapter->creationDate());
        $request->bindValue(':modifiedDate', $chapter->modifiedDate());
        $request->bindValue(':enableComments', $chapter->enableComments());
        $request->execute();

        $chapter->hydrate([
            'id' => $this->_dataBase->lastInsertId(),

            'isDeleted' => "Non",
        ]);

    }

    public function exists($info)
    {
     
      $request = $this->_dataBase->prepare('SELECT COUNT(*) FROM chapter WHERE title = :title AND isDeleted = "Non"');
      $request->execute([':title' => $info]);
      
      return (bool) $request->fetchColumn();
    }

    public function count()
    {
      return $this->_dataBase->query('SELECT COUNT(*) FROM chapter')->fetchColumn();
    }

    public function delete(Post $chapter)
    {
      $request = $this->_dataBase->prepare('UPDATE chapter SET isDeleted = "Oui" WHERE id = :id');
      $request->bindValue(':id', $chapter->id(), \PDO::PARAM_INT);
      $request->execute();
    }

    public function getPost($info)
    {
      if (is_int($info))
      {
        $request = $this->_dataBase->query('SELECT * FROM chapter WHERE id = '.$info );
        $data = $request->fetch(\PDO::FETCH_ASSOC);
        
        return new Post($data);
      }
    }

    public function getLastPost()
    {
        $request = $this->_dataBase->query('SELECT * FROM chapter WHERE isDeleted = "Non" ORDER BY id DESC LIMIT 1');
        $data = $request->fetch(\PDO::FETCH_ASSOC);
        
        return new Post($data);
    }
    
    
    public function getList()
    {
      $chapters = [];
      
      $request = $this->_dataBase->prepare('SELECT id, userId, title, content, creationDate, modifiedDate, enableComments, isDeleted FROM chapter ORDER BY id');
      $request->execute();
      
      while ($data = $request->fetch(\PDO::FETCH_ASSOC))
      {
        $chapters[] = new Post($data);
      }
      
      return $chapters;
    }
    
    public function update(Post $chapter)
    {
      $request = $this->_dataBase->prepare('UPDATE chapter SET title = :title, content = :content, modifiedDate = :modifiedDate WHERE id = :id');
      
      $request->bindValue(':title', $chapter->title());
      $request->bindValue(':content', $chapter->content());
      $request->bindValue(':modifiedDate', $chapter->modifiedDate());
      $request->bindValue(':id', $chapter->id(), \PDO::PARAM_INT);
      
      $request->execute();
    }

}