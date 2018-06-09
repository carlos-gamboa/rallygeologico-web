<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\Hash;
use Cake\Auth\DefaultPasswordHasher;

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
     * @return \Cake\Http\Response|void JSON Response.
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
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Competition', 'InvitationSend', 'InvitationReceive', 'CompetitionStatistics', 'CompetitionStatisticsSite']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $users = $this->Users->newEntity();
        if ($this->getRequest()->is('post')) {
            $users = $this->Users->patchEntity($users, $this->getRequest()->getData());
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
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->getRequest()->getData());
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
        $this->getRequest()->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Gets all the users that aren't participating in a competition.
     */
    public function usersToInvite(){
        $data = $this->getRequest()->getData();
        $CompetitionId = $data['competition_id'];

        $this->loadModel('Invitation');
        $this->loadModel('Competition');
        $this->loadModel('CompetitionStatistics');

        $users = $this->Users->find('all', [
                'conditions' => [
                    'Users.id NOT IN' => $this->CompetitionStatistics->find('all', [
                        'fields' => ['CompetitionStatistics.user_id'],
                            'conditions' => [
                                'CompetitionStatistics.competition_id' => $CompetitionId
                            ]
                        ])
                ]
        ]);

        $this->set('users', $users->toList());
        $this->render('/Users/json/template');
    }

    /**
     * Find an user by it's username
     *
     * @param null $Username
     */
    public function username($Username = null)
    {
        $users = $this->Users->find('all', [
                'conditions' => ['users.username' => $Username]]
        );
        $this->set('users', $users);
        $this->render('/Users/json/template');
    }

    /**
     * Checks if a username is already taken.
     *
     * @param null $Username User's username
     */
    public function usernameExists($Username = null)
    {
        $users = $this->Users->find('all', [
                'conditions' => ['users.username' => $Username]]
        );
        $this->set('users', $users);
        if ($users->isEmpty()){
            $this->set('users', false);
        }
        else{
            $this->set('users', true);
        }
        $this->render('/Users/json/template');
    }

    /**
     * Checks if a user is admin.
     *
     * @param null $Username User's username
     */
    public function userIsAdmin($Username = null)
    {
        $users = $this->Users->find('all', [
                'conditions' => [
                    'users.username' => $Username,
                    'users.is_Admin' => 0,
                ]
            ]
        );
        $this->set('users', $users);
        if (!$users->isEmpty()){
            $this->set('users', false);
        }
        else{
            $this->set('users', true);
        }
        $this->render('/Users/json/template');
    }

    /**
     * Find an user by it's email
     *
     * @param null $Email User's email.
     */
    public function email($Email = null)
    {
        $users = $this->Users->find('all', [
                'conditions' => ['users.email' => $Email]]
        );
        $this->set('users', $users);
        $this->render('/Users/json/template');
    }

    /**
     * Checks if an email is already taken.
     *
     * @param null $Email User's email.
     */
    public function emailExists($Email = null)
    {
        $users = $this->Users->find('all', [
                'conditions' => ['users.email' => $Email]]
        );
        $this->set('users', $users);
        if ($users->isEmpty()){
            $this->set('users', false);
        }
        else{
            $this->set('users', true);
        }
        $this->render('/Users/json/template');
    }

    /**
     * Find an user by it's api id
     *
     */
    public function findApiId()
    {
        $data = $this->getRequest()->getData();
        $ApiId = $data['api_id'];
        $LoginApi = $data['login_api'];
        $users = $this->Users->find('all', [
                'conditions' => [
                    'users.api_id' => $ApiId,
                    'users.login_api' => $LoginApi
                ]
            ]
        );
        $this->set('users', $users);
        $this->render('/Users/json/template');
    }


    /**
     * Find an admin by it's api id
     *
     */
    public function findApiIdAdmin()
    {
        $data = $this->getRequest()->getData();
        $ApiId = $data['api_id'];
        $LoginApi = $data['login_api'];
        $users = $this->Users->find('all', [
                'conditions' => [
                    'users.api_id' => $ApiId,
                    'users.login_api' => $LoginApi,
                    'users.is_admin' => 1
                ]
            ]
        );
        $this->set('users', $users);
        $this->render('/Users/json/template');
    }

    /**
     * Checks if an API ID already exists based on the API.
     */
    public function idExists()
    {
        $data = $this->getRequest()->getData();
        $ApiId = $data['api_id'];
        $LoginApi = $data['login_api'];
        $users = $this->Users->find('all', [
                'conditions' => [
                    'users.api_id' => $ApiId,
                    'users.login_api' => $LoginApi
                ]
            ]
        );
        $this->set('users', $users);
        if ($users->isEmpty()){
            $this->set('users', false);
        }
        else{
            $this->set('users', true);
        }
        $this->render('/Users/json/template');
    }
}
