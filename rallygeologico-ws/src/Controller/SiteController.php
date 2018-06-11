<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Site Controller
 *
 * @property \App\Model\Table\SiteTable $Site
 *
 * @method \App\Model\Entity\Site[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SiteController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void JSON Response.
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['District', 'Rally']
        ];
        $site = $this->paginate($this->Site);

        $this->set(compact('site'));
        $this->set('_serialize', 'site');
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
     * @param string|null $id Site id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $site = $this->Site->get($id, [
            'contain' => ['District', 'Rally', 'Term']
        ]);

        $this->set('site', $site);
        $this->render('/Site/json/template');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $site = $this->Site->newEntity();
        if ($this->getRequest()->is('post')) {
            $site = $this->Site->patchEntity($site, $this->getRequest()->getData());
            if ($this->Site->save($site)) {
                $this->Flash->success(__('The site has been saved.'));
            }
            $this->Flash->error(__('The site could not be saved. Please, try again.'));
        }
        $this->set('site', $site);
        $this->render('/Site/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id Site id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $site = $this->Site->get($id, [
            'contain' => ['CompetitionStatistics', 'Rally', 'Term']
        ]);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $site = $this->Site->patchEntity($site, $this->getRequest()->getData());
            if ($this->Site->save($site)) {
                $this->Flash->success(__('The site has been saved.'));
            }
            $this->Flash->error(__('The site could not be saved. Please, try again.'));
        }
        $district = $this->Site->District->find('list', ['limit' => 200]);
        $competitionStatistics = $this->Site->CompetitionStatistics->find('list', ['limit' => 200]);
        $rally = $this->Site->Rally->find('list', ['limit' => 200]);
        $term = $this->Site->Term->find('list', ['limit' => 200]);
        $this->set(compact('site', 'district', 'competitionStatistics', 'rally', 'term'));
        $this->render('/Site/json/template');
    }

    /**
     * Delete method
     *
     * @param string|null $id Site id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        $site = $this->Site->get($id);
        if ($this->Site->delete($site)) {
            $this->Flash->success(__('The site has been deleted.'));
            $this->set('site', true);
        } else {
            $this->Flash->error(__('The site could not be deleted. Please, try again.'));
            $this->set('site', false);
        }

        $this->render('/Site/json/template');
    }

    /**
     * Gets all sites those aren't part of the specified rally
     *
     * @param null $rallyId
     */
    public function getOtherSites($rallyId = null){
        $this->loadModel('RallySite');
        $sites = $this->Site->find('all', [
            'conditions' => [
                'Site.id NOT IN ' => $this->RallySite->find('all', [
                    'fields' => ['RallySite.site_id'],
                    'conditions' => ['RallySite.rally_id' => $rallyId
                    ]
                ])
            ],
            'contain' => ['District']
        ]);
        $this->set('site', $sites);
        $this->render('/Site/json/template');
    }

    /**
     * Gets all sites those are part of the specified rally
     *
     * @param null $rallyId
     */
    public function getAssociatedSites($rallyId = null){
        $this->loadModel('RallySite');
        $sites = $this->Site->find('all', [
            'conditions' => [
                'Site.id IN ' => $this->RallySite->find('all', [
                    'fields' => ['RallySite.site_id'],
                    'conditions' => ['RallySite.rally_id' => $rallyId
                    ]
                ])
            ],
            'contain' => ['District']
        ]);
        $this->set('site', $sites);
        $this->render('/Site/json/template');
    }

    /**
     * Gets all sites those aren't part of the specified term
     *
     * @param null $rallyId
     */
    public function getOtherSitesFromTerm($termId = null){
        $this->loadModel('TermSite');
        $sites = $this->Site->find('all', [
            'conditions' => [
                'Site.id NOT IN ' => $this->TermSite->find('all', [
                    'fields' => ['TermSite.site_id'],
                    'conditions' => ['TermSite.term_id' => $termId
                    ]
                ])
            ]
        ]);
        $this->set('site', $sites);
        $this->render('/Site/json/template');
    }

    /**
     * Gets all sites those are part of the specified term
     *
     * @param null $termId
     */
    public function getAssociatedSitesFromTerm($termId = null){
        $this->loadModel('TermSite');
        $sites = $this->Site->find('all', [
            'conditions' => [
                'Site.id IN ' => $this->TermSite->find('all', [
                    'fields' => ['TermSite.site_id'],
                    'conditions' => ['TermSite.term_id' => $termId
                    ]
                ])
            ]
        ]);
        $this->set('site', $sites);
      $this->render('/Site/json/template');
    }

  /*
     * Gets the total sites
     */
    public function getTotalSites(){
        $site = $this->Site->find('all', [
            'fields' => [
                'totalSites' => 'COUNT( Site.id)',
            ]
        ]);

        $this->set('site', $site->toList());
        $this->render('/Site/json/template');
    }
}
