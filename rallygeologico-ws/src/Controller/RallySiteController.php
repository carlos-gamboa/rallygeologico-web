<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RallySite Controller
 *
 * @property \App\Model\Table\RallySiteTable $RallySite
 *
 * @method \App\Model\Entity\RallySite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RallySiteController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Rally', 'Site']
        ];
        $rallySite = $this->paginate($this->RallySite);

        $this->set(compact('rallySite'));
        $this->set('_serialize', 'rallySite');
    }

    /**
     * View method
     *
     * @param string|null $id Rally Site id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rallySite = $this->RallySite->get($id, [
            'contain' => ['Rally', 'Site']
        ]);

        $this->set('rallySite', $rallySite);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rallySite = $this->RallySite->newEntity();
        if ($this->request->is('post')) {
            $rallySite = $this->RallySite->patchEntity($rallySite, $this->request->getData());
            if ($this->RallySite->save($rallySite)) {
                $this->Flash->success(__('The rally site has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rally site could not be saved. Please, try again.'));
        }
        $rally = $this->RallySite->Rally->find('list', ['limit' => 200]);
        $site = $this->RallySite->Site->find('list', ['limit' => 200]);
        $this->set(compact('rallySite', 'rally', 'site'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rally Site id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rallySite = $this->RallySite->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rallySite = $this->RallySite->patchEntity($rallySite, $this->request->getData());
            if ($this->RallySite->save($rallySite)) {
                $this->Flash->success(__('The rally site has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rally site could not be saved. Please, try again.'));
        }
        $rally = $this->RallySite->Rally->find('list', ['limit' => 200]);
        $site = $this->RallySite->Site->find('list', ['limit' => 200]);
        $this->set(compact('rallySite', 'rally', 'site'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rally Site id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rallySite = $this->RallySite->get($id);
        if ($this->RallySite->delete($rallySite)) {
            $this->Flash->success(__('The rally site has been deleted.'));
        } else {
            $this->Flash->error(__('The rally site could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
