<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Activity Controller
 *
 * @property \App\Model\Table\ActivityTable $Activity
 *
 * @method \App\Model\Entity\Activity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivityController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void JSON response.
     */
    public function index()
    {
        $activity = $this->Activity->find('all', [
            'contain' => ['Site']
        ]);

        $this->set(compact('activity'));
        $this->render('/Activity/json/template');
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
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response|void JSON response.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activity = $this->Activity->get($id, [
            'contain' => ['Site', 'Multimedia', 'Options']
        ]);

        $this->set('activity', $activity);
        $this->render('/Activity/json/template');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $activity = $this->Activity->newEntity();
        if ($this->getRequest()->is('post')) {
            $activity = $this->Activity->patchEntity($activity, $this->request->getData());
            if ($this->Activity->save($activity)) {
                $this->Flash->success(__('The activity has been saved.'));
            }
            $this->Flash->error(__('The activity could not be saved. Please, try again.'));
        }
        $site = $this->Activity->Site->find('list', ['limit' => 200]);
        $multimedia = $this->Activity->Multimedia->find('list', ['limit' => 200]);
        $this->set(compact('activity', 'site', 'multimedia'));
        $this->render('/Activity/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $activity = $this->Activity->get($id, [
            'contain' => []
        ]);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $activity = $this->Activity->patchEntity($activity, $this->request->getData());
            if ($this->Activity->save($activity)) {
                $this->Flash->success(__('The activity has been saved.'));

            }
            $this->Flash->error(__('The activity could not be saved. Please, try again.'));
        }
        $site = $this->Activity->Site->find('list', ['limit' => 200]);
        $multimedia = $this->Activity->Multimedia->find('list', ['limit' => 200]);
        $this->set(compact('activity', 'site', 'multimedia'));
        $this->render('/Activity/json/template');
    }


    /**
     * Delete method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        $activity = $this->Activity->get($id);
        if ($this->Activity->delete($activity)) {
            $this->Flash->success(__('The activity has been deleted.'));
            $this->set('activity', true);
        } else {
            $this->Flash->error(__('The activity could not be deleted. Please, try again.'));
            $this->set('activity', false);
        }

        //return $this->redirect(['action' => 'index']);
        $this->render('/Activity/json/template');
    }

    /**
     * Gets the termSite entry with the specified values
     * @param null $termId
     */
    public function getActivity($site_id = null){
        $activity = $this->Activity->find('all', [
                'conditions' => ['Activity.site_id' => $site_id]]
        );
        $this->set('activity', $activity->extract('id'));
        $this->render('/Activity/json/template');
    }

    public function getAllActivities($termId = null){
        $activities = $this->Activity->find('all', [
        ]);
        $this->set('activity', $activities);
        $this->render('/Activity/json/template');
    }

    /**
     * Gets all activities those aren't part of the specified multimedia
     *
     * @param null $id
     */
    public function getOtherActivitiesFromMultimedia($id = null){
        $this->loadModel('ActivityMultimedia');
        $activities = $this->Activity->find('all', [
            'conditions' => [
                'Activity.id NOT IN ' => $this->ActivityMultimedia->find('all', [
                    'fields' => ['ActivityMultimedia.activity_id'],
                    'conditions' => ['ActivityMultimedia.multimedia_id' => $id
                    ]
                ])
            ]
        ]);
        $this->set('activity', $activities);
        $this->render('/Activity/json/template');
    }

    /**
     * Gets all activities those are part of the specified multimedia
     *
     * @param null $id
     */
    public function getAssociatedActivitiesFromMultimedia($id = null){
        $this->loadModel('ActivityMultimedia');
        $activities = $this->Activity->find('all', [
            'conditions' => [
                'Activity.id IN ' => $this->ActivityMultimedia->find('all', [
                    'fields' => ['ActivityMultimedia.activity_id'],
                    'conditions' => ['ActivityMultimedia.multimedia_id' => $id
                    ]
                ])
            ]
        ]);
        $this->set('activity', $activities);
        $this->render('/Activity/json/template');
    }

    /**
     * Gets all the activities by site
     *
     * @param null $siteId Id of the site
     */
    public function getActivitiesBySite($siteId = null){
        $activities = $this->Activity->find('all', [
                'contain' => ['Multimedia', 'Options'],
                'conditions' => [
                    'Activity.site_id' => $siteId
                ]
            ]
        );
        $this->set('activity', $activities);
        $this->render('/Activity/json/template');
    }

}
