<?php

use Core\Controller;
use App\Views\View;
use App\Models\MessageManager;
use App\Models\Message;

class MessageController extends Controller
{

    public function mailbox()
    {

        if (!isset($_SESSION['user']) || !$_SESSION['user']) {
            header('Location: /auth/login');
        }

        $messageManager = new MessageManager();
        $messages = $messageManager->getConversationsByUser($_SESSION['user']['id']);

        $interlocutors = [];
        foreach ($messages as $message) {
            $interlocutors[$message['interlocutor_id']] = $messageManager->getInterlocutor($message['interlocutor_id']);
        }

        $message = $messages;

        $view = new View('Boîte de réception');
        $view->render('message/mailbox', [
            'user' => $_SESSION['user'],
            'interlocutors' => $interlocutors
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