<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Competition Controller
 *
 * @property \App\Model\Table\CompetitionTable $Competition
 *
 * @method \App\Model\Entity\Competition[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CompetitionController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $competition = $this->paginate($this->Competition);

        $this->set(compact('competition'));
        $this->set('_serialize', 'competition');
    }

    /**
     * View method
     *
     * @param string|null $id Competition id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $competition = $this->Competition->get($id, [
            'contain' => []
        ]);

        $this->set('competition', $competition);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $competition = $this->Competition->newEntity();
        if ($this->request->is('post')) {
            $competition = $this->Competition->patchEntity($competition, $this->request->getData());
            if ($this->Competition->save($competition)) {
                $this->Flash->success(__('The competition has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competition could not be saved. Please, try again.'));
        }
        $this->set(compact('competition'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Competition id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $competition = $this->Competition->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $competition = $this->Competition->patchEntity($competition, $this->request->getData());
            if ($this->Competition->save($competition)) {
                $this->Flash->success(__('The competition has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competition could not be saved. Please, try again.'));
        }
        $this->set(compact('competition'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Competition id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $competition = $this->Competition->get($id);
        if ($this->Competition->delete($competition)) {
            $this->Flash->success(__('The competition has been deleted.'));
        } else {
            $this->Flash->error(__('The competition could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
