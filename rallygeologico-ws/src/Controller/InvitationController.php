<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Invitation Controller
 *
 * @property \App\Model\Table\InvitationTable $Invitation
 *
 * @method \App\Model\Entity\Invitation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InvitationController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void JSON Response.
     */
    public function index()
    {
        $invitation = $this->Invitation->find('all', [
            'contain' => ['Competition', 'UserSend', 'UserReceive']
        ]);

        $this->set(compact('invitation'));
        $this->set('_serialize', 'invitation');
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
     * @param string|null $id Invitation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invitation = $this->Invitation->get($id, [
            'contain' => ['Competition', 'UserSend', 'UserReceive']
        ]);

        $this->set('invitation', $invitation);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $invitation = $this->Invitation->newEntity();
        if ($this->getRequest()->is('post')) {
            $invitation = $this->Invitation->patchEntity($invitation, $this->getRequest()->getData());
            if ($this->Invitation->save($invitation)) {
                $this->Flash->success(__('The invitation has been saved.'));
            }
            $this->Flash->error(__('The invitation could not be saved. Please, try again.'));
        }
        $competition = $this->Invitation->Competition->find('list', ['limit' => 200]);
        $userSend = $this->Invitation->UserSend->find('list', ['limit' => 200]);
        $userReceive = $this->Invitation->UserReceive->find('list', ['limit' => 200]);
        $this->set(compact('invitation', 'competition', 'userSend', 'userReceive'));
        $this->render('/Invitation/json/template');
    }

    /**
     * Edit method
     *
     * @param string|null $id Invitation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invitation = $this->Invitation->get($id, [
            'contain' => []
        ]);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $invitation = $this->Invitation->patchEntity($invitation, $this->getRequest()->getData());
            if ($this->Invitation->save($invitation)) {
                $this->Flash->success(__('The invitation has been saved.'));
            }
            $this->Flash->error(__('The invitation could not be saved. Please, try again.'));
        }
        $competition = $this->Invitation->Competition->find('list', ['limit' => 200]);
        $userSend = $this->Invitation->UserSend->find('list', ['limit' => 200]);
        $userReceive = $this->Invitation->UserReceive->find('list', ['limit' => 200]);
        $this->set(compact('invitation', 'competition', 'userSend', 'userReceive'));
        $this->render('/Invitation/json/template');
    }

    /**
     * Delete method
     *
     * @param string|null $id Invitation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        $invitation = $this->Invitation->get($id);
        if ($this->Invitation->delete($invitation)) {
            $this->Flash->success(__('The invitation has been deleted.'));
        } else {
            $this->Flash->error(__('The invitation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Find an invitation by it's receiver id
     *
     * @param null $receiveId
     */
    public function receive($receiveId = null)
    {
        $invitations = $this->Invitation->find('all', [
                'conditions' => [
                    'Invitation.user_id_receive' => $receiveId,
                    'Invitation.accepted' => 0,
                    'Invitation.rejected' => 0
                ],
                'contain' => ['Competition', 'UserSend']
            ]
        );
        $this->set('invitation', $invitations);
        $this->render('/Invitation/json/template');
    }

    /**
     * Gets an invitation based on the receiver user id and the competition id.
     */
    public function userCompetitionInvitation() {
        $data = $this->getRequest()->getData();
        $UserIdReceive = $data['user_id_receive'];
        $CompetitionId = $data['competition_id'];
        $invitation = $this->Invitation->find('all', [
                'conditions' => [
                    'Invitation.user_id_receive' => $UserIdReceive,
                    'Invitation.competition_id' => $CompetitionId
                ]
            ]
        );
        $this->set('invitation', $invitation);
        $this->render('/Invitation/json/template');
    }
}
