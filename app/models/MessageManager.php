<?php
namespace App\Models;

use App\Models\Message;
use Core\ModelManager;
use Core\Error;

class MessageManager extends ModelManager
{
    public function createMessage(Message $message)
    {
        $sql = "INSERT INTO messages (m_sender_id, m_receiver_id, m_content, m_is_read) VALUES (:sender, :receiver, :content, :is_read)";
        $this->db->query($sql, [
            'sender' => $message->getSender(),
            'receiver' => $message->getReceiver(),
            'content' => $message->getContent(),
            'is_read' => $message->getIsRead()
        ]);
    }

    public function getConversationsByUser($id)
    {
        $sql = "SELECT 
                CASE 
                    WHEN m_sender_id = :id THEN m_receiver_id 
                    ELSE m_sender_id 
                END AS interlocutor_id,
                MAX(m_created_at) AS last_message
            FROM messages
            WHERE m_sender_id = :id OR m_receiver_id = :id
            GROUP BY interlocutor_id
            ORDER BY last_message DESC";

        $stmt = $this->db->query($sql, ['id' => $id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getInterlocutor($id)
    {
        $sql = "SELECT u_username FROM users WHERE u_id = :id";
        $stmt = $this->db->query($sql, ['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}