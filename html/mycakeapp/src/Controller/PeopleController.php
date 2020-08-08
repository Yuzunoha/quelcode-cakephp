<?php

namespace App\Controller;

use App\Controller\AppController;

class PeopleController extends AppController
{
  public function index()
  {
    if ($this->request->is('post')) {
      $find = $this->request->data['People']['find'];
      $condition = ['conditions' => ['name' => $find]];
      $data = $this->People->find('all', $condition);
    } else {
      $data = $this->People->find('all');
    }
    $this->set('data', $data);
  }

  public function add()
  {
    $entity = $this->People->newEntity();
    $this->set('entity', $entity);
  }

  public function create()
  {
    if ($this->request->is('post')) {
      $data =  $this->request->data['People'];
      $entity = $this->People->newEntity($data);
      $this->People->save($entity);
    }
    return $this->redirect(['action' => 'index']);
  }

  public function edit()
  {
    $id = $this->request->query['id'];
    $entity = $this->People->get($id);
    $this->set(compact('entity'));
  }

  public function update()
  {
    if ($this->request->isPost()) {
      $data = $this->request->data['People'];
      $id = $data['id'];
      $entity = $this->People->get($id);
      $this->People->patchEntity($entity, $data);
      $this->People->save($entity);
    }
    return $this->redirect(['action' => 'index']);
  }

  public function delete()
  {
    $id = $this->request->query['id'];
    $entity = $this->People->get($id);
    $this->set(compact('entity'));
  }

  public function destroy()
  {
    if ($this->request->isPost()) {
      $data = $this->request->data['People'];
      $id = $data['id'];
      $entity = $this->People->get($id);
      $this->People->delete($entity);
    }
    return $this->redirect(['action' => 'index']);
  }
}
