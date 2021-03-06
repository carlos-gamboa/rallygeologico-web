<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Canton Controller
 *
 * @property \App\Model\Table\CantonTable $Canton
 *
 * @method \App\Model\Entity\Canton[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CantonController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void JSON Response.
     */
    public function index()
    {
        $canton = $this->Canton->find('all', [
            'contain' => ['Province']
        ]);

        $this->set(compact('canton'));
        $this->set('_serialize', 'canton');
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
     * @param string|null $id Canton id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $canton = $this->Canton->get($id, [
            'contain' => ['Province', 'District']
        ]);

        $this->set('canton', $canton);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $canton = $this->Canton->newEntity();
        if ($this->getRequest()->is('post')) {
            $canton = $this->Canton->patchEntity($canton, $this->getRequest()->getData());
            if ($this->Canton->save($canton)) {
                $this->Flash->success(__('The canton has been saved.'));

            }
            $this->Flash->error(__('The canton could not be saved. Please, try again.'));
        }
        $province = $this->Canton->Province->find('list', ['limit' => 200]);
        $this->set(compact('canton', 'province'));
        $this->render('/Canton/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id Canton id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $canton = $this->Canton->get($id, [
            'contain' => []
        ]);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $canton = $this->Canton->patchEntity($canton, $this->getRequest()->getData());
            if ($this->Canton->save($canton)) {
                $this->Flash->success(__('The canton has been saved.'));
            }
            $this->Flash->error(__('The canton could not be saved. Please, try again.'));
        }
        $province = $this->Canton->Province->find('list', ['limit' => 200]);
        $this->set(compact('canton', 'province'));
        $this->render('/Canton/json/template');
    }

    /**
     * Delete method
     *
     * @param string|null $id Canton id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        $canton = $this->Canton->get($id);
        if ($this->Canton->delete($canton)) {
            $this->Flash->success(__('The canton has been deleted.'));
            $this->set('canton', true);
        } else {
            $this->Flash->error(__('The canton could not be deleted. Please, try again.'));
            $this->set('canton', false);
        }

        $this->render('/Canton/json/template');
    }
}
