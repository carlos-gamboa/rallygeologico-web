<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Multimedia Controller
 *
 * @property \App\Model\Table\MultimediaTable $Multimedia
 *
 * @method \App\Model\Entity\Multimedia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MultimediaController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $multimedia = $this->paginate($this->Multimedia);

        $this->set(compact('multimedia'));
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();

    }

    /**
     * View method
     *
     * @param string|null $id Multimedia id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $multimedia = $this->Multimedia->get($id, [
            'contain' => ['Activity', 'Term']
        ]);

        $this->set('multimedia', $multimedia);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $multimedia = $this->Multimedia->newEntity();
        if ($this->request->is('post')) {
            $multimedia = $this->Multimedia->patchEntity($multimedia, $this->request->getData());
            if ($this->Multimedia->save($multimedia)) {
                $this->Flash->success(__('The multimedia has been saved.'));
            }
            $this->Flash->error(__('The multimedia could not be saved. Please, try again.'));
        }
        $activity = $this->Multimedia->Activity->find('list', ['limit' => 200]);
        $term = $this->Multimedia->Term->find('list', ['limit' => 200]);
        $this->set(compact('multimedia', 'activity', 'term'));
        $this->render('/Multimedia/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id Multimedia id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $multimedia = $this->Multimedia->get($id, [
            'contain' => ['Activity', 'Term']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $multimedia = $this->Multimedia->patchEntity($multimedia, $this->request->getData());
            if ($this->Multimedia->save($multimedia)) {
                $this->Flash->success(__('The multimedia has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The multimedia could not be saved. Please, try again.'));
        }
        $activity = $this->Multimedia->Activity->find('list', ['limit' => 200]);
        $term = $this->Multimedia->Term->find('list', ['limit' => 200]);
        $this->set(compact('multimedia', 'activity', 'term'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Multimedia id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $multimedia = $this->Multimedia->get($id);
        if ($this->Multimedia->delete($multimedia)) {
            $this->Flash->success(__('The multimedia has been deleted.'));
        } else {
            $this->Flash->error(__('The multimedia could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
