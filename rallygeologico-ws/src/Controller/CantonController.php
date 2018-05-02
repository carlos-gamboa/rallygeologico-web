<?php
namespace App\Controller;

use App\Controller\AppController;

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
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Province']
        ];
        $canton = $this->paginate($this->Canton);

        $this->set(compact('canton'));
        $this->set('_serialize', 'canton');
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
        if ($this->request->is('post')) {
            $canton = $this->Canton->patchEntity($canton, $this->request->getData());
            if ($this->Canton->save($canton)) {
                $this->Flash->success(__('The canton has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The canton could not be saved. Please, try again.'));
        }
        $province = $this->Canton->Province->find('list', ['limit' => 200]);
        $this->set(compact('canton', 'province'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $canton = $this->Canton->patchEntity($canton, $this->request->getData());
            if ($this->Canton->save($canton)) {
                $this->Flash->success(__('The canton has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The canton could not be saved. Please, try again.'));
        }
        $province = $this->Canton->Province->find('list', ['limit' => 200]);
        $this->set(compact('canton', 'province'));
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
        $this->request->allowMethod(['post', 'delete']);
        $canton = $this->Canton->get($id);
        if ($this->Canton->delete($canton)) {
            $this->Flash->success(__('The canton has been deleted.'));
        } else {
            $this->Flash->error(__('The canton could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
