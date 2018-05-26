<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Invitation;
use Cake\Event\Event;
use Cake\Utility\Hash;

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
        $this->paginate = [
            'contain' => ['Users', 'Rally']
        ];
        $competition = $this->paginate($this->Competition);

        $this->set(compact('competition'));
        $this->set('_serialize', 'competition');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();

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
            'contain' => ['Users', 'Rally', 'CompetitionStatistics', 'Invitation']
        ]);

        $this->set('competition', $competition);
        $this->render('/Competition/json/template');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $competition = $this->Competition->newEntity();
        if ($this->getRequest()->is('post')) {
            $competition = $this->Competition->patchEntity($competition, $this->getRequest()->getData());
            if ($this->Competition->save($competition)) {
                $this->Flash->success(__('The competition has been saved.'));
            }
            $this->Flash->error(__('The competition could not be saved. Please, try again.'));
        }
        $users = $this->Competition->Users->find('list', ['limit' => 200]);
        $rally = $this->Competition->Rally->find('list', ['limit' => 200]);
        $this->set(compact('competition', 'users', 'rally'));
        $this->render('/Competition/json/template');
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
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $competition = $this->Competition->patchEntity($competition, $this->getRequest()->getData());
            if ($this->Competition->save($competition)) {
                $this->Flash->success(__('The competition has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competition could not be saved. Please, try again.'));
        }
        $users = $this->Competition->Users->find('list', ['limit' => 200]);
        $rally = $this->Competition->Rally->find('list', ['limit' => 200]);
        $this->set(compact('competition', 'users', 'rally'));
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
        $this->getRequest()->allowMethod(['post', 'delete']);
        $competition = $this->Competition->get($id);
        if ($this->Competition->delete($competition)) {
            $this->Flash->success(__('The competition has been deleted.'));
        } else {
            $this->Flash->error(__('The competition could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getAllPublicCompetitions($user_id = null) {
        $this->loadModel('CompetitionStatistics');
        $competitions = $this->Competition->find('all', [
            'contain' =>
                [
                    'Users',
                    'Rally'
                ],
            'conditions' => [
                    'AND' => [
                        'competition.is_active' => 1,
                        'competition.is_public' => 1,
                        'competition.admin_id !=' =>  $user_id
                    ],
                    ['competition.id NOT IN' => $this->CompetitionStatistics->find('all', [
                        'fields' => ['CompetitionStatistics.competition_id'],
                        'conditions' => [
                            'CompetitionStatistics.user_id' => $user_id
                        ]
                    ])]
            ]
        ]);

        $this->set('competition', $competitions);
        $this->render('/Competition/json/template');
    }
    
}