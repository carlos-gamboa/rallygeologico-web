<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CompetitionStatistics Controller
 *
 * @property \App\Model\Table\CompetitionStatisticsTable $CompetitionStatistics
 *
 * @method \App\Model\Entity\CompetitionStatistic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CompetitionStatisticsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Competition']
        ];
        $competitionStatistics = $this->paginate($this->CompetitionStatistics);

        $this->set(compact('competitionStatistics'));
        $this->set('_serialize', 'competitionStatistics');
    }

    /**
     * View method
     *
     * @param string|null $id Competition Statistic id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $competitionStatistic = $this->CompetitionStatistics->get($id, [
            'contain' => ['Users', 'Competition']
        ]);

        $this->set('competitionStatistic', $competitionStatistic);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $competitionStatistic = $this->CompetitionStatistics->newEntity();
        if ($this->request->is('post')) {
            $competitionStatistic = $this->CompetitionStatistics->patchEntity($competitionStatistic, $this->request->getData());
            if ($this->CompetitionStatistics->save($competitionStatistic)) {
                $this->Flash->success(__('The competition statistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competition statistic could not be saved. Please, try again.'));
        }
        $users = $this->CompetitionStatistics->Users->find('list', ['limit' => 200]);
        $competition = $this->CompetitionStatistics->Competition->find('list', ['limit' => 200]);
        $this->set(compact('competitionStatistic', 'users', 'competition'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Competition Statistic id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $competitionStatistic = $this->CompetitionStatistics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $competitionStatistic = $this->CompetitionStatistics->patchEntity($competitionStatistic, $this->request->getData());
            if ($this->CompetitionStatistics->save($competitionStatistic)) {
                $this->Flash->success(__('The competition statistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competition statistic could not be saved. Please, try again.'));
        }
        $users = $this->CompetitionStatistics->Users->find('list', ['limit' => 200]);
        $competition = $this->CompetitionStatistics->Competition->find('list', ['limit' => 200]);
        $this->set(compact('competitionStatistic', 'users', 'competition'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Competition Statistic id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $competitionStatistic = $this->CompetitionStatistics->get($id);
        if ($this->CompetitionStatistics->delete($competitionStatistic)) {
            $this->Flash->success(__('The competition statistic has been deleted.'));
        } else {
            $this->Flash->error(__('The competition statistic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
