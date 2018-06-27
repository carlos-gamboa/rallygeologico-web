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
        $competitionStatistics = $this->CompetitionStatistics->find('all', [
            'contain' => ['Users', 'Competition']
        ]);

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
        $competitionStatistics = $this->CompetitionStatistics->newEntity();
        if ($this->getRequest()->is('post')) {
            $competitionStatistics = $this->CompetitionStatistics->patchEntity($competitionStatistics, $this->getRequest()->getData());
            if ($this->CompetitionStatistics->save($competitionStatistics)) {
                $competitionStatistics = $this->CompetitionStatistics->get($competitionStatistics->id, [
                    'contain' => ['Users', 'Competition', 'Site', 'Activity']
                ]);
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
            $this->set('competitionStatistics', true);
        } else {
            $this->Flash->error(__('The competition statistic could not be deleted. Please, try again.'));
            $this->set('competitionStatistics', false);
        }

        $this->render('/CompetitionStatistics/json/template');
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
            'conditions' => ['CompetitionStatistics.competition_id' => $competitionId]]
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
            'contain' => ['Competition', 'Site', 'Activity'],
            'conditions' => ['CompetitionStatistics.user_id' => $userId]
        ]);

        $this->set('competitionStatistics', $competitionStatistics);
        $this->render('/CompetitionStatistics/json/template');
    }

    /**
     * Gets the Competitions and CompetitionStatistics for the competitions that the user is participating.
     *
     * @param null $userId User Id.
     */
    public function currentActiveCompetitions($userId = null){

        $this->loadModel('Competition');

        $competitionStatistics = $this->CompetitionStatistics->find('all', [
            'contain' => ['Competition', 'Site', 'Activity'],
            'conditions' => [
                'CompetitionStatistics.user_id' => $userId,
                'CompetitionStatistics.competition_id IN' => $this->Competition->find('all', [
                    'fields' => ['Competition.id'],
                    'conditions' => [
                        'Competition.is_active' => 1
                    ]
                ])
            ]
        ]);

        $this->set('competitionStatistics', $competitionStatistics);
        $this->render('/CompetitionStatistics/json/template');
    }

    /**
     * Gets the overall statistics associated with a rally.
     *
     * @param null $rallyId Rally Id
     */
    public function getTotalRallyStatistics($rallyId = null){
        $this->loadModel('Competition');

        $competitionStatistics = $this->CompetitionStatistics->find('all', [
            'fields' => [
                'totalCompetitions' => 'COUNT( DISTINCT CompetitionStatistics.competition_id)',
                'totalUsers' => 'COUNT( DISTINCT CompetitionStatistics.user_id)',
                'maxPoints' => 'MAX(CompetitionStatistics.points)',
                'totalPoints' => 'SUM(CompetitionStatistics.points)'
            ],
            'conditions' => [
                'CompetitionStatistics.competition_id IN' => $this->Competition->find('all', [
                    'fields' => ['Competition.id'],
                    'conditions' => [
                        'Competition.rally_id' => $rallyId
                    ]
                ]),
            ]
        ]);

        $this->set('competitionStatistics', $competitionStatistics->toList());
        $this->render('/CompetitionStatistics/json/template');
    }

    /**
     * Gets the statistics associated with a rally's active competitions.
     *
     * @param null $rallyId Rally Id
     */
    public function getActiveRallyStatistics($rallyId = null){
        $this->loadModel('Competition');

        $competitionStatistics = $this->CompetitionStatistics->find('all', [
            'fields' => [
                'totalCompetitions' => 'COUNT( DISTINCT CompetitionStatistics.competition_id)',
                'totalUsers' => 'COUNT( DISTINCT CompetitionStatistics.user_id)',
                'maxPoints' => 'MAX(CompetitionStatistics.points)',
                'totalPoints' => 'SUM(CompetitionStatistics.points)'
            ],
            'conditions' => [
                'CompetitionStatistics.competition_id IN' => $this->Competition->find('all', [
                    'fields' => ['Competition.id'],
                    'conditions' => [
                        'Competition.rally_id' => $rallyId,
                        'Competition.is_active' => 1
                    ]
                ]),
            ]
        ]);

        $this->set('competitionStatistics', $competitionStatistics->toList());
        $this->render('/CompetitionStatistics/json/template');
    }

    /**
     * Gets the number of users with the most points associated with a rally
     */
    public function getUsersWithMostPoints(){
        $this->loadModel('Competition');
        $data = $this->getRequest()->getData();
        $rallyId = $data['rally_id'];
        $maxPoints = $data['max_points'];
        $isActive = $data['is_active'];

        if ($isActive == 1){
            $competitionStatistics = $this->CompetitionStatistics->find('all', [
                'fields' => [
                    'totalUsers' => 'COUNT( DISTINCT CompetitionStatistics.user_id)',
                ],
                'conditions' => [
                    'CompetitionStatistics.competition_id IN' => $this->Competition->find('all', [
                        'fields' => ['Competition.id'],
                        'conditions' => [
                            'Competition.rally_id' => $rallyId,
                            'Competition.is_active' => 1
                        ]
                    ]),
                    'CompetitionStatistics.points' => $maxPoints
                ]
            ]);
        } else {
            $competitionStatistics = $this->CompetitionStatistics->find('all', [
                'fields' => [
                    'totalUsers' => 'COUNT( DISTINCT CompetitionStatistics.user_id)',
                ],
                'conditions' => [
                    'CompetitionStatistics.competition_id IN' => $this->Competition->find('all', [
                        'fields' => ['Competition.id'],
                        'conditions' => [
                            'Competition.rally_id' => $rallyId,
                        ]
                    ]),
                    'CompetitionStatistics.points' => $maxPoints
                ]
            ]);
        }

        $this->set('competitionStatistics', $competitionStatistics->toList());
        $this->render('/CompetitionStatistics/json/template');
    }

    /**
     * Gets the statistics associated with a site.
     *
     * @param null $siteId Id of the site.
     */
    public function getSiteStatistics($siteId = null){
        $this->loadModel('CompetitionStatisticsSite');

        $competitionStatistics = $this->CompetitionStatistics->find('all', [
            'fields' => [
                'totalUsers' => 'COUNT( DISTINCT CompetitionStatistics.user_id)',
            ],
            'conditions' => [
                'CompetitionStatistics.id IN' => $this->CompetitionStatisticsSite->find('all', [
                    'fields' => ['CompetitionStatisticsSite.competition_statistics_id'],
                    'conditions' => [
                        'CompetitionStatisticsSite.site_id' => $siteId
                    ]
                ]),
            ]
        ]);

        $this->set('competitionStatistics', $competitionStatistics->toList());
        $this->render('/CompetitionStatistics/json/template');
    }

    /**
     * Gets the statistics associated with a user's active competitions.
     *
     * @param null $userId User Id
     */
    public function getActiveUserStatistics($userId = null){
        $this->loadModel('Competition');

        $competitionStatistics = $this->CompetitionStatistics->find('all', [
            'fields' => [
                'totalActiveCompetitions' => 'COUNT( DISTINCT CompetitionStatistics.competition_id)',
            ],
            'conditions' => [
                'CompetitionStatistics.competition_id IN' => $this->Competition->find('all', [
                    'fields' => ['Competition.id'],
                    'conditions' => [
                        'Competition.is_active' => 1
                    ]
                ]),
                'CompetitionStatistics.user_id' => $userId
            ]
        ]);

        $this->set('competitionStatistics', $competitionStatistics->toList());
        $this->render('/CompetitionStatistics/json/template');
    }

    /**
     * Gets the statistics associated with a user's competitions.
     *
     * @param null $userId User Id
     */
    public function getUserStatistics($userId = null){
        $this->loadModel('Competition');

        $competitionStatistics = $this->CompetitionStatistics->find('all', [
            'fields' => [
                'totalCompetitions' => 'COUNT( DISTINCT CompetitionStatistics.competition_id)',
                'totalPoints' => 'SUM(CompetitionStatistics.points)'
            ],
            'conditions' => [
                'CompetitionStatistics.competition_id IN' => $this->Competition->find('all', [
                    'fields' => ['Competition.id']
                ]),
                'CompetitionStatistics.user_id' => $userId
            ]
        ]);

        $this->set('competitionStatistics', $competitionStatistics->toList());
        $this->render('/CompetitionStatistics/json/template');
    }
}
