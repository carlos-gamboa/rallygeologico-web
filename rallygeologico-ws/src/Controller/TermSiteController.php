<?php
namespace App\Controller;

use App\Controller\AppController;

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
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $termSite = $this->paginate($this->TermSite);

        $this->set(compact('termSite'));
        $this->set('_serialize', 'termSite');
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
            'contain' => []
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
        if ($this->request->is('post')) {
            $termSite = $this->TermSite->patchEntity($termSite, $this->request->getData());
            if ($this->TermSite->save($termSite)) {
                $this->Flash->success(__('The term site has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The term site could not be saved. Please, try again.'));
        }
        $this->set(compact('termSite'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $termSite = $this->TermSite->patchEntity($termSite, $this->request->getData());
            if ($this->TermSite->save($termSite)) {
                $this->Flash->success(__('The term site has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The term site could not be saved. Please, try again.'));
        }
        $this->set(compact('termSite'));
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
        $this->request->allowMethod(['post', 'delete']);
        $termSite = $this->TermSite->get($id);
        if ($this->TermSite->delete($termSite)) {
            $this->Flash->success(__('The term site has been deleted.'));
        } else {
            $this->Flash->error(__('The term site could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
