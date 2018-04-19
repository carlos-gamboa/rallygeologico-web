<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CompetitionsStatistics Controller
 *
 * @property \App\Model\Table\CompetitionsStatisticsTable $CompetitionsStatistics
 *
 * @method \App\Model\Entity\CompetitionsStatistic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CompetitionsStatisticsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $competitionsStatistics = $this->paginate($this->CompetitionsStatistics);

        $this->set(compact('competitionsStatistics'));
        $this->set('_serialize', 'competitionStatistics');
    }

    /**
     * View method
     *
     * @param string|null $id Competitions Statistic id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $competitionsStatistic = $this->CompetitionsStatistics->get($id, [
            'contain' => []
        ]);

        $this->set('competitionsStatistic', $competitionsStatistic);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $competitionsStatistic = $this->CompetitionsStatistics->newEntity();
        if ($this->request->is('post')) {
            $competitionsStatistic = $this->CompetitionsStatistics->patchEntity($competitionsStatistic, $this->request->getData());
            if ($this->CompetitionsStatistics->save($competitionsStatistic)) {
                $this->Flash->success(__('The competitions statistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competitions statistic could not be saved. Please, try again.'));
        }
        $this->set(compact('competitionsStatistic'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Competitions Statistic id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $competitionsStatistic = $this->CompetitionsStatistics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $competitionsStatistic = $this->CompetitionsStatistics->patchEntity($competitionsStatistic, $this->request->getData());
            if ($this->CompetitionsStatistics->save($competitionsStatistic)) {
                $this->Flash->success(__('The competitions statistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competitions statistic could not be saved. Please, try again.'));
        }
        $this->set(compact('competitionsStatistic'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Competitions Statistic id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $competitionsStatistic = $this->CompetitionsStatistics->get($id);
        if ($this->CompetitionsStatistics->delete($competitionsStatistic)) {
            $this->Flash->success(__('The competitions statistic has been deleted.'));
        } else {
            $this->Flash->error(__('The competitions statistic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
