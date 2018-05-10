<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

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

    /**
     * Allow not authorized users
     *
     * @param Event $event
     * @return \Cake\Http\Response|null|void
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
            'contain' => ['Competition']
        ]);

        $this->set('user', $user);
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
     * Find an user by it's email
     *
     * @param null $Email
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
}
