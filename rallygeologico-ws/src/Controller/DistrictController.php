<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * District Controller
 *
 * @property \App\Model\Table\DistrictTable $District
 *
 * @method \App\Model\Entity\District[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DistrictController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Canton']
        ];
        $district = $this->paginate($this->District);

        $this->set(compact('district'));
        $this->set('_serialize', 'district');
    }

    /**
     * View method
     *
     * @param string|null $id District id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $district = $this->District->get($id, [
            'contain' => ['Canton', 'Site']
        ]);

        $this->set('district', $district);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $district = $this->District->newEntity();
        if ($this->request->is('post')) {
            $district = $this->District->patchEntity($district, $this->request->getData());
            if ($this->District->save($district)) {
                $this->Flash->success(__('The district has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The district could not be saved. Please, try again.'));
        }
        $canton = $this->District->Canton->find('list', ['limit' => 200]);
        $this->set(compact('district', 'canton'));
    }

    /**
     * Edit method
     *
     * @param string|null $id District id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $district = $this->District->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $district = $this->District->patchEntity($district, $this->request->getData());
            if ($this->District->save($district)) {
                $this->Flash->success(__('The district has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The district could not be saved. Please, try again.'));
        }
        $canton = $this->District->Canton->find('list', ['limit' => 200]);
        $this->set(compact('district', 'canton'));
    }

    /**
     * Delete method
     *
     * @param string|null $id District id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $district = $this->District->get($id);
        if ($this->District->delete($district)) {
            $this->Flash->success(__('The district has been deleted.'));
        } else {
            $this->Flash->error(__('The district could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
