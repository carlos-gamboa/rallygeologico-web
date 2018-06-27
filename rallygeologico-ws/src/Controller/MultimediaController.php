<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use function Couchbase\fastlzCompress;
use function MongoDB\BSON\toJSON;

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
        $multimedia = $this->Multimedia->find('all', [
        ]);

        $this->set(compact('multimedia'));
        $this->set('_serialize', 'multimedia');
        $this->render('/Multimedia/json/template');
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
        $this->render('/Multimedia/json/template');
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
     * Upload image method
     *
     * @param null $filename
     * @throws \Aura\Intl\Exception
     */
    public function uploadImage($filename = null)
    {
        if ($this->getRequest()->is('post')) {
            if(!empty($this->getRequest()->getData('file'))){
                $uploadFile = WWW_ROOT. "img/" . $filename;
                if (move_uploaded_file($this->getRequest()->getData('file')['tmp_name'], $uploadFile)) {
                    $this->set('multimedia', true);
                    $this->Flash->success(__('File has been uploaded and inserted successfully.'));
                } else {
                    $this->set('multimedia', false);
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                }
            } else {
                $this->set('multimedia', false);
                $this->Flash->error(__('Please choose a file to upload.'));
            }
        }
        $this->render('/Multimedia/json/template');
    }

    /**
     * Edit method
     *
     * @param null $id
     * @throws \Aura\Intl\Exception
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
            }
            else{
                $this->Flash->error(__('The multimedia could not be saved. Please, try again.'));
            }
        }
        $activity = $this->Multimedia->Activity->find('list', ['limit' => 200]);
        $term = $this->Multimedia->Term->find('list', ['limit' => 200]);
        $this->set(compact('multimedia', 'activity', 'term'));
        $this->render('/Multimedia/json/template');
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
}
