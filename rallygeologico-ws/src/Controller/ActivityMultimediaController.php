<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * ActivityMultimedia Controller
 *
 * @property \App\Model\Table\ActivityMultimediaTable $ActivityMultimedia
 *
 * @method \App\Model\Entity\ActivityMultimedia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivityMultimediaController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $activityMultimedia = $this->ActivityMultimedia->find('all', [
            'contain' => ['Activity', 'Multimedia']
        ]);

        $this->set(compact('activityMultimedia'));
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
     * @param string|null $id Activity Multimedia id.
     * @return \Cake\Http\Response|void JSON Response.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activityMultimedia = $this->ActivityMultimedia->get($id, [
            'contain' => ['Activity', 'Multimedia']
        ]);

        $this->set('activityMultimedia', $activityMultimedia);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $activityMultimedia = $this->ActivityMultimedia->newEntity();
        if ($this->request->is('post')) {
            $activityMultimedia = $this->ActivityMultimedia->patchEntity($activityMultimedia, $this->request->getData());
            if ($this->ActivityMultimedia->save($activityMultimedia)) {
                $this->Flash->success(__('The activity multimedia has been saved.'));
            }
            $this->Flash->error(__('The activity multimedia could not be saved. Please, try again.'));
        }
        $activity = $this->ActivityMultimedia->Activity->find('list', ['limit' => 200]);
        $multimedia = $this->ActivityMultimedia->Multimedia->find('list', ['limit' => 200]);
        $this->set(compact('activityMultimedia', 'activity', 'multimedia'));
        $this->render('/ActivityMultimedia/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id Activity Multimedia id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $activityMultimedia = $this->ActivityMultimedia->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $activityMultimedia = $this->ActivityMultimedia->patchEntity($activityMultimedia, $this->request->getData());
            if ($this->ActivityMultimedia->save($activityMultimedia)) {
                $this->Flash->success(__('The activity multimedia has been saved.'));

            }
            $this->Flash->error(__('The activity multimedia could not be saved. Please, try again.'));
        }
        $activity = $this->ActivityMultimedia->Activity->find('list', ['limit' => 200]);
        $multimedia = $this->ActivityMultimedia->Multimedia->find('list', ['limit' => 200]);
        $this->set(compact('activityMultimedia', 'activity', 'multimedia'));
        $this->render('/ActivityMultimedia/json/template');

    }

    /**
     * Delete method
     *
     * @param string|null $id Activity Multimedia id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $activityMultimedia = $this->ActivityMultimedia->get($id);
        if ($this->ActivityMultimedia->delete($activityMultimedia)) {
            $this->Flash->success(__('The activity multimedia has been deleted.'));
            $this->set('activityMultimedia', true);
        } else {
            $this->Flash->error(__('The activity multimedia could not be deleted. Please, try again.'));
            $this->set('activityMultimedia', true);
        }

        $this->render('/ActivityMultimedia/json/template');
    }

    /**
     * Gets the relation id based on activity and multimedia's ids.
     *
     * @param null $activityId
     * @param null $multimediaId
     */
    public function getActivityMultimedia($activityId = null, $multimediaId = null){
        $activityMultimedia = $this->ActivityMultimedia->find('all', [
                'conditions' => ['ActivityMultimedia.activity_id' => $activityId,
                    'ActivityMultimedia.multimedia_id' => $multimediaId]]
        );
        $this->set('activityMultimedia', $activityMultimedia->extract('id'));
        $this->render('/activityMultimedia/json/template');
    }
}
