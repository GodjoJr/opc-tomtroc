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
            conv.interlocutor_id,
            u.u_username AS interlocutor_username,
            u.u_avatar AS interlocutor_avatar,
            m.m_content AS last_message,
            m.m_created_at AS last_message_date,
            DATE_FORMAT(m.m_created_at, '%H:%i') AS last_message_time,
            m.m_is_read AS is_read
        FROM (
            SELECT 
                CASE 
                    WHEN m_sender_id = :id THEN m_receiver_id 
                    ELSE m_sender_id 
                END AS interlocutor_id,
                MAX(m_created_at) AS last_message_date
            FROM messages
            WHERE m_sender_id = :id OR m_receiver_id = :id
            GROUP BY interlocutor_id
        ) conv
        JOIN messages m 
            ON (
                (m.m_sender_id = :id AND m.m_receiver_id = conv.interlocutor_id)
                OR (m.m_receiver_id = :id AND m.m_sender_id = conv.interlocutor_id)
            )
            AND m.m_created_at = conv.last_message_date
        JOIN users u ON u.u_id = conv.interlocutor_id
        ORDER BY conv.last_message_date DESC";

        $stmt = $this->db->query($sql, ['id' => $id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }



    public function getAllMessagesFromAConversation($receiver_id, $sender_id, $max = 5)
    {
        $sql = "SELECT * FROM messages WHERE (m_sender_id = :receiver_id AND m_receiver_id = :sender_id) OR (m_sender_id = :sender_id AND m_receiver_id = :receiver_id) ORDER BY m_created_at DESC LIMIT $max";
        $stmt = $this->db->query($sql, ['receiver_id' => $receiver_id, 'sender_id' => $sender_id]);
        return array_reverse($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function readMessages($receiver_id)
    {
        $sql = "UPDATE messages SET m_is_read = 1 
        WHERE m_receiver_id = :receiver_id";
        $this->db->query($sql, ['receiver_id' => $receiver_id]);

    }

    public function countUnreadMessages($recevier_id)
    {
        $sql = "SELECT COUNT(*) AS count FROM messages WHERE m_is_read = 0 AND m_receiver_id = :receiver_id";
        $stmt = $this->db->query($sql, ['receiver_id' => $recevier_id]);
        return $stmt->fetch()['count'];
    }
}