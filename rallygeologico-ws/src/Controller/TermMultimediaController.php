<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * TermMultimedia Controller
 *
 * @property \App\Model\Table\TermMultimediaTable $TermMultimedia
 *
 * @method \App\Model\Entity\TermMultimedia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TermMultimediaController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Term', 'Multimedia']
        ];
        $termMultimedia = $this->paginate($this->TermMultimedia);

        $this->set(compact('termMultimedia'));
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();

    }

    /**
     * View method
     *
     * @param string|null $id Term Multimedia id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $termMultimedia = $this->TermMultimedia->get($id, [
            'contain' => ['Term', 'Multimedia']
        ]);

        $this->set('termMultimedia', $termMultimedia);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $termMultimedia = $this->TermMultimedia->newEntity();
        if ($this->request->is('post')) {
            $termMultimedia = $this->TermMultimedia->patchEntity($termMultimedia, $this->request->getData());
            if ($this->TermMultimedia->save($termMultimedia)) {
                $this->Flash->success(__('The term multimedia has been saved.'));
            }
            $this->Flash->error(__('The term multimedia could not be saved. Please, try again.'));
        }
        $term = $this->TermMultimedia->Term->find('list', ['limit' => 200]);
        $multimedia = $this->TermMultimedia->Multimedia->find('list', ['limit' => 200]);
        $this->set(compact('termMultimedia', 'term', 'multimedia'));
        $this->render('/TermMultimedia/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id Term Multimedia id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $termMultimedia = $this->TermMultimedia->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $termMultimedia = $this->TermMultimedia->patchEntity($termMultimedia, $this->request->getData());
            if ($this->TermMultimedia->save($termMultimedia)) {
                $this->Flash->success(__('The term multimedia has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The term multimedia could not be saved. Please, try again.'));
        }
        $term = $this->TermMultimedia->Term->find('list', ['limit' => 200]);
        $multimedia = $this->TermMultimedia->Multimedia->find('list', ['limit' => 200]);
        $this->set(compact('termMultimedia', 'term', 'multimedia'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Term Multimedia id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $termMultimedia = $this->TermMultimedia->get($id);
        if ($this->TermMultimedia->delete($termMultimedia)) {
            $this->Flash->success(__('The term multimedia has been deleted.'));
        } else {
            $this->Flash->error(__('The term multimedia could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}