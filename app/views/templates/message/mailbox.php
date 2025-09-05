<div class="mailbox">

    <div class="container">

        <div class="left-container">
            <h1>Boîte de réception</h1>
            <pre>
                <!-- <?php var_dump($interlocutor); ?> -->
            </pre>

            <?php foreach ($discussions as $discussion): ?>
                <a href="/message/mailbox/<?= $discussion['interlocutor_id'] ?>"
                    class="discussion <?= $id == $discussion['interlocutor_id'] ? 'active' : '' ?>">
                    <img src="<?= $discussion['interlocutor_avatar'] ?: '/images/default-avatar.jpg' ?>"
                        alt="Image de <?= $discussion['interlocutor_username'] ?>">

                    <div class="message">
                        <div class="top-container">
                            <p class="username"><?= $discussion['interlocutor_username'] ?></p>
                            <p class="time"><?= $discussion['last_message_time'] ?></p>
                        </div>
                        <p class="last-message"><?= $discussion['last_message'] ?></p>

                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="right-container">

            <div class="top-container">
                <a href="/dashboard/profile/<?= urlencode($interlocutor->getUsername()) ?>">
                    <img src="<?= $interlocutor->getAvatar() ?: '/images/default-avatar.jpg' ?>"
                        alt="Avatar de <?= $interlocutor->getUsername() ?>">
                    <p class="username"><?= $interlocutor->getUsername() ?></p>
                </a>
            </div>

            <div class="all-messages">
                <?php foreach ($messages as $message): ?>
                    <?php if ($message['m_sender_id'] == $_SESSION['user']['id']): ?>
                        <div class="message right">
                            <p class="time"><?= date('d.m H:i', strtotime($message['m_created_at'])) ?></p>
                            <p class="content"><?= $message['m_content'] ?></p>
                        </div>
                    <?php else: ?>
                        <div class="message left">
                                <p class="time"><?= date('d.m H:i', strtotime($message['m_created_at'])) ?></p>
                            <p class="content"><?= $message['m_content'] ?></p>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <form action="/message/send" method="post">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="receiver" value="<?= $interlocutor->getId() ?>">
                <textarea name="message" id="message" cols="30" rows="10"
                    placeholder="Ecrivez votre message ici..."></textarea>
                <button type="submit">Envoyer</button>
            </form>

        </div>

    </div>
</div>