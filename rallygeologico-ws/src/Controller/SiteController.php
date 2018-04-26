<?php
namespace App\Controller;

use App\Controller\AppController;

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
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['District']
        ];
        $site = $this->paginate($this->Site);

        $this->set(compact('site'));
        $this->set('_serialize', 'site');
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
            'contain' => ['District', 'CompetitionStatistics', 'Rally', 'Term']
        ]);

        $this->set('site', $site);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $site = $this->Site->newEntity();
        if ($this->request->is('post')) {
            $site = $this->Site->patchEntity($site, $this->request->getData());
            if ($this->Site->save($site)) {
                $this->Flash->success(__('The site has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The site could not be saved. Please, try again.'));
        }
        $district = $this->Site->District->find('list', ['limit' => 200]);
        $competitionStatistics = $this->Site->CompetitionStatistics->find('list', ['limit' => 200]);
        $rally = $this->Site->Rally->find('list', ['limit' => 200]);
        $term = $this->Site->Term->find('list', ['limit' => 200]);
        $this->set(compact('site', 'district', 'competitionStatistics', 'rally', 'term'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $site = $this->Site->patchEntity($site, $this->request->getData());
            if ($this->Site->save($site)) {
                $this->Flash->success(__('The site has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The site could not be saved. Please, try again.'));
        }
        $district = $this->Site->District->find('list', ['limit' => 200]);
        $competitionStatistics = $this->Site->CompetitionStatistics->find('list', ['limit' => 200]);
        $rally = $this->Site->Rally->find('list', ['limit' => 200]);
        $term = $this->Site->Term->find('list', ['limit' => 200]);
        $this->set(compact('site', 'district', 'competitionStatistics', 'rally', 'term'));
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
        $this->request->allowMethod(['post', 'delete']);
        $site = $this->Site->get($id);
        if ($this->Site->delete($site)) {
            $this->Flash->success(__('The site has been deleted.'));
        } else {
            $this->Flash->error(__('The site could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
