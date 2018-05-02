<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CompetitionStatisticsSite Controller
 *
 * @property \App\Model\Table\CompetitionStatisticsSiteTable $CompetitionStatisticsSite
 *
 * @method \App\Model\Entity\CompetitionStatisticsSite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CompetitionStatisticsSiteController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'CompetitionStatistics', 'Site']
        ];
        $competitionStatisticsSite = $this->paginate($this->CompetitionStatisticsSite);

        $this->set(compact('competitionStatisticsSite'));
        $this->set('_serialize', 'competitionStatisticsSite');
    }

    /**
     * View method
     *
     * @param string|null $id Competition Statistics Site id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $competitionStatisticsSite = $this->CompetitionStatisticsSite->get($id, [
            'contain' => ['Users', 'CompetitionStatistics', 'Site']
        ]);

        $this->set('competitionStatisticsSite', $competitionStatisticsSite);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $competitionStatisticsSite = $this->CompetitionStatisticsSite->newEntity();
        if ($this->request->is('post')) {
            $competitionStatisticsSite = $this->CompetitionStatisticsSite->patchEntity($competitionStatisticsSite, $this->request->getData());
            if ($this->CompetitionStatisticsSite->save($competitionStatisticsSite)) {
                $this->Flash->success(__('The competition statistics site has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competition statistics site could not be saved. Please, try again.'));
        }
        $users = $this->CompetitionStatisticsSite->Users->find('list', ['limit' => 200]);
        $competitionStatistics = $this->CompetitionStatisticsSite->CompetitionStatistics->find('list', ['limit' => 200]);
        $site = $this->CompetitionStatisticsSite->Site->find('list', ['limit' => 200]);
        $this->set(compact('competitionStatisticsSite', 'users', 'competitionStatistics', 'site'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Competition Statistics Site id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $competitionStatisticsSite = $this->CompetitionStatisticsSite->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $competitionStatisticsSite = $this->CompetitionStatisticsSite->patchEntity($competitionStatisticsSite, $this->request->getData());
            if ($this->CompetitionStatisticsSite->save($competitionStatisticsSite)) {
                $this->Flash->success(__('The competition statistics site has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competition statistics site could not be saved. Please, try again.'));
        }
        $users = $this->CompetitionStatisticsSite->Users->find('list', ['limit' => 200]);
        $competitionStatistics = $this->CompetitionStatisticsSite->CompetitionStatistics->find('list', ['limit' => 200]);
        $site = $this->CompetitionStatisticsSite->Site->find('list', ['limit' => 200]);
        $this->set(compact('competitionStatisticsSite', 'users', 'competitionStatistics', 'site'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Competition Statistics Site id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $competitionStatisticsSite = $this->CompetitionStatisticsSite->get($id);
        if ($this->CompetitionStatisticsSite->delete($competitionStatisticsSite)) {
            $this->Flash->success(__('The competition statistics site has been deleted.'));
        } else {
            $this->Flash->error(__('The competition statistics site could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
