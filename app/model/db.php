<?php
class app_model_db extends core_model {
    protected $table = 'notes';

    /**
     *
     */
    public function add_post($id, $content) {
        $sql = "INSERT INTO `{$this->table}` (`id`, `content`, `time`) VALUES ( '$id',, '$content', NOW());";
        return $this->execute ( $sql );
    }

    /**
     *
     */
    public function list_post() {
        $sql = "SELECT * FROM `{$this->table}`";
        return $this->query ( $sql );
    }

    /**
     *
     */
    public function update_post($id, $title, $content) {
        $sql = "UPDATE `{$this->table}` SET `title` =  '$title',`content` = '$content' WHERE `notes`.`id` =$id";
        return $this->execute ( $sql );
    }

    /**
     *
     */
    public function get_post($id) {
        $sql = "SELECT * FROM `{$this->table}` WHERE `id` = $id";
        return $this->query ( $sql );
    }
}
?>