<?php

namespace App\Model;

class UserManager extends Manager
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

    public function add(User $user){

        $request = $this->_dataBase->prepare('INSERT INTO `user`(`name`, `pseudo`, `password`, `email`, `privilege`, `subscribeDate`, `isDeleted`)
            VALUES (:userName, :pseudo, :userPassword, :email, :privilege, :subscribeDate, :isDeleted)');

        $request->bindValue(':userName', $user->name());
        $request->bindValue(':pseudo', $user->pseudo());
        $request->bindValue(':password', $user->password());
        $request->bindValue(':email', $user->email());
        $request->bindValue(':privilege', $user->privilege());
        $request->bindValue(':subscribeDate', $user->subscribeDate());
        $request->bindValue(':isDeleted', $user->isDeleted());
        $request->execute();

        $user->hydrate([
            'id' => $this->_dataBase->lastInsertId(),
        ]);

    }

    public function exists($info)
    {
     
      $request = $this->_dataBase->prepare('SELECT COUNT(*) FROM user WHERE pseudo = :pseudo AND isDeleted = 0');
      $request->execute([':pseudo' => $info]);
      
      return (bool) $request->fetchColumn();
    }

    public function count()
    {
      return $this->_dataBase->query('SELECT COUNT(*) FROM user')->fetchColumn();
    }

    public function delete(User $user)
    {
      if ($user->isDeleted()!=null && $user->isDeleted()===0)
      {
        $request = $this->_dataBase->prepare('UPDATE user SET isDeleted = 1 WHERE id = :id');
        $request->bindValue(':id', $user->id(), \PDO::PARAM_INT);
        $request->execute();
      }else if ($user->isDeleted()!=null && $user->isDeleted()===1)
      {
        $this->definitiveDelete($user);
      }
    }

    public function definitiveDelete(User $user)
    {
      $request = $this->_dataBase->prepare('DELETE FROM user WHERE id = :id');
      $request->bindValue(':id', $user->id(), \PDO::PARAM_INT);
      $request->execute();
    }

    public function getUser($info)
    {
      if (is_int($info))
      {
        $request = $this->_dataBase->query('SELECT * FROM user WHERE id = '.$info );
        $data = $request->fetch(\PDO::FETCH_ASSOC);
        
        return new User($data);
      }
    }

    
    public function getList()
    {
      $users = [];
      
      $request = $this->_dataBase->prepare('SELECT `id`, `name`, `pseudo`, `email`, `privilege`, `subscribeDate`, `isDeleted` FROM `user` ORDER BY id');
      $request->execute();
      
      while ($data = $request->fetch(\PDO::FETCH_ASSOC))
      {
        $users[] = new User($data);
      }
      return $users;
    }
    
    public function update(User $user)
    {
      $request = $this->_dataBase->prepare('UPDATE user SET `name`= :userName `pseudo` = :pseudo,  `password` = :userPassword,  WHERE `id` = :id');
      
      $request->bindValue(':userName', $user->name());
      $request->bindValue(':pseudo', $user->pseudo());
      $request->bindValue(':userPassword', $user->password());
      $request->bindValue(':id', $user->id(), \PDO::PARAM_INT);
      
      $request->execute();
    }

}