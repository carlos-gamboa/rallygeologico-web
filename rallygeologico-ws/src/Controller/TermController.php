<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Term Controller
 *
 * @property \App\Model\Table\TermTable $Term
 *
 * @method \App\Model\Entity\Term[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TermController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void JSON Response.
     */
    public function index()
    {
        $term = $this->paginate($this->Term);

        $this->set(compact('term'));
        $this->set('_serialize', 'term');
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
     * @param string|null $id Term id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $term = $this->Term->get($id, [
            'contain' => ['Site', 'Multimedia']
        ]);

        $this->set('term', $term);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $term = $this->Term->newEntity();
        if ($this->getRequest()->is('post')) {
            $term = $this->Term->patchEntity($term, $this->getRequest()->getData());
            if ($this->Term->save($term)) {
                $this->Flash->success(__('The term has been saved.'));
            }
            $this->Flash->error(__('The term could not be saved. Please, try again.'));
        }
        $site = $this->Term->Site->find('list', ['limit' => 200]);
        $this->set(compact('term', 'site'));
        $this->render('/Term/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id Term id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $term = $this->Term->get($id, [
            'contain' => ['Site']
        ]);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $term = $this->Term->patchEntity($term, $this->getRequest()->getData());
            if ($this->Term->save($term)) {
                $this->Flash->success(__('The term has been saved.'));
            }
            $this->Flash->error(__('The term could not be saved. Please, try again.'));
        }
        $site = $this->Term->Site->find('list', ['limit' => 200]);
        $this->set(compact('term', 'site'));
        $this->render('/Term/json/template');
    }

    /**
     * Delete method
     *
     * @param string|null $id Term id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        $term = $this->Term->get($id);
        if ($this->Term->delete($term)) {
            $this->Flash->success(__('The term has been deleted.'));
            $this->set('term', true);
        } else {
            $this->Flash->error(__('The term could not be deleted. Please, try again.'));
            $this->set('term', false);
        }
        //return $this->redirect(['action' => 'index']);
        $this->render('/Term/json/template');
    }

    /**
     * Gets all the terms
     *
     */
    public function getAllTerms(){
        $term = $this->Term->find('all', [
        ]);
        $this->set('term', $term);
        $this->render('/Term/json/template');
    }

    /**
     * Gets all the terms ordered by letter
     */
    public function getAllTermsOrdered(){
        $term = $this->Term->find('all', [
                'order' => ['Term.name' => 'ASC'],
                'contain' => ['Multimedia']
            ]
        );
        $this->set('term', $term);
        $this->render('/Term/json/template');
    }

    public function getATerm($id = null){
        $term = $this->Term->get($id, [
                'contain' => ['Multimedia','Site']
            ]
        );
        $this->set('term', $term);
        $this->render('/Term/json/template');
    }

}
