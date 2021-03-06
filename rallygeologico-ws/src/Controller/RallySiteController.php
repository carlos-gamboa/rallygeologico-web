<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * RallySite Controller
 *
 * @property \App\Model\Table\RallySiteTable $RallySite
 *
 * @method \App\Model\Entity\RallySite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RallySiteController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void JSON Response.
     */
    public function index()
    {
        $rallySite = $this->RallySite->find('all', [
            'contain' => ['Rally', 'Site']
        ]);

        $this->set(compact('rallySite'));
        $this->set('_serialize', 'rallySite');
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
     * @param string|null $id Rally Site id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rallySite = $this->RallySite->get($id, [
            'contain' => ['Rally', 'Site']
        ]);

        $this->set('rallySite', $rallySite);
        $this->render('/RallySite/json/template');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rallySite = $this->RallySite->newEntity();
        if ($this->getRequest()->is('post')) {
            $rallySite = $this->RallySite->patchEntity($rallySite, $this->getRequest()->getData());
            if ($this->RallySite->save($rallySite)) {
                $this->Flash->success(__('The rally site has been saved.'));
            }
            $this->Flash->error(__('The rally site could not be saved. Please, try again.'));
        }
        $rally = $this->RallySite->Rally->find('list', ['limit' => 200]);
        $site = $this->RallySite->Site->find('list', ['limit' => 200]);
        $this->set(compact('rallySite', 'rally', 'site'));
        $this->render('/RallySite/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id Rally Site id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rallySite = $this->RallySite->get($id, [
            'contain' => []
        ]);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $rallySite = $this->RallySite->patchEntity($rallySite, $this->getRequest()->getData());
            if ($this->RallySite->save($rallySite)) {
                $this->Flash->success(__('The rally site has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rally site could not be saved. Please, try again.'));
        }
        $rally = $this->RallySite->Rally->find('list', ['limit' => 200]);
        $site = $this->RallySite->Site->find('list', ['limit' => 200]);
        $this->set(compact('rallySite', 'rally', 'site'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rally Site id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        $rallySite = $this->RallySite->get($id);
        if ($this->RallySite->delete($rallySite)) {
            $this->Flash->success(__('The rally site has been deleted.'));
            $this->set('rallySite', true);

        } else {
            $this->Flash->error(__('The rally site could not be deleted. Please, try again.'));
            $this->set('rallySite', false);
        }

        //return $this->redirect(['action' => 'index']);
        $this->render('/RallySite/json/template');
    }

    /**
     * Gets the relation id based on rally and site's ids.
     *
     * @param null $rallyId
     * @param null $siteId
     */
    public function getRallySite($rallyId = null, $siteId = null){
        $rallySite = $this->RallySite->find('all', [
                'conditions' => ['RallySite.rally_id' => $rallyId,
                    'RallySite.site_id' => $siteId]]
        );
        $this->set('rallySite', $rallySite->extract('id'));
        $this->render('/RallySite/json/template');
    }
}
