<?php
/**
 * demo index
 */
class app_controller_index extends core_controller {
    public $param = array ();

    /**
     *
     */
    public function execute() {
        if (! isset ( $_COOKIE ['login'] ) || $_COOKIE ['login'] != true) {return $this->auth ();}
        try {
            $db = new app_model_db ();
            $r = $db->list_post ();
        } catch ( Exception $e ) {
            echo $e->getMessage ();
        }
        $this->view->assign ( 'list', $r );
        core_log::access ( 'index page visit' );
        $this->view->display ( 'page/index.html' );
    }

    /**
     *
     */
    public function edit() {
        if (isset ( $this->param ['id'] )) {
            $id = ( int ) $this->param ['id'];
            try {
                $db = new app_model_db ();
                $r = $db->get_post ( $id );
                $this->view->assign ( 'list', $db->list_post () );
                $this->view->assign ( 'action', 'update' );
                $this->view->assign ( 'post', $r [0] );
            } catch ( Exception $e ) {
                echo $e->getMessage ();
            }
        }
        core_log::access ( 'edit page visit' );
        $this->view->display ( 'page/index.html' );
    }

    /**
     *
     */
    public function post() {
        $id = strip_tags ( $this->param ['id'] );
        $title = strip_tags ( $this->param ['title'] );
        $action = strip_tags ( $this->param ['action'] );
        $content = strip_tags ( $this->param ['content'] );
        try {
            $db = new app_model_db ();
            if ($action == 'update') {
                $db->update_post ( $id, $title, $content );
            } else {
                $db->add_post ( $id, $title, $content );
            }
            echo '提交成功';
        } catch ( Exception $e ) {
            echo $e->getMessage ();
        }
    }

    public function auth() {
        return $this->view->display ( 'page/auth.html' );
    }
}
?>