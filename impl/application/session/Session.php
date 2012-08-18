<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 02.08.12
 * Time: 20:44
 * To change this template use File | Settings | File Templates.
 */
class Session
{
    const FEEDBACK_MESSAGES = "feedback";

    public static function get()
    {
       if(!isset($_SESSION[Session::FEEDBACK_MESSAGES])){
           //init session
           $_SESSION[Session::FEEDBACK_MESSAGES] = array();
       }

       return new Session($_SESSION);
    }

    /**
     * @var array
     */
    private $sessionData;

    private function Session(array $sessionData){
        $this->sessionData = $sessionData;
    }

    public function getValue($key){
        return $this->sessionData[$key];
    }

    public function register($key, $value){
        $_SESSION[$key]=$value;
    }

    public function getFeedbackMessages(){
        $feedback = new FeedbackMessages();
        $messages = $_SESSION[Session::FEEDBACK_MESSAGES];
        foreach($messages as $message){
            $feedback->addMessage($message);
        }
        return $feedback;
    }

    public function registerMessage(FeedbackMessage $feedbackMessage){
        array_push( $_SESSION[Session::FEEDBACK_MESSAGES],$feedbackMessage);
    }

}
