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
     * @return \Cake\Http\Response|void JSON Response.
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
     * Allows public access to the web services.
     *
     * @param Event $event Access event
     * @return \Cake\Http\Response|null|void No response
     */
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

    /**
     * Gets the CompetitionStatistics associated with 1 Competition.
     *
     * @param null $competitionId Competition Id
     */
    public function getCompetitionStatistics ($competitionId = null)
    {
        $competitionStatistics = $this->CompetitionStatistics->find('all', [
            'contain' => ['Users', 'Site', 'Activity'],
            'conditions' => ['competitionStatistics.competition_id' => $competitionId]]
        );
        $this->set('competitionStatistics', $competitionStatistics);
        $this->render('/CompetitionStatistics/json/template');
    }

    /**
     * Gets the Competitions and CompetitionStatistics for the competitions that the user is participating.
     *
     * @param null $userId User Id.
     */
    public function currentCompetitions($userId = null){

        $competitionStatistics = $this->CompetitionStatistics->find('all', [
            'contain' => ['Competition'],
            'conditions' => ['competitionStatistics.user_id' => $userId]
        ]);

        $this->set('competitionStatistics', $competitionStatistics);
        $this->render('/CompetitionStatistics/json/template');
    }

    /**
     * Gets the statistics associated with a rally.
     * Cantidad de gente en el rally (distinct) por separado jugando actual y no
     * Maximo de puntos obtenidos
     * Gente con el maximo de puntos
     * Suma total de puntos
     *
     *
     * @param null $rallyId Rally Id
     */
    public function getRallyStatistics($rallyId = null){
        $this->loadModel('Competition');

        $users = $this->CompetitionStatistics->find('all', [
            'conditions' => [
                'CompetitionStatistics.competition_id IN' => $this->Competition->find('all', [
                    'fields' => ['Competition.id'],
                    'conditions' => [
                        'Competition.rally_id' => $rallyId
                    ]
                ])
            ]
        ]);

        $this->set('users', $users->toList());
        $this->render('/Users/json/template');
    }
}
