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
 * @property \App\Model\Table\LoginTable $Login
 */
class LoginController extends AppController
{

    /**
     *  Initialize Controller
     */

    public function initialize()
    {
        $this->loadModel('User');
        parent::initialize();
    }


    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'logout']);
    }

    /**
     * Index Login method  API URL  /api/login method: POST
     * @return json response
     */
    public function index()
    {
        try {
            if(!isset($this->request->data['facebookId'])){
                throw new UnauthorizedException("Please enter your facebookId");
            }

            $facebookId  = $this->request->data['facebookId'];

            // Check for user credentials
            $user = $this->User->find('login', ['facebookId'=>$facebookId]);
            if(!$user) {
                throw new UnauthorizedException("Invalid login");
            }

            // if everything is OK set Auth session with user data
            $this->Auth->setUser($user->toArray());

            // Generate user Auth token
            $token =  Security::hash($user->id.$user->facebookId, 'sha1', true);
            // Add user token into Auth session
            $this->request->session()->write('Auth.User.token', $token);

            // return Auth token
            $this->response->header('Authorization', 'Bearer ' . $token);



        } catch (UnauthorizedException $e) {
            throw new UnauthorizedException($e->getMessage(),401);
        }
        $this->set('user', $this->Auth->user());
        $this->set('_serialize', ['user']);
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