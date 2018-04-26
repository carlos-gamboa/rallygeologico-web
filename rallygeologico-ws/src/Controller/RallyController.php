<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Rally Controller
 *
 * @property \App\Model\Table\RallyTable $Rally
 *
 * @method \App\Model\Entity\Rally[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RallyController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $rally = $this->paginate($this->Rally);

        $this->set(compact('rally'));
        $this->set('_serialize', 'rally');
    }

    /**
     * View method
     *
     * @param string|null $id Rally id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rally = $this->Rally->get($id, [
            'contain' => ['Site', 'Competition']
        ]);

        $this->set('rally', $rally);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rally = $this->Rally->newEntity();
        if ($this->request->is('post')) {
            $rally = $this->Rally->patchEntity($rally, $this->request->getData());
            if ($this->Rally->save($rally)) {
                $this->Flash->success(__('The rally has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rally could not be saved. Please, try again.'));
        }
        $site = $this->Rally->Site->find('list', ['limit' => 200]);
        $this->set(compact('rally', 'site'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rally id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rally = $this->Rally->get($id, [
            'contain' => ['Site']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rally = $this->Rally->patchEntity($rally, $this->request->getData());
            if ($this->Rally->save($rally)) {
                $this->Flash->success(__('The rally has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rally could not be saved. Please, try again.'));
        }
        $site = $this->Rally->Site->find('list', ['limit' => 200]);
        $this->set(compact('rally', 'site'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rally id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rally = $this->Rally->get($id);
        if ($this->Rally->delete($rally)) {
            $this->Flash->success(__('The rally has been deleted.'));
        } else {
            $this->Flash->error(__('The rally could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function newestRallies (){
        $rally = $this->Rally->find('all', [
                'order' => ['rally.id' => 'DESC']
            ]
        );
        $this->set('rally', $rally);
        $this->render('/Rally/json/template');
    }
}
