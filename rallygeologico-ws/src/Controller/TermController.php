<?php
namespace App\Controller;

use App\Controller\AppController;

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
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $term = $this->paginate($this->Term);

        $this->set(compact('term'));
        $this->set('_serialize', 'term');
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
            'contain' => ['Site']
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
        if ($this->request->is('post')) {
            $term = $this->Term->patchEntity($term, $this->request->getData());
            if ($this->Term->save($term)) {
                $this->Flash->success(__('The term has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The term could not be saved. Please, try again.'));
        }
        $site = $this->Term->Site->find('list', ['limit' => 200]);
        $this->set(compact('term', 'site'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $term = $this->Term->patchEntity($term, $this->request->getData());
            if ($this->Term->save($term)) {
                $this->Flash->success(__('The term has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The term could not be saved. Please, try again.'));
        }
        $site = $this->Term->Site->find('list', ['limit' => 200]);
        $this->set(compact('term', 'site'));
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
        $this->request->allowMethod(['post', 'delete']);
        $term = $this->Term->get($id);
        if ($this->Term->delete($term)) {
            $this->Flash->success(__('The term has been deleted.'));
        } else {
            $this->Flash->error(__('The term could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
