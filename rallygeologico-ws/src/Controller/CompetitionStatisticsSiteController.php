<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

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
     * @return \Cake\Http\Response|void JSON Response.
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CompetitionStatistics', 'Site']
        ];
        $competitionStatisticsSite = $this->paginate($this->CompetitionStatisticsSite);

        $this->set(compact('competitionStatisticsSite'));
        $this->set('_serialize', 'competitionStatisticsSite');
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
     * @param string|null $id Competition Statistics Site id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $competitionStatisticsSite = $this->CompetitionStatisticsSite->get($id, [
            'contain' => ['CompetitionStatistics', 'Site']
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
        $associations = ['CompetitionStatistics', 'Site'];
        $competitionStatisticsSite = $this->CompetitionStatisticsSite->newEntity();
        if ($this->getRequest()->is('post')) {
            $competitionStatisticsSite = $this->CompetitionStatisticsSite->patchEntity($competitionStatisticsSite, $this->getRequest()->getData());
            if ($this->CompetitionStatisticsSite->save($competitionStatisticsSite)) {
                $competitionStatisticsSite = $this->CompetitionStatisticsSite->loadInto($competitionStatisticsSite, $associations);
                $this->Flash->success(__('The competition statistics site has been saved.'));
            }
            $this->Flash->error(__('The competition statistics site could not be saved. Please, try again.'));
        }
        $this->set('competitionStatisticsSite', $competitionStatisticsSite);
        $this->render('/CompetitionStatisticsSite/json/template');
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
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $competitionStatisticsSite = $this->CompetitionStatisticsSite->patchEntity($competitionStatisticsSite, $this->getRequest()->getData());
            if ($this->CompetitionStatisticsSite->save($competitionStatisticsSite)) {
                $this->Flash->success(__('The competition statistics site has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competition statistics site could not be saved. Please, try again.'));
        }
        $competitionStatistics = $this->CompetitionStatisticsSite->CompetitionStatistics->find('list', ['limit' => 200]);
        $site = $this->CompetitionStatisticsSite->Site->find('list', ['limit' => 200]);
        $this->set(compact('competitionStatisticsSite', 'competitionStatistics', 'site'));
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
        $this->getRequest()->allowMethod(['post', 'delete']);
        $competitionStatisticsSite = $this->CompetitionStatisticsSite->get($id);
        if ($this->CompetitionStatisticsSite->delete($competitionStatisticsSite)) {
            $this->Flash->success(__('The competition statistics site has been deleted.'));
            $this->set('competitionStatisticsSite', true);
        } else {
            $this->Flash->error(__('The competition statistics site could not be deleted. Please, try again.'));
            $this->set('competitionStatisticsSite', true);
        }

        $this->render('/CompetitionStatisticsSite/json/template');
    }
}
