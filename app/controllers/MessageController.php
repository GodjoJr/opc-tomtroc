<?php

use Core\Controller;
use App\Views\View;
use App\Models\MessageManager;
use App\Models\UsersManager;
use App\Models\Message;

class MessageController extends Controller
{

public function mailbox($id = null)
{
    if (!isset($_SESSION['user']) || !$_SESSION['user']) {
        header('Location: /auth/login');
        exit;
    }

    $messageManager = new MessageManager();
    $discussions = $messageManager->getConversationsByUser($_SESSION['user']['id']);


    if (empty($discussions) && empty($id)) {
        $view = new View('Boîte de réception');
        $view->render('message/mailbox', [
            'user' => $_SESSION['user'],
            'discussions' => [],
            'messages' => [],
            'interlocutor' => null,
            'id' => null
        ]);
        return; 
    }

    if (empty($id)) {
        $id = $discussions[0]['interlocutor_id'];
    }

    $messageManager->readMessages($_SESSION['user']['id']);

    $usersManager = new UsersManager();
    $interlocutor = $usersManager->findUserById($id) ?? null;

    if (!$interlocutor) {
        header('Location: /message/mailbox');
        exit;
    }

    $messages = $messageManager->getAllMessagesFromAConversation($id, $_SESSION['user']['id']);

    $view = new View('Boîte de réception');
    $view->render('message/mailbox', [
        'user' => $_SESSION['user'],
        'discussions' => $discussions,
        'messages' => $messages,
        'interlocutor' => $interlocutor,
        'id' => $id
    ]);
}


    public function send()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']) {
            header('Location: /auth/login');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('Erreur : jeton CSRF invalide.');
            }

            $sender = $_SESSION['user']['id'];
            $receiver = $_POST['receiver'] ?? null;
            $content = $_POST['message'] ?? null;

            if (!$sender || !$receiver || !$content) {
                header('Location: /dashboard/profile/' . $_SESSION['user']['username']);
                return;
            }

            $message = (new Message())
                ->setSender($sender)
                ->setReceiver($receiver)
                ->setContent($content);

            $messageManager = new MessageManager();
            $messageManager->createMessage($message);
            header('Location: /message/mailbox/' . $receiver);
        }
    }
}
