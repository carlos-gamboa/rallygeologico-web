<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

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

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();
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
        $competitionStatistics = $this->CompetitionStatistics->get($id, [
            'contain' => ['Users', 'Competition']
        ]);

        $this->set('competitionStatistics', $competitionStatistics);
        $this->render('/CompetitionStatistics/json/template');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $associations = ['Users', 'Competition'];
        $competitionStatistics = $this->CompetitionStatistics->newEntity();
        if ($this->getRequest()->is('post')) {
            $competitionStatistics = $this->CompetitionStatistics->patchEntity($competitionStatistics, $this->getRequest()->getData(), ['associated' => $associations]);
            if ($this->CompetitionStatistics->save($competitionStatistics)) {
                $competitionStatistics = $this->CompetitionStatistics->loadInto($competitionStatistics, $associations);
                $this->Flash->success(__('The competition statistic has been saved.'));
            }
            $this->Flash->error(__('The competition statistic could not be saved. Please, try again.'));
        }
        $this->set('competitionStatistics', $competitionStatistics);
        $this->render('/CompetitionStatistics/json/template');
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
        $competitionStatistics = $this->CompetitionStatistics->get($id, [
            'contain' => []
        ]);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $competitionStatistics = $this->CompetitionStatistics->patchEntity($competitionStatistics, $this->getRequest()->getData());
            if ($this->CompetitionStatistics->save($competitionStatistics)) {
                $this->Flash->success(__('The competition statistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competition statistic could not be saved. Please, try again.'));
        }
        $users = $this->CompetitionStatistics->Users->find('list', ['limit' => 200]);
        $competition = $this->CompetitionStatistics->Competition->find('list', ['limit' => 200]);
        $this->set(compact('competitionStatistics', 'users', 'competition'));
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
        $this->getRequest()->allowMethod(['post', 'delete']);
        $competitionStatistics = $this->CompetitionStatistics->get($id);
        if ($this->CompetitionStatistics->delete($competitionStatistics)) {
            $this->Flash->success(__('The competition statistic has been deleted.'));
        } else {
            $this->Flash->error(__('The competition statistic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getCompetitionStatistics ($competitionId = null)
    {
        $competitionStatistics = $this->CompetitionStatistics->find('all', [
            'contain' => ['Users', 'Site', 'Activity'],
            'conditions' => ['competitionStatistics.competition_id' => $competitionId]]
        );
        $this->set('competitionStatistics', $competitionStatistics);
        $this->render('/CompetitionStatistics/json/template');
    }

    public function currentCompetitions($userId = null){

        $competitionStatistics = $this->CompetitionStatistics->find('all', [
            'contain' => ['Competition'],
            'conditions' => ['competitionStatistics.user_id' => $userId]
        ]);

        $this->set('competitionStatistics', $competitionStatistics);
        $this->render('/CompetitionStatistics/json/template');
    }
}
