<?php
class Friends{
    private $pdo;
    public function __construct($pdo){
        $this->pdo = $pdo;

    }

    public function makeFriendRequest($id,  $receiver_id)
    {
        $stmt = $this->pdo->prepare("INSERT INTO friends_requests(sender_id, receiver_id,state) VALUES(?, ?,?)");
        $stmt->execute([$id, $receiver_id, "pending"]);
        return $stmt->rowCount();
    }

    public function getFrinedsRequests( $user_id)
    {
        $stmt = $this->pdo->prepare("SELECT fr.id, fr.sender_id, fr.receiver_id, fr.state, u.id as user_id, u.first_name, u.last_name, u.email
        FROM friends_requests fr 
        JOIN users u ON fr.sender_id = u.id
        WHERE fr.receiver_id = ? AND fr.state = 'pending'
        ");
        $stmt->execute([$user_id]);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function acceptRequest( $id)
    {
        $stmt = $this->pdo->prepare("UPDATE friends_requests SET state = 'accepted' WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    public function getAllFriends(mixed $user_id)
    {
        $stmt = $this->pdo->prepare("SELECT fr.id, fr.sender_id, fr.receiver_id, fr.state, u.id as user_id, u.first_name, u.last_name, u.email
        FROM friends_requests fr 
        JOIN users u ON (fr.sender_id = u.id OR fr.receiver_id = u.id)
        WHERE (fr.receiver_id = ? OR fr.sender_id = ?)
          AND fr.state = 'accepted'
            AND u.id != ?
        ");
        $stmt->execute([$user_id, $user_id,$user_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function unfriend($request_id)
    {
        $stmt = $this->pdo->prepare("UPDATE friends_requests SET state = 'rejected' WHERE id = ?");
        $stmt->execute([$request_id]);
        return $stmt->rowCount();

    }


}
