<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Error\Debugger;
use Cake\Log\Log;
use Cake\Database;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;


class AccountsController extends AppController
{

    public function login()
    {
        $this->viewBuilder()->enableAutoLayout(false);
        $account = $this->Accounts->newEntity();

        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $password = $this->request->getData('password');
            Log::debug($email);
            Log::debug($password);
            // Find the account based on the email
            $accountExists = $this->Accounts->find()->select(['email', 'password'])->where(['email' => $email])->first();
            $hashPswdObj = new DefaultPasswordHasher();
            // Log for debugging
            Log::debug(json_encode($accountExists));

            // Check if an account was found and proceed with password verification
            if (!is_null($accountExists)) {
                
                if ($hashPswdObj->check($password, $accountExists->password)) {
                    // Login successful
                    Log::debug('success valid');
                    $result = ['status' => 'success', 'message' => 'Login successfull'];
                    return $this->response->withType("application/json")
                                        ->withStringBody(json_encode($result));
                } else {
                    // Invalid password
                    Log::debug('success invalid');
                    $result = ['status' => 'success', 'message' => 'Invalid password'];
                    return $this->response->withType("application/json")
                                        ->withStringBody(json_encode($result));
                }
            } 
            else{
                $account->email = $email;
                $account->password = $hashPswdObj->hash($password);

                if ($this->Accounts->save($account) && !empty($email) && !empty($password)) {
                    Log::debug('success');
                    $result = ['status' => 'success', 'message' => 'User is added'];
                    return $this->response->withType("application/json")
                                        ->withStringBody(json_encode($result));
                } else {
                    $result = ['status' => 'error', 'message' => 'User is not added'];
                    return $this->response->withType("application/json")
                                        ->withStringBody(json_encode($result));
                }
            }
        }
        $this->set(compact('account'));
    }


    public function logout(){
        $this->viewBuilder()->enableAutoLayout(false);
        $this->render('login');

    }
}