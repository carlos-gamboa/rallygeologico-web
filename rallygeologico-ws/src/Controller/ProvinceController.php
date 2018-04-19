<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Province Controller
 *
 * @property \App\Model\Table\ProvinceTable $Province
 *
 * @method \App\Model\Entity\Province[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProvinceController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $province = $this->paginate($this->Province);

        $this->set(compact('province'));
        $this->set('_serialize', 'province');
    }

    /**
     * View method
     *
     * @param string|null $id Province id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $province = $this->Province->get($id, [
            'contain' => []
        ]);

        $this->set('province', $province);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $province = $this->Province->newEntity();
        if ($this->request->is('post')) {
            $province = $this->Province->patchEntity($province, $this->request->getData());
            if ($this->Province->save($province)) {
                $this->Flash->success(__('The province has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The province could not be saved. Please, try again.'));
        }
        $this->set(compact('province'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Province id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $province = $this->Province->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $province = $this->Province->patchEntity($province, $this->request->getData());
            if ($this->Province->save($province)) {
                $this->Flash->success(__('The province has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The province could not be saved. Please, try again.'));
        }
        $this->set(compact('province'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Province id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $province = $this->Province->get($id);
        if ($this->Province->delete($province)) {
            $this->Flash->success(__('The province has been deleted.'));
        } else {
            $this->Flash->error(__('The province could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
