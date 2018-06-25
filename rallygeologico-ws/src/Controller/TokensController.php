<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Tokens Controller
 *
 * @property \App\Model\Table\TokensTable $Tokens
 *
 * @method \App\Model\Entity\Token[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TokensController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $tokens = $this->Tokens->find('all', [
            'contain' => ['Users']
        ]);

        $this->set(compact('tokens'));
        // Specify which view vars JsonView should serialize.
        $this->set('_serialize', 'tokens');
        $this->render('/Tokens/json/template');
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
     * @param string|null $id Token id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $token = $this->Tokens->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('token', $token);
        $this->render('/Tokens/json/template');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $token = $this->Tokens->newEntity();
        if ($this->getRequest()->is('post')) {
            $token = $this->Tokens->patchEntity($token, $this->getRequest()->getData());
            if ($this->Tokens->save($token)) {
                $this->Flash->success(__('The token has been saved.'));
            }
            $this->Flash->error(__('The token could not be saved. Please, try again.'));
        }
        $users = $this->Tokens->Users->find('list', ['limit' => 200]);
        $this->set(compact('token', 'users'));
        $this->render('/Tokens/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id Token id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $token = $this->Tokens->get($id, [
            'contain' => []
        ]);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $token = $this->Tokens->patchEntity($token, $this->getRequest()->getData());
            if ($this->Tokens->save($token)) {
                $this->Flash->success(__('The token has been saved.'));
            }
            $this->Flash->error(__('The token could not be saved. Please, try again.'));
        }
        $users = $this->Tokens->Users->find('list', ['limit' => 200]);
        $this->set(compact('token', 'users'));
        $this->render('/Tokens/json/template');
    }

    /**
     * Delete method
     *
     * @param string|null $id Token id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        $token = $this->Tokens->get($id);
        if ($this->Tokens->delete($token)) {
            $this->Flash->success(__('The token has been deleted.'));
            $this->set('tokens', true);
        } else {
            $this->Flash->error(__('The token could not be deleted. Please, try again.'));
            $this->set('tokens', false);
        }

        $this->render('/Tokens/json/template');
    }

    public function getTokenByValue(){
        $data = $this->getRequest()->getData();
        $value = $data['value'];
        $tokens = $this->Tokens->find('all', [
                'conditions' => [
                    'Tokens.value' => $value
                ],
                'contain' => ['Users']
            ]
        );
        $this->set('tokens', $tokens);

        $this->render('/Tokens/json/template');
    }

    public function invalidateUserToken(){
        $data = $this->getRequest()->getData();
        $userId = $data['user_id'];
        $type = $data['type'];
        $this->Tokens->updateAll(
            ['is_valid' => 0],
            ['user_id' => $userId, 'type' => $type]
        );

        $this->set('tokens', true);

        $this->render('/Tokens/json/template');
    }
}
