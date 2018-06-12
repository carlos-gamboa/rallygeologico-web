<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\InternalErrorException;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Event\Event;
use Cake\Utility\Text;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;

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


    /**
     * Allows public access to the web services.
     *
     * @param Event $event Access event
     * @return \Cake\Http\Response|null|void No response
     */
    public function beforeFilter(Event $event)
    {
        /*parent::beforeFilter($event);*/
        $this->Auth->allow();
    }

    /**
     * Get the active session user
     */
    public function activeSession(){
        $this->set('users', [$this->Auth->user()['0']]);
        $this->render('/Users/json/template');
    }

    /**
     * Index Login method  API URL  /api/login method: POST
     * @return json response
     */
    public function index()
    {
        try {
            $data = $this->getRequest()->getData();
            if(!isset($data['login_api'])){
                throw new UnauthorizedException("Please enter your FacebookId" . print_r($data, true));
            }
            
            $loginApi = $data['login_api'];
            
            if ($loginApi == 3){
                $users = $this->Auth->identify();
                if(!$users) {
                    throw new UnauthorizedException("Invalid login");
                }

                $this->Auth->setUser([$users]);

                // Generate user Auth token
                $token =  Security::hash($users['id'].$users['api_id'], 'sha1', true);
            } else {
                $apiId = $data['api_id'];

                // Check for user credentials
                $users = $this->Users->find('all', [
                    'conditions' => [
                        'Users.api_id' => $apiId,
                        'Users.login_api' => $loginApi
                    ]
                ]);
                if(!$users) {
                    throw new UnauthorizedException("Invalid login");
                }

                // if everything is OK set Auth session with user data
                $this->Auth->setUser($users->toArray());

                // Generate user Auth token
                $token =  Security::hash($users->id.$users->api_id, 'sha1', true);
            }

            // Add user token into Auth session
            $this->getRequest()->getSession()->write('Auth.User.token', $token);

            // return Auth token
            $this->getResponse()->header('Authorization', 'Bearer ' . $token);

        } catch (UnauthorizedException $e) {
            //throw new UnauthorizedException($e->getMessage(),401);
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
