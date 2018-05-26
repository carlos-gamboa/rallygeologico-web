<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * TermSite Controller
 *
 * @property \App\Model\Table\TermSiteTable $TermSite
 *
 * @method \App\Model\Entity\TermSite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TermSiteController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void JSON Response.
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Term']
        ];
        $termSite = $this->paginate($this->TermSite);

        $this->set(compact('termSite'));
        $this->set('_serialize', 'termSite');
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
     * @param string|null $id Term Site id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $termSite = $this->TermSite->get($id, [
            'contain' => ['Term']
        ]);

        $this->set('termSite', $termSite);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $termSite = $this->TermSite->newEntity();
        if ($this->getRequest()->is('post')) {
            $termSite = $this->TermSite->patchEntity($termSite, $this->getRequest()->getData());
            if ($this->TermSite->save($termSite)) {
                $this->Flash->success(__('The term site has been saved.'));
            }
            $this->Flash->error(__('The term site could not be saved. Please, try again.'));
        }
        $term = $this->TermSite->Term->find('list', ['limit' => 200]);
        $this->set(compact('termSite', 'term'));
        $this->render('/TermSite/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id Term Site id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $termSite = $this->TermSite->get($id, [
            'contain' => []
        ]);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $termSite = $this->TermSite->patchEntity($termSite, $this->getRequest()->getData());
            if ($this->TermSite->save($termSite)) {
                $this->Flash->success(__('The term site has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The term site could not be saved. Please, try again.'));
        }
        $term = $this->TermSite->Term->find('list', ['limit' => 200]);
        $this->set(compact('termSite', 'term'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Term Site id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        $termSite = $this->TermSite->get($id);
        if ($this->TermSite->delete($termSite)) {
            $this->Flash->success(__('The term site has been deleted.'));
        } else {
            $this->Flash->error(__('The term site could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
