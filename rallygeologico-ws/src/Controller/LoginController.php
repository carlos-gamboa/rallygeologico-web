<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\InternalErrorException;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Event\Event;
use Cake\Utility\Text;
use Cake\Utility\Security;

/**
 * Login Controller
 *
 */
class LoginController extends AppController
{

    /**
     *  Initialize Controller
     */

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
    }


    public function beforeFilter(Event $event)
    {
        /*parent::beforeFilter($event);*/
        $this->Auth->allow();
    }

    /**
     * Index Login method  API URL  /api/login method: POST
     * @return json response
     */
    public function index()
    {
        try {
            $data = $this->request->getData();
            if(!isset($data['facebook_id'])){
                throw new UnauthorizedException("Please enter your FacebookId" . print_r($data, true));
            }

            $FacebookId = $data['facebook_id'];

            // Check for user credentials
            $users = $this->Users->find('all', [
                'conditions' => ['users.facebook_id' => $FacebookId]]);
            if(!$users) {
                throw new UnauthorizedException("Invalid login");
            }

            // if everything is OK set Auth session with user data
            $this->Auth->setUser($users->toArray());

            // Generate user Auth token
            $token =  Security::hash($users->id.$users->facebook_id, 'sha1', true);
            // Add user token into Auth session
            $this->request->getSession()->write('Auth.User.token', $token);

            // return Auth token
            $this->response->withAddedHeader('Authorization', 'Bearer ' . $token);

        } catch (UnauthorizedException $e) {
            throw new UnauthorizedException($e->getMessage(),401);
        }
        $this->set('users', $this->Auth->user());
        $this->render('/Users/json/template');
    }
    /**
     * Logout user
     * API URL  /api/login method: DELETE
     * @return json response
     */
    public function logout()
    {
        $this->Auth->logout();
        $this->set('message', 'You were logged out');
        $this->set('_serialize', ['message']);
    }
}
