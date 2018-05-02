<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => []
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        // Specify which view vars JsonView should serialize.
        $this->set('_serialize', 'users');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
       $this->Auth->allow();

    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Invitations', 'CompetitionStatistics', 'CompetitionStatisticsSite']
        ]);

        $this->set('user', $user);
    }

    /*public function login()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if(!isset($data['facebook_id'])){
                throw new UnauthorizedException("Please enter your FacebookId" . print_r($data, true));
            }

            $FacebookId = $data['facebook_id'];

            $users = $this->Users->find('all', [
                    'conditions' => ['users.facebook_id' => $FacebookId]]
            );
        }
        $this->set(compact('users'));
        $this->render('/Users/json/template');
    }*/

    public function username($Username = null)
    {
        $users = $this->Users->find('all', [
                'conditions' => ['users.username' => $Username]]
        );
        $this->set('users', $users);
        $this->render('/Users/json/template');
    }

    public function email($Email = null)
    {
        $users = $this->Users->find('all', [
                'conditions' => ['users.email' => $Email]]
        );
        $this->set('users', $users);
        $this->render('/Users/json/template');
    }

    public function facebookid($facebookid = null)
    {
        $users = $this->Users->find('all', [
                'conditions' => ['users.facebook_id' => $facebookid]]
        );
        $this->set('users', $users);
        $this->render('/Users/json/template');
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $users = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $users = $this->Users->patchEntity($users, $this->request->getData());
            if ($this->Users->save($users)) {
                $this->Flash->success(__('The user has been saved.'));
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('users'));
        $this->render('/Users/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
