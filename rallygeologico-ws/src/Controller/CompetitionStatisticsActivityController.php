<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * CompetitionStatisticsActivity Controller
 *
 * @property \App\Model\Table\CompetitionStatisticsActivityTable $CompetitionStatisticsActivity
 *
 * @method \App\Model\Entity\CompetitionStatisticsActivity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CompetitionStatisticsActivityController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void JSON Response.
     */
    public function index()
    {
        $competitionStatisticsActivity = $this->CompetitionStatisticsActivity->find('all', [
            'contain' => ['CompetitionStatistics', 'Activity']
        ]);

        $this->set(compact('competitionStatisticsActivity'));
        $this->set('_serialize', 'competitionStatisticsActivity');
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
     * @param string|null $id Competition Statistics Activity id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $competitionStatisticsActivity = $this->CompetitionStatisticsActivity->get($id, [
            'contain' => ['CompetitionStatistics', 'Activity']
        ]);

        $this->set('competitionStatisticsActivity', $competitionStatisticsActivity);
        $this->render('/CompetitionStatisticsActivity/json/template');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $associations = ['CompetitionStatistics', 'Activity'];
        $competitionStatisticsActivity = $this->CompetitionStatisticsActivity->newEntity();
        if ($this->getRequest()->is('post')) {
            $competitionStatisticsActivity = $this->CompetitionStatisticsActivity->patchEntity($competitionStatisticsActivity, $this->getRequest()->getData());
            if ($this->CompetitionStatisticsActivity->save($competitionStatisticsActivity)) {
                $competitionStatisticsActivity = $this->CompetitionStatisticsActivity->loadInto($competitionStatisticsActivity, $associations);
                $this->Flash->success(__('The competition statistics activity has been saved.'));
            }
            $this->Flash->error(__('The competition statistics activity could not be saved. Please, try again.'));
        }
        $this->set('competitionStatisticsActivity', $competitionStatisticsActivity);
        $this->render('/CompetitionStatisticsActivity/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id Competition Statistics Activity id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $competitionStatisticsActivity = $this->CompetitionStatisticsActivity->get($id, [
            'contain' => []
        ]);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $competitionStatisticsActivity = $this->CompetitionStatisticsActivity->patchEntity($competitionStatisticsActivity, $this->getRequest()->getData());
            if ($this->CompetitionStatisticsActivity->save($competitionStatisticsActivity)) {
                $this->Flash->success(__('The competition statistics activity has been saved.'));
            }
            $this->Flash->error(__('The competition statistics activity could not be saved. Please, try again.'));
        }
        $competitionStatistics = $this->CompetitionStatisticsActivity->CompetitionStatistics->find('list', ['limit' => 200]);
        $activity = $this->CompetitionStatisticsActivity->Activity->find('list', ['limit' => 200]);
        $this->set(compact('competitionStatisticsActivity', 'competitionStatistics', 'activity'));
        $this->render('/CompetitionStatisticsActivity/json/template');
    }

    /**
     * Delete method
     *
     * @param string|null $id Competition Statistics Activity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        $competitionStatisticsActivity = $this->CompetitionStatisticsActivity->get($id);
        if ($this->CompetitionStatisticsActivity->delete($competitionStatisticsActivity)) {
            $this->Flash->success(__('The competition statistics activity has been deleted.'));
            $this->set('competitionStatisticsActivity', true);
        } else {
            $this->Flash->error(__('The competition statistics activity could not be deleted. Please, try again.'));
            $this->set('competitionStatisticsActivity', false);
        }

        $this->render('/CompetitionStatisticsActivity/json/template');
    }
}
