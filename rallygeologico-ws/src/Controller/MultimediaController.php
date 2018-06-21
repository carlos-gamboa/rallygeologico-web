<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Multimedia Controller
 *
 * @property \App\Model\Table\MultimediaTable $Multimedia
 *
 * @method \App\Model\Entity\Multimedia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MultimediaController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void JSON Response.
     */
    public function index()
    {
        $multimedia = $this->paginate($this->Multimedia);

        $this->set(compact('multimedia'));
        $this->set('_serialize', 'multimedia');
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
     * @param string|null $id Multimedia id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $multimedia = $this->Multimedia->get($id, [
            'contain' => ['Activity', 'Term']
        ]);

        $this->set('multimedia', $multimedia);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $associations = ['Term', 'Activity'];
        $multimedia = $this->Multimedia->newEntity();
        if ($this->getRequest()->is('post')) {
            $multimedia = $this->Multimedia->patchEntity($multimedia, $this->getRequest()->getData());
            //$competition = $this->Competition->loadInto($competition, $associations);
            if ($this->Multimedia->save($multimedia)) {
                $multimedia = $this->Multimedia->loadInto($multimedia, $associations);
                $this->Flash->success(__('The multimedia has been saved.'));
            }
            $this->Flash->error(__('The multimedia could not be saved. Please, try again.'));
        }
        //$activity = $this->Multimedia->Activity->find('list', ['limit' => 200]);
        //$term = $this->Multimedia->Term->find('list', ['limit' => 200]);
        $this->set('multimedia', $multimedia);
        $this->render('/Multimedia/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id Multimedia id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $multimedia = $this->Multimedia->get($id, [
            'contain' => ['Activity', 'Term']
        ]);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $multimedia = $this->Multimedia->patchEntity($multimedia, $this->getRequest()->getData());
            if ($this->Multimedia->save($multimedia)) {
                $this->Flash->success(__('The multimedia has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The multimedia could not be saved. Please, try again.'));
        }
        $activity = $this->Multimedia->Activity->find('list', ['limit' => 200]);
        $term = $this->Multimedia->Term->find('list', ['limit' => 200]);
        $this->set(compact('multimedia', 'activity', 'term'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Multimedia id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        $multimedia = $this->Multimedia->get($id);
        if ($this->Multimedia->delete($multimedia)) {
            $this->Flash->success(__('The multimedia has been deleted.'));
            $this->set('multimedia', true);
        } else {
            $this->Flash->error(__('The multimedia could not be deleted. Please, try again.'));
            $this->set('multimedia', false);
        }

        $this->render('/Multimedia/json/template');
    }

    /**
     * Gets all multimedia that isn't associated with the term
     *
     * @param null $termId
     */
    public function getOtherMultimedia($termId = null){
        $this->loadModel('TermMultimedia');
        $media = $this->Multimedia->find('all', [
            'conditions' => [
                'Multimedia.id NOT IN ' => $this->TermMultimedia->find('all', [
                    'fields' => ['TermMultimedia.multimedia_id'],
                    'conditions' => ['TermMultimedia.term_id' => $termId
                    ]
                ])
            ]
        ]);
        $this->set('multimedia', $media);
        $this->render('/Multimedia/json/template');
    }

    /**
     * Gets all multimedia associated with the term
     *
     * @param null $termId
     */
    public function getAssociatedMultimedia($termId = null){
        $this->loadModel('TermMultimedia');
        $media = $this->Multimedia->find('all', [
            'conditions' => [
                'Multimedia.id IN ' => $this->TermMultimedia->find('all', [
                    'fields' => ['TermMultimedia.multimedia_id'],
                    'conditions' => ['TermMultimedia.term_id' => $termId
                    ]
                ])
            ]
        ]);
        $this->set('multimedia', $media);
        $this->render('/Multimedia/json/template');
    }

    /**
     * Gets all multimedia that isn't associated with the activity
     *
     * @param null $activity
     */
    public function getOtherMultimediaFromActivity($activityId = null){
        $this->loadModel('ActivityMultimedia');
        $media = $this->Multimedia->find('all', [
            'conditions' => [
                'Multimedia.id NOT IN ' => $this->ActivityMultimedia->find('all', [
                    'fields' => ['ActivityMultimedia.multimedia_id'],
                    'conditions' => ['ActivityMultimedia.activity_id' => $activityId
                    ]
                ])
            ]
        ]);
        $this->set('multimedia', $media);
        $this->render('/Multimedia/json/template');
    }

    /**
     * Gets all multimedia associated with the activity
     *
     * @param null $activity
     */
    public function getAssociatedMultimediaFromActivity($activityId = null){
        $this->loadModel('ActivityMultimedia');
        $media = $this->Multimedia->find('all', [
            'conditions' => [
                'Multimedia.id NOT IN ' => $this->ActivityMultimedia->find('all', [
                    'fields' => ['ActivityMultimedia.multimedia_id'],
                    'conditions' => ['ActivityMultimedia.activity_id' => $activityId
                    ]
                ])
            ]
        ]);
        $this->set('multimedia', $media);
        $this->render('/Multimedia/json/template');
    }
}
