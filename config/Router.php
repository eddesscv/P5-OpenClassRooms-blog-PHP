<?php


namespace App\config;

use App\src\controller\BackController;
use App\src\controller\ErrorController;
use App\src\controller\FrontController;
use Exception;

class Router
{
    private $backController;
    private $errorController;
    private $frontController;
    private $request;
    public function __construct()
    {
        $this->backController = new BackController();
        $this->errorController = new ErrorController();
        $this->frontController = new FrontController();
        $this->request = new Request();
    }
    public function run()
    {
        try{
            $url = $this->request->getGet()->get('url');
            if(isset($url))
            {
                if($url === 'article'){
                    $this->frontController->article($this->request->getGet()->get('articleId'));
                }
                elseif($url === 'addArticle'){
                    $this->backController->addArticle($this->request->getPost());
                }
                elseif($url === 'editArticle'){
                    $this->backController->editArticle($this->request->getPost(), $this->request->getGet()->get('articleId'));
                }
                elseif($url === 'deleteArticle') {
                    $this->backController->deleteArticle($this->request->getGet()->get('articleId'));
                }
                elseif($url === 'addComment'){
                    $this->frontController->addComment($this->request->getPost(), $this->request->getGet()->get('articleId'));
                }
                elseif($url === 'flagComment'){
                    $this->frontController->flagComment($this->request->getGet()->get('commentId'));
                }
                elseif($url === 'unflagComment'){
                    $this->backController->unflagComment($this->request->getGet()->get('commentId'));
                }
                elseif($url === 'validComment'){
                    $this->backController->validComment($this->request->getGet()->get('commentId'));
                }
                elseif($url === 'deleteComment'){
                    $this->backController->deleteComment($this->request->getGet()->get('commentId'));
                }
                elseif($url === 'register'){
                    $this->frontController->register($this->request->getPost());
                }
                elseif($url === 'login'){
                    $this->frontController->login($this->request->getPost());
                }
                elseif($url === 'profile'){
                    $this->backController->profile();
                }
                elseif($url === 'updatePassword'){
                    $this->backController->updatePassword($this->request->getPost());
                }
                elseif($url === 'logout'){
                    $this->backController->logout();
                }
                elseif($url === 'deleteAccount'){
                    $this->backController->deleteAccount();
                }
                elseif($url === 'deleteUser'){
                    $this->backController->deleteUser($this->request->getGet()->get('userId'));
                }
                elseif($url === 'validerUser'){
                    $this->backController->validerUser($this->request->getGet()->get('userId'));
                }
                elseif($url === 'administration'){
                    $this->backController->administration();
                }
                elseif($url === 'search'){
                    $this->frontController->search($this->request->getPost());
                }
                elseif($url === 'blog'){
                    $this->frontController->blog();
                }
                elseif($url === 'sendMessage'){
                    $this->frontController->sendMessage($this->request->getPost());
                }
                elseif($url === 'deleteMessage') {
                    $this->backController->deleteMessage($this->request->getGet()->get('contactId'));
                }
                elseif($url === 'contact'){
                    $this->frontController->contact();
                }
                else{
                    $this->errorController->errorNotFound();
                }
            } else {
                $this->frontController->home();
            }
        } catch (Exception $e) {
            $this->errorController->errorServer();
        }
    }
}
