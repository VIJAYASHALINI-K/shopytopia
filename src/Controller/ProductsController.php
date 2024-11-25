<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Log\Log;

/**
 * Products Controller
 *
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->enableAutoLayout(false); 
        if($id != null){
            $product = $this->Products->get($id, [
                 'contain' => [],
            ]);
        }
        else{
            $product = $this->Products->find('all');
        }
        $this->set('products', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = '')
    {
        $this->viewBuilder()->enableAutoLayout(false); 
        $product = $this->Products->newEntity();
        
        if(empty($id)){
            if ($this->request->is('post')) {
                $product = $this->Products->patchEntity($product, $this->request->getData());
                if ($this->Products->save($product)) {
                    Log::debug(json_encode($product));
                    $result = ['status' => 'success', 'message' => 'Product added successfully!!!'];
                    return $this->response->withType("application/json")
                                          ->withStringBody(json_encode($result));                
                } else {
                    Log::debug(json_encode($product->getErrors()));
                    $result = ['status' => 'error', 'message' => 'Product is not added'];
                    return $this->response->withType("application/json")
                                          ->withStringBody(json_encode($result));
                }
            }
        }        
        $this->set(compact('product'));
    }

    public function edit($id = null) {
        $this->viewBuilder()->enableAutoLayout(false); 
        $product = $this->Products->get($id);
        if ($this->request->is(['post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $result = ['status' => 'success', 'message' => 'Product updated successfully!'];
                return $this->response->withType('application/json')
                                      ->withStringBody(json_encode($result));
            } else {
                $result = ['status' => 'error', 'message' => 'The product could not be updated. Please try again.'];
                return $this->response->withType('application/json')
                                      ->withStringBody(json_encode($result));
            }
        }
        $this->set(compact('product'));
    }
    

    public function delete($id = '') {
        $this->viewBuilder()->enableAutoLayout(false);
        Log::debug('inside here');
        if ($this->request->is('post')) {
            if(!empty($id)){
                $product = $this->Products->get($id);
                if ($this->Products->delete($product)) {
                    Log::debug('deleted');
                    $result = ['status' => 'success', 'message' => 'Product deleted successfully!!!'];
                    return $this->response->withType("application/json")
                                          ->withStringBody(json_encode($result));
                } else {
                    $result = ['status' => 'success', 'message' => "Error deleting product"];
                    return $this->response->withType("application/json")
                                          ->withStringBody(json_encode($result));
                }
            }
            else{
                $result = ['status' => 'success', 'message' => "The product could not be deleted. Please, try again."];
                return $this->response->withType("application/json")
                                          ->withStringBody(json_encode($result));
            }
        }
    }


}