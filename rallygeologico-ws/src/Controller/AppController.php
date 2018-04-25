<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * User Id
     */
    public $user_id;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->template = 'ajax';
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginAction'=>['controller'=>'Pages', 'action'=>'unauthorized', '_ext'=>'json'],
            'authorize'=>['Controller'],
            'authError'=>"Error"

        ]);
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    public function beforeFilter(Event $event)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->user_id = $this->Auth->user('id');

        // validate user token for logged user
        if($this->user_id) {
            if(!$this->checkUserToken()) {
                $this->Auth->logout(); // logout user
                throw new ForbiddenException("Invalid Token!");    // throw an 403 error
            }
        }
    }


    /**
     * Check User Token
     */
    public function checkUserToken()
    {
        $request_token = $this->getRequestToken();

        if (!$request_token) {
            return false;
        }

        if ($request_token != $this->userToken()) {
            return false;
        }
        return true;
    }

    /**
     * Get Request token
     */
    public function getRequestToken()
    {

        $headers = $this->getHeaders();
        if (!isset($headers['Authorization'])) return false;
        $token = explode(" ", $headers['Authorization']);
        return $token[1];
    }

    /**
     * Get Request headers
     */
    private function getHeaders()
    {
        $headers = getallheaders();
        return $headers;
    }

    /**
     * Get User token
     *
     */
    public function userToken()
    {
        return $this->Auth->user('token');
    }

    /**
     * Authorization default true
     */
    public function isAuthorized($user)
    {
        return false;
    }

}
