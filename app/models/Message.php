<?php

namespace App\Models;

use Core\ModelEntity;

class Message extends ModelEntity
{
    private int $sender;
    private int $receiver;
    private string $content;
    private bool $is_read = false;
    private string $created_at;

    public function getSender(): int
    {
        return $this->sender;
    }

    public function setSender(int $sender): self
    {
        $this->sender = $sender;
        return $this;
    }

    public function getReceiver(): int
    {
        return $this->receiver;
    }

    public function setReceiver(int $receiver): self
    {
        $this->receiver = $receiver;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getIsRead(): int
    {
        return $this->is_read ? 1 : 0;
    }

    public function setIsRead(bool $is_read): self
    {
        $this->is_read = $is_read;
        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }
}