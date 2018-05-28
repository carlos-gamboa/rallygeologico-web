<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Options Controller
 *
 * @property \App\Model\Table\OptionsTable $Options
 *
 * @method \App\Model\Entity\Option[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OptionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void JSON Response.
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Activity']
        ];
        $options = $this->paginate($this->Options);

        $this->set(compact('options'));
    }

    /**
     * Allows public access to the web services.
     *
     * @param Event $event Access event
     * @return \Cake\Http\Response|null|void No response
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();

    }

    /**
     * View method
     *
     * @param string|null $id Option id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $option = $this->Options->get($id, [
            'contain' => ['Activity']
        ]);

        $this->set('option', $option);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $option = $this->Options->newEntity();
        if ($this->request->is('post')) {
            $option = $this->Options->patchEntity($option, $this->request->getData());
            if ($this->Options->save($option)) {
                $this->Flash->success(__('The option has been saved.'));
            }
            $this->Flash->error(__('The option could not be saved. Please, try again.'));
        }
        $activity = $this->Options->Activity->find('list', ['limit' => 200]);
        $this->set(compact('option', 'activity'));
        $this->render('/Options/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id Option id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $option = $this->Options->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $option = $this->Options->patchEntity($option, $this->request->getData());
            if ($this->Options->save($option)) {
                $this->Flash->success(__('The option has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The option could not be saved. Please, try again.'));
        }
        $activity = $this->Options->Activity->find('list', ['limit' => 200]);
        $this->set(compact('option', 'activity'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Option id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $option = $this->Options->get($id);
        if ($this->Options->delete($option)) {
            $this->Flash->success(__('The option has been deleted.'));
        } else {
            $this->Flash->error(__('The option could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
