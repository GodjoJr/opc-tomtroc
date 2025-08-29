<div class="mailbox" style="display: flex;">

    
    <div class="left-container">
        <h1>Boîte de réception</h1>
        <?php foreach ($interlocutors as $interlocutor): ?>
            <div class="message">
              <p><?= $interlocutor['u_username'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="right-container">
        
        <form action="/message/send" method="post">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <input type="hidden" name="receiver" value="<?= $receiver ?>">
            <textarea name="message" id="message" cols="30" rows="10"></textarea>
            <button type="submit">Envoyer</button>
        </form>
        
    </div>

</div>