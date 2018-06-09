<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Rally Controller
 *
 * @property \App\Model\Table\RallyTable $Rally
 *
 * @method \App\Model\Entity\Rally[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RallyController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void JSON Response.
     */
    public function index()
    {
        $rally = $this->paginate($this->Rally);

        $this->set(compact('rally'));
        $this->set('_serialize', 'rally');
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
     * @param string|null $id Rally id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rally = $this->Rally->get($id, [
            'contain' => ['Site', 'Competition']
        ]);

        $this->set('rally', $rally);
        $this->render('/Rally/json/template');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rally = $this->Rally->newEntity();
        if ($this->getRequest()->is('post')) {
            $rally = $this->Rally->patchEntity($rally, $this->getRequest()->getData());
            if ($this->Rally->save($rally)) {
                $this->Flash->success(__('The rally has been saved.'));
            }
            $this->Flash->error(__('The rally could not be saved. Please, try again.'));
        }
        $site = $this->Rally->Site->find('list', ['limit' => 200]);
        $this->set(compact('rally', 'site'));
        $this->render('/Rally/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id Rally id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rally = $this->Rally->get($id, [
            'contain' => ['Site']
        ]);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $rally = $this->Rally->patchEntity($rally, $this->getRequest()->getData());
            if ($this->Rally->save($rally)) {
                $this->Flash->success(__('The rally has been saved.'));
            }
            $this->Flash->error(__('The rally could not be saved. Please, try again.'));
        }
        $site = $this->Rally->Site->find('list', ['limit' => 200]);
        $this->set(compact('rally', 'site'));
        $this->render('/Rally/json/template');

    }

    /**
     * Delete method
     *
     * @param string|null $id Rally id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        $rally = $this->Rally->get($id);
        if ($this->Rally->delete($rally)) {
            $this->Flash->success(__('The rally has been deleted.'));
            $this->set('rally', true);
        } else {
            $this->Flash->error(__('The rally could not be deleted. Please, try again.'));
            $this->set('rally', false);
        }
        //return $this->redirect(['action' => 'index']);
        $this->render('/Rally/json/template');
    }

    /**
     * Gets all the rallies in descendant order.
     */
    public function newestRallies (){
        $rally = $this->Rally->find('all', [
                'order' => ['rally.id' => 'DESC']
            ]
        );
        $this->set('rally', $rally);
        $this->render('/Rally/json/template');
    }

    /**
     * Gets all rallies those aren't part of the specified site
     *
     * @param null $siteId
     */
    public function getOtherRallies($siteId = null){
        $this->loadModel('RallySite');
        $sites = $this->Rally->find('all', [
            'conditions' => [
                'rally.id NOT IN ' => $this->RallySite->find('all', [
                    'fields' => ['RallySite.rally_id'],
                    'conditions' => ['RallySite.site_id' => $siteId
                    ]
                ])
            ]
        ]);
        $this->set('site', $sites);
        $this->render('/Site/json/template');
    }
    /**
     * Gets all rallies those are part of the specified site
     *
     * @param null $siteId
     */
    public function getAssociatedRallies($siteId = null){
        $this->loadModel('RallySite');
        $sites = $this->Rally->find('all', [
            'conditions' => [
                'rally.id IN ' => $this->RallySite->find('all', [
                    'fields' => ['RallySite.rally_id'],
                    'conditions' => ['RallySite.site_id' => $siteId
                    ]
                ])
            ]
        ]);
        $this->set('site', $sites);
        $this->render('/Site/json/template');
    }
}
